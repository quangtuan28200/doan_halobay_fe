<div class="search-result d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between py-3">
    <div>@if ($list_combo) {{ $list_combo->total }} @else 0 @endif Kết quả tìm kiếm</div>
    <div>Giá cơ bản cho một người lớn</div>
</div>
<div class="list-rated list-combo-booking">
    @if ($list_combo)
    @foreach ($list_combo->comboList as $combo)
    <a class="rated-item bg-white text-dark text-decoration-none d-block mb-2 box-shadow" href="combo/{{ $combo->link }}.html">
        <div class="rated-item-body">
            <div class="rated-item-hotel tour-booking-container">
                <div class="row no-gutters">
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="rated-item-hotel-img h-100 position-relative">
                            <img src="{{ asset($combo->imageUrl) }}" class="img-fluid w-100 object-fit-cover">
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
                                        {{ $combo->title }}
                                    </div>
                                </div>
                            </div>
                            <div class="tour-booking-short-info">
                                <div class="rated-item-hotel-body text-md-right text-xs-right text-sm-right text-lg-right text-xl-right d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                    <div class="text-success font-16pt align-self-end">{{$combo->cancelStatus == 1 ? 'Hủy mất phí' : 'Hủy miễn phí'}}</div>
                                    <div>
                                        @if ($combo->price !== $combo->priceDisplay)
                                        <div class="text-line-through text-muted">{{ number_format($combo->price, 0, ',', '.') }} VND</div>
                                        @endif
                                        <div class="font-title text-success font-sm-title">{{ number_format($combo->priceDisplay, 0, ',', '.') }} VND</div>
                                    </div>
                                </div>
                                <div class="rated-item-hotel-footer d-flex justify-content-between">
                                    <div class="font-18pt">
                                        <div><span class="font-title mr-2">{{$combo->rateAverage}} / 5</span>({{$combo->rateCount}} đánh giá)</div>
                                    </div>
                                    <div class="align-self-end">Bao gồm thuế và phí</div>
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