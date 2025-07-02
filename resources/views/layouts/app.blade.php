<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="@lang('miscellaneous.description')">
        <meta name="keywords" content="@lang('miscellaneous.keywords')">
        <meta name="strt-url" content="{{ getWebURL() }}">
        <meta name="strt-api-url" content="{{ getApiURL() }}">
        <meta name="strt-visitor" content="{{ !empty($current_user) ? $current_user->id : null }}">
        <meta name="strt-ref" content="{{ !empty($current_user) ? $current_user->api_token : null }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('assets/img/favicon/site.webmanifest') }}">

        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic%7CPT+Gudea:400,700,400italic%7CPT+Oswald:400,700,300' rel='stylesheet' id="googlefont">

        <!-- Font Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{ asset('assets/css/venedor/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/venedor/prettyPhoto.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/venedor/revslider.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/venedor/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/venedor/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/venedor/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/addons/cropper/css/cropper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/addons/jquery/jquery-ui/jquery-ui.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/addons/jquery/datetimepicker/css/jquery.datetimepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        <!--- jQuery -->
        {{-- <script src="{{ asset('assets/addons/jquery/js/jquery.min.js') }}"></script> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            window.jQuery || document.write('<script src="js/jquery-1.11.1.min.js"><\/script>')
        </script>

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->

        <style id="custom-style">
            textarea { resize: none; }
            .item .item-image-container { position: relative; width: 100%; padding-top: 139.91%; overflow: hidden; }
            .item .item-image-container img { position: absolute; top: 0; left: 0; width: 100% !important; height: 100% !important; object-fit: cover; }
        </style>

        <title>
@if (!empty($page_title))
            START / {{ $page_title }}
@else
            START
@endif
        </title>
    </head>

    <body>
        <!-- MODALS-->
        <!-- ### Crop other user image ### -->
        <div class="modal fade" id="cropModal_profile" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding: 10px; border: 0;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="@lang('miscellaneous.close')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body pt-0">
                        <h4 class="text-center text-muted">@lang('miscellaneous.crop_before_save')</h4>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="bg-image" style="max-width: 100%; overflow: hidden;">
                                        <img src="" id="retrieved_image_profile" class="img-responsive center-block" alt="Photo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style="display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('miscellaneous.cancel')</button>
                        <button type="button" id="crop_profile" class="btn btn-custom-2" data-dismiss="modal">@lang('miscellaneous.register')</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ### Crop user image ### -->
        <div class="modal fade" id="cropModalUser" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding: 10px; border: 0;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="@lang('miscellaneous.close')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <h4 class="text-center text-muted">@lang('miscellaneous.crop_before_save')</h4>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="bg-image" style="max-width: 100%; overflow: hidden;">
                                        <img src="" id="retrieved_image" class="img-responsive center-block" alt="Photo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style="display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('miscellaneous.cancel')</button>
                        <button type="button" id="crop_avatar" class="btn btn-custom-2" data-dismiss="modal">@lang('miscellaneous.register')</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODALS-->

        <div id="wrapper">
            <header id="header">
                <div id="header-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="header-top-left">
@if (!empty($current_user))
                                    <ul id="top-links" class="clearfix">
                                        <li><a href="{{ route('account.home') }}" title="@lang('miscellaneous.menu.account.title')"><i class="bi bi-person" style="margin-right: 0.5rem!important;"></i><span class="hide-for-xs">@lang('miscellaneous.menu.account.title')</span></a></li>
                                        <li><a href="{{ route('account.entity', ['entity' => 'cart']) }}" title="@lang('miscellaneous.menu.account.cart')"><i class="bi bi-cart3" style="margin-right: 0.5rem!important;"></i><span class="hide-for-xs">@lang('miscellaneous.menu.account.cart')</span></a></li>
                                    </ul>
@endif
                                </div><!-- End .header-top-left -->
                                <div class="header-top-right">
                                    <div class="header-top-dropdowns pull-right">
@if (!empty($current_user))
                                        <div class="btn-group dropdown-money">
                                            <button type="button" class="btn btn-custom dropdown-toggle"
                                                data-toggle="dropdown">
                                                <span class="hide-for-xs">US Dollar</span><span class="hide-for-lg">USD</span>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="#" id="USD"><span class="hide-for-xs">US Dollar</span><span class="hide-for-lg">USD</span></a></li>
                                                <li><a href="#" id="CDF"><span class="hide-for-xs">Franc congolais</span><span class="hide-for-lg">CDF</span></a></li>
                                            </ul>
                                        </div><!-- End .btn-group -->
@endif
                                        <div class="btn-group dropdown-language">
                                            <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
@if ($current_locale == 'fr')
                                                <span class="flag-container"><i class="fi fi-fr"></i></span>
                                                <span class="hide-for-xs">Français</span>
@else
                                                <span class="flag-container"><i class="fi fi-us"></i></span>
                                                <span class="hide-for-xs">English</span>
@endif
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li>
                                                    <a href="{{ route('change_language', ['locale' => 'en']) }}">
                                                        <span class="flag-container">
                                                            <i class="fi fi-us"></i>
                                                        </span>
                                                        <span class="hide-for-xs">English</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('change_language', ['locale' => 'fr']) }}">
                                                        <span class="flag-container">
                                                            <i class="fi fi-fr"></i>
                                                        </span>
                                                        <span class="hide-for-xs">Français</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- End .btn-group -->
                                    </div><!-- End .header-top-dropdowns -->

                                    <div class="header-text-container pull-right">
@if (!empty($current_user))
                                        <p class="header-text">@lang('miscellaneous.welcome_title', ['user' => 'Xanders Samoth'])</p>
@else
            							<p class="header-link"><a href="{{ route('login') }}">@lang('auth.login')</a>&nbsp;or&nbsp;<a href="{{ route('register') }}">@lang('auth.register')</a></p>
@endif
                                    </div><!-- End .pull-right -->
                                </div><!-- End .header-top-right -->
                            </div><!-- End .col-md-12 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End #header-top -->

                <div id="inner-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12 logo-container">
                                <h1 class="logo clearfix">
                                    <span>@lang('miscellaneous.start')</span>
                                    <a href="{{ route('home') }}" title="@lang('miscellaneous.start')">
                                        <img src="{{ asset('assets/img/brand.png') }}" alt="START" width="250" height="79">
                                    </a>
                                </h1>
                            </div><!-- End .col-md-5 -->
                            <div class="col-md-7 col-sm-7 col-xs-12 header-inner-right">
                                <div class="header-box contact-infos pull-right">
    								<ul>
    									<li><span class="header-box-icon header-box-icon-email"></span><a href="mailto:contact@start.com">contact@start.com</a></li>
    								</ul>
                                </div><!-- End .contact-infos -->

                                <div class="header-box contact-phones pull-right clearfix">
                                    <span class="header-box-icon header-box-icon-earphones"></span>
                                    <ul class="pull-left">
                                        <li>+(243) 581 000 815</li>
                                    </ul>
                                </div><!-- End .contact-phones -->

                            </div><!-- End .col-md-7 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->

                    <div id="main-nav-container">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 clearfix">
                                    <!-- Mani menu -->
                                    <nav id="main-nav">
                                        <div id="responsive-nav">
                                            <div id="responsive-nav-button">
                                                Menu <span id="responsive-nav-button-icon"></span>
                                            </div><!-- responsive-nav-button -->
                                        </div>
                                        <ul class="menu clearfix">
                                            <li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
                                            <li>
                                                <a href="#">@lang('miscellaneous.menu.public.products.title')</a>
                                                <ul>
                                                    <li><a href="{{ route('product.entity', ['entity' => 'project']) }}">@lang('miscellaneous.menu.public.products.projects')</a></li>
                                                    <li><a href="{{ route('product.entity', ['entity' => 'product']) }}">@lang('miscellaneous.menu.public.products.products')</a></li>
                                                    <li><a href="{{ route('product.entity', ['entity' => 'service']) }}">@lang('miscellaneous.menu.public.products.services')</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('discussion.home') }}">@lang('miscellaneous.menu.discussions')</a></li>
                                            <li><a href="{{ route('investor.home') }}">@lang('miscellaneous.menu.public.investors.title')</a></li>
                                            <li><a href="{{ route('crowdfunding.home') }}">@lang('miscellaneous.menu.public.crowdfunding')</a></li>
                                        </ul>
                                    </nav>

                                    <div id="quick-access">
@if (!empty($current_user))
                                        <div class="dropdown-cart-menu-container pull-right">
                                            <div class="btn-group dropdown-cart">
                                                <button type="button" class="btn btn-custom dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    <span class="cart-menu-icon"></span>
                                                    {{ trans_choice('miscellaneous.items', 0, ['count' => 0]) }} <span class="drop-price">- $0.00</span>
                                                </button>

                                                <div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
                                                    <p class="dropdown-cart-description">{{ trans_choice('miscellaneous.recently_added_items', 1) }}</p>
                                                    <ul class="dropdown-cart-product-list">
                                                        <li class="item clearfix">
                                                            <a href="#" title="Delete item" class="delete-item">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                            <a href="#" title="Edit item" class="edit-item">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <figure>
                                                                <a href="{{ route('product.entity.datas', ['entity' => 'product', 'id' => 1]) }}">
                                                                    <img src="{{ getWebURL() . '/template/public/images/products/thumbnails/item12.jpg' }}" alt="phone 4">
                                                                </a>
                                                            </figure>
                                                            <div class="dropdown-cart-details">
                                                                <p class="item-name">
                                                                    <a href="{{ route('product.entity.datas', ['entity' => 'product', 'id' => 1]) }}">Cam Optia AF Webcam </a>
                                                                </p>
                                                                <p>
                                                                    1x <span class="item-price">$499</span>
                                                                </p>
                                                            </div><!-- End .dropdown-cart-details -->
                                                        </li>
                                                        <li class="item clearfix">
                                                            <a href="#" title="Delete item" class="delete-item">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                            <a href="#" title="Edit item" class="edit-item">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <figure>
                                                                <a href="{{ route('product.entity.datas', ['entity' => 'product', 'id' => 2]) }}">
                                                                    <img src="{{ getWebURL() . '/template/public/images/products/thumbnails/item13.jpg' }}" alt="phone 2">
                                                                </a>
                                                            </figure>
                                                            <div class="dropdown-cart-details">
                                                                <p class="item-name">
                                                                    <a href="{{ route('product.entity.datas', ['entity' => 'product', 'id' => 2]) }}">Iphone Case Cover Original</a>
                                                                </p>
                                                                <p>
                                                                    1x <span class="item-price">$499<span class="sub-price">.99</span></span>
                                                                </p>
                                                            </div><!-- End .dropdown-cart-details -->
                                                        </li>
                                                    </ul>
                                                    <ul class="dropdown-cart-total">
                                                        <li><span class="dropdown-cart-total-title">Total:</span>${{ formatIntegerNumber(1005) }}<span class="sub-price">.99</span></li>
                                                    </ul><!-- .dropdown-cart-total -->
                                                    <div class="dropdown-cart-action">
                                                        <p>
                                                            <a href="{{ route('account.entity', ['entity' => 'cart']) }}" class="btn btn-custom-2 btn-block">@lang('miscellaneous.cart')</a>
                                                        </p>
                                                        <p><a href="{{ route('account.entity', ['entity' => 'cart']) }}" class="btn btn-custom btn-block">@lang('miscellaneous.checkout')</a></p>
                                                    </div><!-- End .dropdown-cart-action -->
                                                </div><!-- End .dropdown-cart -->
                                            </div><!-- End .btn-group -->
                                        </div><!-- End .dropdown-cart-menu-container -->
@endif

                                        <form class="form-inline quick-search-form" role="form" action="{{ route('search') }}">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="@lang('miscellaneous.search_input')">
                                            </div><!-- End .form-inline -->
                                            <button type="submit" id="quick-search" class="btn btn-custom"></button>
                                        </form>
                                    </div><!-- End #quick-access -->
                                </div><!-- End .col-md-12 -->
                            </div><!-- End .row -->
                        </div><!-- End .container -->

                    </div><!-- End #nav -->
                </div><!-- End #inner-header -->
            </header><!-- End #header -->

@yield('app-content')

            <footer id="footer">
                <div id="twitterfeed-container">
                    <div class="container">
                        <div class="row">
                            <div class="twitterfeed col-md-12">
                                {{-- <div class="twitter-icon"><i class="fa fa-twitter"></i></div><!-- End .twitter-icon --> --}}
                                <div class="row">
                                    <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
                                        {{-- <div class="twitter_feed flexslider"></div> --}}
                                    </div>
                                </div>

                            </div><!-- End .twiitterfeed .col-md-12 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End #twitterfeed-container -->
                <div id="inner-footer">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 widget">
                                <img src="" alt="" class="">
                                <h3>@lang('miscellaneous.welcome_about.title')</h3>
                                <p>@lang('miscellaneous.welcome_about.content')</p>
                            </div><!-- End .widget -->

                            <div class="col-md-3 col-sm-6 col-xs-12 ml-auto widget">
                                <h3>@lang('miscellaneous.public.footer.useful_links')</h3>
                                <ul class="links">
                                    <li><a href="#">@lang('miscellaneous.menu.terms_of_use')</a></li>
                                    <li><a href="#">@lang('miscellaneous.menu.privacy_policy')</a></li>
                                    <li><a href="#">@lang('miscellaneous.menu.contact')</a></li>
                                    <li><a href="#">@lang('miscellaneous.menu.discussions')</a></li>
                                    <li><a href="#">@lang('miscellaneous.menu.public.crowdfunding')</a></li>
                                    <li><a href="#">@lang('miscellaneous.menu.public.investors.title')</a></li>
                                </ul>
                            </div><!-- End .widget -->

                            <div class="col-md-3 col-sm-6 col-xs-12 widget">
                                <h3>@lang('miscellaneous.menu.account.title')</h3>
                                <ul class="links">
@if (!empty($current_user))
                                    <li><a href="{{ route('account.home') }}">@lang('miscellaneous.account.personal_infos.title')</a></li>
                                    <li><a href="{{ route('account.entity', ['entity' => 'cart']) }}">@lang('miscellaneous.menu.account.cart')</a></li>
                                    <li><a href="{{ route('account.entity', ['entity' => 'projects']) }}">@lang('miscellaneous.menu.account.project.title')</a></li>
                                    <li><a href="{{ route('account.entity', ['entity' => 'products']) }}">@lang('miscellaneous.menu.account.product.title')</a></li>
                                    <li><a href="{{ route('account.entity', ['entity' => 'services']) }}">@lang('miscellaneous.menu.account.service.title')</a></li>
@else
                                    <li><a href="{{ route('register') }}">@lang('miscellaneous.register_title2')</a></li>
                                    <li><a href="{{ route('login') }}">@lang('miscellaneous.login_title2')</a></li>
@endif
                                </ul>
                            </div><!-- End .widget -->

                            <div class="clearfix visible-sm"></div>
                        </div><!-- End .row -->
                    </div><!-- End .container -->

                </div><!-- End #inner-footer -->

                <div id="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-sm-7 col-xs-12 footer-social-links-container">
                                <ul class="social-links clearfix">
                                    <li><a href="#" class="social-icon icon-facebook"></a></li>
                                    <li><a href="#" class="social-icon icon-linkedin"></a></li>
                                    <li><a href="#" class="social-icon icon-email"></a></li>
                                </ul>
                            </div><!-- End .col-md-7 -->

                            <div class="col-md-5 col-sm-5 col-xs-12 footer-text-container">
                                <p>&copy; {{ date('Y') }} START&trade; @lang('miscellaneous.all_right_reserved') | Designed by <a href="https://xsamtech.com" target="_blank">Xsam Technologies</a></p>
                            </div><!-- End .col-md-5 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End #footer-bottom -->

            </footer><!-- End #footer -->
        </div><!-- End #wrapper -->

        <a href="#" id="scroll-top" title="Scroll to Top"><i class="fa-solid fa-angle-up"></i></a><!-- End #scroll-top -->

        <!-- END -->
        <script src="{{ asset('assets/addons/jquery/js/jquery-ui.min.js') }}"></script>
        <script rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/i18n/jquery-ui-i18n.min.js"></script>
        <script src="{{ asset('assets/addons/jquery/datetimepicker/js/jquery.datetimepicker.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/smoothscroll.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/jquery.debouncedresize.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/retina.min.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/jquery.placeholder.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/jquery.hoverIntent.min.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/twitter/jquery.tweet.min.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/jquery.flexslider-min.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/jflickrfeed.min.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/jquery.prettyPhoto.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/jquery.themepunch.tools.min.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/jquery.themepunch.revolution.min.js') }}"></script>
        <script src="{{ asset('assets/js/venedor/main.js') }}"></script>
        <script src="{{ asset('assets/addons/cropper/js/cropper.min.js') }}"></script>
        <script src="{{ asset('assets/addons/autosize/js/autosize.min.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.custom.js') }}"></script>

        <script>
            $(function() {
                // Slider Revolution
                jQuery('#slider-rev').revolution({
                    delay: 8000,
                    startwidth: 1170,
                    startheight: 600,
                    onHoverStop: "true",
                    hideThumbs: 250,
                    navigationHAlign: "center",
                    navigationVAlign: "bottom",
                    navigationHOffset: 0,
                    navigationVOffset: 20,
                    soloArrowLeftHalign: "left",
                    soloArrowLeftValign: "center",
                    soloArrowLeftHOffset: 0,
                    soloArrowLeftVOffset: 0,
                    soloArrowRightHalign: "right",
                    soloArrowRightValign: "center",
                    soloArrowRightHOffset: 0,
                    soloArrowRightVOffset: 0,
                    touchenabled: "on",
                    stopAtSlide: -1,
                    stopAfterLoops: -1,
                    dottedOverlay: "none",
                    fullWidth: "on",
                    spinned: "spinner5",
                    shadow: 0,
                    hideTimerBar: "on",
                    // navigationStyle:"preview4"
                });

            });
        </script>
    </body>
</html>
