@extends('layouts.app')

@section('content')
    @page_component(['col' => 12, 'page' => __('bolao.show_crud', ['page' => $page2])])

        @alert_component(['msg' => session('msg'), 'status' => session('status')])
        @endalert_component

        @breadcrumb_component(['page' => $page,'items' => $breadcrumb ?? []])
        @endbreadcrumb_component

        <p><b>@lang('bolao.title'):</b> {{ $register->title }}</p>
        <p><b>@lang('bolao.bet'):</b> {{ $register->betting_title }}</p>
        <p><b>@lang('bolao.date_start'):</b> {{ $register->date_start_br }}</p>
        <p><b>@lang('bolao.date_end'):</b> {{ $register->date_end_br }}</p>

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
