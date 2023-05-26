@extends('frontend.hotel.index')
@section('hotel-booking-content')
<div class="hotel-booking-list container py-3">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-9 combo-booking-list-left">
            <div class="place-search">
                <div class="place-search-container d-md-block d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="font-title font-20pt font-title-bold">{{ $place->name }}</div>
                    <input type="hidden" name="place_id" value="{{ $place->id }}">
                    <div class="mt-xs-3 w-xs-100 w-sm-100 w-50 w-md-75 d-md-block d-flex align-items-center justify-content-between">
                        <div class="form-group w-sm-75 mb-0 mt-2">
                            <label class="matter-textfield-filled d-block">
                                <input id="hotelName" type="text" placeholder=" ">
                                <span>Tìm kiếm theo tên <p class="text-muted d-xs-none d-inline-block">(VD: Khác sạn Halobay)</p></span>
                            </label>
                        </div>
                        <div class="font-22pt toggle-filter-mobile d-xs-block d-sm-block d-md-none d-lg-none d-xl-none font-title-bold ml-2">Lọc bởi</div>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div id="data_hotel">
                <div class="search-result d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between py-3">
                    <div>{{ $list_hotel->total }} Kết quả tìm kiếm</div>
                    <div>Giá cơ bản cho một người lớn</div>
                </div>
                <div class="list-rated list-combo-booking">
                    @foreach ($list_hotel->hotelList as $hotel)
                    <a class="rated-item bg-white d-block text-dark text-decoration-none mb-2 link-detail-hotel box-shadow" href="hotel/{{ $hotel->url }}.html" data-link-url="{{ $hotel->url }}">
                        <div class="rated-item-body">
                            <div class="rated-item-hotel tour-booking-container">
                                <div class="row no-gutters">
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="rated-item-hotel-img h-100 position-relative">
                                            <img src="{{ $hotel->avatarUrl ?: asset(\Config::get('constants.IMAGES_DEFAULT.HOTEL.HOTEL_LIST'))}}" class="img-fluid w-100 object-fit-cover">
                                            <!-- <div class="wishlist-icon position-absolute circle-icon-md rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fas fa-heart text-danger icon-wishlist"></i>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-8">
                                        <div class="rated-item-hotel-info d-flex flex-column justify-content-between h-100 p-3">
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
                                                    <!-- <div class="text-danger font-16pt align-self-end">@if ($hotel->cancelStatus == \Config::get('constants.STATUS_HOTEL.INACTIVE')) Hủy miễn phí @else Hủy mất phí @endif</div> -->
                                                    <div class="text-danger font-16pt align-self-end"></div>
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
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 combo-booking-right d-xs-none d-sm-none d-md-block d-lg-block d-xl-block">
            <div class="font-title-bold font-20pt py-3 mb-4">Lọc bởi</div>
            <div class="filter-list">
                <div class="filter-item-container">
                    <div class="filter-item-group mb-4">
                        <div class="font-title-bold font-18pt mb-2">Sắp xếp</div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderBy filterItem" type="checkbox" checked value="1">
                                <span>Được đề xuất</span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderBy filterItem" type="checkbox" value="2">
                                <span>Giá từ cao đến thấp</span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderBy filterItem" type="checkbox" value="3">
                                <span>Giá từ thấp đến cao</span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderBy filterItem" type="checkbox" value="4">
                                <span>Đánh giá</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="filter-item-container">
                    <div class="filter-item-group mb-4">
                        <div class="font-title-bold font-18pt mb-2">Đánh giá sao</div>
                        <div class="button-rating-hotel">
                            <button class="btn btn-star-rating filterItem border font-11pt bg-white radius-md" data-star-rating="1">
                                <i class="fas fa-star"></i>
                                <div>1 sao</div>
                            </button>
                            <button class="btn btn-star-rating filterItem border font-11pt bg-white radius-md" data-star-rating="2">
                                <i class="fas fa-star"></i>
                                <div>2 sao</div>
                            </button>
                            <button class="btn btn-star-rating filterItem border font-11pt bg-white radius-md" data-star-rating="3">
                                <i class="fas fa-star"></i>
                                <div>3 sao</div>
                            </button>
                            <button class="btn btn-star-rating filterItem border font-11pt bg-white radius-md" data-star-rating="4">
                                <i class="fas fa-star"></i>
                                <div>4 sao</div>
                            </button>
                            <button class="btn btn-star-rating filterItem border font-11pt bg-white radius-md" data-star-rating="5">
                                <i class="fas fa-star"></i>
                                <div>5 sao</div>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="filter-item-container">
                    <div class="filter-item-group mb-4">
                        <div class="font-title-bold font-18pt mb-2">Giá tiền</div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderByPrice filterItem" type="checkbox" value="0-500000">
                                <span>Dưới 500.000</span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderByPrice filterItem" type="checkbox" value="500000-1000000">
                                <span>Từ 500.000 đến 1.000.000</span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderByPrice filterItem" type="checkbox" value="1000000-5000000">
                                <span>Từ 1.000.000 đến 5.000.000</span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderByPrice filterItem" type="checkbox" value="5000000-10000000">
                                <span>Từ 5.000.000 đến 10.000.000</span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderByPrice filterItem" type="checkbox" value="10000000-0">
                                <span>Trên 10.000.000</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="filter-item-container">
                    <div class="filter-item-group mb-4">
                        <div class="font-title-bold font-18pt mb-2">Đánh giá của khách</div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderByRate filterItem" type="checkbox" value="0-0">
                                <span>Bất kỳ</span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderByRate filterItem" type="checkbox" value="3.5-5.0">
                                <span>3.5 + </span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderByRate filterItem" type="checkbox" value="4.0-5.0">
                                <span>4.0 + </span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="orderByRate filterItem" type="checkbox" value="4.5-5.0">
                                <span>4.5 + </span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="filter-item-container">
                    <div class="filter-item-group">
                        <div class="font-title-bold font-18pt mb-2">Loại khách sạn</div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="type_hotel filterItem" type="checkbox" value="{{ \Config::get('constants.TYPE_HOTEL.HOTEL') }}">
                                <span>Khách sạn</span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="type_hotel filterItem" type="checkbox" value="{{ \Config::get('constants.TYPE_HOTEL.APARTMENT') }}">
                                <span>Căn hộ</span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="type_hotel filterItem" type="checkbox" value="{{ \Config::get('constants.TYPE_HOTEL.VILLA') }}">
                                <span>Biệt thự</span>
                            </label>
                        </div>
                        <div class="matter-checkbox-item">
                            <label class="matter-checkbox">
                                <input class="type_hotel filterItem" type="checkbox" value="{{ \Config::get('constants.TYPE_HOTEL.HOMESTAY') }}">
                                <span>Homestay</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.pagination')
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const load_data_hotel = function(dataFilter) {
            // console.log('dataFilter: ', dataFilter)
            $('.overlay-loader').show();
            $.ajax({
                url: '/load-data-hotel',
                type: "GET",
                data: dataFilter,
                success: function(response) {
                    // console.log('response', response)
                    $('#data_hotel').html(response.data);
                    $('.pagination').html(response.pagination);
                    $("html,body").scrollTop(200);
                    $('.overlay-loader').hide();
                }
            });
        }

        $('.date-hotel-start').on('showCalendar.daterangepicker', function(ev, picker) {
            const time = $('.date-hotel-start').val();
            $('.date-hotel-end').daterangepicker({
                "minDate": "" + time + "",
                singleDatePicker: true,
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " / ",
                    "applyLabel": "Apply",
                    "cancelLabel": "Cancel",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "CN",
                        "T2",
                        "T3",
                        "T4",
                        "T5",
                        "T6",
                        "T7"
                    ],
                    "monthNames": [
                        "Tháng 1 - ",
                        "Tháng 2 - ",
                        "Tháng 3 - ",
                        "Tháng 4 - ",
                        "Tháng 5 - ",
                        "Tháng 6 - ",
                        "Tháng 7 - ",
                        "Tháng 8 - ",
                        "Tháng 9 - ",
                        "Tháng 10 - ",
                        "Tháng 11 - ",
                        "Tháng 12 - "
                    ],
                    "firstDay": 1
                },
                autoApply: true
            });
        });

        const getDataFilter = () => {
            const place_id = $('input[name="place_id"]').val();
            const orderBy = $('.orderBy:checked').val() || null;
            const star = $('.btn-star-rating.active').last().data('star-rating') || null;
            const orderByPrice = $('.orderByPrice:checked').val() || null;
            const orderByRate = $('.orderByRate:checked').val() || null;
            const type_hotel = $('.type_hotel:checked').val() || null;

            return {
                place_id,
                checkInDate: null,
                checkOutDate: null,
                orderBy,
                star: star ? star : null,
                orderByPrice,
                orderByRate,
                type_hotel,
            }
        }

        $('body').on('click', '.page-link', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            const dataFilter = getDataFilter();

            load_data_hotel({
                ...dataFilter,
                page
            });
        });

        const filter = () => {
            $('body').on('click', '.filterItem', function() {
                const dataFilterInit = getDataFilter();

                const isChecked = $(this).is(':checked');
                const filterType = $(this).attr('class').split(' ')[0];
                const filterValue = isChecked ? $(this).val() : null;

                const dataFilter = {
                    ...dataFilterInit,
                    [filterType]: filterValue
                }

                load_data_hotel(dataFilter);
            });
        }

        filter();

        var delay = (function() {
            var timer = 0;
            return function(callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })()

        $('#hotelName').on('keydown', function() {
            delay(function() {
                const hotelName = $('#hotelName').val();
                const dataFilter = getDataFilter();
                load_data_hotel({
                    ...dataFilter,
                    hotelName
                });
            }, 1000);
        });
    });
</script>
@endsection