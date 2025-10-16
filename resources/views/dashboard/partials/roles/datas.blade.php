
            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">{{ $entity_title }}</h5>
                        </div>
                        <ul class="breadcrumb">
@if (!empty($entity_title))
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.role.home') }}">@lang('miscellaneous.menu.admin.role.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.role.entity.home', ['entity' => $entity]) }}">{{ $entity == 'users' ? __('miscellaneous.admin.users.list') : __('Some menu') }}</a></li>
                            <li class="breadcrumb-item">{{ $entity_title }}</li>
@else
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.role.home') }}">@lang('miscellaneous.admin.role.list')</a></li>
                            <li class="breadcrumb-item">{{ $selected_entity['role_name'] }}</li>
@endif
                        </ul>
                    </div>
                </div>
                <!-- [ page-header ] end -->
                <!-- [ Main Content ] start -->
                <div class="main-content">
                    <div class="row">
@if ($entity == 'role')
                        <div class="col-lg-6">
                            <a href="{{ route('dashboard.role.home', ['page' => request()->get('from')]) }}" class="btn btn-light mb-2">
                                <i class="bi bi-chevron-double-left me-2"></i>@lang('miscellaneous.back')
                            </a>

                            <div class="card overflow-hidden">
                                <div class="card-header strt-bg-green-transparent">
                                    <h5 class="mb-0 text-white">@lang('miscellaneous.admin.role.edit')</h5>
                                </div>

                                <div class="card-body">
                                    <form id="addRoleForm" action="{{ route('dashboard.role.datas', ['id' => $selected_entity['id']]) }}" method="POST">
    @csrf
                                        <!-- Role name -->
                                        <div class="mb-2">
                                            <label for="role_name_fr" class="form-label fw-bold">@lang('miscellaneous.admin.role.data.role_name') (FR)</label>
                                            <input type="text" name="role_name_fr" class="form-control" id="role_name_fr" value="{{ $selected_entity['role_name_fr'] }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="role_name_en" class="form-label fw-bold">@lang('miscellaneous.admin.role.data.role_name') (EN)</label>
                                            <input type="text" name="role_name_en" class="form-control" id="role_name_en" value="{{ $selected_entity['role_name_en'] }}">
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-2">
                                            <label for="role_description_fr" class="form-label fw-bold">@lang('miscellaneous.description') (FR)</label>
                                            <textarea name="role_description_fr" class="form-control" id="role_description_fr">{{ $selected_entity['role_description_fr'] }}</textarea>
                                        </div>
                                        <div class="mb-2">
                                            <label for="role_description_en" class="form-label fw-bold">@lang('miscellaneous.description') (EN)</label>
                                            <textarea name="role_description_en" class="form-control" id="role_description_en">{{ $selected_entity['role_description_en'] }}</textarea>
                                        </div>

                                        <button type="submit" class="btn strt-btn-chocolate-3 w-100 mt-4 px-4 rounded-pill">{{ __('miscellaneous.update') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-body mb-4">
                                <div class="card card-body shadow-0">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/addons/duralux/img/flags/4x3/fr.svg') }}" alt="" class="img-fluid wd-20 me-2" />
                                        <strong>Français</strong>
                                    </div>

                                    <h3 class="my-2">{{ $selected_entity['role_name_fr'] ?? '' }}</h3>
                                    <p class="m-0">
                                        <u>@lang('miscellaneous.description')</u><br>
                                        {{ $selected_entity['role_description_fr'] ?? '' }}
                                    </p>
                                </div>
                                <div class="card card-body mb-3 shadow-0">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/addons/duralux/img/flags/4x3/us.svg') }}" alt="" class="img-fluid wd-20 me-2" />
                                        <strong>English</strong>
                                    </div>

                                    <h3 class="my-2">{{ $selected_entity['role_name_en'] ?? '' }}</h3>
                                    <p class="m-0">
                                        <u>@lang('miscellaneous.description')</u><br>
                                        {{ $selected_entity['role_description_en'] ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
@endif

@if ($entity == 'users')
                        <div class="col-lg-4">
                            <a href="{{ route('dashboard.role.entity.home', ['entity' => 'users', 'page' => request()->get('from')]) }}" class="btn btn-light mb-2">
                                <i class="bi bi-chevron-double-left me-2"></i>@lang('miscellaneous.back')
                            </a>

                            <div class="card overflow-hidden">
                                <div class="card-body text-center">
                                    <div class="bg-image mb-3">
                                        <img src="{{ $selected_entity['avatar_url'] }}" alt="{{ $selected_entity['firstname'] . ' ' . $selected_entity['lastname'] }}" class="img-fluid img-thumbnail rounded-circle">
                                        <div class="mask"></div>
                                    </div>
                                    <h4 class="card-title">{{ $selected_entity['firstname'] . ' ' . $selected_entity['lastname'] }}</h4>
                                    <h4 class="m-0">
                                        <span class="badge text-bg-secondary text-uppercase">
                                            <i class="bi bi-mortarboard me-2 fs-5" style="vertical-align: -3px;"></i>{{ $selected_entity['selected_role']['role_name'] }}
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card card-body mb-4">
                                <div class="table-responsive">
                                    <table id="personalInfo" class="table" style="border: 0;">
                                        <!-- First name -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.firstname')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($selected_entity['firstname']) ? $selected_entity['firstname'] : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Last name -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.lastname')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td class="text-uppercase">{{ !empty($selected_entity['lastname']) ? $selected_entity['lastname'] : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Surname -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.surname')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td class="text-uppercase">{{ !empty($selected_entity['surname']) ? $selected_entity['surname'] : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Username -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.username')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($selected_entity['username']) ? '@' . $selected_entity['username'] : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Gender -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.gender_title')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($selected_entity['gender']) ? ($selected_entity['gender'] == 'F' ? __('miscellaneous.gender2') : __('miscellaneous.gender1')) : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Birth date -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.birth_date.label')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($selected_entity['birthdate']) ? ucfirst(__('miscellaneous.on_date') . ' ' . explicitDate($selected_entity['birthdate']))  : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Nationality -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.nationality')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($selected_entity['nationality']) ? $selected_entity['nationality'] : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- E-mail -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.email')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($selected_entity['email']) ? $selected_entity['email'] : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Phone -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.phone')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($selected_entity['phone']) ? $selected_entity['phone'] : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Addresses -->
    @if (!empty($selected_entity['address_1']) && !empty($selected_entity['address_2']))
                                        <tr>
                                            <td><strong>@lang('miscellaneous.addresses')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>
                                                <ul class="ps-0">
                                                    <li class="dktv-line-height-1_4 mb-2" style="list-style: none;">
                                                        <i class="bi bi-geo-alt-fill me-1"></i>{{ $selected_entity['address_1'] }}
                                                    </li>
                                                    <li class="dktv-line-height-1_4" style="list-style: none;">
                                                        <i class="bi bi-geo-alt-fill me-1"></i>{{ $selected_entity['address_2'] }}
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
    @else
                                        <tr>
                                            <td><strong>@lang('miscellaneous.address.title')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($selected_entity['address_1']) ? $selected_entity['address_1'] : (!empty($selected_entity['address_2']) ? $selected_entity['address_2'] : '- - - - - -') }}</td>
                                        </tr>
    @endif

                                        <!-- P.O. box -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.p_o_box')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($selected_entity['p_o_box']) ? $selected_entity['p_o_box'] : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- City -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.address.city')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($selected_entity['city']) ? $selected_entity['city'] : '- - - - - -' }}</td>
                                        </tr>

                                        <!-- Country -->
                                        <tr>
                                            <td><strong>@lang('miscellaneous.country')</strong></td>
                                            <td>@lang('miscellaneous.colon_after_word')</td>
                                            <td>{{ !empty($selected_entity['country']) ? $selected_entity['country'] : '- - - - - -' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
@endif
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
