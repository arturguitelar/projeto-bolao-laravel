@extends('layouts.app')

@section('content')
<!-- Header -->
<header class="masthead">
    <div class="container">
        <div class="intro-text">
            <div class="intro-lead-in">@lang('bolao.wellcome_to_the_betting_website')</div>
            <div class="intro-heading text-uppercase">@lang('bolao.enjoy_with_your_family')</div>
            <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#portfolio">@lang('bolao.check_the_list_here')</a>
        </div>
    </div>
</header>

<!-- Portfolio Grid -->
<section class="bg-light" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">@lang('bolao.betting_list')</h2>
                <h3 class="section-subheading text-muted">@lang('bolao.join_or_create')</h3>
            </div>
        </div>
        <div class="row">

            @foreach ($list as $key => $value)                
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" data-toggle="modal" href="#portfolioModal{{ $value->id }}">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fas fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="{{ asset('img/portfolio/07-thumbnail.jpg') }}" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>{{ $value->title }}</h4>
                    <p class="text-muted">{{ $value->user_name }}</p>
                    <a class="btn btn-info" href="#">Ver Rodadas</a>
                    <button class="btn btn-danger">Deixar Bolão</button>
                    <button class="btn btn-success">Participação</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Fim - Portfolio Grid -->

<!-- Modals -->
@foreach ($list as $key => $value)    
<div class="portfolio-modal modal fade" id="portfolioModal{{ $value->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2 class="text-uppercase">{{ $value->title }}</h2>
                            <p class="item-intro text-muted">{{ $value->user_name }}</p>
                            <p>Este bolão tem as seguinte regras:</p>
                            <ul class="list-inline">
                                <li><b>Valor do Resultado:</b> {{ $value->value_result }}</li>
                                <li><b>Valor Extra:</b> {{ $value->extra_value }}</li>
                                <li><b>Taxa:</b> {{ $value->value_fee }}</li>
                            </ul>

                            <a class="btn btn-info" href="#">Ver Rodadas</a>
                            <button class="btn btn-danger">Deixar Bolão</button>
                            <button class="btn btn-success">Participação</button>

                            <button class="btn btn-primary" data-dismiss="modal" type="button">
                                <i class="fas fa-times"></i>
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Fim - Modals -->

@endsection
