@if ( $totalPage > 1 )
@if ($page !== 0)
<li class="page-item">
    <a data-page="{{ $page - 1 }}" class="arrow-left p-0 d-flex align-items-center justify-content-center border-0 rounded-sm page-link p-0 d-flex align-items-center justify-content-center border-0 rounded-sm-prev text-white" href="#">
        <i class="far fa-chevron-left"></i>
    </a>
</li>
@endif

@for ($i = 0; $i < $totalPage; $i++) <li class="page-item"><a data-page="{{ $i }}" class="page-link p-0 d-flex align-items-center justify-content-center border-0 rounded-sm @if ($page === $i) active @endif" href="#">{{ $i + 1 }}</a></li>
    @endfor

    @if ($page !== ( $totalPage - 1))
    <li class="page-item">
        <a data-page="{{ $page + 1 }}" class="arrow-right page-link p-0 d-flex align-items-center justify-content-center border-0 rounded-sm page-link-next text-white" href="#">
            <i class="far fa-chevron-right"></i>
        </a>
    </li>
    @endif
    @endif