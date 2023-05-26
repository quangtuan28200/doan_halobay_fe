@extends('frontend.layouts.layout')
@section('body')
<div class="backdrop backdrop-toggle-event position-fixed"></div>
<div class="filter-mobile d-xs-block d-sm-block d-md-none d-lg-none d-xl-none smooth-transition w-100 position-fixed top-0 left-0 right-0 p-3 bg-gray overflow-y-auto">
    <div class="d-flex align-items-center justify-content-between">
        <span class="font-title-bold font-20pt">Lọc bởi</span>
        <span class="close-filter-mobile font-22pt"><i class="far fa-times"></i></span>
    </div>
    <div class="dropdown-divider my-3"></div>
    <div class="filter-mobile-content"></div>
</div>
<section class="combo-booking-list">
    <div class="combo-booking-info bg-white py-3">
        <div class="container">
            <form action="{{ route('post_search_Yacht') }}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <div class="row row-medium-space booking-input">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="text-success room-person-select mb-3">
                            <div class="dropdown dropdownPersonRoom d-inline-block ml-auto">
                                <button class="btn bg-transparent p-0 border-0 no-active-focus text-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="total-person">1</span> người <i class="fal fa-chevron-down text-success ml-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton">
                                    <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                    <div class="dropdown-item border-0 d-flex justify-content-between bg-white">
                                        <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                        <span class="input-group-select d-flex align-items-center justify-content-end">
                                            <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                            <input type="number" min="0" value="{{ $info['yacht_adultNum'] }}" name="yacht_adultNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                            <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                        </span>
                                    </div>
                                    <div class="dropdown-item border-0 d-flex justify-content-between bg-white">
                                        <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                        <span class="input-group-select d-flex align-items-center justify-content-end">
                                            <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                            <input type="number" min="0" value="{{ $info['yacht_childNum'] }}" name="yacht_childNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                            <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                        </span>
                                    </div>
                                    <div class="dropdown-item border-0 d-flex justify-content-between bg-white">
                                        <span class="dropdown-select-text text-nowrap">Trẻ em (dưới 2 tuổi)</span>
                                        <span class="input-group-select d-flex align-items-center justify-content-end">
                                            <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                            <input type="number" min="0" value="{{ $info['yacht_childNum2'] }}" name="yacht_childNum2" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                            <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                        </span>
                                    </div>
                                    <div class="dropdown-select-footer font-title text-primary font-17pt py-2 px-3 border-top">
                                        <button class="btn btn-primary-gradient font-title btn-block px-3 py-12px">Đồng ý</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-5">
                        <div class="row row-medium-space">
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-xs-3 mb-sm-3 mb-md-3 mb-lg-0">
                                <div class="form-group mb-0">
                                    <div class="input-group float-label-input">
                                        <div class="input-group-prepend m-0">
                                            <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                            </span>
                                        </div>
                                        <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                            <span>Chọn điểm đến</span>
                                            <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="yacht_place">
                                                @if ($list_place_yacht)
                                                    @foreach ($list_place_yacht as $place_yacht)
                                                    <option value="{{ $place_yacht->id }}" @if ($info['yacht_place'] == $place_yacht->id) selected @endif>{{ $place_yacht->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-xs-3 mb-sm-3 mb-md-3 mb-lg-0">
                                <div class="form-group mb-0">
                                    <div class="input-group float-label-input">
                                        <div class="input-group-prepend m-0">
                                            <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                <i class="far fa-calendar text-primary"></i>
                                            </span>
                                        </div>
                                        <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                            <input type="text" placeholder=" " class="text-primary yacht-date-picker" name="yacht_book_date" value="{{ $info['yacht_book_date'] }}">
                                            <span>Ngày khởi hành</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-5">
                        <div class="row row-medium-space">
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-xs-3 mb-sm-3 mb-md-3 mb-lg-0">
                                <div class="form-group mb-0">
                                    <div class="input-group float-label-input">
                                        <div class="input-group-prepend m-0">
                                            <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                <i class="far fa-calendar text-primary"></i>
                                            </span>
                                        </div>
                                        <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                            <span>Thời gian</span>
                                            <select class="selectpicker form-control h-auto py-12px bg-white" name="yacht_number_day">
                                                <option value="1" @if ($info['yacht_number_day'] == 1) selected @endif>1 ngày</option>
                                                <option value="2" @if ($info['yacht_number_day'] == 2) selected @endif>2 ngày</option>
                                                <option value="3" @if ($info['yacht_number_day'] == 3) selected @endif>3 ngày</option>
                                                <option value="4" @if ($info['yacht_number_day'] == 4) selected @endif>4 ngày</option>
                                                <option value="5" @if ($info['yacht_number_day'] == 5) selected @endif>5 ngày</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-xs-3 mb-sm-3 mb-md-3 mb-lg-0">
                                <div class="form-group mb-0">
                                    <div class="input-group float-label-input">
                                        <div class="input-group-prepend m-0">
                                            <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                <i class="fas fa-star text-primary"></i>
                                            </span>
                                        </div>
                                        <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                            <span>Hạng sao</span>
                                            <select class="selectpicker form-control h-auto py-12px bg-white" name="yacht_number_star">
                                                <option value="1" @if ($info['yacht_number_star'] == 1) selected @endif>1 </option>
                                                <option value="2" @if ($info['yacht_number_star'] == 2) selected @endif>2 </option>
                                                <option value="3" @if ($info['yacht_number_star'] == 3) selected @endif>3 </option>
                                                <option value="4" @if ($info['yacht_number_star'] == 4) selected @endif>4 </option>
                                                <option value="5" @if ($info['yacht_number_star'] == 5) selected @endif>5 </option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2">
                        <button class="btn btn-primary-gradient font-title font-17pt py-12px btn-block mx-auto">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="combo-booking-list-container container py-3">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-9 combo-booking-list-left">
                <div class="place-search">
                    <div class="place-search-container d-md-block d-lg-flex d-xl-flex align-items-center justify-content-between">
                        <div class="font-title font-20pt font-title-bold">{{ $place->name }}</div>
                        <input type="hidden" name="place_id" value="{{ $place->id }}">
                        <div class="mt-xs-3 w-xs-100 w-sm-100 w-50 w-md-75 d-md-block d-flex align-items-center justify-content-between">
                            <div class="form-group w-sm-75 mb-0 mt-2">
                                <label class="matter-textfield-filled d-block">
                                    <input type="text" placeholder=" ">
                                    <span>Tìm kiếm theo tên <p class="text-muted d-xs-none d-inline-block">(VD:Du thuyền Halobay)</p></span>
                                </label>
                            </div>
                            <div class="font-22pt toggle-filter-mobile d-xs-block d-sm-block d-md-none d-lg-none d-xl-none font-title-bold ml-2">Lọc bởi</div>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div id="data_yacht">
                    <div class="search-result d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between py-3">
                        <div>{{ $list_yacht->total }} Kết quả tìm kiếm</div>
                        <div>Giá cơ bản cho một người lớn</div>
                    </div>
                    <div class="list-rated list-combo-booking">
                        @foreach ($list_yacht->yachtList as $yacht)
                        <a class="rated-item bg-white text-dark text-decoration-none d-block mb-2 link-detail-yacht" href="yacht/{{ $yacht->url }}.html" data-link-url="{{ $yacht->url }}">
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
                                    <input class="orderBy" type="checkbox" checked value="0">
                                    <span>Được đề xuất</span>
                                </label>
                            </div>
                            <div class="matter-checkbox-item">
                                <label class="matter-checkbox">
                                    <input class="orderBy" type="checkbox" value="1">
                                    <span>Giá từ cao đến thấp</span>
                                </label>
                            </div>
                            <div class="matter-checkbox-item">
                                <label class="matter-checkbox">
                                    <input class="orderBy" type="checkbox" value="2">
                                    <span>Giá từ thấp đến cao</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    const load_data_yacht = function (params) {
        $('.overlay-loader').show();
        $.ajax({
            url: '/load-data-yacht',
            type: "GET",
            data: {orderBy:params['orderBy'], yacht_place:params['yacht_place'], star:params['star'], yacht_book_date:params['yacht_book_date'], type_hotel:params['type_hotel'], orderByRate:params['orderByRate']},
            success: function(response) {
                $('#data_yacht').html(response.data);
                $("html,body").scrollTop(200);
                $('.overlay-loader').hide();
            }
        });
    }
    $('body').on('click', '.orderBy', function () {
        const orderBy = $(this).val();
        const type_hotel = $('.type_hotel:checked').val();
        const yacht_place = $('input[name="yacht_place"]').val();
        const star = $('input[name="star"]').val();
        const yacht_book_date = $('input[name="yacht_book_date"]').val();
        const yacht_number_star = $('input[name="yacht_number_star"]').val();
        load_data_yacht({orderBy:orderBy, yacht_place:yacht_place, type_hotel:type_hotel, star:star, yacht_book_date:yacht_book_date, yacht_number_star:yacht_number_star})
    });
    $('body').on('click', '.link-detail-yacht', function () {
        const yacht_book_date = "{{ $info['yacht_book_date'] }}";
        const yacht_adultNum = parseInt($('input[name=yacht_adultNum]').val());
        const yacht_childNum = parseInt($('input[name=yacht_childNum]').val());
        const yacht_childNum2 = parseInt($('input[name=yacht_childNum2]').val());
        const yacht_place = parseInt($('select[name=yacht_place] option:selected').val());
        const yacht_number_day = parseInt($('select[name=yacht_number_day] option:selected').val());
        const yacht_number_star = parseInt($('select[name=yacht_number_star] option:selected').val());
        sessionStorage.setItem("yacht_book_date", yacht_book_date);
        sessionStorage.setItem("yacht_adultNum", yacht_adultNum);
        sessionStorage.setItem("yacht_childNum", yacht_childNum);
        sessionStorage.setItem("yacht_childNum2", yacht_childNum2);
        sessionStorage.setItem("yacht_place", yacht_place);
        sessionStorage.setItem("yacht_number_day", yacht_number_day);
        sessionStorage.setItem("yacht_childNum2", yacht_childNum2);
        sessionStorage.setItem("yacht_number_star", yacht_number_star);
    })
</script>
@endsection