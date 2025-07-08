<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/**
 * @author Xanders
 * @see https://xsamtech.com
 */
class ApiClientManager
{
    /**
     * Manage API calling
     *
     * @param  $method
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function call($method, $url, $api_token = null, $data_to_send = [], $current_ip_address = null, $current_user_id = null, $data_json = false)
    {
        // Client used for accessing API
        $client = new Client();

        if ($data_json == true) {
            if ($current_ip_address != null AND $current_user_id != null) {
                try {
                    $response = $client->request($method, $url, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $api_token,
                            'Accept' => 'application/json',
                            'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale(),
                            'X-ip-address' => $current_ip_address,
                            'X-user-id' => $current_user_id,
                        ],
                        'json' => $data_to_send,
                        'verify' => false,
                    ]);
                    $result = json_decode($response->getBody(), false);

                    return $result;

                } catch (ClientException $e) {
                    $result = json_decode($e->getResponse()->getBody()->getContents(), false);

                    return $result;
                }

            } else {
                if ($current_ip_address != null AND $current_user_id == null) {
                    try {
                        $response = $client->request($method, $url, [
                            'headers' => [
                                'Authorization' => 'Bearer ' . $api_token,
                                'Accept' => 'application/json',
                                'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale(),
                                'X-ip-address' => $current_ip_address,
                            ],
                            'json' => $data_to_send,
                            'verify' => false,
                        ]);
                        $result = json_decode($response->getBody(), false);

                        return $result;

                    } catch (ClientException $e) {
                        $result = json_decode($e->getResponse()->getBody()->getContents(), false);

                        return $result;
                    }
                }

                if ($current_ip_address == null AND $current_user_id != null) {
                    try {
                        $response = $client->request($method, $url, [
                            'headers' => [
                                'Authorization' => 'Bearer ' . $api_token,
                                'Accept' => 'application/json',
                                'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale(),
                                'X-user-id' => $current_user_id,
                            ],
                            'json' => $data_to_send,
                            'verify' => false,
                        ]);
                        $result = json_decode($response->getBody(), false);

                        return $result;

                    } catch (ClientException $e) {
                        $result = json_decode($e->getResponse()->getBody()->getContents(), false);

                        return $result;
                    }
                }

                if ($current_ip_address == null AND $current_user_id == null) {
                    try {
                        $response = $client->request($method, $url, [
                            'headers' => [
                                'Authorization' => 'Bearer ' . $api_token,
                                'Accept' => 'application/json',
                                'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale(),
                            ],
                            'json' => $data_to_send,
                            'verify' => false,
                        ]);
                        $result = json_decode($response->getBody(), false);

                        return $result;

                    } catch (ClientException $e) {
                        $result = json_decode($e->getResponse()->getBody()->getContents(), false);

                        return $result;
                    }
                }
            }

        } else {
            if ($current_ip_address != null AND $current_user_id != null) {
                try {
                    $response = $client->request($method, $url, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $api_token,
                            'Accept' => 'application/json',
                            'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale(),
                            'X-ip-address' => $current_ip_address,
                            'X-user-id' => $current_user_id,
                        ],
                        'form_params' => $data_to_send,
                        'verify' => false,
                    ]);
                    $result = json_decode($response->getBody(), false);

                    return $result;

                } catch (ClientException $e) {
                    $result = json_decode($e->getResponse()->getBody()->getContents(), false);

                    return $result;
                }

            } else {
                if ($current_ip_address != null AND $current_user_id == null) {
                    try {
                        $response = $client->request($method, $url, [
                            'headers' => [
                                'Authorization' => 'Bearer ' . $api_token,
                                'Accept' => 'application/json',
                                'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale(),
                                'X-ip-address' => $current_ip_address,
                            ],
                            'form_params' => $data_to_send,
                            'verify' => false,
                        ]);
                        $result = json_decode($response->getBody(), false);

                        return $result;

                    } catch (ClientException $e) {
                        $result = json_decode($e->getResponse()->getBody()->getContents(), false);

                        return $result;
                    }
                }

                if ($current_ip_address == null AND $current_user_id != null) {
                    try {
                        $response = $client->request($method, $url, [
                            'headers' => [
                                'Authorization' => 'Bearer ' . $api_token,
                                'Accept' => 'application/json',
                                'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale(),
                                'X-user-id' => $current_user_id,
                            ],
                            'form_params' => $data_to_send,
                            'verify' => false,
                        ]);
                        $result = json_decode($response->getBody(), false);

                        return $result;

                    } catch (ClientException $e) {
                        $result = json_decode($e->getResponse()->getBody()->getContents(), false);

                        return $result;
                    }
                }

                if ($current_ip_address == null AND $current_user_id == null) {
                    try {
                        $response = $client->request($method, $url, [
                            'headers' => [
                                'Authorization' => 'Bearer ' . $api_token,
                                'Accept' => 'application/json',
                                'X-localization' => !empty(Session::get('locale')) ? Session::get('locale') : App::getLocale(),
                            ],
                            'form_params' => $data_to_send,
                            'verify' => false,
                        ]);
                        $result = json_decode($response->getBody(), false);

                        return $result;

                    } catch (ClientException $e) {
                        $result = json_decode($e->getResponse()->getBody()->getContents(), false);

                        return $result;
                    }
                }
            }
        }
    }
}
