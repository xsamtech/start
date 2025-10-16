@extends('layouts.admin', ['page_title' => __('miscellaneous.menu.dashboard')])

@section('admin-content')

            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">@lang('miscellaneous.menu.dashboard')</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">@lang('miscellaneous.menu.home')</li>
                        </ul>
                    </div>
                </div>
                <!-- [ page-header ] end -->
                <!-- [ Main Content ] start -->
                <div class="main-content">
                    <div class="row">
                        <!-- [Members] start -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-4">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div class="avatar-text avatar-lg bg-gray-200">
                                                <i class="feather-users"></i>
                                            </div>
                                            <div>
                                                <div class="fs-4 fw-bold text-dark"><span class="counter">{{ formatIntegerNumber($members_req->total()) }}</span></div>
                                                <h3 class="fs-13 fw-semibold text-truncate-1-line">{{ trans_choice('miscellaneous.admin.statistics.members.title', $members_req->total()) }}</h3>
                                            </div>
                                        </div>
                                        <a href="{{ route('dashboard.role.entity.home', ['entity' => 'members']) }}" class="">
                                            <i class="feather-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="pt-4">
    @php
        $memberTotal = $members_req->total() > 0 ? $members_req->total() : 1;
        $percent = ($members_disabled_req->total() / $memberTotal) * 100;
    @endphp
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="{{ route('dashboard.role.entity.home', ['entity' => 'members', 'status' => 'disabled']) }}" class="fs-12 fw-medium text-muted text-truncate-1-line">@lang('miscellaneous.admin.statistics.members.disabled.title') </a>
                                            <div class="w-100 text-end">
                                                <span class="fs-12 text-dark">{{ trans_choice('miscellaneous.admin.statistics.members.disabled.content', $members_disabled_req->total(), ['count' => $members_disabled_req->total()]) }}</span>
                                                <span class="fs-11 text-muted">({{ round($percent, 1) }}%)</span>
                                            </div>
                                        </div>
                                        <div class="progress mt-2 ht-3">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ round($percent, 1) }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [Members] end -->

                        <!-- [Products] start -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-4">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div class="avatar-text avatar-lg bg-gray-200">
                                                <i class="feather-box"></i>
                                            </div>
                                            <div>
                                                <div class="fs-4 fw-bold text-dark"><span class="counter">{{ formatIntegerNumber($products_req->total()) }}</span></div>
                                                <h3 class="fs-13 fw-semibold text-truncate-1-line">{{ trans_choice('miscellaneous.admin.statistics.products.title', $products_req->total()) }}</h3>
                                            </div>
                                        </div>
                                        <a href="{{ route('dashboard.category.entity.home', ['entity' => 'product']) }}" class="">
                                            <i class="feather-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="pt-4">
    @php
        $productTotal = $products_req->total() > 0 ? $products_req->total() : 1;
        $percent = ($products_unshared_req->total() / $productTotal) * 100;
    @endphp
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="{{ route('dashboard.category.entity.home', ['entity' => 'product', 'status' => 'unshared']) }}" class="fs-12 fw-medium text-muted text-truncate-1-line">@lang('miscellaneous.admin.statistics.products.unshared.title') </a>
                                            <div class="w-100 text-end">
                                                <span class="fs-12 text-dark">{{ trans_choice('miscellaneous.admin.statistics.products.unshared.content', $products_unshared_req->total(), ['count' => $products_unshared_req->total()]) }}</span>
                                                <span class="fs-11 text-muted">({{ round($percent, 1) }}%)</span>
                                            </div>
                                        </div>
                                        <div class="progress mt-2 ht-3">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ round($percent, 1) }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [Products] end -->

                        <!-- [Services] start -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-4">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div class="avatar-text avatar-lg bg-gray-200">
                                                <i class="feather-box"></i>
                                            </div>
                                            <div>
                                                <div class="fs-4 fw-bold text-dark"><span class="counter">{{ formatIntegerNumber($services_req->total()) }}</span></div>
                                                <h3 class="fs-13 fw-semibold text-truncate-1-line">{{ trans_choice('miscellaneous.admin.statistics.services.title', $services_req->total()) }}</h3>
                                            </div>
                                        </div>
                                        <a href="{{ route('dashboard.category.entity.home', ['entity' => 'service']) }}" class="">
                                            <i class="feather-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="pt-4">
    @php
        $serviceTotal = $services_req->total() > 0 ? $services_req->total() : 1;
        $percent = ($services_unshared_req->total() / $serviceTotal) * 100;
    @endphp
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="{{ route('dashboard.category.entity.home', ['entity' => 'service', 'status' => 'unshared']) }}" class="fs-12 fw-medium text-muted text-truncate-1-line">@lang('miscellaneous.admin.statistics.services.unshared.title') </a>
                                            <div class="w-100 text-end">
                                                <span class="fs-12 text-dark">{{ trans_choice('miscellaneous.admin.statistics.services.unshared.content', $services_unshared_req->total(), ['count' => $services_unshared_req->total()]) }}</span>
                                                <span class="fs-11 text-muted">({{ round($percent, 1) }}%)</span>
                                            </div>
                                        </div>
                                        <div class="progress mt-2 ht-3">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ round($percent, 1) }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [Services] end -->

                        <!-- [Projects] start -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-4">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div class="avatar-text avatar-lg bg-gray-200">
                                                <i class="feather-box"></i>
                                            </div>
                                            <div>
                                                <div class="fs-4 fw-bold text-dark"><span class="counter">{{ formatIntegerNumber($projects_req->total()) }}</span></div>
                                                <h3 class="fs-13 fw-semibold text-truncate-1-line">{{ trans_choice('miscellaneous.admin.statistics.projects.title', $projects_req) }}</h3>
                                            </div>
                                        </div>
                                        <a href="{{ route('dashboard.category.entity.home', ['entity' => 'project']) }}" class="">
                                            <i class="feather-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="pt-4">
    @php
        $projectTotal = $projects_req->total() > 0 ? $projects_req->total() : 1;
        $percent = ($projects_unshared_req->total() / $projectTotal) * 100;
    @endphp
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="{{ route('dashboard.category.entity.home', ['entity' => 'project', 'status' => 'unshared']) }}" class="fs-12 fw-medium text-muted text-truncate-1-line">@lang('miscellaneous.admin.statistics.projects.unshared.title') </a>
                                            <div class="w-100 text-end">
                                                <span class="fs-12 text-dark">{{ trans_choice('miscellaneous.admin.statistics.projects.unshared.content', $projects_unshared_req->total(), ['count' => $projects_unshared_req->total()]) }}</span>
                                                <span class="fs-11 text-muted">({{ round($percent, 1) }}%)</span>
                                            </div>
                                        </div>
                                        <div class="progress mt-2 ht-3">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ round($percent, 1) }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [Projects] end -->

                        <!-- [Payment Records] start -->
                        <div class="col-xxl-8">
                            <div class="card stretch stretch-full">
                                <div class="card-header">
                                    <h5 class="card-title">@lang('miscellaneous.admin.statistics.payment.title')</h5>
                                </div>
                                <div class="card-body custom-card-action p-0">
                                    <div style="width: 80%; margin: auto;">
                                        <canvas id="paymentsChart"></canvas>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row g-4">
                                        <div class="col-lg-4">
                                            <div class="p-3 border border-dashed rounded">
                                                <div class="fs-12 text-muted mb-1">@lang('miscellaneous.admin.statistics.payment.ongoing')</div>
                                                <h6 class="fw-bold text-dark">$5,486</h6>
                                                <div class="progress mt-2 ht-3">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 81%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="p-3 border border-dashed rounded">
                                                <div class="fs-12 text-muted mb-1">@lang('miscellaneous.admin.statistics.payment.done')</div>
                                                <h6 class="fw-bold text-dark">$9,275</h6>
                                                <div class="progress mt-2 ht-3">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 82%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="p-3 border border-dashed rounded">
                                                <div class="fs-12 text-muted mb-1">@lang('miscellaneous.admin.statistics.payment.canceled')</div>
                                                <h6 class="fw-bold text-dark">$3,868</h6>
                                                <div class="progress mt-2 ht-3">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 68%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>@lang('miscellaneous.admin.statistics.payment.data.reference')</th>
                                                    <th>@lang('miscellaneous.admin.statistics.payment.data.amount')</th>
                                                    <th>@lang('miscellaneous.admin.statistics.payment.data.channel')</th>
                                                    <th>@lang('miscellaneous.admin.statistics.payment.data.orders')</th>
                                                    <th>@lang('miscellaneous.admin.statistics.payment.data.order_delivered')</th>
                                                </tr>
                                            </thead>

                                            <tbody>
    @forelse ($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->reference }}</td>
                                                    <td>{{ $payment->amount . ' ' . $payment->currency }}</td>
                                                    <td>{{ $payment->channel }}</td>
                                                    <td>
                                                        <div class="list-group">
        @forelse ($payment->cart->customer_orders as $order)
                                                            <a href="{{ route('product.entity.datas', ['entity' => $order->product->id]) }}" class="list-group-item list-group-item-action">
                                                                <h3 class="mb-1">{{ $order->product->product_name }}</h3>
                                                                <p class="m-0 text-muted"><i class="bi bi-person me-2"></i>{{ $order->product->user->firstname . ' ' . $order->product->user->lastname }}</p>
                                                            </a>
        @empty
        @endforelse
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch pt-1 pb-0">
                                                            <input type="checkbox" role="switch" name="is_delivered-{{ $payment->cart->id }}" id="is_delivered-{{ $payment->cart->id }}" class="form-check-input" onchange="changeIs('delivered', this)"{{ $payment->cart->is_delivered == 1 ? ' checked' : '' }}>
                                                            <label class="form-check-label align-bottom text-{{ $payment->cart->is_delivered == 1 ? 'success' : 'danger' }}" for="is_delivered-{{ $payment->cart->id }}">
                                                                <i class="bi bi-{{ $payment->cart->is_delivered == 1 ? 'check' : 'x' }}-circle position-relative" style="top: -1.65px;"></i>
                                                                <small class="d-inline-block position-relative" style="top: -1.8px;">{{ $payment->cart->is_delivered == 1 ? __('miscellaneous.yes') : __('miscellaneous.no') }}</small>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
    @empty
                                                <tr>
                                                    <td colspan="5" class="lead text-center">@lang('miscellaneous.empty_list')</td>
                                                </tr>
    @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [Payment Records] end -->
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>

@endsection
