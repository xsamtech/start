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
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
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
            #footer .bottom a { color: #84bb26; }
            #footer .bottom a { color: #84bb26; }
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
            #paymentMethod, #phoneNumberForMoney { margin-bottom: 10px; }
            .article .article-meta-date { background: #732f0b; }
            .article-author-image img {
                width: 145px;
                height: 145px;
            }
            .comment img {
                width: 70px;
                height: 70px;
            }
            @media screen and (min-width: 500px) {
                .d-xs-none { display: inline-block; }
                .d-lg-none { display: none; }
                #paymentMethod { text-align: center; }
            }
            @media screen and (max-width: 500px) {
                .d-xs-none { display: none; }
                .d-lg-none { display: inline-block; }
                .article-author-image img {
                    width: 100%;
                    margin-bottom: 20px;
                }
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
                                    <input type="radio" name="transaction_type_id" id="mobile_money" value="1" style="position: relative; top: 1px;" /><span class="text-muted" style="display: inline-block; margin-left: 8px;">@lang('miscellaneous.public.about.subscribe.send_money.mobile_money')</span>
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
                                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
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

    @if ($entity == 'projects')
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
                        <h2 class="text-center" style="font-weight: 700;">@lang('miscellaneous.admin.product.add', ['entity' => __('miscellaneous.admin.product.entity.project.singular')])</h2>
                        <hr>

                        <form id="productForm" action="{{ route('product.entity', ['entity' => 'project']) }}" method="POST">
        @csrf
                            <input type="hidden" name="type" value="project">

                            <div class="row">
                                <!-- Product name -->
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="product_name">@lang('miscellaneous.admin.product.data.product_name', ['entity' => __('miscellaneous.admin.product.entity.project.singular')])</label>
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
                                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
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
@if (Route::is('investor.home') && !empty($current_user))
        <!-- ### Add product ### -->
        <div class="modal fade" id="newInvestorModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding: 5px; border: 0;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="@lang('miscellaneous.close')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="padding-top: 10px;">
                        <h2 class="text-center" style="font-weight: 700;">@lang('miscellaneous.public.investor.become_investor.link')</h2>
                        <hr>

                        <form id="investorForm" action="{{ route('dashboard.role.entity.datas', ['entity' => 'users', 'id' => $current_user->id]) }}" method="POST">
    @csrf
                            <input type="hidden" name="user_id" value="{{ $current_user->id }}">
                            <input type="hidden" name="role_id" value="{{ $role_investor->id }}">

                            <p class="lead text-center" style="margin-bottom: 0;">@lang('miscellaneous.public.investor.become_investor.info')</p>

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
@if (Route::is('crowdfunding.datas'))
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
                            <input type="hidden" name="crowdfunding_id" value="{{ !empty($selected_crowdfunding) ? $selected_crowdfunding->id : null }}">

                            <div class="row">
                                <!-- Amount -->
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="amount">@lang('miscellaneous.admin.crowdfunding.data.amount')</label>
                                        <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
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
                            </div>

                            <hr>
                            <div id="paymentMethod">
                                <p class="lead" style="margin-bottom: 5px;">@lang('miscellaneous.payment_method')</p>

                                <label class="radio-inline" for="mobile_money">
                                    <img src="{{ asset('assets/img/payment-mobile-money.png') }}" alt="@lang('miscellaneous.public.about.subscribe.send_money.mobile_money')" width="40" style="vertical-align: middle; margin-right: 20px;">
                                    <input type="radio" name="transaction_type_id" id="mobile_money" value="1" style="position: relative; top: 1px;" /><span class="text-muted" style="display: inline-block; margin-left: 8px;">@lang('miscellaneous.public.about.subscribe.send_money.mobile_money')</span>
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
                                        <li><a href="{{ route('account.home') }}" title="@lang('miscellaneous.menu.account.title')"><i class="bi bi-person" style="margin-right: 0.5rem!important;"></i><span class="hide-for-xs">@lang('miscellaneous.menu.account.title')</span></a></li>
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
            							<p class="header-link"><a href="{{ route('login') }}">@lang('auth.login')</a>&nbsp;or&nbsp;<a href="{{ route('register') }}">@lang('auth.register')</a></p>
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
@session('cart')
    @php
        $cartItems = session()->get('cart', []);
    @endphp
                                        <div class="dropdown-cart-menu-container pull-right">
                                            <div class="btn-group dropdown-cart">
                                                <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
                                                    <span class="cart-menu-icon"></span>
                                                    {{ trans_choice('miscellaneous.items', count($cartItems), ['count' => count($cartItems)]) }} <span class="drop-price">- {{ formatDecimalNumber($session_cart_total) . ' FC' }}</span>
                                                </button>

                                                <div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
                                                    <p class="dropdown-cart-description">{{ trans_choice('miscellaneous.recently_added_items', count($cartItems)) }}</p>
    @if (count($cartItems) > 0)
                                                    <ul class="dropdown-cart-product-list">
        @foreach ($cartItems as $item)
            @if ($loop->index < 3)
                                                        <li class="item clearfix">
                                                            <a href="#" title="Delete item" class="delete-item">
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
                                                                    {{ $item['quantity'] }}x <span class="item-price">{{ formatDecimalNumber($item['price']) . ' FC' }}</span>
                                                                </p>
                                                            </div><!-- End .dropdown-cart-details -->
                                                        </li>
            @endif
        @endforeach
                                                    </ul>
                                                    <ul class="dropdown-cart-total">
                                                        <li><span class="dropdown-cart-total-title">
                                                            {{ 'TOTAL' . __('miscellaneous.colon_after_word') }}</span>
                                                            {{ formatDecimalNumber($session_cart_total) . ' FC' }}
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
                                                    {{ trans_choice('miscellaneous.items', count($user_orders), ['count' => count($user_orders)]) }} <span class="drop-price">- {{ $current_user->unpaidCartTotal() . ' ' . $current_user->readable_currency }}</span>
                                                </button>

                                                <div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
                                                    <p class="dropdown-cart-description">{{ trans_choice('miscellaneous.recently_added_items', count($user_orders)) }}</p>
    @if (count($user_orders) > 0)
                                                    <ul class="dropdown-cart-product-list">
        @php
            foreach ($user_orders as $item) {
                $item->converted_price = $item->convertPriceAtThatTime($current_user->currency);
                $item->subtotal_price = $item->subtotalPrice($current_user->currency);
            }

            $itemsArray = $user_orders->toArray();
        @endphp

        @foreach ($itemsArray as $item)
            @if ($loop->index < 3)
                                                        <li class="item clearfix">
                                                            <a href="#" title="Delete item" class="delete-item">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                            <a href="{{ route('account.entity', ['entity' => 'cart']) }}" title="Edit item" class="edit-item">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <figure>
                                                                <a href="{{ route('product.entity.datas', ['entity' => 'product', 'id' => 1]) }}">
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
                                                            {{ $current_user->unpaidCartTotal() . ' ' . $current_user->readable_currency }}
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
        <script src="{{ asset('assets/addons/jquery/js/jquery-ui.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/i18n/jquery-ui-i18n.min.js"></script>
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
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="https://cdn.tiny.cloud/1/1jb70lfiyigr5qfhgclx0pv2t9fnl4uco3cs1xk50eqdz73i/tinymce/5/tinymce.min.js"></script>
        <script src="{{ asset('assets/js/scripts.custom.js') }}"></script>

        <script>
            /**
             * TinyMCE : Custom textarea
             */
            tinymce.init({
                selector: '#posts_content',
                // plugins: 'lists link image',
                // toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image',
                // setup: function (editor) {
                //     editor.on('change', function () {
                //         let content = editor.getContent();  // Texte avec les balises HTML
                //         document.getElementById('posts_content').value = content;
                //     });
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
             * For all number fields, it is forbidden to enter a value less than 500
             */
            const inputs = document.querySelectorAll('.input-minimum');

            inputs.forEach(input => {
                input.addEventListener('input', function () {
                    if (parseInt(input.value) < 500) {
                        input.value = 500;
                    }
                });
            });

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
                            quantity: 1,
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
