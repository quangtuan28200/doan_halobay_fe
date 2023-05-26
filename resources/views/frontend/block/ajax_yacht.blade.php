<div class="search-result d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between py-3">
    <div>{{ $list_yacht->total }} Kết quả tìm kiếm</div>
    <div>Giá cơ bản cho một người lớn</div>
</div>
<div class="list-rated list-combo-booking">
    @foreach ($list_yacht->yachtList as $yacht)
    <a class="rated-item bg-white text-dark text-decoration-none d-block mb-2 link-detail-yacht" href="yacht/{{ $yacht->id }}.html" data-link-url="{{ $yacht->id }}">
        <div class="rated-item-body">
            <div class="rated-item-hotel tour-booking-container">
                <div class="row no-gutters">
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="rated-item-hotel-img h-100 position-relative">
                            <img src="{{ asset($yacht->avatarUrl) }}" class="img-fluid w-100 object-fit-cover h-100">
                            <div class="wishlist-icon position-absolute circle-icon-md rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fas fa-heart text-danger icon-wishlist"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <div class="rated-item-hotel-info d-flex flex-column justify-content-between h-100 p-3">
                            <div class="rated-item-hotel-header d-flex justify-content-between">
                                <div>
                                    <div class="font-title text-capitalize font-20pt">
                                    {{ $yacht->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="rated-item-hotel-body text-md-right text-lg-right text-xl-right d-md-flex d-lg-flex d-xl-flex my-2">
                                <div class="d-flex flex-wrap font-14pt w-75">
                                    <div class="text-left mr-3">Khởi hành<br><span class="text-success">Hạ Long</span></div>
                                    <div class="text-left">Tham quan<br><span class="text-capitalize">cát bà - đồng châu - sầm sơn</span><button class="btn bg-transparent border-0 p-0 text-primary text-underline ml-2">Xem hành trình</button></div>
                                    <div class="w-100 text-left mt-2">
                                        <div>Ngày đi</div>
                                        <div class="text-success">1 tháng 4 năm 2021 - 5 tháng 4 năm 2021</div>
                                    </div>
                                </div>
                                <div class="text-xs-right text-sm-right text-md-right">
                                    <div class="text-line-through text-muted">{{ number_format($yacht->price, 0, ',', '.') }} VND</div>
                                    <div class="font-title text-success font-sm-title">{{ number_format($yacht->priceDiscount, 0, ',', '.') }} VND</div>
                                    <div class="font-15pt">/ Mỗi đêm</div>
                                </div>
                            </div>
                            <div class="tour-booking-short-info">
                                <div class="rated-item-hotel-footer d-flex align-items-center justify-content-between">
                                    <div class="font-18pt">
                                        <div><span class="font-title mr-2">{{ $yacht->rateAverage }} / 5</span>({{ $yacht->rateCount }} đánh giá)</div>
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