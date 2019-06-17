@extends('layouts.app')

@section('content')
    @page_component(['col' => 12, 'page' => __('bolao.show_crud', ['page' => $page2])])

        @alert_component(['msg' => session('msg'), 'status' => session('status')])
        @endalert_component

        @breadcrumb_component(['page' => $page,'items' => $breadcrumb ?? []])
        @endbreadcrumb_component

        <p><b>@lang('bolao.title'):</b> {{ $register->title }}</p>
        <p><b>@lang('bolao.current_round'):</b> {{ $register->current_round }}</p>
        <p><b>@lang('bolao.value_result'):</b> {{ $register->value_result }}</p>
        <p><b>@lang('bolao.extra_value'):</b> {{ $register->extra_value }}</p>
        <p><b>@lang('bolao.value_fee'):</b> {{ $register->value_fee }}</p>

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
