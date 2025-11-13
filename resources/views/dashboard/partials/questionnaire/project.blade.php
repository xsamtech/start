
            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">{{ $entity_title }}</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.questionnaire.home') }}">@lang('miscellaneous.menu.admin.questionnaire.title')</a></li>
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
                                <h5 class="mb-3">{{ $entity_title }}</h5>

                                <!-- Data list content -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered border-top">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>@lang('miscellaneous.admin.project_writing.data.description.label')</th>
                                                <th>@lang('miscellaneous.admin.project_writing.data.sheet_url_completed')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
@forelse ($items as $project)
                                            <tr>
                                                <td>
                                                    <img src="{{ count($project['photos']) > 0 ? $project['photos'][0]['file_url'] : asset('assets/img/undefined.png') }}" alt="" width="100">
                                                </td>
                                                <td>
                                                    <p class="m-0" style="max-width: 280px; white-space: normal;">{!! Str::limit($project['project_description'], 200, '...') !!}</p>
                                                </td>
                                                <td>
    @if (count($project['sheets']) > 0)
        @php
            $completedSheet = null;

            foreach ($project['sheets'] as $sheet) {
                if ($sheet['is_sheet_completed'] == 1) {
                    $completedSheet = $sheet;

                    break;  // On s'arrête dès qu'on trouve un fichier complété
                }
            }
        @endphp
        @if ($completedSheet)
                                                    <p class="m-0" style="max-width: 280px; white-space: normal;">
                                                        <a href="{{ $completedSheet['file_url'] }}">{{ getWebURL() . $completedSheet['file_url'] }}</a>
                                                    </p>
        @endif
    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('investor.datas', ['id' => $project['id']]) }}" target="_blank">
                                                        @lang('miscellaneous.details')<i class="feather-chevrons-right ms-1"></i>
                                                    </a><br>
    @if ($project['is_shared'] == 0)
                                                    <form action="{{ route('dashboard.questionnaire.entity.datas', ['entity' => 'project', 'id' => $project['id']]) }}" method="POST">
        @csrf
                                                        <input type="hidden" name="is_shared" value="1">
                                                        <button class="btn btn-sm w-100 btn-outline-success mt-1 pb-1 rounded-pill">
                                                            @lang('miscellaneous.share')
                                                        </button>
                                                    </form>
    @else
                                                    <form action="{{ route('dashboard.questionnaire.entity.datas', ['entity' => 'project', 'id' => $project['id']]) }}" method="POST">
        @csrf
                                                        <input type="hidden" name="is_shared" value="0">
                                                        <button class="btn btn-sm w-100 btn-outline-danger mt-1 pb-1 rounded-pill">
                                                            @lang('miscellaneous.unshare')
                                                        </button>
                                                    </form>
    @endif
                                                </td>
                                            </tr>
@empty
                                            <tr>
                                                <td colspan="4" class="lead text-center">@lang('miscellaneous.empty_list')</td>
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
