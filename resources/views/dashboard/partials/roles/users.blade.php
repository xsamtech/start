
            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">@lang('miscellaneous.admin.users.link')</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.role.home') }}">@lang('miscellaneous.admin.role.list')</a></li>
                            <li class="breadcrumb-item">{{ $entity_title }}</li>
                        </ul>
                    </div>
                </div>
                <!-- [ page-header ] end -->
                <!-- [ Main Content ] start -->
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <h5 class="mb-3">@lang('miscellaneous.admin.users.list')</h5>

                                    <form class="input-group mb-3" method="GET" style="width: 12rem;">
                                        <select name="role_id" class="form-select-sm m-0 border">
                                            <option class="small" disabled {{ request()->has('role_id') ? '' : 'selected' }}>@lang('miscellaneous.choose_role')</option>
@forelse ($roles as $role)
                                            <option value="{{ $role['id'] }}" {{ $role['id'] == request()->get('role_id') ? 'selected' : '' }} style="width: 10rem;">{{ $role['role_name'] }}</option>
@empty
@endforelse
                                        </select>
                                        <button type="submit" class="btn strt-btn-chocolate-3 m-0"><i class="fa-solid fa-search"></i></button>
                                    </form>
                                </div>

                                <!-- Data list content -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered border-top">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>@lang('miscellaneous.names')</th>
                                                <th>@lang('miscellaneous.menu.contact')</th>
                                                <th>@lang('miscellaneous.about_user.label')</th>
                                                <th>@lang('miscellaneous.menu.admin.role.title')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
@forelse ($items as $user)
                                            <tr>
                                                <td>
                                                    <img src="{{ $user['avatar_url'] }}" alt="{{ $user['firstname'] . ' ' . $user['lastname'] }}" class="rounded-circle" width="50">
                                                </td>
                                                <td>{{ $user['firstname'] . ' ' . $user['lastname'] }}</td>
                                                <td>
                                                    <p class="m-0"><a href="mailto:{{ $user['email'] }}">{{ $user['email'] }}</a></p>
                                                    <p class="m-0">{{ $user['phone'] }}</p>
                                                </td>
                                                <td>
                                                    <p class="m-0" style="max-width: 10rem; white-space: normal;">{{ $user['about_me'] }}</p>
                                                </td>
                                                <td>
                                                    <select id="userRole" class="form-select py-1" data-user-id="{{ $user['id'] }}" data-user-role-id="$user['selected_role']['id']" onchange="changeUserRole(this)">
                                                        <option class="small" disabled>@lang('miscellaneous.choose_role')</option>
    @forelse ($roles as $role)
                                                        <option value="{{ $role['id'] }}" {{ $role['id'] == $user['selected_role']['id'] ? 'selected' : '' }}>{{ $role['role_name'] }}</option>
    @empty
    @endforelse
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.role.entity.datas', ['entity' => 'users', 'id' => $user['id'], 'from' => $items_req->currentPage()]) }}">
                                                        @lang('miscellaneous.details')<i class="feather-chevrons-right ms-1"></i>
                                                    </a><br>
                                                    <a role="button" class="d-inline-block mt-1 rounded-pill text-danger" onclick="event.preventDefault(); performAction('delete', 'user', 'item-{{ $user['id'] }}')">
                                                        <i class="feather-trash-2 me-2"></i>@lang('miscellaneous.delete')
                                                    </a><br>
    @if ($user['status'] == 'blocked')
                                                    <form action="{{ route('dashboard.role.entity.datas', ['entity' => 'user-status', 'id' => $user['id']]) }}" method="POST">
        @csrf
                                                        <input type="hidden" name="status" value="activated">
                                                        <button class="btn btn-sm w-100 btn-outline-success mt-3 pb-1 rounded-pill">
                                                            @lang('miscellaneous.activate')
                                                        </button>
                                                    </form>
    @else
                                                    <form action="{{ route('dashboard.role.entity.datas', ['entity' => 'user-status', 'id' => $user['id']]) }}" method="POST">
        @csrf
                                                        <input type="hidden" name="status" value="blocked">
                                                        <button class="btn btn-sm w-100 btn-outline-danger mt-3 pb-1 rounded-pill">
                                                            @lang('miscellaneous.lock')
                                                        </button>
                                                    </form>
    @endif
                                                </td>
                                            </tr>
@empty
                                            <tr>
                                                <td colspan="6" class="lead text-center">@lang('miscellaneous.empty_list')</td>
                                            </tr>
@endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-3">
                                    {{ $items_req->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
