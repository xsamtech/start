@extends('layouts.admin', ['page_title' => __('miscellaneous.menu.admin.complaints')])

@section('admin-content')

            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">@lang('miscellaneous.menu.admin.complaints')</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item">@lang('miscellaneous.menu.admin.complaints')</li>
                        </ul>
                    </div>
                </div>
                <!-- [ page-header ] end -->
                <!-- [ Main Content ] start -->
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-body">
                                <h5 class="mb-3">@lang('miscellaneous.menu.admin.complaints')</h5>

                                <!-- Data list content -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered border-top">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>@lang('miscellaneous.message_sent')</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
@forelse ($customer_feedbacks as $feedback)
                                            <tr>
                                                <td>
                                                    <img src="{{ $feedback['user']['avatar_url'] }}" alt="{{ $feedback['user']['firstname'] . ' ' . $feedback['user']['lastname'] }}" width="50" class="rounded-circle"><br>
                                                    <p class="m-0">{{ $feedback['user']['firstname'] . ' ' . $feedback['user']['lastname'] }}</p>
                                                </td>
                                                <td>
                                                    <p class="m-0" style="max-width: 280px; white-space: normal;">{{ $feedback['comment'] }}</p>
                                                </td>
                                                <td>
                                                    <img src="{{ count($feedback['for_product']['photos']) > 0 ? $feedback['for_product']['photos'][0]->file_url : getWebURL() . '/template/public/images/products/item6.jpg' }}" alt="{{ $feedback['for_product']['product_name'] }}" width="90" class="rounded"><br>
                                                    {{ $feedback['for_product']['product_name'] }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('product.entity.datas', ['entity' => $feedback['for_product']['type'], 'id' => $feedback['for_product']['id']]) }}" target="_blank">
                                                        @lang('miscellaneous.details')<i class="feather-chevrons-right ms-1"></i>
                                                    </a><br>
                                                </td>
                                            </tr>
@empty
                                            <tr>
                                                <td colspan="4" class="lead text-center">@lang('miscellaneous.empty_list')</td>
                                            </tr>
@endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-3">
                                    {{ $customer_feedbacks_req->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>

@endsection
