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
        <link rel="stylesheet" href="{{ asset('assets/addons/custom/cropper/css/cropper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/addons/custom/sweetalert2/dist/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/addons/custom/flatpickr/dist/flatpickr.min.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        <!--- jQuery -->
        {{-- <script src="{{ asset('assets/addons/custom/jquery/js/jquery.min.js') }}"></script> --}}
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
            #header { background: transparent url({{ asset('assets/img/watermak.png') }}) repeat center center / cover; }
            #content { background: transparent url({{ asset('assets/img/watermak.png') }}) repeat center center / contain; }
            #tableOfContent h4 { margin: 0; }
            #tableOfContent ul, #termsContent ul, #privacyContent ul { padding-left: 30px; }
            #tableOfContent ul li { list-style-type: decimal-leading-zero; margin-top: 10px; }
            #tableOfContent ul li:first-child { margin-top: 0; }
            #tableOfContent ul li a { color: #6e9e1a; }
            #tableOfContent ul li a:hover { text-decoration: underline; }
            #termsContent ul li, #privacyContent ul li { list-style-type: disc; }
            #termsContent h3, #privacyContent h3 { font-weight: bold; margin-top: 20px; margin-bottom: 7px; }
            #termsContent, #privacyContent { color: #000;; }
            #termsContent p, #privacyContent p { margin-top: 10px; }
            #termsContent p a, #privacyContent p a { color: #6e9e1a; text-decoration: underline; }
            #termsContent p a:hover, #privacyContent p a:hover { text-decoration: none; }
            #footer .bottom a { color: #84bb26; }
            [for="termsAccept"] a { color: #72a51a; }
            [for="termsAccept"] a:hover { text-decoration: underline; }
            .title-desc a { color: #732f0b; }
            .title-desc a:hover { color: #72a51a; }
            .custom-link { color: #732f0b; }
            .custom-link:hover { color: #72a51a; }
            #top-links li:first-child a { padding-left: 20px!important; }
            #top-links li:nth-child(2) a { padding-left: 5px!important; }
            #top-links li:first-child a:hover, #top-links li:nth-child(2) a:hover { text-decoration: underline; }
            .badge-notify { font-size: 10px; background:red; position: absolute; top: -8px; left: 12px; }
            .breadcrumb li a, .breadcrumb li { font-size: 1.5rem; }
            #showPassword i, #showConfirmPassword i, #showNewPassword i, #showConfirmNewPassword i { font-size: 2rem; }
            .item .item-image-container { position: relative; width: 100%; padding-top: 139.91%; overflow: hidden; }
            .item .item-image-container img { position: absolute; top: 0; left: 0; width: 100% !important; height: 100% !important; object-fit: cover; }
            .item-price-container { display: flex; justify-content: center; align-items: center; width: 200px!important; height: 40px!important; border-radius: 50px!important; }
            .item-price-container .item-price { margin-top: 0!important; }
            .cart-table .item-name-col figure { width: 140px; }
            #personalInfo tr { border-bottom: 1px #ccc solid; }
            #personalInfo td { text-align: left; padding: 1rem 0.5rem; border: 0!important; }
            .d-none { display: none; }
            .bg-light { background-color: #f5f5f5; }
            #paymentMethod, #phoneNumberForMoney { margin-bottom: 10px; }
            .article .article-meta-date { background: #732f0b; }
            .article-author-image img { width: 145px; height: 145px; }
            .comment img { width: 70px; height: 70px; }
            #flexItemsCenter p:first-child { font-size: 2rem; line-height: 25px; }
            #notificationItem { padding: 7px 10px; }
            @media screen and (min-width: 500px) {
                .d-xs-none { display: inline-block; }
                .d-lg-none { display: none; }
                .d-sm-none { display: none; }
                #paymentMethod { text-align: center; }
                #flexItemsCenter { display: flex; align-items: center; }
                #flexItemsCenter p:first-child { font-size: 3rem; line-height: 34px; }
                #notificationItem { display: flex; justify-content: space-between; align-items: center;}
            }
            @media screen and (max-width: 500px) {
                .d-xs-none { display: none; }
                .d-lg-none { display: inline-block; }
                .d-sm-none { display: block; }
                .article-author-image img { width: 100%; margin-bottom: 20px; }
                #userGender { margin-bottom: 20px; }
            }
            /* Image preview to upload */
            #image-preview-container { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
            .preview-thumbnail { position: relative; display: inline-block; width: 100px; height: 100px; }
            .preview-thumbnail img { width: 100%; height: 100%; object-fit: cover; border-radius: 5px; }
            .preview-thumbnail .remove-image { position: absolute; top: 0; right: 0; background-color: rgba(255, 0, 0, 0.7); color: white; border-radius: 50%; cursor: pointer; font-size: 14px; padding: 0 5.5px; }
            .preview-thumbnail .remove-image:hover { background-color: rgba(255, 0, 0, 0.3); }
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
@if (Route::is('product.entity.datas'))
        <!-- ### Add product ### -->
        <div class="modal fade" id="updateProductModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding: 5px; border: 0;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="@lang('miscellaneous.close')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="padding-top: 10px;">
                        <h2 class="text-center" style="font-weight: 700;">@lang('miscellaneous.admin.product.edit', ['entity' => __('miscellaneous.admin.product.entity.product.singular')])</h2>
                        <hr>

                        <form id="productForm" action="{{ route('product.entity.datas', ['entity' => 'product', 'id' => $selected_product->id]) }}" method="POST">
        @csrf
                            <input type="hidden" name="type" value="product">

                            <div class="row">
                                <!-- Product name -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="product_name">@lang('miscellaneous.admin.product.data.product_name', ['entity' => __('miscellaneous.admin.product.entity.product.singular')])</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" required value="{{ $selected_product->product_name }}">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="product_description">@lang('miscellaneous.admin.product.data.product_description')</label>
                                        <textarea class="form-control" id="product_description" name="product_description" rows="2">{{ $selected_product->product_description }}</textarea>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="price">@lang('miscellaneous.admin.product.data.price')</label>
                                        <input type="number" class="form-control" id="price" name="price" step="0.001" required value="{{ $selected_product->price }}">
                                    </div>
                                </div>

                                <!-- Currency -->
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="currency">@lang('miscellaneous.currency')</label>
                                        <select class="form-control" id="currency" name="currency">
                                            <option class="small" disabled>@lang('miscellaneous.currency')</option>
                                            <option {{ $selected_product->currency == 'USD' ? 'selected' : '' }}>USD</option>
                                            <option {{ $selected_product->currency == 'CDF' ? 'selected' : '' }}>CDF</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Quantity -->
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="quantity">@lang('miscellaneous.admin.product.data.quantity')</label>
                                        <input type="number" class="form-control input-minimum" id="quantity" name="quantity" min="500" value="{{ $selected_product->quantity }}" required>
                                    </div>
                                </div>

                                <!-- Action -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="action">@lang('miscellaneous.admin.product.action.title')</label>
                                        <select class="form-control" id="action" name="action">
                                            <option value="sell">@lang('miscellaneous.admin.product.data.action.sell')</option>
                                            <option value="rent">@lang('miscellaneous.admin.product.data.action.rent')</option>
                                            <option value="distribute">@lang('miscellaneous.admin.product.data.action.distribute')</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="category_id">@lang('miscellaneous.admin.product.data.category')</label>
                                        <select class="form-control" id="category_id" name="category_id">
        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}"  {{ $selected_product->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
        @empty
                                            <option disabled>@lang('miscellaneous.empty_list')</option>
        @endforelse
                                        </select>
                                    </div>
                                </div>

                                <!-- Upload images -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="files_urls">@lang('miscellaneous.upload.upload_images')</label>
                                        <input type="file" id="files_urls" name="files_urls[]" class="form-control" multiple>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div id="image-preview-container" class="mt-2"></div> <!-- Conteneur pour les vignettes -->
                                </div>
                            </div>

                            <hr>
                            <div style="display: flex; justify-content: flex-start;">
                                <button type="submit" class="btn strt-btn-chocolate-3" style="width: 250px">
                                    <span style="color: #fff;">@lang('miscellaneous.register')</span>
                                </button>
                                <img id="loading-icon" src="{{ asset('assets/img/ajax-loading.gif') }}" alt="" width="40" height="40" style="margin-left: 6px; display: none;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endif
@if (!empty($entity))
    @if ($entity == 'cart')
        <!-- ### Add product ### -->
        <div class="modal fade" id="payModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding: 5px; border: 0;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="@lang('miscellaneous.close')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="padding-top: 10px;">
                        <h2 class="text-center" style="font-weight: 700;">@lang('miscellaneous.public.about.subscribe.send_money.title')</h2>
                        <hr>

                        <form action="{{ route('pay') }}" method="POST">
        @csrf
                            <input type="hidden" name="app_url" value="{{ getWebURL() }}">
                            <input type="hidden" name="user_id" value="{{ !empty($current_user) ? $current_user->id : null }}">
                            <input type="hidden" name="amount" value="{{ $current_user->unpaidCartTotal() }}">
                            <input type="hidden" name="currency" value="{{ $current_user->currency }}">
                            <input type="hidden" name="cart_id" value="{{ !empty($cart) ? $cart->id : null }}">

                            <div class="card border border-default text-center" style="width: 300px; margin: 0 auto 10px auto;">
                                <div class="card-header">
                                    <h5 style="margin-bottom: 0;">@lang('miscellaneous.amount_to_pay')</p>
                                </div>
                                <div class="card-body">
                                    <h3 style="margin-bottom: 0;"><strong>{{ formatDecimalNumber($current_user->unpaidCartTotal()) . ' ' . $current_user->readable_currency }}</strong></h3>
                                </div>
                            </div>

                            <hr>
                            <div id="paymentMethod">
                                <p class="lead" style="margin-bottom: 5px;">@lang('miscellaneous.payment_method')</p>

                                <label class="radio-inline" for="mobile_money">
                                    <img src="{{ asset('assets/img/payment-mobile-money.png') }}" alt="@lang('miscellaneous.public.about.subscribe.send_money.mobile_money')" width="40" style="vertical-align: middle; margin-right: 20px;">
                                    <input type="radio" name="transaction_type_id" id="mobile_money" value="1" style="position: relative; top: 1px;" checked /><span class="text-muted" style="display: inline-block; margin-left: 8px;">@lang('miscellaneous.public.about.subscribe.send_money.mobile_money')</span>
                                </label>
                                <label class="radio-inline" for="bank_card" style="margin: 0;">
                                    <img src="{{ asset('assets/img/payment-credit-card.png') }}" alt="@lang('miscellaneous.public.about.subscribe.send_money.bank_card')" width="40" style="vertical-align: middle; margin-right: 20px;">
                                    <input type="radio" name="transaction_type_id" id="bank_card" value="2" style="position: relative; top: 1px;" /><span class="text-muted" style="display: inline-block; margin-left: 8px;">@lang('miscellaneous.public.about.subscribe.send_money.bank_card')</span>
                                </label>
                            </div>

                            <div id="phoneNumberForMoney">
                                <hr>
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4" style="padding-right: 0!important;">
                                        <select class="form-control" id="selectCountry" name="other_phone_code">
                                            <option class="small" selected disabled>@lang('miscellaneous.phone_code')</option>
        @forelse ($countries as $country)
            								<option value="{{ ltrim($country['phone'], '+') }}">{{ $country['label'] }}</option>
        @empty
        @endforelse
                                        </select>
                                    </div>
                                    <div class="col-lg-7 col-md-6 col-sm-6 col-xs-8">
                                        <input type="text" class="form-control" id="phone_number" name="other_phone_number" placeholder="@lang('miscellaneous.phone_number')">
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <button class="btn btn-block strt-btn-green rounded-pill" type="submit">@lang('miscellaneous.send')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($entity == 'products')
        <!-- ### Add product ### -->
        <div class="modal fade" id="newProductModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding: 5px; border: 0;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="@lang('miscellaneous.close')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="padding-top: 10px;">
                        <h2 class="text-center" style="font-weight: 700;">@lang('miscellaneous.admin.product.add', ['entity' => __('miscellaneous.admin.product.entity.product.singular')])</h2>
                        <hr>

                        <form id="productForm" action="{{ route('product.entity', ['entity' => 'product']) }}" method="POST">
        @csrf
                            <input type="hidden" name="type" value="product">

                            <div class="row">
                                <!-- Product name -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="product_name">@lang('miscellaneous.admin.product.data.product_name', ['entity' => __('miscellaneous.admin.product.entity.product.singular')])</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="product_description">@lang('miscellaneous.admin.product.data.product_description')</label>
                                        <textarea class="form-control" id="product_description" name="product_description" rows="2"></textarea>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="price">@lang('miscellaneous.admin.product.data.price')</label>
                                        <input type="number" class="form-control" id="price" name="price" step="0.001" required>
                                    </div>
                                </div>

                                <!-- Currency -->
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="currency">@lang('miscellaneous.currency')</label>
                                        <select class="form-control" id="currency" name="currency">
                                            <option class="small" disabled>@lang('miscellaneous.currency')</option>
                                            <option>USD</option>
                                            <option>CDF</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Quantity -->
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="quantity">@lang('miscellaneous.admin.product.data.quantity')</label>
                                        <input type="number" class="form-control input-minimum" id="quantity" name="quantity" min="1" required>
                                    </div>
                                </div>

                                <!-- Action -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="action">@lang('miscellaneous.admin.product.action.title')</label>
                                        <select class="form-control" id="action" name="action">
                                            <option value="sell">@lang('miscellaneous.admin.product.data.action.sell')</option>
                                            <option value="rent">@lang('miscellaneous.admin.product.data.action.rent')</option>
                                            <option value="distribute">@lang('miscellaneous.admin.product.data.action.distribute')</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="category_id">@lang('miscellaneous.admin.product.data.category')</label>
                                        <select class="form-control" id="category_id" name="category_id">
        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @empty
                                            <option disabled>@lang('miscellaneous.empty_list')</option>
        @endforelse
                                        </select>
                                    </div>
                                </div>

                                <!-- Upload images -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="files_urls">@lang('miscellaneous.upload.upload_images')</label>
                                        <input type="file" id="files_urls" name="files_urls[]" class="form-control" multiple>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div id="image-preview-container" class="mt-2"></div> <!-- Conteneur pour les vignettes -->
                                </div>
                            </div>

                            <hr>
                            <div style="display: flex; justify-content: flex-start;">
                                <button type="submit" class="btn strt-btn-chocolate-3" style="width: 250px">
                                    <span style="color: #fff;">@lang('miscellaneous.register')</span>
                                </button>
                                <img id="loading-icon" src="{{ asset('assets/img/ajax-loading.gif') }}" alt="" width="40" height="40" style="margin-left: 6px; display: none;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($entity == 'services')
        <!-- ### Add project ### -->
        <div class="modal fade" id="newProductModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding: 5px; border: 0;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="@lang('miscellaneous.close')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="padding-top: 10px;">
                        <h2 class="text-center" style="font-weight: 700;">@lang('miscellaneous.admin.product.add', ['entity' => __('miscellaneous.admin.product.entity.service.singular')])</h2>
                        <hr>

                        <form id="projectForm" action="{{ route('product.entity', ['entity' => 'service']) }}" method="POST">
        @csrf
                            <input type="hidden" name="type" value="service">

                            <div class="row">
                                <!-- Product name -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="product_name">@lang('miscellaneous.admin.product.data.product_name', ['entity' => __('miscellaneous.admin.product.entity.service.singular')])</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="product_description">@lang('miscellaneous.admin.product.data.product_description')</label>
                                        <textarea class="form-control" id="product_description" name="product_description" rows="2"></textarea>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="price">@lang('miscellaneous.admin.product.data.price')</label>
                                        <input type="number" class="form-control" id="price" name="price" step="0.001" required>
                                    </div>
                                </div>

                                <!-- Currency -->
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="currency">@lang('miscellaneous.currency')</label>
                                        <select class="form-control" id="currency" name="currency">
                                            <option class="small" disabled>@lang('miscellaneous.currency')</option>
                                            <option>USD</option>
                                            <option>CDF</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Action -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="action">@lang('miscellaneous.admin.product.action.title')</label>
                                        <select class="form-control" id="action" name="action">
                                            <option value="sell">@lang('miscellaneous.admin.product.data.action.sell')</option>
                                            <option value="rent">@lang('miscellaneous.admin.product.data.action.rent')</option>
                                            <option value="distribute">@lang('miscellaneous.admin.product.data.action.distribute')</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="category_id">@lang('miscellaneous.admin.product.data.category')</label>
                                        <select class="form-control" id="category_id" name="category_id">
        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @empty
                                            <option disabled>@lang('miscellaneous.empty_list')</option>
        @endforelse
                                        </select>
                                    </div>
                                </div>

                                <!-- Upload images -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="files_urls">@lang('miscellaneous.upload.upload_images')</label>
                                        <input type="file" id="files_urls" name="files_urls[]" class="form-control" multiple>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div id="image-preview-container" class="mt-2"></div> <!-- Conteneur pour les vignettes -->
                                </div>
                            </div>

                            <hr>
                            <div style="display: flex; justify-content: flex-start;">
                                <button type="submit" class="btn strt-btn-chocolate-3" style="width: 250px">
                                    <span style="color: #fff;">@lang('miscellaneous.register')</span>
                                </button>
                                <img id="loading-icon" src="{{ asset('assets/img/ajax-loading.gif') }}" alt="" width="40" height="40" style="margin-left: 6px; display: none;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
@if (Route::is('discussion.home'))
        <!-- ### Add product ### -->
        <div class="modal fade" id="newPostModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding: 5px; border: 0;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="@lang('miscellaneous.close')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="padding-top: 10px;">
                        <h2 class="text-center" style="font-weight: 700;">@lang('miscellaneous.admin.post.add')</h2>
                        <hr>

                        <form id="postForm" action="{{ route('discussion.home') }}" method="POST">
    @csrf
                            <input type="hidden" name="type" value="post">

                            <!-- Post title -->
                            <div class="form-group">
                                <label for="posts_title">@lang('miscellaneous.admin.post.data.posts_title')</label>
                                <input type="text" class="form-control" id="posts_title" name="posts_title" required>
                            </div>

                            <!-- Post content -->
                            <div class="form-group">
                                <label for="posts_content">@lang('miscellaneous.admin.post.data.posts_content')</label>
                                <textarea class="form-control" id="posts_content" name="posts_content" rows="2" required></textarea>
                            </div>

                            <!-- Category -->
                            <div class="form-group">
                                <label for="for_category_id">@lang('miscellaneous.admin.product.data.category')</label>
                                <select class="form-control" id="for_category_id" name="for_category_id">
                                    <option class="small" disabled selected>@lang('miscellaneous.admin.product.data.category')</option>
    @forelse ($project_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
    @empty
    @endforelse
    @forelse ($product_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
    @empty
    @endforelse
    @forelse ($service_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
    @empty
    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="files_urls">@lang('miscellaneous.upload.upload_images')</label>
                                <input type="file" id="files_urls" name="files_urls[]" class="form-control" multiple>
                            </div>

                            <div id="image-preview-container" class="mt-2"></div> <!-- Conteneur pour les vignettes -->

                            <hr>
                            <div style="display: flex; justify-content: flex-start;">
                                <button type="submit" class="btn strt-btn-chocolate-3" style="width: 250px">
                                    <span style="color: #fff;">@lang('miscellaneous.register')</span>
                                </button>
                                <img id="loading-icon" src="{{ asset('assets/img/ajax-loading.gif') }}" alt="" width="40" height="40" style="margin-left: 6px; display: none;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endif
        <!-- MODALS-->

        <div id="wrapper">
            <header id="header">
                <div id="header-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="header-top-left">
                                    <ul id="top-links" class="clearfix">
@session('cart')
                                        <li><a href="{{ route('cart') }}" title="@lang('miscellaneous.menu.account.cart')"><i class="bi bi-cart3" style="margin-right: 0.5rem!important;"></i><span class="hide-for-xs">@lang('miscellaneous.menu.account.cart')</span></a></li>
@endsession
@if (!empty($current_user))
                                        <li>
                                            <a href="{{ route('account.home') }}" title="@lang('miscellaneous.menu.account.title')"><i class="bi bi-person" style="margin-right: 0.5rem!important;"></i><span class="hide-for-xs">@lang('miscellaneous.menu.account.title')</span></a>
                                        </li>
    @include('partials.notifications-badge')
                                        <li>
                                            <form action="{{ route('logout') }}" method="post">
                                                <button class="btn btn-link" style="color: #777;"><i class="bi bi-power" style="margin-right: 0.5rem!important;"></i><span class="hide-for-xs">@lang('miscellaneous.logout')</span></button>
                                            </form>
                                        </li>
@endif
                                    </ul>
                                </div><!-- End .header-top-left -->
                                <div class="header-top-right">
                                    <div class="header-top-dropdowns pull-right">
@if (!empty($current_user))
                                        <div class="btn-group dropdown-money">
                                            <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
    @if ($current_user->currency == 'USD')
                                                <span class="hide-for-xs">US Dollar</span><span class="hide-for-lg">USD</span>
    @else
                                                <span class="hide-for-xs">Franc congolais</span><span class="hide-for-lg">CDF</span>
    @endif
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="{{ route('change_currency', ['currency' => 'USD']) }}" id="USD"><span class="hide-for-xs">US Dollar</span><span class="hide-for-lg">USD</span></a></li>
                                                <li><a href="{{ route('change_currency', ['currency' => 'CDF']) }}" id="CDF"><span class="hide-for-xs">Franc congolais</span><span class="hide-for-lg">CDF</span></a></li>
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
                                        <p class="header-text">@lang('miscellaneous.welcome_title', ['user' => $current_user->firstname . ' ' . $current_user->lastname])</p>
@else
            							<p class="header-link"><a href="{{ route('login') }}">@lang('auth.login')</a>&nbsp;@lang('miscellaneous.or')&nbsp;<a href="{{ route('register') }}">@lang('auth.register')</a></p>
@endif
                                    </div><!-- End .pull-right -->
                                </div><!-- End .header-top-right -->
                            </div><!-- End .col-md-12 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End #header-top -->

            <div id="ajax-alert-container" style="position: relative;"></div>
@if (\Session::has('success_message'))
            <!-- Alert Start -->
            <div style="position: relative;">
                <div style="position: fixed; z-index: 9999; width: 100%; display: flex; justify-content: center;">
                    <div class="alert alert-success alert-dismissible" role="alert" style="width: 500px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="bi bi-check-circle" style="margin-right: 8px; vertical-align: -2px;"></i>{!! \Session::get('success_message') !!}
                    </div>
                </div>
            </div>
            <!-- Alert End -->
@endif
@if (\Session::has('error_message'))
            <!-- Alert Start -->
            <div style="position: relative;">
                <div style="position: fixed; z-index: 9999; width: 100%; display: flex; justify-content: center;">
                    <div class="alert alert-danger alert-dismissible" role="alert" style="width: 500px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="bi bi-exclamation-triangle" style="margin-right: 8px; vertical-align: -2px;"></i>{!! \Session::get('error_message') !!}
                    </div>
                </div>
            </div>
            <!-- Alert End -->
@endif
                <div id="inner-header">
                    <div class="container">
                        <div class="row">

                        </div><!-- End .row -->
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
    									<li><span class="header-box-icon header-box-icon-email"></span><a href="mailto:admin@start-africa.com">admin@start-africa.com</a></li>
    								</ul>
                                </div><!-- End .contact-infos -->

                                <div class="header-box contact-phones pull-right clearfix">
                                    <span class="header-box-icon header-box-icon-earphones"></span>
                                    <ul class="pull-left">
                                        <li>+(243) 810 045 300</li>
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
@session('cart')
    @php
        $cartItems = session()->get('cart', []);
    @endphp
                                        <div class="dropdown-cart-menu-container pull-right">
                                            <div class="btn-group dropdown-cart">
                                                <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
                                                    <span class="cart-menu-icon"></span>
                                                    {{ trans_choice('miscellaneous.items', count($cartItems), ['count' => count($cartItems)]) }} <span class="drop-price">- {{ formatDecimalNumber($session_cart_total) . ' $' }}</span>
                                                </button>

                                                <div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
                                                    <p class="dropdown-cart-description">{{ trans_choice('miscellaneous.recently_added_items', count($cartItems)) }}</p>
    @if (count($cartItems) > 0)
                                                    <ul class="dropdown-cart-product-list">
        @foreach ($cartItems as $item)
            @if ($loop->index < 3)
                                                        <li id="item-{{ $item['id'] }}" class="item clearfix">
                                                            <a href="#" title="Delete item" class="delete-item" onclick="event.preventDefault(); performAction('delete', 'order', 'item-{{ $item['id'] }}')">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                            <a href="{{ route('account.entity', ['entity' => 'cart']) }}" title="Edit item" class="edit-item">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <figure>
                                                                <a href="{{ route('product.entity.datas', ['entity' => $item['type'], 'id' => $item['id']]) }}">
                                                                    <img src="{{ count($item['photos']) > 0 ? $item['photos'][0] : getWebURL() . '/template/public/images/products/thumbnails/item12.jpg' }}" alt="{{ $item['product_name'] }}">
                                                                </a>
                                                            </figure>
                                                            <div class="dropdown-cart-details">
                                                                <p class="item-name">
                                                                    <a href="{{ route('product.entity.datas', ['entity' => $item['type'], 'id' => $item['id']]) }}">
                                                                        {{ $item['product_name'] }}
                                                                    </a>
                                                                </p>
                                                                <p>
                                                                    {{ $item['quantity'] }}x <span class="item-price">{{ formatDecimalNumber($item['price'], 3) . ' $' }}</span>
                                                                </p>
                                                            </div><!-- End .dropdown-cart-details -->
                                                        </li>
            @endif
        @endforeach
                                                    </ul>
                                                    <ul class="dropdown-cart-total">
                                                        <li><span class="dropdown-cart-total-title">
                                                            {{ 'TOTAL' . __('miscellaneous.colon_after_word') }}</span>
                                                            {{ formatDecimalNumber($session_cart_total) . ' $' }}
                                                        </li>
                                                    </ul><!-- .dropdown-cart-total -->
                                                    <div class="dropdown-cart-action">
                                                        <p>
                                                            <a href="{{ route('cart') }}" class="btn btn-custom-2 btn-block">@lang('miscellaneous.cart')</a>
                                                        </p>
                                                    </div><!-- End .dropdown-cart-action -->
        
    @else
                                                    <div style="display: flex; justify-content: center; align-items: flex-end; height: 100px;">
                                                        <i class="bi bi-cart3" style="font-size: 5rem"></i>
                                                    </div>
                                                    <h5 class="text-center">@lang('miscellaneous.empty_list')</h5>
    @endif
                                                </div><!-- End .dropdown-cart -->
                                            </div><!-- End .btn-group -->
                                        </div><!-- End .dropdown-cart-menu-container -->
@endsession
@if (!empty($current_user))
                                        <div class="dropdown-cart-menu-container pull-right">
                                            <div class="btn-group dropdown-cart">
                                                <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
                                                    <span class="cart-menu-icon"></span>
                                                    {{ trans_choice('miscellaneous.items', count($user_orders), ['count' => count($user_orders)]) }} <span class="drop-price">- {{ formatDecimalNumber($current_user->unpaidCartTotal()) . ' ' . $current_user->readable_currency }}</span>
                                                </button>

                                                <div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
                                                    <p class="dropdown-cart-description">{{ trans_choice('miscellaneous.recently_added_items', count($user_orders)) }}</p>
    @if (count($user_orders) > 0)
                                                    <ul class="dropdown-cart-product-list">
        @php
            foreach ($user_orders as $item) {
                $item->converted_price = formatDecimalNumber($item->convertPriceAtThatTime($current_user->currency), 3);
                $item->subtotal_price = formatDecimalNumber($item->subtotalPrice($current_user->currency));
            }

            $itemsArray = $user_orders->toArray();
        @endphp

        @foreach ($itemsArray as $item)
            @if ($loop->index < 3)
                                                        <li id="item-{{ $item['id'] }}" class="item clearfix">
                                                            <a href="#" title="Delete item" class="delete-item" onclick="event.preventDefault(); performAction('delete', 'order', 'item-{{ $item['id'] }}')">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                            <a href="{{ route('account.entity', ['entity' => 'cart']) }}" title="Edit item" class="edit-item">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <figure>
                                                                <a href="{{ route('product.entity.datas', ['entity' => 'product', 'id' => $item['id']]) }}">
                                                                    <img src="{{ count($item['product']['photos']) > 0 ? $item['product']['photos'][0]['file_url'] : getWebURL() . '/template/public/images/products/thumbnails/item12.jpg' }}" alt="{{ $item['product']['product_name'] }}">
                                                                </a>
                                                            </figure>
                                                            <div class="dropdown-cart-details">
                                                                <p class="item-name">
                                                                    <a href="{{ route('product.entity.datas', ['entity' => $item['product']['type'], 'id' => $item['product']['id']]) }}">
                                                                        {{ $item['product']['product_name'] }}
                                                                    </a>
                                                                </p>
                                                                <p>
                                                                    {{ $item['quantity'] }}x <span class="item-price">{{ $item['converted_price'] . ' ' . $current_user->readable_currency }}</span>
                                                                </p>
                                                            </div><!-- End .dropdown-cart-details -->
                                                        </li>
            @endif
        @endforeach
                                                    </ul>
                                                    <ul class="dropdown-cart-total">
                                                        <li><span class="dropdown-cart-total-title">
                                                            {{ 'TOTAL' . __('miscellaneous.colon_after_word') }}</span>
                                                            {{ formatDecimalNumber($current_user->unpaidCartTotal()) . ' ' . $current_user->readable_currency }}
                                                        </li>
                                                    </ul><!-- .dropdown-cart-total -->
                                                    <div class="dropdown-cart-action">
                                                        <p>
                                                            <a href="{{ route('account.entity', ['entity' => 'cart']) }}" class="btn btn-custom-2 btn-block">@lang('miscellaneous.cart')</a>
                                                        </p>
                                                    </div><!-- End .dropdown-cart-action -->
        
    @else
                                                    <div style="display: flex; justify-content: center; align-items: flex-end; height: 100px;">
                                                        <i class="bi bi-cart3" style="font-size: 5rem"></i>
                                                    </div>
                                                    <h5 class="text-center">@lang('miscellaneous.empty_list')</h5>
    @endif
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
                                    <li><a href="{{ route('terms') }}">@lang('miscellaneous.menu.terms_of_use')</a></li>
                                    <li><a href="{{ route('privacy') }}">@lang('miscellaneous.menu.privacy_policy')</a></li>
                                    <li><a href="{{ route('discussion.home') }}">@lang('miscellaneous.menu.discussions')</a></li>
                                    <li><a href="{{ route('crowdfunding.home') }}">@lang('miscellaneous.menu.public.crowdfunding')</a></li>
                                    <li><a href="{{ route('investor.home') }}">@lang('miscellaneous.menu.public.investors.title')</a></li>
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

                            <div class="col-md-5 col-sm-5 col-xs-12 footer-text-container bottom">
                                <p>&copy; {{ date('Y') }} START&trade; @lang('miscellaneous.all_right_reserved') | Designed by <a href="https://xsamtech.com" target="_blank">Xsam Technologies</a></p>
                            </div><!-- End .col-md-5 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End #footer-bottom -->

            </footer><!-- End #footer -->
        </div><!-- End #wrapper -->

        <a href="#" id="scroll-top" title="Scroll to Top"><i class="fa-solid fa-angle-up"></i></a><!-- End #scroll-top -->

        <!-- END -->
        <script type="text/javascript" src="{{ asset('assets/addons/custom/flatpickr/dist/flatpickr.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/addons/custom/flatpickr/dist/fr.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/smoothscroll.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/jquery.debouncedresize.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/retina.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/jquery.placeholder.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/jquery.hoverIntent.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/twitter/jquery.tweet.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/jquery.flexslider-min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/jflickrfeed.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/jquery.prettyPhoto.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/jquery.themepunch.tools.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/jquery.themepunch.revolution.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/venedor/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/addons/custom/cropper/js/cropper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/addons/custom/autosize/js/autosize.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/addons/custom/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script type="text/javascript" src="https://cdn.tiny.cloud/1/1jb70lfiyigr5qfhgclx0pv2t9fnl4uco3cs1xk50eqdz73i/tinymce/5/tinymce.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/js/scripts.custom.js') }}"></script>

@if (Auth::check())
        <script type="text/javascript">
            /**
             * Notifications
             */
            // Fonction pour mettre à jour la zone des notifications
            const updateNotifications = () => {
                $('#userNotifications').load('{{ route('notifications.badge') }}');
            };

            // Actualiser les notifications toutes les 1 secondes
            const notificationIntervalId = setInterval(updateNotifications, 1000);

            // Pour arrêter l'intervalle lorsque c'est nécessaire
            clearInterval(notificationIntervalId);
        </script>
@endif
@if (Route::is('register') || Route::is('account.entity') && $entity == 'update')
        <script type="text/javascript">
            /**
             * Limit characters in the textarea
             */
            const textarea = document.getElementById('limitChars');
            const charCountSpan = document.getElementById('charCount');
            const maxLength = textarea.getAttribute('maxlength');

            // Initial update on page load
            updateCharCount();

            // Add event listener for input changes
            textarea.addEventListener('input', updateCharCount);

            function updateCharCount() {
                const currentLength = textarea.value.length;
                const remaining = maxLength - currentLength;

                charCountSpan.textContent = remaining;

                // Optional: Add visual cues when approaching or exceeding limit
                if (remaining <= 10 && remaining >= 0) {
                    charCountSpan.style.color = 'orange'; // Warning color

                } else if (remaining < 0) {
                    charCountSpan.style.color = 'red'; // Exceeded limit color
                    // Optionally, truncate the text if the maxlength attribute isn't strictly enforced
                    // textarea.value = textarea.value.substring(0, maxLength);

                } else {
                    charCountSpan.style.color = 'initial'; // Reset color
                }
            }
        </script>
@endif
@if (Route::is('crowdfunding.home') && !empty($current_user))
        <script type="text/javascript">
            /**
             * Limit characters in the textarea
             */
            const textareaChar = document.getElementById('limitChars');
            const charCountSpan = document.getElementById('charCount');
            const maxLength = textareaChar.getAttribute('maxlength');

            // Initial update on page load
            updateCharCount();

            // Add event listener for input changes
            textareaChar.addEventListener('input', updateCharCount);

            function updateCharCount() {
                const currentLength = textareaChar.value.length;
                const remaining = maxLength - currentLength;

                charCountSpan.textContent = remaining;

                // Optional: Add visual cues when approaching or exceeding limit
                if (remaining <= 10 && remaining >= 0) {
                    charCountSpan.style.color = 'orange'; // Warning color

                } else if (remaining < 0) {
                    charCountSpan.style.color = 'red'; // Exceeded limit color
                    // Optionally, truncate the text if the maxlength attribute isn't strictly enforced
                    // textareaChar.value = textareaChar.value.substring(0, maxLength);

                } else {
                    charCountSpan.style.color = 'initial'; // Reset color
                }
            }

            /**
             * Inputs number always numeric
             */
            const numberInputs = document.querySelectorAll('input[type="number"]');

            numberInputs.forEach(input => {
                input.addEventListener('input', function(event) {
                    let value = event.target.value;
                    // Supprime tous les caractères non numériques (sauf si c'est une virgule ou un point)
                    value = value.replace(/[^0-9.,]/g, '');

                    // Permet la virgule ou le point comme seul séparateur décimal
                    value = value.replace(/(\.)(?=.*\.)/, '').replace(/(,)(?=.*,)/, ''); // Autoriser un seul point ou une seule virgule
                    value = value.replace(/^([^.,]*[,.])/g, '$1'); // S'assurer que le premier caractère est un nombre si ce n'est pas un chiffre

                    event.target.value = value;
                });
            });

            /**
             * Limit words in the textarea
             */
            const textarea = document.getElementById('limitWords');
            const wordCountDisplay = document.getElementById('wordCount');
            const maxWords = 500; // Set your desired word limit

            textarea.addEventListener('input', function() {
                const text = textarea.value.trim(); // Trim leading/trailing spaces
                const words = text.split(/\s+/).filter(word => word.length > 0); // Split by spaces and filter empty strings
                const currentWords = words.length;

                if (currentWords > maxWords) {
                    // If limit exceeded, truncate the text to the allowed word count
                    textarea.value = words.slice(0, maxWords).join(' ');
                }

                wordCountDisplay.textContent = maxWords - currentWords;
            });

            // Initialize the display on page load
            textarea.dispatchEvent(new Event('input'));

            /**
             * Switch between inputs and blocks
             */
            // Agriculture
            const agriculture = document.getElementById('agriculture');
            const blocAgriculture = document.getElementById('blocAgriculture');
            const radioIsLandOwnerAgricultureYes = document.getElementById('is_land_owner_agriculture_yes');
            const radioIsLandOwnerAgricultureNo = document.getElementById('is_land_owner_agriculture_no');
            // Breeding
            const breeding = document.getElementById('breeding');
            const blocBreeding = document.getElementById('blocBreeding');
            const radioIsLandOwnerBreedingYes = document.getElementById('is_land_owner_breeding_yes');
            const radioIsLandOwnerBreedingNo = document.getElementById('is_land_owner_breeding_no');

            // TOGGLE AGRICULTURE AND BREEDING
            function toggleActivity() {
                // Agriculture
                const productionAgriculture = document.getElementById('productionAgriculture');
                const transformationAgriculture = document.getElementById('transformationAgriculture');
                const inputsSupplyAgriculture = document.getElementById('inputsSupplyAgriculture');
                const equipmentSupplyAgriculture = document.getElementById('equipmentSupplyAgriculture');
                // Breeding
                const fishBreeding = document.getElementById('fishBreeding');
                const poultryBreeding = document.getElementById('poultryBreeding');
                const pigBreeding = document.getElementById('pigBreeding');
                const rabbitBreeding = document.getElementById('rabbitBreeding');
                const cattleBreeding = document.getElementById('cattleBreeding');
                const sheepBreeding = document.getElementById('sheepBreeding');

                if (agriculture.checked) {
                    blocAgriculture.classList.remove('d-none');

                } else {
                    productionAgriculture.checked = false;
                    transformationAgriculture.checked = false;
                    inputsSupplyAgriculture.checked = false;
                    equipmentSupplyAgriculture.checked = false;

                    blocAgriculture.classList.add('d-none');
                    resetAgriProduction();
                    resetAgriTransformation();
                    resetAgriInputsSupply();
                    resetAgriEquipmentSupply();
                }

                if (breeding.checked) {
                    blocBreeding.classList.remove('d-none');

                } else {
                    fishBreeding.checked = false;
                    poultryBreeding.checked = false;
                    pigBreeding.checked = false;
                    rabbitBreeding.checked = false;
                    cattleBreeding.checked = false;
                    sheepBreeding.checked = false;

                    blocBreeding.classList.add('d-none');
                    resetBreedFish();
                    resetBreedPoultry();
                    resetBreedPig();
                    resetBreedRabbit();
                    resetBreedCattle();
                    resetBreedSheep();
                }
            }

            // AGRICULTURE : Reset owner data
            function resetAgricultureDataNotOwner() {
                const landAreaYieldAgriculture = document.getElementById('landAreaYieldAgriculture');
                const isLandOwnerAgriculture = document.getElementById('isLandOwnerAgriculture');
                const inputsOwner = isLandOwnerAgriculture.querySelectorAll('input[type="text"], input[type="number"]');

                radioIsLandOwnerAgricultureNo.checked = true;

                landAreaYieldAgriculture.classList.add('d-none');
                inputsOwner.forEach(input => {
                    if (input.type === 'text') {
                        input.value = ''; // Reset text inputs to an empty string

                    } else if (input.type === 'number') {
                        input.value = ''; // Reset number inputs to an empty string to clear them
                    }
                });
            }

            // BREEDING : Reset owner data
            function resetBreedingDataNotOwner() {
                const landAreaBreeding = document.getElementById('landAreaBreeding');
                const inputsOwner = landAreaBreeding.querySelectorAll('input[type="text"], input[type="number"]');

                radioIsLandOwnerBreedingNo.checked = true;

                landAreaBreeding.classList.add('d-none');
                inputsOwner.forEach(input => {
                    if (input.type === 'text') {
                        input.value = ''; // Reset text inputs to an empty string

                    } else if (input.type === 'number') {
                        input.value = ''; // Reset number inputs to an empty string to clear them
                    }
                });
            }

            // TYPE-AGRI : Reset production type data
            function resetAgriProduction() {
                const landAreaYieldAgriculture = document.getElementById('landAreaYieldAgriculture');
                const productionData = document.getElementById('productionData');
                const inputsProductionData = productionData.querySelectorAll('input[type="text"], input[type="number"]');

                radioIsLandOwnerAgricultureNo.checked = true;

                landAreaYieldAgriculture.classList.add('d-none');
                productionData.classList.add('d-none');
                inputsProductionData.forEach(input => {
                    if (input.type === 'text') {
                        input.value = ''; // Reset text inputs to an empty string

                    } else if (input.type === 'number') {
                        input.value = ''; // Reset number inputs to an empty string to clear them
                    }
                });
            }

            // TYPE-AGRI : Reset transformation type data
            function resetAgriTransformation() {
                const transformationData = document.getElementById('transformationData');
                const inputsTransformationData = transformationData.querySelectorAll('input[type="text"], input[type="number"]');

                transformationData.classList.add('d-none');
                inputsTransformationData.forEach(input => {
                    if (input.type === 'text') {
                        input.value = ''; // Reset text inputs to an empty string

                    } else if (input.type === 'number') {
                        input.value = ''; // Reset number inputs to an empty string to clear them
                    }
                });
            }

            // TYPE-AGRI : Reset inputs-supply type data
            function resetAgriInputsSupply() {
                const inputsSupplyingData = document.getElementById('inputsSupplyingData');
                const inputsInputsSupplyingData = inputsSupplyingData.querySelectorAll('input[type="text"]');

                inputsSupplyingData.classList.add('d-none');
                inputsInputsSupplyingData.forEach(input => {
                    input.value = ''; // Reset text inputs to an empty string
                });
            }

            // TYPE-AGRI : Reset equipment-supply type data
            function resetAgriEquipmentSupply() {
                const equipmentSupplyingData = document.getElementById('equipmentSupplyingData');
                const inputsEquipmentSupplyingData = equipmentSupplyingData.querySelectorAll('input[type="text"]');

                equipmentSupplyingData.classList.add('d-none');
                inputsEquipmentSupplyingData.forEach(input => {
                    input.value = ''; // Reset text inputs to an empty string
                });
            }

            // TYPE-BREED : Reset fish type data
            function resetBreedFish() {
                const fishData = document.getElementById('fishData');
                const inputsFishData = fishData.querySelectorAll('input[type="text"], input[type="number"]');

                fishData.classList.add('d-none');
                inputsFishData.forEach(input => {
                    if (input.type === 'text') {
                        input.value = ''; // Reset text inputs to an empty string

                    } else if (input.type === 'number') {
                        input.value = ''; // Reset number inputs to an empty string to clear them
                    }
                });
            }

            // TYPE-BREED : Reset poultry type data
            function resetBreedPoultry() {
                const poultryData = document.getElementById('poultryData');
                const inputsPoultryData = poultryData.querySelectorAll('input[type="text"], input[type="number"]');

                poultryData.classList.add('d-none');
                inputsPoultryData.forEach(input => {
                    if (input.type === 'text') {
                        input.value = ''; // Reset text inputs to an empty string

                    } else if (input.type === 'number') {
                        input.value = ''; // Reset number inputs to an empty string to clear them
                    }
                });
            }

            // TYPE-BREED : Reset pig type data
            function resetBreedPig() {
                const pigData = document.getElementById('pigData');
                const inputsPigData = pigData.querySelectorAll('input[type="text"], input[type="number"]');

                pigData.classList.add('d-none');
                inputsPigData.forEach(input => {
                    if (input.type === 'text') {
                        input.value = ''; // Reset text inputs to an empty string

                    } else if (input.type === 'number') {
                        input.value = ''; // Reset number inputs to an empty string to clear them
                    }
                });
            }

            // TYPE-BREED : Reset rabbit type data
            function resetBreedRabbit() {
                const rabbitData = document.getElementById('rabbitData');
                const inputsRabbitData = rabbitData.querySelectorAll('input[type="text"], input[type="number"]');

                rabbitData.classList.add('d-none');
                inputsRabbitData.forEach(input => {
                    if (input.type === 'text') {
                        input.value = ''; // Reset text inputs to an empty string

                    } else if (input.type === 'number') {
                        input.value = ''; // Reset number inputs to an empty string to clear them
                    }
                });
            }

            // TYPE-BREED : Reset cattle type data
            function resetBreedCattle() {
                const cattleData = document.getElementById('cattleData');
                const inputsCattleData = cattleData.querySelectorAll('input[type="text"], input[type="number"]');

                cattleData.classList.add('d-none');
                inputsCattleData.forEach(input => {
                    if (input.type === 'text') {
                        input.value = ''; // Reset text inputs to an empty string

                    } else if (input.type === 'number') {
                        input.value = ''; // Reset number inputs to an empty string to clear them
                    }
                });
            }

            // TYPE-BREED : Reset sheep type data
            function resetBreedSheep() {
                const sheepData = document.getElementById('sheepData');
                const inputsSheepData = cattleData.querySelectorAll('input[type="text"], input[type="number"]');

                sheepData.classList.add('d-none');
                inputsSheepData.forEach(input => {
                    if (input.type === 'text') {
                        input.value = ''; // Reset text inputs to an empty string

                    } else if (input.type === 'number') {
                        input.value = ''; // Reset number inputs to an empty string to clear them
                    }
                });
            }

            // TOGGLE TYPES FOR AGRICULTURE OR BREEDING
            function toggleType() {
                // Agriculture
                const productionAgriculture = document.getElementById('productionAgriculture');
                const productionData = document.getElementById('productionData');
                const transformationAgriculture = document.getElementById('transformationAgriculture');
                const transformationData = document.getElementById('transformationData');
                const inputsSupplyAgriculture = document.getElementById('inputsSupplyAgriculture');
                const inputsSupplyingData = document.getElementById('inputsSupplyingData');
                const equipmentSupplyAgriculture = document.getElementById('equipmentSupplyAgriculture');
                const equipmentSupplyingData = document.getElementById('equipmentSupplyingData');
                // Breeding
                const fishBreeding = document.getElementById('fishBreeding');
                const fishData = document.getElementById('fishData');
                const poultryBreeding = document.getElementById('poultryBreeding');
                const poultryData = document.getElementById('poultryData');
                const pigBreeding = document.getElementById('pigBreeding');
                const pigData = document.getElementById('pigData');
                const rabbitBreeding = document.getElementById('rabbitBreeding');
                const rabbitData = document.getElementById('rabbitData');
                const cattleBreeding = document.getElementById('cattleBreeding');
                const cattleData = document.getElementById('cattleData');
                const sheepBreeding = document.getElementById('sheepBreeding');
                const sheepData = document.getElementById('sheepData');

                // Agriculture
                if (productionAgriculture.checked) {
                    productionData.classList.remove('d-none');

                } else {
                    productionData.classList.add('d-none');
                    resetAgriProduction();
                }

                if (transformationAgriculture.checked) {
                    transformationData.classList.remove('d-none');

                } else {
                    transformationData.classList.add('d-none');
                    resetAgriTransformation();
                }

                if (inputsSupplyAgriculture.checked) {
                    inputsSupplyingData.classList.remove('d-none');

                } else {
                    inputsSupplyingData.classList.add('d-none');
                    resetAgriInputsSupply();
                }

                if (equipmentSupplyAgriculture.checked) {
                    equipmentSupplyingData.classList.remove('d-none');

                } else {
                    equipmentSupplyingData.classList.add('d-none');
                    resetAgriEquipmentSupply();
                }

                // Breeding
                if (fishBreeding.checked) {
                    fishData.classList.remove('d-none');

                } else {
                    fishData.classList.add('d-none');
                    resetBreedFish();
                }

                if (poultryBreeding.checked) {
                    poultryData.classList.remove('d-none');

                } else {
                    poultryData.classList.add('d-none');
                    resetBreedPoultry();
                }

                if (pigBreeding.checked) {
                    pigData.classList.remove('d-none');

                } else {
                    pigData.classList.add('d-none');
                    resetBreedPig();
                }

                if (rabbitBreeding.checked) {
                    rabbitData.classList.remove('d-none');

                } else {
                    rabbitData.classList.add('d-none');
                    resetBreedRabbit();
                }

                if (cattleBreeding.checked) {
                    cattleData.classList.remove('d-none');

                } else {
                    cattleData.classList.add('d-none');
                    resetBreedCattle();
                }

                if (sheepBreeding.checked) {
                    sheepData.classList.remove('d-none');

                } else {
                    sheepData.classList.add('d-none');
                    resetBreedSheep();
                }
            }

            function isLandOwnerAgriculture() {
                const landAreaYieldAgriculture = document.getElementById('landAreaYieldAgriculture');

                if (radioIsLandOwnerAgricultureYes.checked) {
                    landAreaYieldAgriculture.classList.remove('d-none');

                } else {
                    landAreaYieldAgriculture.classList.add('d-none');
                    resetAgricultureDataNotOwner();
                }

                if (radioIsLandOwnerAgricultureNo.checked) {
                    landAreaYieldAgriculture.classList.add('d-none');
                    resetAgricultureDataNotOwner();

                } else {
                    landAreaYieldAgriculture.classList.remove('d-none');
                }
            }

            function isLandOwnerBreeding() {
                const landAreaBreeding = document.getElementById('landAreaBreeding');

                if (radioIsLandOwnerBreedingYes.checked) {
                    landAreaBreeding.classList.remove('d-none');

                } else {
                    landAreaBreeding.classList.add('d-none');
                    resetBreedingDataNotOwner();
                }

                if (radioIsLandOwnerBreedingNo.checked) {
                    landAreaBreeding.classList.add('d-none');
                    resetBreedingDataNotOwner();

                } else {
                    landAreaBreeding.classList.remove('d-none');
                }
            }

            // Initialize display on load
            document.addEventListener('DOMContentLoaded', () => {
                isLandOwnerAgriculture();
                isLandOwnerBreeding();
                toggleActivity();
                toggleType();

                agriculture.addEventListener('change', toggleActivity);
                radioIsLandOwnerAgricultureYes.addEventListener('change', isLandOwnerAgriculture);
                radioIsLandOwnerAgricultureNo.addEventListener('change', isLandOwnerAgriculture);
                breeding.addEventListener('change', toggleActivity);
                radioIsLandOwnerBreedingYes.addEventListener('change', isLandOwnerBreeding);
                radioIsLandOwnerBreedingNo.addEventListener('change', isLandOwnerBreeding);
            });
        </script>
@endif
@if (Route::is('register'))
        <script type="text/javascript">
            /**
             * Activate submit on check terms accept
             */
            function checkTermsAccept() {
                const termsAccept = document.getElementById('termsAccept');
                const registerNewUser = document.getElementById('registerNewUser');

                if (termsAccept.checked) {
                    registerNewUser.classList.remove('disabled');

                } else {
                    registerNewUser.classList.add('disabled');
                }
            }

            checkTermsAccept();
        </script>
@endif
@if (Route::is('discussion.home') || Route::is('discussion.datas'))
        <script type="text/javascript">
            /**
             * TinyMCE : Custom textarea
             */
            $('#newPostModal').on('shown.bs.modal', function () {
                tinymce.init({
                    selector: '#posts_content',
                    setup: function (editor) {
                        editor.on('init', function () {
                            editor.focus(false); // Empêche de prendre le focus immédiatement
                        });
                    }
                    // plugins: 'lists link image',
                    // toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image',
                    // setup: function (editor) {
                    //     editor.on('change', function () {
                    //         let content = editor.getContent();  // Texte avec les balises HTML
                    //         document.getElementById('posts_content').value = content;
                    //     });
                    // }
                });
            });
        </script>
@endif
        <script type="text/javascript">
            /**
             * Perform action on element
             */
            function performAction(action, entity, entity_id) {
                if (action === 'delete') {
                    var entityId = parseInt(entity_id.split('-')[1]);

                    Swal.fire({
                        title: "<?= __('miscellaneous.alert.attention.delete') ?>",
                        text: "<?= __('miscellaneous.alert.confirm.delete') ?>",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#04471a",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "<?= __('miscellaneous.alert.yes.delete') ?>",
                        cancelButtonText: "<?= __('miscellaneous.cancel') ?>"

                    }).then(function (result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                headers: headers,
                                type: "DELETE",
                                url: `${currentHost}/delete/${entity}/${entityId}`,
                                contentType: false,
                                processData: false,
                                data: JSON.stringify({ "entity" : entity, "id" : entityId }),
                                success: function (result) {
                                    if (!result.success) {
                                        Swal.fire({
                                            title: "<?= __('miscellaneous.alert.oups') ?>",
                                            text: result.message,
                                            icon: "error"
                                        });

                                    } else {
                                        Swal.fire({
                                            title: "<?= __('miscellaneous.alert.perfect') ?>",
                                            text: result.message,
                                            icon: "success"
                                        });
                                        location.reload();
                                    }
                                },
                                error: function (xhr, error, status_description) {
                                    console.log(xhr.responseJSON);
                                    console.log(xhr.status);
                                    console.log(error);
                                    console.log(status_description);
                                }
                            });

                        } else {
                            Swal.fire({
                                title: "<?= __('miscellaneous.cancel') ?>",
                                text: "<?= __('miscellaneous.alert.canceled.delete') ?>",
                                icon: "error"
                            });
                        }
                    });
                }
            }

            /**
             * Flatpickr : DateTime picker
             */
            flatpickr("#birthdate", {
                dateFormat: "Y-m-d",  // Affiche la date comme "YYYY-mm-dd"
                locale: locale,
                // onChange: function(selectedDates, dateStr, instance) {
                //     // Format MySQL avant l'envoi (automatique au submit)
                //     instance.input.value = selectedDates[0].toISOString().split('T')[0]; // YYYY-MM-DD
                // }
            });

            /**
             * Utility to update the list of files in the input
             */
            function FileListItems(files) {
                const dataTransfer = new DataTransfer();

                files.forEach(file => dataTransfer.items.add(file));

                return dataTransfer.files;
            }

            /**
             * Update order quantity
             */
            function updateProductQuantity(action, orderId, quantity = null) {
                let url = `${currentHost}/products/update-order-quantity/${orderId}`;
                let data = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    action: action
                };

                // If the action is "update", we add the specific quantity
                if (action === 'update') {
                    data.quantity = quantity;

                } else {
                    // For "increment" or "decrement", the quantity is always 1
                    data.quantity = 1;
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        // Update the UI if everything is fine
                        if (response.inCart) {
                            // Update the quantity in the input
                            $(`#order-quantity-${orderId}`).val(response.newQuantity);
                            // Display success message
                            $('#ajax-alert-container').html(`<div style="position: fixed; z-index: 9999; width: 100%; display: flex; justify-content: center;">
                                                                <div class="alert alert-success alert-dismissible" role="alert" style="width: 500px;">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <i class="bi bi-check-circle" style="margin-right: 8px; vertical-align: -2px;"></i>
                                                                    ${response.message || '{{ __("notifications.update_customer_order_success") }}'}
                                                                </div>
                                                            </div>`);
                        }

                        if (!response.inStock) {
                            // Update the quantity in the input
                            $(`#order-quantity-${orderId}`).val(response.newQuantity);
                            // Display error message if the stock is insufficient
                            $('#ajax-alert-container').html(`<div style="position: fixed; z-index: 9999; width: 100%; display: flex; justify-content: center;">
                                                                <div class="alert alert-danger alert-dismissible" role="alert" style="width: 500px;">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <i class="bi bi-exclamation-triangle" style="margin-right: 8px; vertical-align: -2px;"></i>
                                                                    {{ __('miscellaneous.public.insufficient_stock') }}
                                                                </div>
                                                            </div>`);
                        }

                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Update the quantity in the input
                        $(`#order-quantity-${orderId}`).val(xhr.responseJSON.newQuantity);
                        // Display error alert
                        $('#ajax-alert-container').html(`<div style="position: fixed; z-index: 9999; width: 100%; display: flex; justify-content: center;">
                                                            <div class="alert alert-danger alert-dismissible" role="alert" style="width: 500px;">
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <i class="bi bi-exclamation-triangle" style="margin-right: 8px; vertical-align: -2px;"></i>
                                                                ${xhr.responseJSON.message}
                                                            </div>
                                                        </div>`);
                        location.reload();
                    }
                });
            }

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

                /**
                 * Slick carousel
                 */
                $('.my-carousel').slick({
                    autoplay: true,
                    autoplaySpeed: 2000,
                    arrows: true,
                    dots: true
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

                /* Post form */
                $('#postForm').on('submit', function (e) {
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
                            $('#newPostModal').modal('hide');

                            // Réinitialiser tous les champs du formulaire
                            $('#postForm')[0].reset();

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

                /* Comment form */
                $('#comment-form').on('submit', function (e) {
                    e.preventDefault();

                    // Afficher l'animation de chargement
                    $('#loading-icon').show();

                    // Effacer les alertes précédentes
                    $('#ajax-alert-container').empty();

                    var formData = new FormData(this);

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
                                                                    ${response.message || 'Commentaire ajouté avec succès !'}
                                                                </div>
                                                            </div>`);

                            // Réinitialiser tous les champs du formulaire
                            $('#comment-form')[0].reset();

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

                /* Investor form */
                $('#investorForm').on('submit', function (e) {
                    e.preventDefault();

                    // Afficher l'animation de chargement
                    $('#loading-icon').show();

                    // Effacer les alertes précédentes
                    $('#ajax-alert-container').empty();

                    var formData = new FormData(this);

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
                                                                    ${response.message || 'Vous êtes maintenant un investisseur !'}
                                                                </div>
                                                            </div>`);

                            // Réinitialiser tous les champs du formulaire
                            $('#investorForm')[0].reset();

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

                /**
                 * Add to cart button
                 */
                $('.item-add-btn').on('click', function () {
                    const productId = $(this).data('id');
                    const productContainer = $(`#product-${productId}`); // Le conteneur du produit à mettre à jour

                    // Cacher le texte et afficher l'icône de chargement pour ce produit spécifique
                    $(`#icon-cart-text-${productId}`).css('opacity', 0);
                    $(`#ajax-loading-${productId}`).show();

                    $.ajax({
                        url: `${currentHost}/products/add-to-cart/${productId}`,
                        method: 'POST',
                        data: {
                            quantity: 500,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success(response) {
                            let newHtml = '';

                            if (!response.isLoggedIn) {
                                // Si l'utilisateur n'est pas connecté, on affiche un message ou un bouton "se connecter"
                                newHtml = `<p class="btn btn-default disabled" style="margin: -2px;">
                                                <span class="text-uppercase" style="font-size: 12px">@lang('miscellaneous.public.product_is_in_cart')</span>
                                            </p>`;

                            } else if (response.inCart) {
                                // Si le produit est dans le panier (connecté)
                                newHtml = `<p class="btn btn-default disabled" style="margin: -2px;">
                                                <span class="text-uppercase" style="font-size: 12px">@lang('miscellaneous.public.product_is_in_cart')</span>
                                            </p>`;

                            } else if (response.inStock) {
                                // Si le produit est en stock
                                newHtml = `<button class="item-add-btn" data-id="${productId}" style="position: relative;">
                                                <span id="icon-cart-text-${productId}" class="icon-cart-text">@lang('miscellaneous.public.add_to_cart')</span>
                                                <img id="ajax-loading-${productId}" src="{{ asset('assets/img/ajax-loading.gif') }}" alt="@lang('miscellaneous.loading')" width="30" height="30" style="position: absolute; top: 2px; right: 43%; display: none;">
                                            </button>`;

                            } else {
                                // Si le produit est en rupture de stock
                                newHtml = `<p class="btn btn-default disabled" style="margin: -2px;">
                                                <span class="text-uppercase">@lang('miscellaneous.public.insufficient_stock')</span>
                                            </p>`;
                            }

                            // Remplacer le bloc du produit avec le nouveau HTML
                            productContainer.find('.item-add-btn').replaceWith(newHtml);
                            $('#top-links').load(location.href + ' #top-links > *');
                            $('#quick-access').load(location.href + ' #quick-access > *');
                            console.log('Produit ajouté');
                        },
                        error(xhr) {
                            alert(xhr.responseJSON.message || '{{ __('notifications.add_error') }}');
                        }
                    });
                });
            });
        </script>
    </body>
</html>
