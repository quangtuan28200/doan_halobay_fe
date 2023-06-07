@extends('frontend.layouts.layout')
@section('body')
<section class="news-detail pt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 sidebar-news-mobile d-md-none d-lg-none d-xl-none mb-3 px-sm-0 px-md-0"></div>
            <div class="col-sm-12 col-md-8 col-lg-9 px-sm-0 px-md-0">
                <div class="news-detail-content">
                    <h5>{{ $news->title }}</h5>
                    <div class="news-date-post text-primary"> {{ \Carbon\Carbon::parse($news->createDate)->format('d/m/Y H:s') }}</div>
                    <div class="dropdown-divider"></div>
                    <div class="news-detail-description">
                        <img src="{{ $news->illustrationImage }}" class="img-fluid w-100 mb-3">
                        {!! $news->content !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 news-sidebar-related-news">
                <div class="news-category mb-4">
                    <div class="list-news-main-title font-md-title d-flex align-items-center justify-content-between border-bottom mb-2">
                        <span class="font-title">Danh mục</span>
                    </div>
                    @include('frontend.block.cate_news')
                </div>
                <!-- <div class="similar-news-container mb-4">
                    <div class="list-news-main-title font-md-title d-flex align-items-center justify-content-between border-bottom mb-2">
                        <span class="font-title">Tin tức tương tự</span>
                    </div>
                    <div class="list-new-category similar-news">
                        <a href="news-detail.html" class="similar-news-item d-block text-decoration-none text-dark mb-5px">
                            <img src="img/news-demo-img.png" class="img-fluid w-100">
                            <div class="similar-news-content bg-white p-2">
                                <p class="mb-2">Thủy phi cơ ngắm Vịnh Hạ Long: Trải nghiệm sống động trên bầu trời, chiêm ngưỡng trọn vẹn kỳ quan thiên nhiên thế giới</p>
                                <div class="news-date-post text-primary">20/01/2021 - 18:30</div>
                            </div>
                        </a>
                        <a href="news-detail.html" class="similar-news-item d-block text-decoration-none text-dark mb-5px">
                            <img src="img/news-demo-img.png" class="img-fluid w-100">
                            <div class="similar-news-content bg-white p-2">
                                <p class="mb-2">Thủy phi cơ ngắm Vịnh Hạ Long: Trải nghiệm sống động trên bầu trời, chiêm ngưỡng trọn vẹn kỳ quan thiên nhiên thế giới</p>
                                <div class="news-date-post text-primary">20/01/2021 - 18:30</div>
                            </div>
                        </a>
                        <a href="news-detail.html" class="similar-news-item d-block text-decoration-none text-dark mb-5px">
                            <img src="img/news-demo-img.png" class="img-fluid w-100">
                            <div class="similar-news-content bg-white p-2">
                                <p class="mb-2">Thủy phi cơ ngắm Vịnh Hạ Long: Trải nghiệm sống động trên bầu trời, chiêm ngưỡng trọn vẹn kỳ quan thiên nhiên thế giới</p>
                                <div class="news-date-post text-primary">20/01/2021 - 18:30</div>
                            </div>
                        </a>
                        <a href="news-detail.html" class="similar-news-item d-block text-decoration-none text-dark mb-5px">
                            <img src="img/news-demo-img.png" class="img-fluid w-100">
                            <div class="similar-news-content bg-white p-2">
                                <p class="mb-2">Thủy phi cơ ngắm Vịnh Hạ Long: Trải nghiệm sống động trên bầu trời, chiêm ngưỡng trọn vẹn kỳ quan thiên nhiên thế giới</p>
                                <div class="news-date-post text-primary">20/01/2021 - 18:30</div>
                            </div>
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')

@endsection