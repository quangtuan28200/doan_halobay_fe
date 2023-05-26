
@if ((int)$page !== 0  && (int) round($news->total / 4) !== 0)
<li class="page-item">
    <a data-page="{{ $page -1 }}" data-cate-id="@if ($cate_news != null) {{ $cate_news->id }} @else 0 @endif" class="arrow-left p-0 d-flex align-items-center justify-content-center border-0 rounded-sm page-link p-0 d-flex align-items-center justify-content-center border-0 rounded-sm-prev text-white" href="#">
        <i class="far fa-chevron-left"></i>
    </a>
</li>
@endif
@for ($i = 0; $i < round($news->total / $perPage); $i++)
<li class="page-item"><a data-page="{{ $i }}" data-cate-id="@if ($cate_news != null) {{ $cate_news->id }} @else 0 @endif" class="page-link p-0 d-flex align-items-center justify-content-center border-0 rounded-sm @if ((int)$page === $i) active @endif" href="#">{{ $i + 1 }}</a></li>
@endfor

@if ((int)$page !== (int)(round($news->total / $perPage) - 1) && (int) round($news->total / 4) !== 0)
<li class="page-item">
    <a data-page="{{ $page + 1 }}" data-cate-id="@if ($cate_news != null) {{ $cate_news->id }} @else 0 @endif" class="arrow-right page-link p-0 d-flex align-items-center justify-content-center border-0 rounded-sm page-link-next text-white" href="#">
        <i class="far fa-chevron-right"></i>
    </a>
</li>
@endif