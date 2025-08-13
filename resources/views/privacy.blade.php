@extends('layouts.app', ['page_title' => __('miscellaneous.public.about.privacy_policy.title')])

@section('app-content')

            <section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li class="active">@lang('miscellaneous.public.about.privacy_policy.title')</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 10px;">
							<div class="clearfix">
								<header class="content-title" style="float: left;">
                                    <h1 class="title">@lang('miscellaneous.public.about.privacy_policy.title')</h1>
									<p class="title-desc"><a href="{{ route('terms') }}">@lang('miscellaneous.public.about.terms_of_use.title') <i class="bi bi-chevron-double-right" style="font-size: 2rem; vertical-align: -1px"></i></a></p>
								</header>
                            </div>
                        </div>

						<div class="container">
							<div class="row">
                                <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                                    <div id="tableOfContent" class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>@lang('miscellaneous.table_of_content')</h4>
                                        </div>
                                        <div class="panel-body">
                                            <ul>
@forelse ($titles as $title)
                                                <li><a href="#{{ $title['ref'] }}">{{ $title['title'] }}</a></li>
@empty
@endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="privacyContent" class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <p>@lang('miscellaneous.public.about.privacy_policy.description')</p>

@forelse ($titles as $title)
                                    <h3 id="{{ $title['ref'] }}">{!! $title['title'] !!}</h3>

    @forelse ($title['contents'] as $content)
                                    <p>{!! $content['content'] !!}</p>

        @if (count($content['dashes']) > 0)
                                    <ul>
            @foreach ($content['dashes'] as $dash)
				@if (!empty($dash['title']))
                                        <li>{!! $dash['title'] !!}</li>

										<ul>
					@foreach ($dash['subdashes'] as $subdash)
											<li style="list-style-type: square; margin-bottom: 5px;">{!! $subdash !!}</li>
					@endforeach
										</ul>
				@else
                                        <li>{!! $dash !!}</li>
				@endif
            @endforeach
                                    </ul>
        @endif
    @empty
    @endforelse
@empty
@endforelse
                                </div>
							</div>
						</div><!-- End .container -->
					</div><!-- End .row -->
				</div><!-- End .container -->
            </section><!-- End #content -->

@endsection
