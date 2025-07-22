
            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">@lang('miscellaneous.menu.admin.project_sectors')</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item">@lang('miscellaneous.menu.admin.project_sectors')</li>
                        </ul>
                    </div>
                </div>
                <!-- [ page-header ] end -->
                <!-- [ Main Content ] start -->
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-body">
                                <h5 class="mb-3">@lang('miscellaneous.admin.group.project_sector.list')</h5>

                                <!-- Data list content -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered border-top">
                                        <thead>
                                            <tr>
                                                <th>@lang('miscellaneous.admin.group.project_sector.data.sector_name')</th>
                                                <th>@lang('miscellaneous.description')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
@forelse ($sectors as $sector)
                                            <tr>
                                                <td>{{ $sector['sector_name'] }}</td>
                                                <td>
                                                    <p class="m-0" style="max-width: 280px; white-space: normal;">{{ $sector['sector_description'] }}</p>
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.sector.datas', ['id' => $sector['id']]) }}">
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
                                    {{ $sectors_req->links() }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card overflow-hidden">
                                <div class="card-header strt-bg-green-transparent">
                                    <h5 class="mb-0 text-white">@lang('miscellaneous.admin.group.project_sector.add')</h5>
                                </div>

                                <div class="card-body">
                                    <div id="ajax-loader" class="position-absolute d-none" style="top: 10px; right: 10px;">
                                        <img src="{{ asset('assets/img/ajax-loading.gif') }}" alt="@lang('miscellaneous.loading')" width="32" height="32">
                                    </div>

                                    <form id="addSectorForm" action="{{ route('dashboard.sector.home') }}" method="POST">
@csrf
                                        <!-- Sector name -->
                                        <div class="mb-2">
                                            <label for="sector_name_fr" class="form-label fw-bold">@lang('miscellaneous.admin.group.project_sector.data.sector_name') (FR)</label>
                                            <input type="text" name="sector_name_fr" class="form-control" id="sector_name_fr">
                                        </div>
                                        <div class="mb-2">
                                            <label for="sector_name_en" class="form-label fw-bold">@lang('miscellaneous.admin.group.project_sector.data.sector_name') (EN)</label>
                                            <input type="text" name="sector_name_en" class="form-control" id="sector_name_en">
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-2">
                                            <label for="sector_description_fr" class="form-label fw-bold">@lang('miscellaneous.description') (FR)</label>
                                            <textarea name="sector_description_fr" class="form-control" id="sector_description_fr"></textarea>
                                        </div>
                                        <div class="mb-2">
                                            <label for="sector_description_en" class="form-label fw-bold">@lang('miscellaneous.description') (EN)</label>
                                            <textarea name="sector_description_en" class="form-control" id="sector_description_en"></textarea>
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
