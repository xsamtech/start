@extends('layouts.app', ['page_title'  => __('notifications.' . $exception->getStatusCode() . '_title')])

@section('app-content')

			<section id="content" class="no-content">

				<div class="lg-margin"></div><!-- Space -->
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="no-content-comment">
								<h2>{{ $exception->getStatusCode() }}</h2>
								<h3>{!! __('notifications.419_description') !!}</h3>
							</div><!-- End .no-content-comment -->
						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->

@endsection
