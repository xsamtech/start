@extends('layouts.app', ['page_title' => !empty($selected_investor) ? __('miscellaneous.admin.investor.details') : __('miscellaneous.menu.public.investors.title')])

@section('app-content')

    @if (!empty($selected_investor))
        @include('partials.investors.datas')
    @else
        @include('partials.investors.home')
    @endif

@endsection
