@extends('layouts.app')

@section('content')

    @page_component(['col'=>12, 'page'=>$page])

        @alert_component(['msg'=>session('msg'), 'status'=>session('status')])
        @endalert_component

        <!-- Portfolio Grid -->
        <div id="portfolio">

            <div class="row">

                @can('list-user')
                <div class="col-md-4 col-sm-6 portfolio-item"
                    onclick="window.location='{{ route('users.index') }}'">
                    <a class="portfolio-link">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('img/portfolio/03-thumbnail.jpg')}}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>@lang('bolao.list', [ 'page' => __('bolao.user_list')])</h4>
                        <p class="text-muted">@lang('bolao.create_or_edit').</p>
                    </div>
                </div>
                @endcan

                @can('acl')                    
                <div class="col-md-4 col-sm-6 portfolio-item"
                    onclick="window.location='{{ route('roles.index') }}'">
                    <a class="portfolio-link">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('img/portfolio/04-thumbnail.jpg') }}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>@lang('bolao.list', [ 'page' => __('bolao.role_list')])</h4>
                        <p class="text-muted">@lang('bolao.create_or_edit').</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 portfolio-item"
                    onclick="window.location='{{ route('permissions.index') }}'">
                    <a class="portfolio-link">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('img/portfolio/05-thumbnail.jpg') }}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>@lang('bolao.list', [ 'page' => __('bolao.permission_list')])</h4>
                        <p class="text-muted">@lang('bolao.create_or_edit').</p>
                    </div>
                </div>
                @endcan

                <div class="col-md-4 col-sm-6 portfolio-item"
                    onclick="window.location='{{ route('bettings.index') }}'">
                    <a class="portfolio-link">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('img/portfolio/01-thumbnail.jpg')}}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>@lang('bolao.list', [ 'page' => __('bolao.betting_list')])</h4>
                        <p class="text-muted">@lang('bolao.create_or_edit').</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 portfolio-item"
                    onclick="window.location='{{ route('rounds.index') }}'">
                    <a class="portfolio-link">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('img/portfolio/02-thumbnail.jpg')}}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>@lang('bolao.list', [ 'page' => __('bolao.round_list')])</h4>
                        <p class="text-muted">@lang('bolao.create_or_edit').</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 portfolio-item"
                    onclick="window.location='{{ route('matches.index') }}'">
                    <a class="portfolio-link">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('img/portfolio/06-thumbnail.jpg')}}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>@lang('bolao.list', [ 'page' => __('bolao.match_list')])</h4>
                        <p class="text-muted">@lang('bolao.create_or_edit').</p>
                    </div>
                </div>
            </div>
        </div>
    @endpage_component
@endsection
