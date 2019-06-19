@extends('layouts.app')

@section('content')
    @page_component(['col' => 12, 'page' => __('bolao.show_crud', ['page' => $page2])])

        @alert_component(['msg' => session('msg'), 'status' => session('status')])
        @endalert_component

        @breadcrumb_component(['page' => $page,'items' => $breadcrumb ?? []])
        @endbreadcrumb_component

        <p><b>@lang('bolao.title'):</b> {{ $register->title }}</p>
        <p><b>@lang('bolao.stadium'):</b> {{ $register->stadium }}</p>
        <p><b>@lang('bolao.team_a'):</b> {{ $register->team_a }}</p>
        <p><b>@lang('bolao.team_b'):</b> {{ $register->team_b }}</p>
        <p><b>@lang('bolao.result'):</b> {{ $register->result }}</p>
        <p><b>@lang('bolao.scoreboard_a'):</b> {{ $register->scoreboard_a }}</p>
        <p><b>@lang('bolao.scoreboard_b'):</b> {{ $register->scoreboard_b }}</p>
        <p><b>@lang('bolao.date'):</b> {{ $register->date_br }}</p>

        @if ($delete)            
            @form_component([
                'action' => route($routeName.".destroy", $register->id), 
                'method' => "DELETE"
            ])
                <button class="btn btn-danger btn-lg float-right">@lang('bolao.delete')</button>
            @endform_component
        @endif

    @endpage_component
@endsection
