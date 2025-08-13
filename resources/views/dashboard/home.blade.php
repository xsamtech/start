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
        $percent = ($members_disabled_req->total() / $members_req->total()) * 100;
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
    @php
        $projects_req = 257836;
        $projects_unshared_req = 19577;
    @endphp
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-4">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div class="avatar-text avatar-lg bg-gray-200">
                                                <i class="feather-box"></i>
                                            </div>
                                            <div>
                                                <div class="fs-4 fw-bold text-dark"><span class="counter">{{ formatIntegerNumber($projects_req) }}</span></div>
                                                <h3 class="fs-13 fw-semibold text-truncate-1-line">{{ trans_choice('miscellaneous.admin.statistics.projects.title', $projects_req) }}</h3>
                                            </div>
                                        </div>
                                        <a href="{{ route('dashboard.category.entity.home', ['entity' => 'project']) }}" class="">
                                            <i class="feather-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="pt-4">
    @php
        $projectTotal = $projects_req > 0 ? $projects_req : 1;
        $percent = ($projects_unshared_req / $projectTotal) * 100;
    @endphp
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="{{ route('dashboard.category.entity.home', ['entity' => 'project', 'status' => 'unshared']) }}" class="fs-12 fw-medium text-muted text-truncate-1-line">@lang('miscellaneous.admin.statistics.projects.unshared.title') </a>
                                            <div class="w-100 text-end">
                                                <span class="fs-12 text-dark">{{ trans_choice('miscellaneous.admin.statistics.projects.unshared.content', $projects_unshared_req, ['count' => $projects_unshared_req]) }}</span>
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
                                    <h5 class="card-title">Payment Record</h5>
                                    <div class="card-header-action">
                                        <div class="card-header-btn">
                                            {{-- <div data-bs-toggle="tooltip" title="Delete">
                                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                            </div> --}}
                                            <div data-bs-toggle="tooltip" title="Refresh">
                                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"><i class="bi bi-reply"></i></a>
                                            </div>
                                            <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"><i class="bi bi-exp"></i></a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                                <div data-bs-toggle="tooltip" title="Options">
                                                    <i class="feather-more-vertical"></i>
                                                </div>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="feather-at-sign"></i>New</a>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="feather-calendar"></i>Event</a>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="feather-bell"></i>Snoozed</a>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="feather-trash-2"></i>Deleted</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="feather-settings"></i>Settings</a>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="feather-life-buoy"></i>Tips & Tricks</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body custom-card-action p-0">
                                    <div id="payment-records-chart"></div>
                                </div>
                                <div class="card-footer">
                                    <div class="row g-4">
                                        <div class="col-lg-3">
                                            <div class="p-3 border border-dashed rounded">
                                                <div class="fs-12 text-muted mb-1">Awaiting</div>
                                                <h6 class="fw-bold text-dark">$5,486</h6>
                                                <div class="progress mt-2 ht-3">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 81%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="p-3 border border-dashed rounded">
                                                <div class="fs-12 text-muted mb-1">Completed</div>
                                                <h6 class="fw-bold text-dark">$9,275</h6>
                                                <div class="progress mt-2 ht-3">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 82%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="p-3 border border-dashed rounded">
                                                <div class="fs-12 text-muted mb-1">Rejected</div>
                                                <h6 class="fw-bold text-dark">$3,868</h6>
                                                <div class="progress mt-2 ht-3">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 68%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="p-3 border border-dashed rounded">
                                                <div class="fs-12 text-muted mb-1">Revenue</div>
                                                <h6 class="fw-bold text-dark">$50,668</h6>
                                                <div class="progress mt-2 ht-3">
                                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 75%"></div>
                                                </div>
                                            </div>
                                        </div>
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
