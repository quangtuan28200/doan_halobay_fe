@extends('frontend.layouts.layout')
@section('body')
<section class="introduce">
    <img src="{{ asset('frontend/img/introduce-banner.png') }}" class="img-fluid w-100">
    <div class="container">
        <div class="introduce-title font-medium font-lg-title text-center">
            Lời giới thiệu về <span class="text-primary">Halo</span><span class="text-success">Bay</span>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12 col-md-12 col-lg-6 mb-sm-3">
                <div class="intoduce-content">
                   {!! $about_us->content !!}
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="introduce-video position-relative">
                    <img src="{{ asset('frontend/img/video-poster.png') }}" class="img-fluid w-100">
                    <div class="btn-play text-white position-absolute">
                        <img src="{{ asset('frontend/img/play-button.svg') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="{{ asset('frontend/img/introduce-banner-2.png') }}" class="img-fluid w-100">
</section>
@endsection
@section('scripts')

@endsection