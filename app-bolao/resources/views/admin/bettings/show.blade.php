@extends('layouts.app')

@section('content')
    @page_component(['col' => 12, 'page' => __('bolao.show_crud', ['page' => $page2])])

        @alert_component(['msg' => session('msg'), 'status' => session('status')])
        @endalert_component

        @breadcrumb_component(['page' => $page,'items' => $breadcrumb ?? []])
        @endbreadcrumb_component

        <p>{{ __('bolao.title') }}: {{ $register->title }}</p>
        <p>{{ __('bolao.current_round') }}: {{ $register->current_round }}</p>
        <p>{{ __('bolao.value_result') }}: {{ $register->value_result }}</p>
        <p>{{ __('bolao.extra_value') }}: {{ $register->extra_value }}</p>
        <p>{{ __('bolao.value_fee') }}: {{ $register->value_fee }}</p>

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
