@extends('layouts.app')

@section('app-content')

			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">@lang('miscellaneous.bank_transaction_description')</li>
						</ul>
					</div>
				</div>

                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="center-block text-center" style="max-width: 40rem; min-height: 30rem;">
@if (Route::is('transaction.waiting'))
                        <div style="margin: 3rem 0;">
                            <p class="lead text-center">
                                <svg id="Calque_1" width="100px" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 223.88 281.85"><defs><style>.cls-1{fill:#9a0000;}.cls-2{fill:#010101;}.cls-3{fill:#9b0000;}.cls-4{fill:#9b0202;}.cls-5{fill:#080808;}.cls-6{fill:#0a0a0a;}.cls-7{fill:#f2f2f2;}.cls-8{fill:#fafafa;}</style></defs><title>human-hand-holding-smartphone</title><path class="cls-1" d="M145.45,246.28c-1.65-6.78-4.81-12.06-7.28-17.56-10.06-22.43-20.35-44.76-30.49-67.16-3.25-7.18-1.6-13,4.2-15.7,7.05-3.28,13.93-.69,17.26,6.7,6.34,14.08,12.56,28.21,18.85,42.31.94,2.09,2,4.12,3.09,6.42,6.23-9.33,11.58-10.45,20.44-4.31,2,1.38,2.54,1.08,3.65-.88,3.72-6.59,10.28-8.48,16.81-4.58,2.45,1.46,3.36,1.81,5.28-.87,4.44-6.16,14.88-5.68,18.54,1.13,9.11,16.94,19.1,33.78,20.9,53.4,1.38,14.9-4,27.85-16.17,37.2-20.15,15.49-44.68,17.79-66.64,5.79-8-4.37-13.69-11.55-20.54-17.32C125,263.79,117,256.26,108.79,249c-3.68-3.27-3.61-6.58.75-9.12,8.22-4.79,16.64-3.51,24.84.1C137.94,241.54,141.2,243.83,145.45,246.28Z" transform="translate(-13.04 -13.95)"/><path class="cls-1" d="M119.62,221.13C99.89,242.64,67,255.08,39.48,238c-14-8.72-21-21.87-23.55-37.61-1-6.26-3.73-12.43-2.64-18.82,1.31-7.75,3.37-15.37,5.27-23,3.8-15.2,8.56-30,17.64-43.07,3.11-4.49,5-9.74,6.47-15,1.66-5.86,6.41-7.22,11.09-3,5.81,5.18,6.8,12,5.51,19.18-1.63,9.13-3.37,18.28-5.74,27.24-2.3,8.64-2.83,17.32-2.67,26.16s0,17.65,0,26.47a24.57,24.57,0,0,0,24.61,24.72c7.33.08,14.66,0,22,0Z" transform="translate(-13.04 -13.95)"/><path d="M156.71,109.48v-72c0-6.56-.16-6.73-6.71-6.73H70.53c-6.21,0-6.53.31-6.53,6.43,0,21.14,0,42.27-.43,63.57-2.86-6-9.43-9.33-8.72-18,1.19-14.4.74-29,.21-43.45A24.57,24.57,0,0,1,80.23,14c20.46.77,41,.49,61.46.1,13-.25,24,11.14,23.45,23.45-.89,19.12-.53,38.31-.07,57.46C165.23,101.74,164.16,106.86,156.71,109.48Z" transform="translate(-13.04 -13.95)"/><path class="cls-2" d="M63.89,196c1.18,2.52,3.45,2.14,5.6,2.14,15,0,30,.1,44.94-.1,3.19,0,4.68,1,5.76,3.86,1.52,4,3.44,7.92,5.31,11.81,1.07,2.25.92,3.2-2,3.18-15.31-.11-30.66.6-45.92-.26-11.38-.64-21.88-7.93-22.41-23.75-.17-5.16.37-10.36-.1-15.47-1.58-17.06,3.52-33.08,7.12-49.35,2.49,1,1.18,3.18,1.19,4.71.11,19.27.06,38.55.09,57.82C63.51,192.38,63.13,194.24,63.89,196Z" transform="translate(-13.04 -13.95)"/><path class="cls-3" d="M152.41,176.88c-4.34-.32-7.59-2.44-9.25-6.43-1.58-3.77-1.48-7.76,1.78-10.59,5.88-5.1,11.89-10.09,18.2-14.65,4.26-3.09,10.17-1.82,13.4,2.08s3.3,10.19-.62,13.65c-5.82,5.15-12.11,9.78-18.31,14.49A7.43,7.43,0,0,1,152.41,176.88Z" transform="translate(-13.04 -13.95)"/><path class="cls-3" d="M181.15,117.94a11.92,11.92,0,0,1-4.43,8.34c-4.19,3.51-8.47,6.93-12.85,10.2-5.35,4-10.64,3.43-14.6-1.3-3.78-4.52-3.31-10.39,1.56-14.62,4.5-3.92,9.2-7.62,14-11.18a9.1,9.1,0,0,1,10.67-.58A11.15,11.15,0,0,1,181.15,117.94Z" transform="translate(-13.04 -13.95)"/><path class="cls-4" d="M169.18,96.43c0-8.87.09-16.15,0-23.43,0-3.19,1.73-4.29,4.31-3.87,4.2.68,7.88,2.58,9.46,6.89,1.32,3.62,1.2,7.4-1.67,10.19C177.76,89.59,173.84,92.52,169.18,96.43Z" transform="translate(-13.04 -13.95)"/><path class="cls-5" d="M164.92,175.67c0,4-.13,7.13.05,10.27.13,2.31-.49,3.79-2.91,2.87-1.8-.69-4.84,2.41-5.2-1-.3-3-2.05-7.14,3-8.73C161.48,178.53,162.81,177.12,164.92,175.67Z" transform="translate(-13.04 -13.95)"/><path class="cls-6" d="M63.89,196c-1.5-1.53-.86-3.47-.87-5.23,0-19.14,0-38.28-.05-57.42,0-1.77.58-3.68-.75-5.29-.19-1.66.27-3.15,1.67-5.47Z" transform="translate(-13.04 -13.95)"/><path class="cls-7" d="M111.25,21h14.48c1.36,0,3,0,3.07,1.68.08,1.93-1.53,2.22-3.18,2.22q-14.48,0-29,0c-1.58,0-3.39-.23-3.35-2.09s2-1.78,3.46-1.79C101.59,21,106.42,21,111.25,21Z" transform="translate(-13.04 -13.95)"/><path class="cls-8" d="M113.31,201a6.22,6.22,0,0,1,5.52,5.91c.26,3.28-3.21,6.13-7,6s-5.72-2.17-5.8-5.92S108.4,200.94,113.31,201Z" transform="translate(-13.04 -13.95)"/></svg>
                            </p>
                            <p class="lead">@lang('notifications.transaction_waiting')</p>
                            <p>
                                <a href="{{ route('transaction.message', ['app_id' => '', 'orderNumber' => explode('-', request()->success_message)[0], 'userId' => explode('-', request()->success_message)[1]]) }}" class="btn strt-btn-green py-3 px-5 rounded-pill">
                                    <i class="fa-regular fa-thumbs-up"></i> OK
                                </a>
                            </p>
                        </div>
@else
    @if (!empty($status_code))

                        <div style="margin: 3rem 0;">
        @if ($status_code == '0')
                            <h1 class="bng-text-success" style="font-size: 10rem; margin-bottom: 3rem;"><span class="bi bi-check-circle text-success"></span></h1>
        @endif

        @if ($status_code == '1')
                            <h1 class="bng-text-warning" style="font-size: 10rem; margin-bottom: 3rem;"><span class="bi bi-exclamation-circle text-warning"></span></h1>
        @endif

        @if ($status_code == '2')
                            <h1 class="bng-text-danger" style="font-size: 10rem; margin-bottom: 3rem;"><span class="bi bi-x-circle text-danger"></span></h1>
        @endif
    @endif
                            <h4 style="font-weight: 500; margin: 0;">{{ \Session::has('error_message') ? \Session::get('error_message') : $message_content }}</h4>
                        </div>

    @if (!empty($payment))
                        <div class="clearfix" style="background-color: #e0e0e0; margin-bottom: 5rem; padding: 10px;">
                            <div class="pull-left text-left">
                                <p>{{ $payment->reference }}</p>
                                <h4 class="text-{{ $payment->status == 0 ? 'success' : ($payment->status == 1 ? 'warning' : 'danger') }}" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 700;">
                                    {{ $payment->amount . ' ' . $payment->currency }}
                                </h4>
                                <p style="margin: 0"><small>{{ $payment->created_at }}</small></p>
                            </div>
                            <div class="pull-right" style="padding-top: 1.5rem;">
                                <p class="text-black text-uppercase" style="font-weight: 500">{{ $payment->channel }}</p>
                                <span class="badge rounded-pill" style="font-weight: 600; background-color: {{ $payment->status == 0 ? 'green' : ($payment->status == 1 ? 'orange' : 'red') }}">
                                    {{ $payment->status == 0 ? __('miscellaneous.transaction_successful') : ($payment->status == 1 ? __('miscellaneous.transaction_pending') : __('miscellaneous.transaction_failed')) }}
                                </span>
                            </div>
                        </div>
    @endif
@endif
                    </div>
                </div><!-- End .container -->

			</section><!-- End #content -->
@endsection
