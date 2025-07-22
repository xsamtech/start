
            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">@lang('miscellaneous.menu.admin.categories.title')</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item">@lang('miscellaneous.menu.admin.categories.title')</li>
                        </ul>
                    </div>
                </div>
                <!-- [ page-header ] end -->
                <!-- [ Main Content ] start -->
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-body">
                                <h5 class="mb-3">@lang('miscellaneous.admin.group.category.list')</h5>

                                <!-- Data list content -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered border-top">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>@lang('miscellaneous.admin.group.category.data.category_name')</th>
                                                <th>@lang('miscellaneous.description')</th>
                                                <th>@lang('miscellaneous.admin.group.category.data.sector')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
@forelse ($m_categories as $category)
                                            <tr>
                                                <td><img src="{{ $category['image_url'] }}" alt="" width="40"></td>
                                                <td>
                                                    <p class="m-0" style="max-width: 280px; white-space: normal;">{{ $category['category_name'] }}</p>
                                                </td>
                                                <td>
                                                    <p class="m-0" style="max-width: 280px; white-space: normal;">{{ $category['category_description'] }}</p>
                                                </td>
                                                <td>
                                                    <p class="m-0" style="max-width: 280px; white-space: normal;">{{ !empty($category['project_sector']) ? $category['project_sector']['sector_name'] : '' }}</p>
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.category.datas', ['id' => $category['id']]) }}">
                                                        @lang('miscellaneous.details')<i class="feather-chevrons-right ms-1"></i>
                                                    </a><br>
                                                    <a class="d-inline-block mt-1 rounded-pill text-danger" href="#">
                                                        <i class="feather-trash-2 me-2"></i>@lang('miscellaneous.delete')
                                                    </a>
                                                </td>
                                            </tr>
@empty
                                            <tr>
                                                <td colspan="3" class="lead text-center">@lang('miscellaneous.empty_list')</td>
                                            </tr>
@endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-3">
                                    {{ $categories_req->links() }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card overflow-hidden">
                                <div class="card-header strt-bg-green-transparent">
                                    <h5 class="mb-0 text-white">@lang('miscellaneous.admin.group.category.add')</h5>
                                </div>

                                <div class="card-body">
                                    <div id="ajax-loader" class="position-absolute d-none" style="top: 10px; right: 10px;">
                                        <img src="{{ asset('assets/img/ajax-loading.gif') }}" alt="@lang('miscellaneous.loading')" width="32" height="32">
                                    </div>

                                    <form id="addCategoryForm" action="{{ route('dashboard.category.home') }}" method="POST">
@csrf
                                        <!-- Category name -->
                                        <div id="profileImageWrapper" style="margin-bottom: 20px;">
                                            <div class="text-center">
                                                <img src="{{ asset('assets/img/undefined.png') }}" alt="Cover" width="200" class="other-user-image" style="border-radius: 5px;">
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
                                            <input type="text" name="category_name_fr" class="form-control" id="category_name_fr">
                                        </div>
                                        <div class="mb-2">
                                            <label for="category_name_en" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.category_name') (EN)</label>
                                            <input type="text" name="category_name_en" class="form-control" id="category_name_en">
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-2">
                                            <label for="category_description_fr" class="form-label fw-bold">@lang('miscellaneous.description') (FR)</label>
                                            <textarea name="category_description_fr" class="form-control" id="category_description_fr"></textarea>
                                        </div>
                                        <div class="mb-2">
                                            <label for="category_description_en" class="form-label fw-bold">@lang('miscellaneous.description') (EN)</label>
                                            <textarea name="category_description_en" class="form-control" id="category_description_en"></textarea>
                                        </div>

                                        <!-- Alias -->
                                        <div class="mb-2">
                                            <label for="alias" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.alias')</label>
                                            <input type="text" name="alias" class="form-control" id="alias">
                                        </div>

                                        <!-- For which group -->
                                        <div class="mb-2">
                                            <label for="for_service" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.for_which_group')</label>
                                            <select name="for_service" id="for_service" class="form-select">
                                                <option value="2">@lang('miscellaneous.admin.group.category.data.for_projects')</option>
                                                <option value="0" selected>@lang('miscellaneous.admin.group.category.data.for_products')</option>
                                                <option value="1">@lang('miscellaneous.admin.group.category.data.for_services')</option>
                                            </select>
                                        </div>

                                        <!-- Sector -->
                                        <div class="mb-2">
                                            <label for="project_sector_id" class="form-label fw-bold">@lang('miscellaneous.admin.group.category.data.sector')</label>
                                            <select name="project_sector_id" id="project_sector_id" class="form-select">
                                                <option class="small" selected disabled>@lang('miscellaneous.admin.group.category.data.sector')</option>
@foreach ($project_sectors as $sector)
                                                <option value="{{ $sector->id }}">{{ $sector->sector_name }}</option>
@endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="btn strt-btn-chocolate-3 w-100 mt-4 px-4 rounded-pill">{{ __('miscellaneous.register') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
