<div class="search-result d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between py-3">
    <div>@if ($list_tour->total) {{ $list_tour->total }} @else 0 @endif Kết quả tìm kiếm</div>
    <div>Giá cơ bản cho một người lớn</div>
</div>
<div class="list-rated list-tour-booking">
    @if ($list_tour->tourList)
    @foreach ($list_tour->tourList as $tour)
    <a class="rated-item bg-white text-dark text-decoration-none d-block mb-2 box-shadow" href="tour/{{ $tour->link }}.html">
        <div class="rated-item-body">
            <div class="rated-item-hotel tour-booking-container">
                <div class="row no-gutters">
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="rated-item-hotel-img h-100 position-relative">
                            <img src="{{ $tour->imageUrl }}" class="img-fluid w-100 h-100 object-fit-cover">
                            <!-- <div class="wishlist-icon position-absolute circle-icon-md rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fas fa-heart text-danger icon-wishlist"></i>
                                            </div> -->
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <div class="rated-item-hotel-info d-flex flex-column justify-content-between h-100 p-3">
                            <div class="rated-item-hotel-header d-flex justify-content-between">
                                <div>
                                    <div class="font-title text-capitalize font-20pt">
                                        {{ $tour->title }}
                                    </div>
                                    <div>
                                        Mã tour: {{ $tour->code }}
                                    </div>
                                    <div>
                                        Thời gian: {{ $tour->dayNum }} ngày {{ $tour->dayNum - 1 }} đêm
                                    </div>
                                    <div style="display: -webkit-box;max-width: 100%;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;">
                                        {{ $tour->shortContent }}
                                    </div>
                                </div>
                            </div>
                            <div class="tour-booking-short-info">
                                <div class="mt-2 rated-item-hotel-body text-md-right text-xs-right text-sm-right text-lg-right text-xl-right d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                    <div class="text-success font-16pt align-self-end">
                                        <!-- Hủy miễn phí -->
                                    </div>
                                    <div>
                                        @if ($tour->price !== $tour->priceDiscount)
                                        <div class="text-line-through text-muted">{{ number_format($tour->price, 0, ',', '.') }} VND</div>
                                        @endif
                                        <div class="font-title text-success font-sm-title">{{ number_format($tour->priceDiscount, 0, ',', '.') }} VND</div>
                                    </div>
                                </div>
                                <div class="rated-item-hotel-footer d-flex justify-content-between">
                                    <!-- <div class="font-18pt">
                                                        <div><span class="font-title mr-2">{{ $tour->code }} / 5</span>({{ $tour->code }} đánh giá)</div>
                                                    </div>
                                                    <div class="align-self-end">Bao gồm thuế và phí</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    @endforeach
    @endif
</div>