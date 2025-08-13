<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="" />
        <meta name="keyword" content="" />
        <meta name="author" content="Xsam Technologies" />
        <meta name="strt-url" content="{{ getWebURL() }}">
        <meta name="strt-api-url" content="{{ getApiURL() }}">
        <meta name="strt-visitor" content="{{ !empty($current_user) ? $current_user->id : null }}">
        <meta name="strt-ref" content="{{ !empty($current_user) ? $current_user->api_token : null }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->

        <!--! BEGIN: Favicon-->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('assets/img/favicon/site.webmanifest') }}">
        <!--! END: Favicon-->

        <!--! BEGIN: Bootstrap CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/duralux/bootstrap.min.css') }}" />
        <!--! END: Bootstrap CSS-->
        <!--! BEGIN: Vendors CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/duralux/css/vendors.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/duralux/css/daterangepicker.min.css') }}" />
        <!--! END: Vendors CSS-->
        <!--! BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/custom/cropper/css/cropper.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/custom/sweetalert2/dist/sweetalert2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/custom/flatpickr/dist/flatpickr.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/duralux/theme.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />

        <style>
            textarea { resize: none; }
            .modal { z-index: 99999; }
            /* Image preview to upload */
            #image-preview-container { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
            .preview-thumbnail { position: relative; display: inline-block; width: 100px; height: 100px; }
            .preview-thumbnail img { width: 100%; height: 100%; object-fit: cover; border-radius: 5px; }
            .preview-thumbnail .remove-image { position: absolute; top: 0; right: 0; background-color: rgba(255, 0, 0, 0.7); color: white; border-radius: 50%; cursor: pointer; font-size: 14px; padding: 0 5.5px; }
            .preview-thumbnail .remove-image:hover { background-color: rgba(255, 0, 0, 0.3); }
        </style>
        <!--! END: Custom CSS-->
        <!--! HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries !-->
        <!--! WARNING: Respond.js doesn"t work if you view the page via file: !-->
        <!--[if lt IE 9]>
                <script src="https:oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https:oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

        <!--! BEGIN: Apps Title-->
        <title>
@if (!empty($page_title))
            {{ $page_title }}
@else
            @lang('miscellaneous.menu.dashboard')
@endif
        </title>
        <!--! END:  Apps Title-->
    </head>

    <body>
        <!--! ================================================================ !-->
        <!--! [Start] Modals !-->
        <!--! ================================================================ !-->
        <!-- ### Crop other user image ### -->
        <div class="modal fade" id="cropModal_profile" tabindex="-1" aria-hidden="true" data-bs-backdrop="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header py-0 border-bottom-0">
                        <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="@lang('miscellaneous.close')"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-center text-muted">@lang('miscellaneous.crop_before_save')</h5>

                        <div class="container">
                            <div class="row">
                                <div class="col-12 mb-sm-0 mb-4">
                                    <div class="bg-image">
                                        <img src="" id="retrieved_image_profile" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary px-4 rounded-pill text-white" data-bs-dismiss="modal">@lang('miscellaneous.cancel')</button>
                        <button type="button" id="crop_profile" class="btn btn-primary px-4 rounded-pill" data-bs-dismiss="modal">@lang('miscellaneous.register')</button>
                    </div>
                </div>
            </div>
        </div>
        <!--! ================================================================ !-->
        <!--! [End]  Modals !-->
        <!--! ================================================================ !-->
        <!--! ================================================================ !-->
        <!--! [Start] Navigation Manu !-->
        <!--! ================================================================ !-->
        <nav class="nxl-navigation">
            <div class="navbar-wrapper">
                <div class="m-header">
                    <a href="{{ route('dashboard.home') }}" class="b-brand">
                        <!-- ========   change your logo hear   ============ -->
                        <img src="{{ asset('assets/img/brand.png') }}" alt="" class="logo logo-lg" width="160" />
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" class="logo logo-sm" width="51" />
                    </a>
                </div>
                <div class="navbar-content">
                    <ul class="nxl-navbar">
                        <li class="nxl-item nxl-caption">
                            <label>Navigation</label>
                        </li>
                        <!-- Dashboard -->
                        <li class="nxl-item">
                            <a class="nxl-link" href="{{ route('dashboard.home') }}">
                                <span class="nxl-micon"><i class="feather-airplay"></i></span>
                                <span class="nxl-mtext">@lang('miscellaneous.menu.dashboard')</span>
                            </a>
                        </li>
                        <!-- Roles -->
                        <li class="nxl-item nxl-hasmenu">
                            <a href="javascript:void(0);" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-users"></i></span>
                                <span class="nxl-mtext">@lang('miscellaneous.menu.admin.role.title')</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('dashboard.role.home') }}">@lang('miscellaneous.admin.role.link')</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('dashboard.role.entity.home', ['entity' => 'admins']) }}">@lang('miscellaneous.menu.admin.role.admins')</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('dashboard.role.entity.home', ['entity' => 'members']) }}">@lang('miscellaneous.menu.admin.role.membres')</a></li>
                            </ul>
                        </li>
                        <!-- Sectors -->
                        <li class="nxl-item">
                            <a class="nxl-link" href="{{ route('dashboard.sector.home') }}">
                                <span class="nxl-micon"><i class="feather-airplay"></i></span>
                                <span class="nxl-mtext">@lang('miscellaneous.menu.admin.project_sectors')</span>
                            </a>
                        </li>
                        <!-- Categories -->
                        <li class="nxl-item nxl-hasmenu">
                            <a href="javascript:void(0);" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-users"></i></span>
                                <span class="nxl-mtext">@lang('miscellaneous.menu.admin.categories.title')</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('dashboard.category.home') }}">@lang('miscellaneous.admin.group.category.link')</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('dashboard.category.entity.home', ['entity' => 'project']) }}">@lang('miscellaneous.menu.admin.categories.projects')</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('dashboard.category.entity.home', ['entity' => 'product']) }}">@lang('miscellaneous.menu.admin.categories.products')</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('dashboard.category.entity.home', ['entity' => 'service']) }}">@lang('miscellaneous.menu.admin.categories.services')</a></li>
                            </ul>
                        </li>
                        <!-- Complaints -->
                        <li class="nxl-item">
                            <a class="nxl-link" href="{{ route('dashboard.complaints.home') }}">
                                <span class="nxl-micon"><i class="feather-airplay"></i></span>
                                <span class="nxl-mtext">@lang('miscellaneous.menu.admin.complaints')</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--! ================================================================ !-->
        <!--! [End]  Navigation Manu !-->
        <!--! ================================================================ !-->
        <!--! ================================================================ !-->
        <!--! [Start] Alert !-->
        <!--! ================================================================ !-->
        <div id="ajax-alert-container"></div>
@if (\Session::has('success_message'))
        <div class="row position-fixed w-100" style="opacity: 0.9; z-index: 99999;">
            <div class="col-lg-4 col-sm-6 mx-auto">
                <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
                    <i class="bi bi-info-circle me-2 fs-4" style="vertical-align: -3px;"></i> {!! \Session::get('success_message') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            </div>
        </div>
@endif
@if (\Session::has('error_message'))
        <div class="row position-fixed w-100" style="opacity: 0.9; z-index: 99999;">
            <div class="col-lg-4 col-sm-6 mx-auto">
                <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
                    <i class="bi bi-exclamation-triangle me-2 fs-4" style="vertical-align: -3px;"></i> {!! \Session::get('error_message') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            </div>
        </div>
@endif
        <!--! ================================================================ !-->
        <!--! [End]  Alert !-->
        <!--! ================================================================ !-->
        <!--! ================================================================ !-->
        <!--! [Start] Header !-->
        <!--! ================================================================ !-->
        <header class="nxl-header">
            <div class="header-wrapper">
                <!--! [Start] Header Left !-->
                <div class="header-left d-flex align-items-center gap-4">
                    <!--! [Start] nxl-head-mobile-toggler !-->
                    <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!--! [Start] nxl-head-mobile-toggler !-->
                    <!--! [Start] nxl-navigation-toggle !-->
                    <div class="nxl-navigation-toggle">
                        <a href="javascript:void(0);" id="menu-mini-button">
                            <i class="feather-align-left"></i>
                        </a>
                        <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                            <i class="feather-arrow-right"></i>
                        </a>
                    </div>
                    <!--! [End] nxl-navigation-toggle !-->

                    <!--! [Start] nxl-search !-->
                    <div class="dropdown nxl-h-item nxl-header-search">
                        <a href="javascript:void(0);" class="nxl-head-link me-0" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                            <i class="feather-search"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-start nxl-h-dropdown nxl-search-dropdown">
                            <div class="input-group search-form">
                                <span class="input-group-text">
                                    <i class="feather-search fs-6 text-muted"></i>
                                </span>
                                <input type="text" class="form-control search-input-field" placeholder="@lang('miscellaneous.search_input')" />
                                <span class="input-group-text">
                                    <button type="button" class="btn-close"></button>
                                </span>
                            </div>
                            <div class="dropdown-divider mt-0"></div>
                            <div class="search-items-wrapper">
                                <div class="searching-for px-4 py-2">
                                    <p class="fs-11 fw-medium text-muted">@lang('miscellaneous.search_info')</p>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a href="javascript:void(0);" class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">@lang('miscellaneous.menu.admin.project_sectors')</a>
                                        <a href="javascript:void(0);" class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">@lang('miscellaneous.admin.product.entity.project.plural')</a>
                                        <a href="javascript:void(0);" class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">@lang('miscellaneous.admin.product.data.category')</a>
                                        <a href="javascript:void(0);" class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">@lang('miscellaneous.admin.product.entity.product.plural')</a>
                                        <a href="javascript:void(0);" class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">@lang('miscellaneous.menu.public.products.services')</a>
                                        <a href="javascript:void(0);" class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">@lang('miscellaneous.menu.admin.role.membres')</a>
                                        <a href="javascript:void(0);" class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">@lang('miscellaneous.menu.admin.role.title')</a>
                                        <a href="javascript:void(0);" class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">@lang('miscellaneous.menu.admin.role.admins')</a>
                                        <a href="javascript:void(0);" class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">@lang('miscellaneous.menu.admin.complaints')</a>
                                    </div>
                                </div>
                                <div class="dropdown-divider my-3"></div>
                                <div class="users-result px-4 py-2">
                                    <h4 class="fs-13 fw-normal text-gray-600 mb-3">@lang('miscellaneous.search_members') <span class="badge small bg-gray-200 rounded ms-1 text-dark">{{ $members_req->total() }}</span></h4>
@forelse ($members as $user)
    @if ($loop->index < 3)
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-image rounded">
                                                <img src="{{ $user['avatar_url'] }}" alt="{{ $user['firstname'] . ' ' . $user['lastname'] }}" class="img-fluid" />
                                            </div>
                                            <div>
                                                <a href="{{ route('dashboard.role.entity.datas', ['entity' => 'members', 'id' => $user['id']]) }}" class="font-body fw-bold d-block mb-1">{{ $user['firstname'] . ' ' . $user['lastname'] }}</a>
                                                <p class="fs-11 text-muted mb-0">{{ !empty($user['email']) ? $user['email'] : $user['phone'] }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('dashboard.role.entity.datas', ['entity' => 'members', 'id' => $user['id']]) }}" class="avatar-text avatar-md">
                                            <i class="feather-chevron-right"></i>
                                        </a>
                                    </div>
    @endif
@empty
@endforelse
                                </div>

                                <div class="dropdown-divider my-3"></div>
                                <div class="file-result px-4 py-2">
                                    <h4 class="fs-13 fw-normal text-gray-600 mb-3">@lang('miscellaneous.search_sectors') <span class="badge small bg-gray-200 rounded ms-1 text-dark">{{ $sectors_req->total() }}</span></h4>
@forelse ($sectors as $sector)
    @if ($loop->index < 3)
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <a href="{{ route('dashboard.sector.datas', ['id' => $sector['id']]) }}" class="font-body fw-bold d-block mb-1">{{ $sector['sector_name'] }}</a>
                                            </div>
                                        </div>
                                        <a href="{{ route('dashboard.sector.datas', ['id' => $sector['id']]) }}" class="avatar-text avatar-md">
                                            <i class="feather-chevron-right"></i>
                                        </a>
                                    </div>
    @endif
@empty
@endforelse
                                </div>

                                <div class="dropdown-divider my-3"></div>
                                <div class="file-result px-4 py-2">
                                    <h4 class="fs-13 fw-normal text-gray-600 mb-3">@lang('miscellaneous.search_categories') <span class="badge small bg-gray-200 rounded ms-1 text-dark">{{ $categories_req->total() }}</span></h4>
@forelse ($m_categories as $category)
    @if ($loop->index < 3)
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <a href="{{ route('dashboard.category.datas', ['id' => $category['id']]) }}" class="font-body fw-bold d-block mb-1">{{ $category['category_name'] }}</a>
                                            </div>
                                        </div>
                                        <a href="{{ route('dashboard.category.datas', ['id' => $category['id']]) }}" class="avatar-text avatar-md">
                                            <i class="feather-chevron-right"></i>
                                        </a>
                                    </div>
    @endif
@empty
@endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--! [End] nxl-search !-->

                </div>
                <!--! [End] Header Left !-->
                <!--! [Start] Header Right !-->
                <div class="header-right ms-auto">
                    <div class="d-flex align-items-center">
                        <div class="dropdown nxl-h-item nxl-header-language d-none d-sm-flex">
                            <a href="javascript:void(0);" class="nxl-head-link me-0 nxl-language-link" data-bs-toggle="dropdown" data-bs-auto-close="outside">
@if (app()->getLocale() == 'en')
                                <img src="{{ asset('assets/addons/duralux/img/flags/4x3/us.svg') }}" alt="" class="img-fluid wd-20" />
@else
                                <img src="{{ asset('assets/addons/duralux/img/flags/4x3/fr.svg') }}" alt="" class="img-fluid wd-20" />
@endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-language-dropdown">
                                <div class="dropdown-divider mt-0"></div>
                                <div class="language-items-wrapper">
                                    <div class="select-language px-4 py-2 hstack justify-content-between gap-4">
                                        <div class="lh-lg">
                                            <h6 class="mb-0">@lang('miscellaneous.your_language')</h6>
                                            {{-- <p class="fs-11 text-muted mb-0">2 languages avaiable!</p> --}}
                                        </div>
                                        {{-- <a href="javascript:void(0);" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Add Language">
                                            <i class="feather-plus"></i>
                                        </a> --}}
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div class="row px-4 pt-3">
                                        <div class="col-sm-4 col-6 language_select">
                                            <a href="{{ route('change_language', ['locale' => 'en']) }}" class="d-flex align-items-center gap-2">
                                                <div class="avatar-image avatar-sm"><img src="{{ asset('assets/addons/duralux/img/flags/4x3/us.svg') }}" alt="" class="img-fluid" /></div>
                                                <span>English</span>
                                            </a>
                                        </div>
                                        <div class="col-sm-4 col-6 language_select">
                                            <a href="{{ route('change_language', ['locale' => 'fr']) }}" class="d-flex align-items-center gap-2">
                                                <div class="avatar-image avatar-sm"><img src="{{ asset('assets/addons/duralux/img/flags/4x3/fr.svg') }}" alt="" class="img-fluid" /></div>
                                                <span>Français</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nxl-h-item d-none d-sm-flex">
                            <div class="full-screen-switcher">
                                <a href="javascript:void(0);" class="nxl-head-link me-0" onclick="$('body').fullScreenHelper('toggle');">
                                    <i class="feather-maximize maximize"></i>
                                    <i class="feather-minimize minimize"></i>
                                </a>
                            </div>
                        </div>
                        <div class="nxl-h-item dark-light-theme">
                            <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button">
                                <i class="feather-moon"></i>
                            </a>
                            <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display: none">
                                <i class="feather-sun"></i>
                            </a>
                        </div>
                        <div class="dropdown nxl-h-item">
                            <a class="nxl-head-link me-3" data-bs-toggle="dropdown" href="#" role="button" data-bs-auto-close="outside">
                                <i class="feather-bell"></i>
                                <span class="badge bg-danger nxl-h-badge"></span>
                            </a>
                            {{-- <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-notifications-menu">
                                <div class="d-flex justify-content-between align-items-center notifications-head">
                                    <h6 class="fw-bold text-dark mb-0">Notifications</h6>
                                    <a href="javascript:void(0);" class="fs-11 text-success text-end ms-auto" data-bs-toggle="tooltip" title="Make as Read">
                                        <i class="feather-check"></i>
                                        <span>Make as Read</span>
                                    </a>
                                </div>
                                <div class="notifications-item">
                                    <img src="/assets/images/avatar/4.png" alt="" class="rounded me-3 border" />
                                    <div class="notifications-desc">
                                        <a href="javascript:void(0);" class="font-body text-truncate-2-line"> <span class="fw-semibold text-dark">Archie Cantones</span> Don't forget to pickup Jeremy after school!</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="notifications-date text-muted border-bottom border-bottom-dashed">53 minutes ago</div>
                                            <div class="d-flex align-items-center float-end gap-2">
                                                <a href="javascript:void(0);" class="d-block wd-8 ht-8 rounded-circle bg-gray-300" data-bs-toggle="tooltip" title="Make as Read"></a>
                                                <a href="javascript:void(0);" class="text-danger" data-bs-toggle="tooltip" title="Remove">
                                                    <i class="feather-x fs-12"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center notifications-footer">
                                    <a href="javascript:void(0);" class="fs-13 fw-semibold text-dark">Alls Notifications</a>
                                </div>
                            </div> --}}
                        </div>
                        <div class="dropdown nxl-h-item">
                            <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button" data-bs-auto-close="outside">
                                <img src="{{ $current_user['avatar_url'] ?? asset('assets/img/user.png') }}" alt="user-image" class="img-fluid user-avtar me-0" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                                <div class="dropdown-header">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $current_user['avatar_url'] }}" alt="user-image" class="img-fluid user-avtar" />
                                        <div>
                                            <h6 class="text-dark mb-0">{{ $current_user['firstname'] . ' ' . $current_user['lastname']  }} <span class="badge bg-soft-success text-success ms-1">ADMIN</span></h6>
                                            <span class="fs-12 fw-medium text-muted">{{ !empty($current_user['email']) ? $current_user['email'] : $current_user['phone'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('account.home') }}" class="dropdown-item">
                                    <i class="feather-settings"></i>
                                    <span>@lang('miscellaneous.menu.account.title')</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
@csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="feather-log-out"></i>
                                        <span>@lang('miscellaneous.logout')</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--! [End] Header Right !-->
            </div>
        </header>
        <!--! ================================================================ !-->
        <!--! [End] Header !-->
        <!--! ================================================================ !-->
        <!--! ================================================================ !-->
        <!--! [Start] Main Content !-->
        <!--! ================================================================ !-->
        <main class="nxl-container">
@yield('admin-content')
            <!-- [ Footer ] start -->
            <footer class="footer">
                <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
                    <span>Copyright ©</span>
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    <a href="https://start-africa.com" target="_blank">START</a>
                </p>
                <div class="d-flex align-items-center gap-1">
                    <span>Designed by</span> <a href="https://xsamtech.com" target="_blank" class="fs-11 fw-semibold text-uppercase">Xsam Technologies</a>
                </div>
            </footer>
            <!-- [ Footer ] end -->
        </main>
        <!--! ================================================================ !-->
        <!--! [End] Main Content !-->
        <!--! ================================================================ !-->
        <!--! ================================================================ !-->
        <!--! Footer Script !-->
        <!--! ================================================================ !-->
        <!--! BEGIN: Vendors JS !-->
        <script src="{{ asset('assets/addons/duralux/js/vendors.min.js') }}"></script>
        <!-- vendors.min.js {always must need to be top} -->
        <script src="{{ asset('assets/addons/custom/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/addons/duralux/js/daterangepicker.min.js') }}"></script>
@if (Route::is('dashboard.home'))
        <script src="{{ asset('assets/addons/duralux/js/apexcharts.min.js') }}"></script>
@endif
        <script src="{{ asset('assets/addons/duralux/js/circle-progress.min.js') }}"></script>
        <!--! END: Vendors JS !-->
        <!--! BEGIN: Apps Init  !-->
        <script src="{{ asset('assets/js/duralux/common-init.min.js') }}"></script>
@if (Route::is('dashboard.home'))
        <script src="{{ asset('assets/js/duralux/dashboard-init.min.js') }}"></script>
@endif
        <!--! END: Apps Init !-->
        <!--! BEGIN: Theme Customizer  !-->
        <script src="{{ asset('assets/js/duralux/theme-customizer-init.min.js') }}"></script>
        <!--! END: Theme Customizer !-->
        <!--! BEGIN: Custom JS  !-->
        <script type="text/javascript" src="{{ asset('assets/addons/custom/flatpickr/dist/flatpickr.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/addons/custom/flatpickr/dist/fr.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/addons/custom/cropper/js/cropper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/addons/custom/autosize/js/autosize.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/addons/custom/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
        <script type="text/javascript">
            // Custom switch
            $('[data-toggle="switchbutton"]').bootstrapSwitchButton();
            // Common variables
            const navigator = window.navigator;
            const currentLanguage = $('html').attr('lang');
            const browserLanguage = (navigator.language || navigator.userLanguage).substring(0, 2);
            const currentUser = $('[name="strt-visitor"]').attr('content');
            const currentHost = $('[name="strt-url"]').attr('content');
            const apiHost = $('[name="strt-api-url"]').attr('content');
            // Preview images
            const retrievedImageProfile = document.getElementById('retrieved_image_profile');
            const currentImageProfile = document.querySelector('#profileImageWrapper img');
            let locale = currentLanguage === 'fr' ? 'fr' : 'en';
            let cropper;

            /**
             * Toggle Password Visibility
             * 
             * @param string current
             * @param string element
             */
            function passwordVisible(current, element) {
                var el = document.getElementById(element);

                if (el.type === 'password') {
                    el.type = 'text';
                    current.innerHTML = '<i class="bi bi-eye-slash-fill"></i>'

                } else {
                    el.type = 'password';
                    current.innerHTML = '<i class="bi bi-eye-fill"></i>'
                }
            }

            /**
             * Show alert on Ajax
             * 
             * @param string current
             * @param string element
             */
            function showAjaxAlert(type, message) {
                const icon = type === 'success'
                    ? '<i class="bi bi-info-circle me-2 fs-4" style="vertical-align: -3px;"></i>'
                    : '<i class="bi bi-exclamation-triangle me-2 fs-4" style="vertical-align: -3px;"></i>';

                const alertHtml = `
                    <div class="position-relative">
                        <div class="row position-fixed w-100" style="opacity: 0.9; z-index: 999;">
                            <div class="col-lg-4 col-sm-6 mx-auto">
                                <div class="alert alert-${type} alert-dismissible fade show rounded-0 cnpr-line-height-1_1" role="alert">
                                    ${icon} ${message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                                </div>
                            </div>
                        </div>
                    </div>`;

                $('#ajax-alert-container').html(alertHtml);

                // Auto-dismiss après 5 secondes
                setTimeout(() => {
                    $('.alert').alert('close');
                }, 5000);
            }

            /**
             * Flatpickr : DateTime picker
             */
            flatpickr("#birthdate", {
                dateFormat: "d/m/Y",  // Affiche la date comme "DD/MM/YYYY"
                locale: locale,
                onChange: function(selectedDates, dateStr, instance) {
                    // Format MySQL avant l'envoi (automatique au submit)
                    instance.input.value = selectedDates[0].toISOString().split('T')[0]; // YYYY-MM-DD
                }
            });

            $(function () {
                /* On check, show/hide some blocs */
                // OFFER TYPE
                $('#donationType .form-check-input').each(function () {
                    $(this).on('click', function () {
                        if ($('#anonyme').is(':checked')) {
                            $('#donorIdentity, #otherDonation').addClass('d-none');

                        } else {
                            $('#donorIdentity, #otherDonation').removeClass('d-none');
                        }
                    });
                });

                // TRANSACTION TYPE
                $('#paymentMethod .radio-inline').each(function () {
                    $(this).on('click', function () {
                        if ($('#bank_card').is(':checked')) {
                            $('#phoneNumberForMoney').addClass('d-none');

                        } else {
                            $('#phoneNumberForMoney').removeClass('d-none');
                        }
                    });
                });

                /* Auto-resize textarea */
                autosize($('textarea'));

                $('#image_profile').on('change', function (e) {
                    var files = e.target.files;
                    var done = function (url) {
                        retrievedImageProfile.src = url;
                        var modal = new bootstrap.Modal(document.getElementById('cropModal_profile'), { keyboard: false });

                        modal.show();
                    };

                    if (files && files.length > 0) {
                        var reader = new FileReader();

                        reader.onload = function () {
                            done(reader.result);
                        };
                        reader.readAsDataURL(files[0]);
                    }
                });

                $('#cropModal_profile').on('shown.bs.modal', function () {
                    cropper = new Cropper(retrievedImageProfile, {
                        aspectRatio: 1,
                        viewMode: 3,
                        preview: '#cropModal_profile .preview'
                    });

                }).on('hidden.bs.modal', function () {
                    cropper.destroy();

                    cropper = null;
                });

                $('#cropModal_profile #crop_profile').on('click', function () {
                    var canvas = cropper.getCroppedCanvas({
                        width: 700,
                        height: 700
                    });

                    canvas.toBlob(function (blob) {
                        URL.createObjectURL(blob);
                        var reader = new FileReader();

                        reader.readAsDataURL(blob);
                        reader.onloadend = function () {
                            var base64_data = reader.result;

                            $(currentImageProfile).attr('src', base64_data);
                            $('#image_64').attr('value', base64_data);
                        };
                    });
                });

                /**
                 * Image preview to upload
                 */
                $('#files_urls').on('change', function (e) {
                    // Récupérer les fichiers
                    const files = e.target.files;
                    const imagePreviewContainer = $('#image-preview-container');

                    // Effacer les vignettes existantes
                    imagePreviewContainer.empty();

                    // Créer une vignette pour chaque fichier sélectionné
                    Array.from(files).forEach(file => {
                        const reader = new FileReader();

                        reader.onload = function (e) {

                            const imageUrl = e.target.result;
                            const fileName = file.name;

                            // Créer l'élément de la vignette avec la croix
                            const imageThumbnail = $(`
                            <div class="preview-thumbnail">
                                <img src="${imageUrl}" alt="${fileName}" />
                                <span class="remove-image">&times;</span>
                                </div>
                                `);

                            // Ajouter la vignette au conteneur
                            imagePreviewContainer.append(imageThumbnail);

                            // Gérer la suppression de l'image
                            imageThumbnail.find('.remove-image').on('click', function () {

                                // Supprimer le fichier de l'input
                                const fileList = Array.from($('#files_urls')[0].files);
                                const index = fileList.findIndex(f => f.name === fileName);

                                if (index !== -1) {
                                    fileList.splice(index, 1);
                                }

                                // Mettre à jour les fichiers de l'input
                                $('#files_urls')[0].files = new FileListItems(fileList);

                                // Supprimer la vignette de l'UI
                                imageThumbnail.remove();
                            });
                        };

                        reader.readAsDataURL(file);
                    });
                });

                /**
                 * Ajax to send
                 */
                /* Product form */
                $('#productForm').on('submit', function (e) {
                    e.preventDefault();

                    // Afficher l'animation de chargement
                    $('#loading-icon').show();

                    // Effacer les alertes précédentes
                    $('#ajax-alert-container').empty();

                    var formData = new FormData(this);

                    // Ajouter les images à FormData (dans le cas où il y en a)
                    var images = $('#files_urls')[0].files;

                    for (var i = 0; i < images.length; i++) {
                        formData.append('files_urls[' + i + ']', images[i]);
                    }

                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            // Cacher l'animation de chargement
                            $('#loading-icon').hide();

                            // Afficher une alerte de succès
                            $('#ajax-alert-container').html(`<div style="position: fixed; z-index: 9999; width: 100%; display: flex; justify-content: center;">
                                                                <div class="alert alert-success alert-dismissible" role="alert" style="width: 500px;">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <i class="bi bi-check-circle" style="margin-right: 8px; vertical-align: -2px;"></i>
                                                                    ${response.message || 'Produit ajouté avec succès !'}
                                                                </div>
                                                            </div>`);

                            // Optionnellement, fermer le modal après un succès
                            $('#newProductModal').modal('hide');

                            // Réinitialiser tous les champs du formulaire
                            $('#productForm')[0].reset();

                            // Réinitialiser le champ de fichiers (images)
                            $('#files_urls').val(null);

                            location.reload();
                        },
                        error: function (error) {
                            // Cacher l'animation de chargement
                            $('#loading-icon').hide();

                            // Afficher une alerte d'erreur
                            $('#ajax-alert-container').html(`<div style="position: fixed; z-index: 9999; width: 100%; display: flex; justify-content: center;">
                                                                <div class="alert alert-danger alert-dismissible" role="alert" style="width: 500px;">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <i class="bi bi-exclamation-triangle" style="margin-right: 8px; vertical-align: -2px;"></i>
                                                                    {{ __('notifications.error_while_processing') }}
                                                                </div>
                                                            </div>`);
                        }
                    });
                });
            });
        </script>
        <!--! END: Custom JS !-->
    </body>
</html>