@extends('layouts.app', ['page_title' => !empty($selected_project) ? __('miscellaneous.admin.project_writing.details') : __('miscellaneous.menu.public.crowdfunding')])

@section('app-content')

    @if (!empty($selected_project))
        @include('partials.crowdfundings.datas')
    @else
        @include('partials.crowdfundings.home')
    @endif

@endsection
