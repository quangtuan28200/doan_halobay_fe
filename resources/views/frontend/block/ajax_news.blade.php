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