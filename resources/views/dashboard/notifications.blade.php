@extends('layouts.admin', ['page_title' => __('miscellaneous.menu.notifications')])

@section('admin-content')

            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">@lang('miscellaneous.menu.notifications')</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item">@lang('miscellaneous.menu.notifications')</li>
                        </ul>
                    </div>
                </div>
                <!-- [ page-header ] end -->
                <!-- [ Main Content ] start -->
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-body">
                                <h5 class="mb-3">@lang('miscellaneous.menu.notifications')</h5>

    @if (count($items['unread']) > 0 || count($items['read']) > 0)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="list-group">
	    @forelse ($items['unread'] as $notif)
                                            <a href="{{ $notif['url'] }}" class="list-group-item list-group-item-action bg-light">
                                                <div id="notificationItem" class="d-sm-flex justify-content-between">
                                                    <p style="margin-bottom: 0;">
                                                        <i class="fa-solid fa-circle text-primary"></i> {!! $notif['text'] !!}
                                                    </p>
                                                    <small class="text-muted fw-lighter">{{ ucfirst(explicitDate($notif['created_at'])) }}</small>
                                                </div>
                                            </a>
	    @empty
	    @endforelse
	    @forelse ($items['read'] as $notif)
                                            <a href="{{ $notif['url'] }}" class="list-group-item list-group-item-action">
                                                <div id="notificationItem" class="d-sm-flex justify-content-between">
                                                    <p style="margin-bottom: 0;">
                                                        {!! $notif['text'] !!}
                                                    </p>
                                                    <small class="text-muted fw-lighter">{{ ucfirst(explicitDate($notif['created_at'])) }}</small>
                                                </div>
                                            </a>
	    @empty
	    @endforelse
                                        </div>
                                    </div><!-- End .col-md-12 -->
                                </div><!-- End .row -->
    @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="display: flex; justify-content: center; align-items: flex-end; height: 100px;">
                                            <i class="bi bi-bell" style="font-size: 10rem"></i>
                                        </div>
                                        <h3 class="text-center">@lang('miscellaneous.empty_list')</h3>
                                    </div><!-- End .col-md-12 -->
                                </div><!-- End .row -->
    @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>

@endsection
