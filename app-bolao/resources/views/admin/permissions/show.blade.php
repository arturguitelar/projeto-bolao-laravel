@extends('layouts.app')

@section('content')
    @page_component(['col' => 12, 'page' => __('bolao.show_crud', ['page' => $page2])])

        @alert_component(['msg' => session('msg'), 'status' => session('status')])
        @endalert_component

        @breadcrumb_component(['page' => $page,'items' => $breadcrumb ?? []])
        @endbreadcrumb_component

        <p><b>@lang('bolao.name'):</b> {{ $register->name }}</p>
        <p><b>@lang('bolao.description'):</b> {{ $register->description }}</p>

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
