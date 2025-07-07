@extends('layouts.app', ['page_title' => !empty($selected_post) ? __('miscellaneous.admin.post.details') : __('miscellaneous.menu.discussions')])

@section('app-content')

    @if (!empty($selected_post))
        @include('partials.discussions.datas')
    @else
        @include('partials.discussions.home')
    @endif

@endsection
