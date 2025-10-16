@extends('layouts.admin', ['page_title' => !empty($entity_title) ? $entity_title : __('miscellaneous.admin.role.list')])

@section('admin-content')

    @if (!empty($selected_entity))
        @include('dashboard.partials.roles.datas')
    @else
        @if (!empty($entity))
            @include('dashboard.partials.roles.' . $entity)
        @else
            @include('dashboard.partials.roles.home')
        @endif
    @endif

@endsection
