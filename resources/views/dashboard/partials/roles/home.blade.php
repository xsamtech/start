
            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">@lang('miscellaneous.admin.role.list')</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item">@lang('miscellaneous.admin.role.list')</li>
                        </ul>
                    </div>
                </div>
                <!-- [ page-header ] end -->
                <!-- [ Main Content ] start -->
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-body">
                                <h5 class="mb-3">@lang('miscellaneous.admin.role.list')</h5>

                                <!-- Data list content -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered border-top">
                                        <thead>
                                            <tr>
                                                <th>@lang('miscellaneous.admin.role.data.role_name')</th>
                                                <th>@lang('miscellaneous.description')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
@forelse ($roles as $role)
                                            <tr>
                                                <td>{{ $role['role_name'] }}</td>
                                                <td>
                                                    <p class="m-0" style="max-width: 280px; white-space: normal;">{{ $role['role_description'] }}</p>
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.role.entity.datas', ['entity' => 'role', 'id' => $role['id']]) }}">
                                                        @lang('miscellaneous.details')<i class="feather-chevrons-right ms-1"></i>
                                                    </a><br>
                                                    <a role="button" class="d-inline-block mt-1 rounded-pill text-danger" onclick="event.preventDefault(); performAction('delete', 'role', 'item-{{ $role['id'] }}')">
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
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card overflow-hidden">
                                <div class="card-header strt-bg-green-transparent">
                                    <h5 class="mb-0 text-white">@lang('miscellaneous.menu.admin.questionnaire.questions.add')</h5>
                                </div>

                                <div class="card-body">
                                    <form id="addRoleForm" action="{{ route('dashboard.role.home') }}" method="POST">
@csrf
                                        <!-- Role name -->
                                        <div class="mb-2">
                                            <label for="role_name_fr" class="form-label fw-bold">@lang('miscellaneous.admin.role.data.role_name') (FR)</label>
                                            <input type="text" name="role_name_fr" class="form-control" id="role_name_fr">
                                        </div>
                                        <div class="mb-2">
                                            <label for="role_name_en" class="form-label fw-bold">@lang('miscellaneous.admin.role.data.role_name') (EN)</label>
                                            <input type="text" name="role_name_en" class="form-control" id="role_name_en">
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-2">
                                            <label for="role_description_fr" class="form-label fw-bold">@lang('miscellaneous.description') (FR)</label>
                                            <textarea name="role_description_fr" class="form-control" id="role_description_fr"></textarea>
                                        </div>
                                        <div class="mb-2">
                                            <label for="role_description_en" class="form-label fw-bold">@lang('miscellaneous.description') (EN)</label>
                                            <textarea name="role_description_en" class="form-control" id="role_description_en"></textarea>
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
