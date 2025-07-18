@extends('layouts.app', ['page_title' => !empty($selected_crowdfunding) ? __('miscellaneous.admin.crowdfunding.details') : __('miscellaneous.menu.public.crowdfunding')])

@section('app-content')

    @if (!empty($selected_crowdfunding))
        @include('partials.crowdfundings.datas')
    @else
        @include('partials.crowdfundings.home')
    @endif

@endsection
