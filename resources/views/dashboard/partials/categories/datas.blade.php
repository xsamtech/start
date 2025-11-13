
            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">@lang('miscellaneous.admin.group.category.details')</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.category.home') }}">@lang('miscellaneous.menu.admin.categories.title')</a></li>
                            <li class="breadcrumb-item">@lang('miscellaneous.details')</li>
                        </ul>
                    </div>
                </div>
                <!-- [ page-header ] end -->
                <!-- [ Main Content ] start -->
                <div class="main-content">
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
                                            <label for="alias" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.alias')</label>
                                            <input type="text" name="alias" class="form-control" id="alias" value="{{ $selected_category->alias }}">
                                        </div>

                                        <!-- Unit quantity -->
                                        <div class="mb-2">
                                            <label for="min_quantity" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.min_quantity')</label>
                                            <input type="text" name="min_quantity" class="form-control" id="min_quantity" value="{{ $selected_category->min_quantity }}">
                                        </div>

                                        <!-- For which group -->
                                        <div class="mb-2">
                                            <label for="for_service" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.for_which_group')</label>
                                            <select name="for_service" id="for_service" class="form-select">
                                                <option value="2"{{ $selected_category->for_service == 2 ? ' selected' : '' }}>@lang('miscellaneous.admin.group.category.data.for_projects')</option>
                                                <option value="0"{{ $selected_category->for_service == 0 ? ' selected' : '' }}>@lang('miscellaneous.admin.group.category.data.for_products')</option>
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
                                    @lang('miscellaneous.admin.group.category.data.alias')@lang('miscellaneous.colon_after_word')
                                    <strong>{{ $selected_category->alias }}</strong>
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
                </div>
                <!-- [ Main Content ] end -->
            </div>
