@extends('frontend.layouts.layout')
@section('body')
<section class="sub-banner">
    <img src="{{ asset('frontend/img/combo-home-bg.jpg') }}" class="img-fluid w-100 object-fit-cover">
</section>
<section class="payment-method pt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-9 detail-post-intro order-sm-last order-md-first order-lg-first order-xl-first">
                <div class="payment-method-container">
                    <div class="list-news-main-title font-md-title d-flex align-items-center justify-content-between border-bottom mb-2">
                        <span class="font-title">{{ $data->title }}</span>
                    </div>
                    <p class="mb-0 p-3 bg-white font-17pt">
                        {!! $data->content !!}
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 news-sidebar-category-list order-sm-first order-md-last order-lg-last order-xl-last">
                <div class="news-category mb-4">
                    <div class="list-news-main-title font-md-title d-flex align-items-center justify-content-between border-bottom mb-2">
                        <span class="font-title">Danh mục</span>
                    </div>
                    @include('frontend.block.cate_news')
                </div>
            </div>
        </div>
</section>
@endsection
@section('scripts')

@endsection