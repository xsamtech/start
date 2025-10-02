@extends('layouts.admin', ['page_title' => !empty($selected_entity) ? $entity_title : __('miscellaneous.menu.admin.questionnaire.compose')])

@section('admin-content')

    @if (!empty($selected_entity))
        @include('dashboard.partials.questionnaire.datas')
    @else
        @if (!empty($entity))
            @include('dashboard.partials.questionnaire.' . $entity)
        @else
            @include('dashboard.partials.questionnaire.home')
        @endif
    @endif

@endsection
