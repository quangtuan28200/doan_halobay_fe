<div class="search-result d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between py-3">
    <div>{{ $list_hotel->total }} Kết quả tìm kiếm</div>
    <div>Giá cơ bản cho một người lớn</div>
</div>
<div class="list-rated list-combo-booking">
    @foreach ($list_hotel->hotelList as $hotel)
    <a class="rated-item bg-white d-block text-dark text-decoration-none mb-2 link-detail-hotel" href="hotel/{{ $hotel->url }}.html" data-link-url="{{ $hotel->url }}">
        <div class="rated-item-body">
            <div class="rated-item-hotel tour-booking-container">
                <div class="row no-gutters">
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="rated-item-hotel-img h-100 position-relative">
                            <img src="{{ $hotel->avatarUrl }}" class="img-fluid w-100 object-fit-cover">
                            <!-- <div class="wishlist-icon position-absolute circle-icon-md rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fas fa-heart text-danger icon-wishlist"></i>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <div class="rated-item-hotel-info d-flex flex-column justify-content-between h-100 p-3" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                            <div class="rated-item-hotel-header d-flex justify-content-between mb-xs-3 mb-sm-3 mb-md-3">
                                <div class="font-title text-capitalize font-20pt">
                                    {{ $hotel->name }}
                                </div>
                                @if ($hotel->star != null)
                                <div class="star-rating">
                                    @for($i = 0; $i < $hotel->star; $i++)
                                        <i class="fas fa-star text-warning font-12pt"></i>
                                        @endfor
                                </div>
                                @endif
                            </div>
                            <div class="mt-n3">{{ $hotel->roomEmpty ? $hotel->roomEmpty : 0 }} còn lại</div>
                            <div class="tour-booking-short-info">
                                <div class="rated-item-hotel-body text-md-right text-xs-right text-sm-right text-lg-right text-xl-right d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between mb-2">
                                    <div class="text-danger font-16pt align-self-end">@if ($hotel->cancelStatus == \Config::get('constants.STATUS_HOTEL.INACTIVE')) Hủy miễn phí @else Hủy mất phí @endif</div>
                                    <div>
                                        <div class="text-line-through text-muted">{{ number_format($hotel->price, 0, ',', '.') }} VND</div>
                                        <div class="font-title text-success font-sm-title">{{ number_format($hotel->priceDiscount, 0, ',', '.') }} VND</div>
                                        <div style="font-size: 14px;">/Mỗi đêm</div>
                                    </div>
                                </div>
                                <div class="rated-item-hotel-footer d-flex justify-content-between">
                                    <div class="font-18pt">
                                        <div><span class="font-title mr-2">{{ $hotel->rateAverage }} / 5</span>({{ $hotel->rateCount }} đánh giá)</div>
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
</div>