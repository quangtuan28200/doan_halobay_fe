<div class="list-new-category">
    @if ($list_cate_news)
        @foreach ($list_cate_news as $cate)
        <a href="{{ route('news', $cate->id) }}" class="new-category-item bg-white text-dark text-decoration-none d-flex align-items-center justify-content-between smooth-transition bg-white px-3 py-2 @if ($cate_news != null && $cate_news->id ==$cate->id) active @endif">
            <span>{{ $cate->name }}</span>
            <i class="fas fa-caret-right"></i>
        </a>
        @endforeach
    @endif
</div>