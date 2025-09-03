@extends('layouts.app', ['page_title' => !empty($selected_project) ? __('miscellaneous.admin.project_writing.details') : __('miscellaneous.menu.public.investors.title')])

@section('app-content')

    @if (!empty($selected_project))
        @include('partials.investors.datas')
    @else
        @include('partials.investors.home')
    @endif

@endsection
