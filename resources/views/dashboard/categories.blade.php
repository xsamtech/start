@extends('layouts.admin', ['page_title' => !empty($selected_item) ? $selected_item->product_name : (!empty($selected_category) ? __('miscellaneous.admin.group.category.details') : (!empty($entity_title) ? $entity_title : __('miscellaneous.menu.admin.categories.title')))])

@section('admin-content')

    @if (!empty($selected_item) || !empty($selected_category))
        @include('dashboard.partials.categories.datas')
    @else
        @if (!empty($entity))
            @include('dashboard.partials.categories.' . $entity)
        @else
            @include('dashboard.partials.categories.home')
        @endif
    @endif

@endsection
