@extends('frontend.layouts.layout')
@section('body')
<section class="news pt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-9 list-news-container">
                <div class="list-news">
                    <div class="list-news-main-title font-md-title d-flex align-items-center justify-content-between border-bottom mb-2">
                        <span class="font-title">@if ($cate_news != null) {{ $cate_news->name }} @else Tin tức mới nhất @endif</span>
                        <!-- <a href="#" class="text-decoration-none font-15pt">Xem tất cả</a> -->
                    </div>
                    <div class="row list-news-item">
                        @if ($news)
                            @foreach ($news->lst as $new)
                            <a href="{{ route('detail_news', $new->linkId) }}" class="col-sm-12 col-md-12 col-lg-12 news-item text-decoration-none text-dark">
                                <div class="row no-gutters bg-white">
                                    <div class="col-sm-12 col-md-5 col-lg-4">
                                        <div class="news-item-img">
                                            <img src="{{ asset($new->illustrationImage) }}" class="img-fluid object-fit-cover w-100">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7 col-lg-8">
                                        <div class="news-item-content d-flex flex-column justify-content-between h-100 p-3">
                                            <div class="news-item-title font-title text-trim-line text-three-line">{{ $new->title }}</div>
                                            <div class="news-item-descripition text-trim-line text-two-line">{{ $new->shortContent }}</div>
                                            <div class="news-item-date-post text-md-right text-lg-right text-xl-right text-primary">
                                            {{ \Carbon\Carbon::parse($new->createDate)->format('d/m/Y H:s') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 news-sidebar">
                <div class="news-category">
                    <div class="list-news-main-title font-md-title d-flex align-items-center justify-content-between border-bottom mb-2">
                        <span class="font-title">Danh mục</span>
                    </div>
                    @include('frontend.block.cate_news')
                </div>
            </div>
        </div>
        <nav class="mt-3">
            <ul class="pagination">
                @if ($page !== 0)
                <li class="page-item">
                    <a data-page="{{ $page -1 }}" data-cate-id="@if ($cate_news != null) {{ $cate_news->id }} @else 0 @endif" class="arrow-left p-0 d-flex align-items-center justify-content-center border-0 rounded-sm page-link p-0 d-flex align-items-center justify-content-center border-0 rounded-sm-prev text-white" href="#">
                        <i class="far fa-chevron-left"></i>
                    </a>
                </li>
                @endif
                @for ($i = 0; $i < round($news->total / $perPage); $i++)
                <li class="page-item"><a data-page="{{ $i }}" data-cate-id="@if ($cate_news != null) {{ $cate_news->id }} @else 0 @endif" class="page-link p-0 d-flex align-items-center justify-content-center border-0 rounded-sm @if ($page === $i) active @endif" href="#">{{ $i + 1 }}</a></li>
                @endfor
                @if ($page !== (int)(round($news->total / $perPage) - 1) && (int) round($news->total / 4) !== 0)
                <li class="page-item">
                    <a data-page="{{ $page + 1 }}" data-cate-id="@if ($cate_news != null) {{ $cate_news->id }} @else 0 @endif" class="arrow-right page-link p-0 d-flex align-items-center justify-content-center border-0 rounded-sm page-link-next text-white" href="#">
                        <i class="far fa-chevron-right"></i>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</section>
@endsection
@section('scripts')
<script>
$('body').on('click', '.page-link', function() {
    const page = $(this).data('page');
    const cate_id = $(this).data('cate-id');
    $('.overlay-loader').show();
    $.ajax({
        url: '/load-data-news',
        type: "GET",
        data: {page:page, cate_id:cate_id},
        success: function(response) {
           $('.list-news-item').html(response.data);
           $('.pagination').html(response.paginate);
           $('.overlay-loader').hide();
        }
    });
});
</script>
@endsection