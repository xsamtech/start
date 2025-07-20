<?php

namespace App\Http\Controllers\API;

use App\Models\PaidFund;
use Illuminate\Http\Request;
use App\Http\Resources\PaidFund as ResourcesPaidFund;
use App\Models\Payment;
use App\Models\User;
use stdClass;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class PaidFundController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérer tous les produits avec leurs crowdfundings
        $paid_funds = PaidFund::with('crowdfunding')->get();

        // Regrouper les produits par catégorie
        $groupedProducts = $paid_funds->groupBy(function ($paid_fund) {
            return $paid_fund->crowdfunding->description;
        });

        // Transformer les données regroupées pour les envoyer dans la réponse
        // Ici on fait une ressource personnalisée pour chaque crowdfunding, tu peux adapter selon ce que tu veux retourner
        $groupedPaidFundsResource = $groupedProducts->map(function ($group) {
            return ResourcesPaidFund::collection($group); // ou créer une nouvelle ressource personnalisée pour chaque groupe
        });

        return $this->handleResponse($groupedPaidFundsResource, __('notifications.find_all_paid_funds_success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaidFund $paid_fund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaidFund $paid_fund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaidFund $paid_fund)
    {
        //
    }

    // ==================================== CUSTOM METHODS ====================================
    /**
     * Pay fund.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $paid_fund_id
     * @param  int $user_id
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request, $paid_fund_id, $user_id)
    {
        // FlexPay accessing data
        $gateway_mobile = config('services.flexpay.gateway_mobile');
        $gateway_card = config('services.flexpay.gateway_card_v2');
        // Vonage accessing data
        // $basic  = new \Vonage\Client\Credentials\Basic(config('vonage.api_key'), config('vonage.api_secret'));
        // $client = new \Vonage\Client($basic);

        $current_user = User::find($user_id);

        if (is_null($current_user)) {
            return $this->handleError(__('notifications.find_user_404'));
        }

        $paid_fund = PaidFund::find($paid_fund_id);

        if (is_null($paid_fund)) {
            return $this->handleError(__('notifications.find_paid_fund_404'));
        }

        // Validations
        if ($request->transaction_type_id == null OR !is_numeric($request->transaction_type_id)) {
            return $this->handleError($request->transaction_type_id, __('validation.required') . ' TRANSACTION FIELD', 400);
        }

        // If the transaction is via mobile money
        if ($request->transaction_type_id == 1) {
            $reference_code = 'REF-' . ((string) random_int(10000000, 99999999)) . '-' . $paid_fund->user_id;

            // Create response by sending request to FlexPay
            $data = array(
                'merchant' => config('services.flexpay.merchant'),
                'type' => 1,
                'phone' => $request->other_phone,
                'reference' => $reference_code,
                'amount' => $paid_fund->convertAmount($current_user->currency),
                'currency' => $current_user->currency,
                'callbackUrl' => getApiURL() . '/payment/store'
            );
            $data = json_encode($data);
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $gateway_mobile);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, Array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . config('services.flexpay.api_token')
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                return $this->handleError(curl_errno($ch), __('notifications.transaction_request_failed'), 400);

            } else {
                curl_close($ch); 

                $jsonRes = json_decode($response, true);
                $code = $jsonRes['code']; // Push sending status

                if ($code != '0') {
                    return $this->handleError(__('miscellaneous.error_label'), __('notifications.transaction_push_failed'), 400);

                } else {
                    // Register payment, even if FlexPay will
                    $payment = Payment::where('order_number', $jsonRes['orderNumber'])->first();

                    if (is_null($payment)) {
                        $payment = Payment::create([
                            'reference' => $reference_code,
                            'order_number' => $jsonRes['orderNumber'],
                            'amount' => $paid_fund->convertAmount($current_user->currency),
                            'phone' => $request->other_phone,
                            'currency' => $current_user->currency,
                            'channel' => $request->channel,
                            'type' => $request->transaction_type_id,
                            'status' => 1,
                            'paid_fund_id' => $paid_fund->id
                        ]);
                    }

                    $object = new stdClass();

                    $object->result_response = [
                        'message' => $jsonRes['message'],
                        'order_number' => $jsonRes['orderNumber']
                    ];
                    $object->paid_fund = new ResourcesPaidFund($paid_fund);

                    return $this->handleResponse($object, __('notifications.create_paid_fund_success'));
                }
            }
        }

        // If the transaction is via bank card
        if ($request->transaction_type_id == 2) {
            $reference_code = 'REF-' . ((string) random_int(10000000, 99999999)) . '-' . $paid_fund->user_id;

            // Create response by sending request to FlexPay
            $body = json_encode(array(
                'authorization' => 'Bearer ' . config('services.flexpay.api_token'),
                'merchant' => config('services.flexpay.merchant'),
                'reference' => $reference_code,
                'amount' => $paid_fund->convertAmount($current_user->currency),
                'currency' => $current_user->currency,
                'description' => __('miscellaneous.bank_transaction_description'),
                'callback_url' => getApiURL() . '/payment/store',
                'approve_url' => $request->app_url . '/paid/' . $paid_fund->convertAmount($current_user->currency) . '/' . $current_user->currency . '/0/paid_fund/' . $paid_fund->id,
                'cancel_url' => $request->app_url . '/paid/' . $paid_fund->convertAmount($current_user->currency) . '/' . $current_user->currency . '/1/paid_fund/' . $paid_fund->id,
                'decline_url' => $request->app_url . '/paid/' . $paid_fund->convertAmount($current_user->currency) . '/' . $current_user->currency . '/2/paid_fund/' . $paid_fund->id,
                'home_url' => $request->app_url . '/crowdfunding/' . $paid_fund->crowdfunding_id,
            ));

            $curl = curl_init($gateway_card);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $curlResponse = curl_exec($curl);

            $jsonRes = json_decode($curlResponse, true);
            $code = $jsonRes['code'];
            $message = $jsonRes['message'];

            if (!empty($jsonRes['error'])) {
                return $this->handleError($jsonRes['error'], $message, $jsonRes['status']);

            } else {
                if ($code != '0') {
                    return $this->handleError($code, $message, 400);

                } else {
                    $url = $jsonRes['url'];
                    $orderNumber = $jsonRes['orderNumber'];
                    // Register payment, even if FlexPay will
                    $payment = Payment::where('order_number', $orderNumber)->first();

                    if (is_null($payment)) {
                        $payment = Payment::create([
                            'reference' => $reference_code,
                            'order_number' => $orderNumber,
                            'amount' => $paid_fund->convertAmount($current_user->currency),
                            'phone' => $request->other_phone,
                            'currency' => $current_user->currency,
                            'channel' => $request->channel,
                            'type' => $request->transaction_type_id,
                            'status' => 1,
                            'paid_fund_id' => $paid_fund->id
                        ]);
                    }

                    $object = new stdClass();

                    $object->result_response = [
                        'message' => $message,
                        'order_number' => $orderNumber,
                        'url' => $url
                    ];
                    $object->paid_fund = new ResourcesPaidFund($paid_fund);

                    return $this->handleResponse($object, __('notifications.create_paid_fund_success'));
                }
            }
        }
    }
}
