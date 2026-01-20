
            <div class="nxl-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">{{ $entity_title }}</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('miscellaneous.menu.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.category.home') }}">@lang('miscellaneous.menu.admin.categories.title')</a></li>
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
                                                <th>@lang('miscellaneous.admin.project_writing.details')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
@forelse ($items as $project)
                                            <tr>
                                                <td><img src="{{ count($product['photos']) > 0 ? $product['photos'][0]['file_url'] : asset('assets/img/undefined.png') }}" alt="" width="40"></td>
                                                <td>
                                                    <p class="m-0" style="max-width: 280px; white-space: normal;">{!! Str::limit($project['projects_description'], 200) !!}</p>
                                                </td>
                                                <td>
                                                    <a href="#">
                                                        @lang('miscellaneous.details')<i class="feather-chevrons-right ms-1"></i>
                                                    </a><br>
                                                    <span class="d-inline-block mt-1 rounded-pill text-danger" href="#">
                                                        <input type="checkbox" data-toggle="switchbutton">
                                                    </span>
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
                                    {{ $items_req->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
