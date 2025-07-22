
            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">@lang('miscellaneous.admin.group.project_sector.details')</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.sector.home') }}">@lang('miscellaneous.menu.admin.project_sectors')</a></li>
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
                                    <h5 class="mb-0 text-white">@lang('miscellaneous.admin.group.project_sector.edit')</h5>
                                </div>

                                <div class="card-body">
                                    <div id="ajax-loader" class="position-absolute d-none" style="top: 10px; right: 10px;">
                                        <img src="{{ asset('assets/img/ajax-loading.gif') }}" alt="@lang('miscellaneous.loading')" width="32" height="32">
                                    </div>

                                    <form id="editSectorForm" action="{{ route('dashboard.sector.datas', ['id' => $selected_sector->id]) }}" method="POST">
@csrf
                                        <!-- Sector name -->
                                        <div class="mb-2">
                                            <label for="sector_name_fr" class="form-label fw-bold">@lang('miscellaneous.admin.group.project_sector.data.sector_name') (FR)</label>
                                            <input type="text" name="sector_name_fr" class="form-control" id="sector_name_fr" value="{{ $selected_sector->getTranslation('sector_name', 'fr') }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="sector_name_en" class="form-label fw-bold">@lang('miscellaneous.admin.group.project_sector.data.sector_name') (EN)</label>
                                            <input type="text" name="sector_name_en" class="form-control" id="sector_name_en" value="{{ $selected_sector->getTranslation('sector_name', 'en') }}">
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-2">
                                            <label for="sector_description_fr" class="form-label fw-bold">@lang('miscellaneous.description') (FR)</label>
                                            <textarea name="sector_description_fr" class="form-control" id="sector_description_fr">{{ $selected_sector->getTranslation('sector_description', 'fr') }}</textarea>
                                        </div>
                                        <div class="mb-2">
                                            <label for="sector_description_en" class="form-label fw-bold">@lang('miscellaneous.description') (EN)</label>
                                            <textarea name="sector_description_en" class="form-control" id="sector_description_en">{{ $selected_sector->getTranslation('sector_description', 'en') }}</textarea>
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

                                    <h3 class="my-2">{{ $selected_sector->getTranslation('sector_name', 'fr') }}</h3>
                                    <p class="m-0">{{ $selected_sector->getTranslation('sector_description', 'fr') }}</p>
                                </div>
                                <div class="card card-body mb-3 shadow-0">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/addons/duralux/img/flags/4x3/us.svg') }}" alt="" class="img-fluid wd-20 me-2" />
                                        <strong>English</strong>
                                    </div>

                                    <h3 class="my-2">{{ $selected_sector->getTranslation('sector_name', 'en') }}</h3>
                                    <p class="m-0">{{ $selected_sector->getTranslation('sector_description', 'en') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
