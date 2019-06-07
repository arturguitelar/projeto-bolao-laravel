@extends('layouts.app')

@section('content')

    @page_component(['col'=>12, 'page'=>$page])

        @alert_component(['msg'=>session('msg'), 'status'=>session('status')])
        @endalert_component

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
                
            @can('list-users')      
            <div class="col">

                <div onclick="window.location='{{ route('users.index') }}'"
                    class="card text-white bg-primary mb-3"
                    style="max-width: 18rem; cursor: pointer">
                    <div class="card-header">@lang('bolao.list', [ 'page' => __('bolao.user_list')])</div>
                    <div class="card-body">
                        <p class="card-text">@lang('bolao.create_or_edit').</p>
                    </div>
                </div>
            </div>
            @endcan

            <div class="col">

                <div onclick="window.location='{{ route('roles.index') }}'"
                    class="card text-white bg-success mb-3"
                    style="max-width: 18rem; cursor: pointer">
                    <div class="card-header">@lang('bolao.list', [ 'page' => __('bolao.role_list')])</div>
                    <div class="card-body">
                        <p class="card-text">@lang('bolao.create_or_edit').</p>
                    </div>
                </div>
            </div>

            <div class="col">

                <div onclick="window.location='{{ route('permissions.index') }}'"
                    class="card text-white bg-danger mb-3"
                    style="max-width: 18rem; cursor: pointer">
                    <div class="card-header">@lang('bolao.list', [ 'page' => __('bolao.permission_list')])</div>
                    <div class="card-body">
                        <p class="card-text">@lang('bolao.create_or_edit').</p>
                    </div>
                </div>
            </div>
        </div>
    @endpage_component
@endsection
