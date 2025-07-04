
			<section id="content">
				<div id="breadcrumb-container">
					<div class="container">
						<ul class="breadcrumb">
							<li><a href="{{ route('home') }}">@lang('miscellaneous.menu.home')</a></li>
							<li><a href="{{ route('product.entity', ['entity' => $entity]) }}">{{ $entity_title }}</a></li>
							<li class="active">{{ $selected_product->product_name }}</li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<header class="content-title">
								<h1 class="title" style="margin-bottom: 5px;">{{ $selected_product->product_name }}</h1>
@switch($entity)
    @case('service')
								<p class="title-desc">{{ __('miscellaneous.admin.product.details', ['entity' => __('miscellaneous.admin.product.entity.service.singular')]) }}</p>
        @break
    @case('project')
								<p class="title-desc">{{ __('miscellaneous.admin.product.details', ['entity' => __('miscellaneous.admin.product.entity.project.singular')]) }}</p>
        @break
    @default
								<p class="title-desc">{{ __('miscellaneous.admin.product.details', ['entity' => __('miscellaneous.admin.product.entity.product.singular')]) }}</p>
@endswitch
							</header>

							<div class="row" data-maxcolumn="2" data-layoutmode="fitRows">

                            </div><!-- End.row -->

						</div><!-- End .col-md-12 -->
					</div><!-- End .row -->
				</div><!-- End .container -->

			</section><!-- End #content -->
