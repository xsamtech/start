@extends('layouts.admin', ['page_title' => !empty($selected_sector) ? __('miscellaneous.admin.group.project_sector.details') : __('miscellaneous.menu.admin.project_sectors')])

@section('admin-content')

    @if (!empty($selected_sector))
        @include('dashboard.partials.sectors.datas')
    @else
        @include('dashboard.partials.sectors.home')
    @endif

@endsection
