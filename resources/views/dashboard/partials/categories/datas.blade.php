
            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">{{ !empty($selected_category) ? __('miscellaneous.admin.group.category.details') : __('miscellaneous.admin.product.details', ['entity' => $selected_item->type == 'product' ? strtolower(__('miscellaneous.product')) : strtolower(__('miscellaneous.service'))]) }}</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.category.home') }}">@lang('miscellaneous.menu.admin.categories.title')</a></li>
@if (!empty($selected_item))
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.category.entity.home', ['entity' => $entity]) }}">{{ $entity_title ?? '------' }}</a></li>
@endif
                            <li class="breadcrumb-item">{{ !empty($selected_category) ? $selected_category->category_name : $selected_item->product_name }}</li>
                        </ul>
                    </div>
                </div>
                <!-- [ page-header ] end -->
                <!-- [ Main Content ] start -->
                <div class="main-content">
@if (!empty($selected_category))
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card overflow-hidden">
                                <div class="card-header strt-bg-green-transparent">
                                    <h5 class="mb-0 text-white">@lang('miscellaneous.admin.group.category.edit')</h5>
                                </div>

                                <div class="card-body">
                                    <div id="ajax-loader" class="position-absolute d-none" style="top: 10px; right: 10px;">
                                        <img src="{{ asset('assets/img/ajax-loading.gif') }}" alt="@lang('miscellaneous.loading')" width="32" height="32">
                                    </div>

                                    <form id="editCategoryForm" action="{{ route('dashboard.category.datas', ['id' => $selected_category->id]) }}" method="POST">
    @csrf
                                        <!-- Category name -->
                                        <div id="profileImageWrapper" style="margin-bottom: 20px;">
                                            <div class="text-center">
                                                <img src="{{ $selected_category->image_url ?? asset('assets/img/undefined.png') }}" alt="Cover" width="200" class="other-user-image" style="border-radius: 5px;">
                                                <label role="button" for="image_profile" class="btn btn-light">
                                                    <i class="bi bi-pencil-fill me-2 fs-6"></i>@lang('miscellaneous.change_image')
                                                    <input type="file" name="image_profile" id="image_profile" style="display: none;">
                                                </label>
                                            </div>
                                            <input type="hidden" name="image_64" id="image_64">
                                        </div>

                                        <!-- Category name -->
                                        <div class="mb-2">
                                            <label for="category_name_fr" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.category_name') (FR)</label>
                                            <input type="text" name="category_name_fr" class="form-control" id="category_name_fr" value="{{ $selected_category->getTranslation('category_name', 'fr') }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="category_name_en" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.category_name') (EN)</label>
                                            <input type="text" name="category_name_en" class="form-control" id="category_name_en" value="{{ $selected_category->getTranslation('category_name', 'en') }}">
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-2">
                                            <label for="category_description_fr" class="form-label fw-bold">@lang('miscellaneous.description') (FR)</label>
                                            <textarea name="category_description_fr" class="form-control" id="category_description_fr">{{ $selected_category->getTranslation('category_description', 'fr') }}</textarea>
                                        </div>
                                        <div class="mb-2">
                                            <label for="category_description_en" class="form-label fw-bold">@lang('miscellaneous.description') (EN)</label>
                                            <textarea name="category_description_en" class="form-control" id="category_description_en">{{ $selected_category->getTranslation('category_description', 'en') }}</textarea>
                                        </div>

                                        <!-- Alias -->
                                        <div class="mb-2">
                                            <label for="alias" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.alias.title')</label>
                                            <input type="text" name="alias" class="form-control" id="alias" placeholder="@lang('miscellaneous.admin.group.category.data.alias.description')" value="{{ $selected_category->alias }}">
                                        </div>

                                        <!-- Unit quantity -->
                                        <div class="mb-2">
                                            <label for="min_quantity" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.min_quantity.title')</label>
                                            <input type="number" name="min_quantity" class="form-control" id="min_quantity" placeholder="@lang('miscellaneous.admin.group.category.data.min_quantity.description')" value="{{ $selected_category->min_quantity }}">
                                        </div>

                                        <!-- For which group -->
                                        <div class="mb-2">
                                            <label for="for_service" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.for_which_group')</label>
                                            <select name="for_service" id="for_service" class="form-select">
                                                <option value="2"{{ $selected_category->for_service == 2 ? ' selected' : '' }}>@lang('miscellaneous.admin.group.category.data.for_projects')</option>
                                                <option value="5"{{ $selected_category->for_service == 0 ? ' selected' : '' }}>@lang('miscellaneous.admin.group.category.data.for_products')</option>
                                                <option value="1"{{ $selected_category->for_service == 1 ? ' selected' : '' }}>@lang('miscellaneous.admin.group.category.data.for_services')</option>
                                            </select>
                                        </div>

                                        <!-- Sector -->
                                        <div class="mb-2">
                                            <label for="project_sector_id" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.sector')</label>
                                            <select name="project_sector_id" id="project_sector_id" class="form-select">
                                                <option class="small"{{ empty($selected_category->project_sector_id) ? ' selected' : '' }} disabled>@lang('miscellaneous.admin.group.category.data.sector')</option>
    @foreach ($project_sectors as $sector)
                                                <option value="{{ $sector->id }}"{{ !empty($selected_category->project_sector_id) && $selected_category->project_sector_id == $sector->id ? ' selected' : '' }}>{{ $sector->sector_name }}</option>
    @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="btn strt-btn-chocolate-3 w-100 mt-4 px-4 rounded-pill">{{ __('miscellaneous.register') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-body">
                                <div class="card card-body shadow-0">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/addons/duralux/img/flags/4x3/fr.svg') }}" alt="" class="img-fluid wd-20 me-2" />
                                        <strong>Français</strong>
                                    </div>

                                    <h3 class="my-2">{{ $selected_category->getTranslation('category_name', 'fr') }}</h3>
                                    <p class="m-0">{{ $selected_category->getTranslation('category_description', 'fr') }}</p>
                                </div>
                                <div class="card card-body mb-3 shadow-0">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/addons/duralux/img/flags/4x3/us.svg') }}" alt="" class="img-fluid wd-20 me-2" />
                                        <strong>English</strong>
                                    </div>

                                    <h3 class="my-2">{{ $selected_category->getTranslation('category_name', 'en') }}</h3>
                                    <p class="m-0">{{ $selected_category->getTranslation('category_description', 'en') }}</p>
                                </div>

                                <div class="bg-image">
                                    <img src="{{ $selected_category->image_url }}" alt="" class="card-img mb-2 rounded-5" />
                                    <div class="mask"></div>
                                </div>
                                <h5 class="my-2 fw-lighter">
                                    @lang('miscellaneous.admin.group.category.data.alias.title')@lang('miscellaneous.colon_after_word')
                                    <strong>{{ $selected_category->alias }}</strong>
                                </h5>
                                <h5 class="my-2 fw-lighter">
                                    @lang('miscellaneous.admin.group.category.data.min_quantity.title')@lang('miscellaneous.colon_after_word')
                                    <strong>{{ $selected_category->min_quantity }}</strong>
                                </h5>
    @php
        $for_service = null;

        switch ($selected_category->for_service) {
            case 1:
                $for_service = __('miscellaneous.admin.group.category.data.for_services');
                break;
            
            case 2:
                $for_service = __('miscellaneous.admin.group.category.data.for_projects');
                break;
            
            default:
                $for_service = __('miscellaneous.admin.group.category.data.for_services');
                break;
        }
    @endphp
                                <h5 class="m-0 fw-lighter">
                                    @lang('miscellaneous.admin.group.category.data.for_which_group')@lang('miscellaneous.colon_after_word')
                                    <strong>{{ $for_service }}</strong>
                                </h5>
                            </div>
                        </div>
                    </div>
@else
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card card-body p-lg-4 p-3 border">
    @if ($selected_item->is_shared == 0)
                                            <form action="{{ route('product.entity.datas', ['entity' => 'product-sharing', 'id' => $selected_item->id]) }}" method="POST">
        @csrf
                                                <input type="hidden" name="is_shared" value="1">
                                                <button class="btn btn-sm btn-success mb-3 rounded-pill">
                                                    <i class="bi bi-check-lg me-2 fs-6"></i>@lang('miscellaneous.share')
                                                </button>
                                            </form>
    @else
                                            <form action="{{ route('product.entity.datas', ['entity' => 'product-sharing', 'id' => $selected_item->id]) }}" method="POST">
        @csrf
                                                <input type="hidden" name="is_shared" value="0">
                                                <button class="btn btn-sm btn-danger mb-3 rounded-pill">
                                                    <i class="bi bi-x-lg me-2 fs-6"></i>@lang('miscellaneous.unshare')
                                                </button>
                                            </form>
    @endif

    @if (count($selected_item->photos) > 0)
                                            <div id="productImages" class="carousel slide mb-4" data-bs-ride="carousel">
                                                <div class="carousel-indicators">
        @foreach ($selected_item->photos as $photo)
            @if ($loop->index == 0)
                                                    <button type="button" data-bs-target="#productImages" data-bs-slide-to="{{ $loop->index }}" class="active" aria-current="true" aria-label="Slide {{ $loop->index }}"></button>
            @else
                                                    <button type="button" data-bs-target="#productImages" data-bs-slide-to="{{ $loop->index }}" aria-label="Slide {{ $loop->index }}"></button>
            @endif
        @endforeach
                                                </div>
                                                <div class="carousel-inner rounded-4 overflow-hidden">
        @foreach ($selected_item->photos as $photo)
                                                    <div class="carousel-item{{ $loop->index == 0 ? ' active' : '' }}">
                                                        <img src="{{ $photo->file_url }}" class="d-block w-100" alt="{{ $selected_item->product_name . $loop->index }}" style="height: 350px; object-fit: cover;">
                                                    </div>
        @endforeach
                                                </div>

                                                <button class="carousel-control-prev" type="button" data-bs-target="#productImages" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">@lang('pagination.previous')</span>
                                                </button>

                                                <button class="carousel-control-next" type="button" data-bs-target="#productImages" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">@lang('pagination.next')</span>
                                                </button>
                                            </div>
    @endif

                                            <h1>{{ $selected_item->product_name }}</h1>

                                            <p class="fs-6">{{ $selected_item->product_description }}</p>
    @if ($selected_item->type == 'product')
                                            <p class="fs-6 mb-0 mt-1">
                                                <span style="text-decoration: underline;">@lang('miscellaneous.admin.product.action.title')</span>
                                                @lang('miscellaneous.colon_after_word') 
                                                <strong>
                                                    {{ __('miscellaneous.admin.product.action.' . $selected_item->action) }}
                                                </strong>
                                            </p>

                                            <p class="fs-6 mb-0 mt-1">
                                                <span style="text-decoration: underline;">@lang('miscellaneous.admin.product.data.quantity.title')</span>
                                                @lang('miscellaneous.colon_after_word') 
                                                <strong>
                                                    {{ $selected_item->quantity }} {{ $selected_item->quantity > 1 ? __('miscellaneous.units_of_measurement.tonne.name.plural') : __('miscellaneous.units_of_measurement.tonne.name.singular') }}
                                                </strong>
                                            </p>
    @endif
    @if ($selected_item->type == 'product')
                                            <p class="fs-6 mb-0 mt-1">
                                                <span style="text-decoration: underline;">@lang('miscellaneous.admin.product.data.product_price')</span>
                                                @lang('miscellaneous.colon_after_word') 
                                                <strong>
                                                    {{ formatDecimalNumber($selected_item->price) }} {{ $selected_item->currency }}
                                                </strong>
                                            </p>
    @else
                                            <p class="fs-6 mb-0 mt-1">
                                                <span style="text-decoration: underline;">@lang('miscellaneous.admin.product.data.service_price')</span>
                                                @lang('miscellaneous.colon_after_word') 
                                                <strong>
                                                    {{ formatDecimalNumber($selected_item->price) }} {{ $selected_item->currency }}
                                                </strong>
                                            </p>
    @endif

                                            <div class="card card-body mt-4 mb-0 px-lg-3 px-2 border bg-light" style="border-color: #d0d0d0!important">
                                                <div class="d-flex flex-lg-row flex-column align-items-center">
                                                    <div>
                                                        <img src="{{ $selected_item->user->avatar_url }}" alt="{{ $selected_item->user->firstname . ' ' . $selected_item->user->lastname }}" width="120" class="rounded-circle">
                                                    </div>
                                                    <div class="ps-sm-3 pt-lg-0 pt-1">
                                                        <h4>{{ $selected_item->user->firstname . ' ' . $selected_item->user->lastname }}</h4>
    @if (!empty($selected_item->user->email))
                                                        <p class="mb-0 text-muted"><i class="bi bi-envelope-fill me-2"></i>{{ $selected_item->user->email }}</p>
    @endif
    @if (!empty($selected_item->user->phone))
                                                        <p class="mt-1 mb-0 text-muted"><i class="bi bi-telephone-fill me-2"></i>{{ $selected_item->user->phone }}</p>
    @endif
    @if (!empty($selected_item->user->username))
                                                        <p class="mt-1 mb-0 text-muted"><i class="bi bi-person-fill me-2"></i>{{ '@' . $selected_item->user->username }}</p>
    @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card border overflow-hidden">
                                            <div class="card-header bg-light">
                                                <h3 class="m-0">@lang('miscellaneous.admin.product.members_comments')</h3>
                                            </div>
    @if (count($selected_item->feedbacks) > 0)
                                                <ul class="list-group list-group-flush">
        @foreach ($selected_item->feedbacks as $feedback)
                                                    <li class="list-group-item px-sm-4 px-3">
                                                        <div class="d-flex flex-sm-row flex-column">
                                                            <div class="mb-1">
                                                                <img src="{{ $feedback->user->avatar_url }}" alt="{{ $feedback->user->firstname . ' ' . $feedback->user->lastname }}" width="60">
                                                            </div>
                                                            <div class="ps-sm-3">
                                                                <h4 class="mb-1 text-primary">{{ $feedback->user->firstname . ' ' . $feedback->user->lastname }}</h4>
                                                                <p class="small mb-1 text-muted">{{ timeAgo($feedback->created_at) }}</p>
                                                                <p class="m-0 fw-normal">{!! $feedback->comment !!}</p>
                                                            </div><!-- End .comment-details -->
                                                        </div><!-- End .comment -->
                                                    </li>
        @endforeach
                                                </ul>
    @else
                                                <div class="d-flex justify-content-center align-items-center flex-column py-4">
                                                    <p style="margin-bottom: 0;"><i class="far fa-comment fs-1"></i></p>
                                                    <p class="lead strt-text-chocolate-2 text-center" style="margin-bottom: 0;">@lang('miscellaneous.empty_list')</p>
                                                </div>
    @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endif
                </div>
                <!-- [ Main Content ] end -->
            </div>
