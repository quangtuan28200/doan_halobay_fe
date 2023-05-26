@extends('frontend.layouts.layout')
@section('body')
<section class="combo-booking-home">
    <div class="combo-booking-menu py-5">
        <div class="container">
            <div class="position-relative">
                <div class="h-100 w-100 position-absolute tab-loader-container">
                    <div class="tab-loader position-absolute h-100 d-flex align-items-center justify-content-center">
                        <div class="spinner-border text-primary position-relative" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white tab-booking-container radius-lg">
                    <nav>
                        <div class="nav nav-tabs combo-booking-nav flex-nowrap border-0 position-relative justify-content-around" role="tablist">
                            @if ($tabs)
                            @foreach ($tabs as $tab)
                            @switch ($tab->name)
                            @case ('Khách sạn')
                            <a class="nav-link text-center border-0 rounded-0 py-4 position-relative bg-transparent " data-toggle="tab" href="#booking-hotel" role="tab">
                                <img src="{{ asset('frontend/img/building.svg') }}" class="img-fluid img-nav mx-auto">
                                <img src="{{ asset('frontend/img/building-active.svg') }}" class="img-fluid img-nav-active mx-auto">
                                @break
                                @case ('Vé máy bay')
                                <a class="nav-link text-center border-0 rounded-0 py-4 position-relative bg-transparent active" data-toggle="tab" href="#booking-airplane" role="tab">

                                    <img src="{{ asset('frontend/img/airplane.svg') }}" class="img-fluid img-nav mx-auto">
                                    <img src="{{ asset('frontend/img/airplane-active.svg') }}" class="img-fluid img-nav-active mx-auto">
                                    @break
                                    @case ('Tour')
                                    <a class="nav-link text-center border-0 rounded-0 py-4 position-relative bg-transparent" data-toggle="tab" href="#booking-tour" role="tab">
                                        <img src="{{ asset('frontend/img/travel.svg') }}" class="img-fluid img-nav mx-auto">
                                        <img src="{{ asset('frontend/img/travel-active.svg') }}" class="img-fluid img-nav-active mx-auto">
                                        @break
                                        @case ('Thủy phi cơ')
                                        <a class="nav-link text-center border-0 rounded-0 py-4 position-relative bg-transparent" data-toggle="tab" href="#booking-seaplane" role="tab">
                                            <img src="{{ asset('frontend/img/seaplane.svg') }}" class="img-fluid img-nav mx-auto">
                                            <img src="{{ asset('frontend/img/seaplane-active.svg') }}" class="img-fluid img-nav-active mx-auto">
                                            @break
                                            @case ('Combo')
                                            <a class="nav-link text-center border-0 rounded-0 py-4 position-relative bg-transparent" data-toggle="tab" href="#booking-combo" role="tab">
                                                <img src="{{ asset('frontend/img/airplane-around-earth.svg') }}" class="img-fluid img-nav mx-auto">
                                                <img src="{{ asset('frontend/img/airplane-around-earth-active.svg') }}" class="img-fluid img-nav-active mx-auto">
                                                @break
                                                @case ('Du thuyền')
                                                <a class="nav-link text-center border-0 rounded-0 py-4 position-relative bg-transparent" data-toggle="tab" href="#booking-yacht" role="tab">
                                                    <img src="{{ asset('frontend/img/boat.svg') }}" class="img-fluid img-nav mx-auto">
                                                    <img src="{{ asset('frontend/img/boat-active.svg') }}" class="img-fluid img-nav-active mx-auto">
                                                    @break
                                                    @endswitch
                                                    <p class="text-primary text-nowrap mt-4 mb-0">{{ $tab->name }}</p>
                                                </a>
                                                @endforeach
                                                @endif
                        </div>
                    </nav>
                    <div class="tab-content combo-booking-tab-content">
                        <div class="tab-pane fade py-5 px-3" id="booking-hotel" role="tabpanel">
                            <form action="{{ route('search-hotel') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="d-flex align-items-center justify-content-end">
                                    <!-- <div class="d-flex align-items-center d-sm-none d-lg-flex d-xl-flex hotel-vehicle-select mb-3">
                                        <div class="mr-4">
                                            <label class="d-flex align-items-center cursor-pointer font-title text-primary mb-0">
                                                <div class="matter-checkbox m-0">
                                                    <input type="checkbox" checked>
                                                    <span></span>
                                                </div>
                                                <div class="ml-1">Kèm chuyến bay</div>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="d-flex align-items-center cursor-pointer font-title text-primary mb-0">
                                                <div class="matter-checkbox m-0">
                                                    <input type="checkbox">
                                                    <span></span>
                                                </div>
                                                <div class="ml-1">Thêm ô tô</div>
                                            </label>
                                        </div>
                                    </div> -->
                                    <div class="text-right text-success room-person-select mb-4">
                                        <div class="dropdown dropdownPersonRoom ml-auto">
                                            <button class="btn bg-transparent p-0 border-0 no-active-focus text-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="total-person">1</span> người, <span class="total-room">1</span> phòng <i class="fal fa-chevron-down text-success ml-1"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton">
                                                <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="1" name="hotel_adultNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="0" name="hotel_childNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Trẻ em (dưới 2 tuổi)</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="0" name="hotel_childNum2" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-select-header font-title text-primary font-17pt py-2 px-3 border-top border-bottom">Số phòng</div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Phòng đơn</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="1" name="hotel_single_room" class="input-step-fill room-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Phòng đôi</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="0" name="hotel_double_room" class="input-step-fill room-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
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
                                <div class="row row-medium-space booking-input">
                                    <div class="col-sm-12 col-md-12 col-lg-6 mb-sm-3 mb-lg-0">
                                        <div class="form-group mb-0">
                                            <div class="input-group float-label-input">
                                                <div class="input-group-prepend m-0">
                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                    </span>
                                                </div>
                                                <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                                    <span>Chọn điểm đến</span>
                                                    <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="placeId_hotel" required>
                                                        @if ($list_place_hotel)
                                                        @foreach ($list_place_hotel as $place_hotel)
                                                        <option value="{{ $place_hotel->id }}">{{ $place_hotel->name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3 mb-sm-3 mb-lg-0">
                                        <div class="form-group mb-0">
                                            <div class="input-group float-label-input">
                                                <div class="input-group-prepend m-0">
                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                        <i class="far fa-calendar text-primary"></i>
                                                    </span>
                                                </div>
                                                <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                                    <input type="text" placeholder=" " class="text-primary date-hotel-start" name="start_date_hotel" required />
                                                    <span>Nhận phòng</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <div class="form-group mb-0">
                                            <div class="input-group float-label-input">
                                                <div class="input-group-prepend m-0">
                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                        <i class="far fa-calendar text-primary"></i>
                                                    </span>
                                                </div>
                                                <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                                    <input type="text" placeholder=" " class="text-primary date-hotel-end" name="end_date_hotel" />
                                                    <span>Trả phòng</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                        <button class="btn btn-primary-gradient font-title font-17pt py-12px px-5 col-sm-12 col-md-6 col-lg-3 col-xl-2 mx-auto mt-sm-2 mt-md-4 mt-lg-4">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade py-5 px-3 show active" id="booking-airplane" role="tabpanel">
                            <div class="d-flex align-items-center justify-content-between flex-wrap mb-4">
                                <ul class="nav nav-pills nav-pill-airplane flex-nowrap mb-0 mb-xs-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link px-xs-3 px-5 py-12px font-title radius-lg text-primary active" data-toggle="pill" href="#roundtrip" role="tab">Khứ hồi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-xs-3 px-5 py-12px font-title radius-lg text-primary" data-toggle="pill" href="#oneway" role="tab">Một chiều</a>
                                    </li>
                                </ul>

                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="roundtrip" role="tabpanel">
                                    <form action="{{ route('post_search_2_way_flight') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="dropdown dropdown-select-airplane dropdownPersonRoom ml-auto py-12px">
                                            <button class="btn bg-transparent p-0 border-0 no-active-focus text-success text-nowrap" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="total-person">1</span> Hành khách
                                            </button>
                                            <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton">
                                                <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="1" name="two_way_adt" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="0" name="two_way_chd" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Em bé (dưới 2 tuổi)</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="0" name="two_way_inf" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-select-footer font-title text-primary font-17pt py-2 px-3 border-top">
                                                    <button class="btn btn-primary-gradient font-title btn-block px-3 py-12px">Đồng ý</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-medium-space">
                                            <div class="col-sm-12 col-md-12 col-lg-7">
                                                <div class="row row-medium-space align-items-center airplane-swap-input">
                                                    <div class="col mb-xs-3 mb-sm-3 mb-lg-0">
                                                        <div class="form-group mb-0">
                                                            <div class="input-group float-label-input">
                                                                <div class="input-group-prepend m-0">
                                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                                    </span>
                                                                </div>
                                                                <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                                                    <span>Chọn điểm đi</span>
                                                                    <select class="airplane-select-start selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="begin_place_2_way">
                                                                        @foreach ($list_place_flight as $place_area_flight)
                                                                        <optgroup label="{{ $place_area_flight->name }}">
                                                                            @foreach ($place_area_flight->sub_list as $place)
                                                                            <option value="{{ $place->code }}">{{ $place->name }} ({{ $place->code }})</option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                        @endforeach
                                                                    </select>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="circle-icon-lg bg-white border rounded-circle shadow-sm d-flex align-items-center justify-content-center swap-place swap-place-airplane">
                                                        <i class="far fa-exchange text-success"></i>
                                                    </div>
                                                    <div class="col mb-xs-3 mb-sm-3 mb-lg-0">
                                                        <div class="form-group mb-0">
                                                            <div class="input-group float-label-input">
                                                                <div class="input-group-prepend m-0">
                                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                                    </span>
                                                                </div>
                                                                <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                                                    <span>Chọn điểm đến</span>
                                                                    <select class="airplane-select-end selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="end_place_2_way">
                                                                        @foreach ($list_place_flight as $place_area_flight)
                                                                        <optgroup label="{{ $place_area_flight->name }}">
                                                                            @foreach ($place_area_flight->sub_list as $place)
                                                                            <option value="{{ $place->code }}">{{ $place->name }} ({{ $place->code }})</option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                        @endforeach
                                                                    </select>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-5">
                                                <div class="row airplane-select-datetime row-medium-space">
                                                    <div class="col-sm-12 col-md-12 col-lg-6 mb-xs-3 mb-sm-3 mb-md-0">
                                                        <div class="form-group mb-0">
                                                            <div class="input-group float-label-input">
                                                                <div class="input-group-prepend m-0">
                                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                                        <i class="far fa-calendar text-primary"></i>
                                                                    </span>
                                                                </div>
                                                                <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                                                    <input type="text" placeholder=" " class="text-primary date-range-airplane-twoway" required name="two_way_start_date">
                                                                    <span>Ngày đi</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-6 mb-xs-3 mb-sm-3 mb-md-0">
                                                        <div class="form-group mb-0">
                                                            <div class="input-group float-label-input">
                                                                <div class="input-group-prepend m-0">
                                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                                        <i class="far fa-calendar text-primary"></i>
                                                                    </span>
                                                                </div>
                                                                <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                                                    <input type="text" placeholder=" " class="text-primary date-airplane" required name="two_way_end_date">
                                                                    <span>Ngày về</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                <button type="submit" class="btn btn-primary-gradient font-title font-17pt py-12px px-5 col-sm-12 col-md-6 col-lg-3 col-xl-2 mx-auto mt-sm-2 mt-md-4 mt-lg-4 search-flight">Tìm kiếm</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="oneway" role="tabpanel">
                                    <form action="{{ route('post_search_flight') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="dropdown dropdown-select-airplane dropdownPersonRoom ml-auto py-12px">
                                            <button class="btn bg-transparent p-0 border-0 no-active-focus text-success text-nowrap" type="button" id="dropdownMenuButton_2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="total-person">1</span> Hành khách
                                            </button>
                                            <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton_2">
                                                <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="1" name="two_way_adt" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="0" name="way_chd" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Em bé (dưới 2 tuổi)</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="0" name="two_way_inf" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-select-footer font-title text-primary font-17pt py-2 px-3 border-top">
                                                    <button class="btn btn-primary-gradient font-title btn-block px-3 py-12px">Đồng ý</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-medium-space">
                                            <div class="col-sm-12 col-md-12 col-lg-8">
                                                <div class="row row-medium-space align-items-center airplane-swap-input">
                                                    <div class="col mb-xs-3 mb-sm-3 mb-md-0">
                                                        <div class="form-group mb-0">
                                                            <div class="input-group float-label-input">
                                                                <div class="input-group-prepend m-0">
                                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                                    </span>
                                                                </div>
                                                                <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                                                    <span>Chọn điểm đến</span>
                                                                    <select class="form-control h-auto py-12px bg-white selectpicker" data-live-search="true" name="begin_place_2_way">
                                                                        @foreach ($list_place_flight as $place_area_flight)
                                                                        <optgroup label="{{ $place_area_flight->name }}">
                                                                            @foreach ($place_area_flight->sub_list as $place)
                                                                            <option value="{{ $place->code }}">{{ $place->name }} ({{ $place->code }})</option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                        @endforeach
                                                                    </select>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="circle-icon-lg bg-white border rounded-circle shadow-sm d-flex align-items-center justify-content-center swap-place swap-place-airplane">
                                                        <i class="far fa-exchange text-success"></i>
                                                    </div>
                                                    <div class="col mb-xs-3 mb-sm-3 mb-md-0">
                                                        <div class="form-group mb-0">
                                                            <div class="input-group float-label-input">
                                                                <div class="input-group-prepend m-0">
                                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                                    </span>
                                                                </div>
                                                                <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                                                    <span>Chọn điểm đến</span>
                                                                    <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="end_place_2_way">
                                                                        @foreach ($list_place_flight as $place_area_flight)
                                                                        <optgroup label="{{ $place_area_flight->name }}">
                                                                            @foreach ($place_area_flight->sub_list as $place)
                                                                            <option value="{{ $place->code }}">{{ $place->name }} ({{ $place->code }})</option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                        @endforeach
                                                                    </select>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-4">
                                                <div class="form-group mb-0">
                                                    <div class="input-group float-label-input">
                                                        <div class="input-group-prepend m-0">
                                                            <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                                <i class="far fa-calendar text-primary"></i>
                                                            </span>
                                                        </div>
                                                        <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                                            <input type="text" placeholder=" " class="text-primary date-range-airplane-oneway" name="way_start_date">
                                                            <span>Ngày đi</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                <button type="submit" class="btn btn-primary-gradient font-title font-17pt py-12px px-5 col-sm-12 col-md-6 col-lg-3 col-xl-2 mx-auto mt-sm-2 mt-md-4 mt-lg-4 search-flight">Tìm kiếm</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade py-5 px-3" id="booking-tour" role="tabpanel">
                            <form action="{{ route('post_search_tour') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="text-right">
                                    <div class="d-inline-block position-relative text-success room-person-select mb-3">
                                        <div class="dropdown d-inline-block dropdown-select-tour dropdownPersonRoom ml-auto">
                                            <button class="btn bg-transparent p-0 border-0 no-active-focus text-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="total-person"></span> Hành khách <i class="fal fa-chevron-down text-success ml-1"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton">
                                                <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="1" name="tour_adultNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="0" name="tour_childNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Trẻ em (dưới 2 tuổi)</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="0" name="tour_childNum2" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
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
                                <div class="row row-medium-space booking-input">
                                    <div class="col-sm-12 col-md-12 col-lg-6 mb-sm-3 mb-lg-0">
                                        <div class="form-group mb-0">
                                            <div class="input-group float-label-input">
                                                <div class="input-group-prepend m-0">
                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                    </span>
                                                </div>
                                                <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                                    <span>Khởi hành từ</span>
                                                    <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="tour_place_start">
                                                        @if ($list_place_tour)
                                                        @foreach ($list_place_tour as $place_tour)
                                                        <option value="{{ $place_tour->id }}">{{ $place_tour->name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3 mb-sm-3 mb-lg-0">
                                        <div class="form-group mb-0">
                                            <div class="input-group float-label-input">
                                                <div class="input-group-prepend m-0">
                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                        <i class="far fa-calendar text-primary"></i>
                                                    </span>
                                                </div>
                                                <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                                    <input type="text" placeholder=" " class="text-primary date-picker-tour" name="tour_date">
                                                    <span>Ngày khởi hành</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <div class="form-group mb-0">
                                            <div class="input-group float-label-input">
                                                <div class="input-group-prepend m-0">
                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                    </span>
                                                </div>
                                                <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                                    <span>Chọn điểm đến</span>
                                                    <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="tour_place_end">
                                                        @if ($list_place_tour)
                                                        @foreach ($list_place_tour as $place_tour)
                                                        <option value="{{ $place_tour->id }}">{{ $place_tour->name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                        <button class="btn btn-primary-gradient font-title font-17pt py-12px px-5 col-sm-12 col-md-6 col-lg-3 col-xl-2 mx-auto mt-sm-2 mt-md-4 mt-lg-4">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade py-5 px-3" id="booking-seaplane" role="tabpanel">
                            <form action="{{ route('post_search_seaplane') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="text-right mb-3">
                                    <div class="dropdown d-inline-block dropdown-select-seaplane dropdownPersonRoom ml-auto">
                                        <button class="btn bg-transparent p-0 border-0 no-active-focus text-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="total-person"></span> Hành khách <i class="fal fa-chevron-down text-success ml-1"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton">
                                            <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                            <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                                <span class="input-group-select d-flex align-items-center justify-content-end">
                                                    <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                    <input type="number" min="0" value="1" name="seaplane_adultNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                    <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                </span>
                                            </div>
                                            <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                                <span class="input-group-select d-flex align-items-center justify-content-end">
                                                    <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                    <input type="number" min="0" value="0" name="seaplane_childNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                    <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                </span>
                                            </div>
                                            <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                <span class="dropdown-select-text text-nowrap">Trẻ em (dưới 2 tuổi)</span>
                                                <span class="input-group-select d-flex align-items-center justify-content-end">
                                                    <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                    <input type="number" min="0" value="0" name="seaplane_childNum2" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                    <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                </span>
                                            </div>
                                            <div class="dropdown-select-footer font-title text-primary font-17pt py-2 px-3 border-top">
                                                <button class="btn btn-primary-gradient font-title btn-block px-3 py-12px">Đồng ý</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-medium-space">
                                    <div class="col-sm-12 col-md-12 col-lg-8">
                                        <div class="row row-medium-space align-items-center airplane-swap-input">
                                            <div class="col mb-xs-3 mb-sm-3 mb-lg-0">
                                                <div class="form-group mb-0">
                                                    <div class="input-group float-label-input">
                                                        <div class="input-group-prepend m-0">
                                                            <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                                            </span>
                                                        </div>
                                                        <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                                            <span>Chọn điểm đi</span>
                                                            <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="startPlace">
                                                                @if ($list_place_seaplane)
                                                                @foreach ($list_place_seaplane as $seaplane)
                                                                <option value="{{ $seaplane->id }}">{{ $seaplane->name }}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="circle-icon-lg bg-white border rounded-circle shadow-sm d-flex align-items-center justify-content-center swap-place swap-place-airplane">
                                                <i class="far fa-exchange text-success"></i>
                                            </div>
                                            <div class="col mb-xs-3 mb-sm-3 mb-lg-0">
                                                <div class="form-group mb-0">
                                                    <div class="input-group float-label-input">
                                                        <div class="input-group-prepend m-0">
                                                            <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                                            </span>
                                                        </div>
                                                        <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                                            <span>Chọn điểm đến</span>
                                                            <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="endPlace">
                                                                @if ($list_place_seaplane)
                                                                @foreach ($list_place_seaplane as $seaplane)
                                                                <option value="{{ $seaplane->id }}">{{ $seaplane->name }}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="row airplane-select-datetime row-medium-space">
                                            <div class="col mb-xs-3 mb-sm-3 mb-lg-0">
                                                <div class="form-group mb-0">
                                                    <div class="input-group float-label-input">
                                                        <div class="input-group-prepend m-0">
                                                            <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                                <i class="far fa-calendar text-primary"></i>
                                                            </span>
                                                        </div>
                                                        <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                                            <input type="text" placeholder=" " class="text-primary date-picker-tour" name="startDate">
                                                            <span>Ngày đi</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-12 col-md-12 col-lg-6 mb-xs-3 mb-sm-3 mb-md-0">
                                                    <div class="form-group mb-0">
                                                        <div class="input-group float-label-input">
                                                            <div class="input-group-prepend m-0">
                                                                <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                                    <i class="far fa-calendar text-primary"></i>
                                                                </span>
                                                            </div>
                                                            <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                                                <input type="text" placeholder=" " class="text-primary date-range-seaplane-end">
                                                                <span>Ngày về</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                        <button class="btn btn-primary-gradient font-title font-17pt py-12px px-5 col-sm-12 col-md-6 col-lg-3 col-xl-2 mx-auto mt-sm-2 mt-md-4 mt-lg-4">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade py-5 px-3" id="booking-yacht" role="tabpanel">
                            <form action="{{ route('post_search_Yacht') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="text-right mb-3">
                                    <div class="dropdown dropdownPersonRoom d-inline-block dropdown-select-yacht ml-auto">
                                        <button class="btn bg-transparent p-0 border-0 no-active-focus text-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="total-person"></span> Hành khách <i class="fal fa-chevron-down text-success ml-1"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton">
                                            <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                            <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                                <span class="input-group-select d-flex align-items-center justify-content-end">
                                                    <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                    <input type="number" min="0" value="1" name="yacht_adultNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                    <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                </span>
                                            </div>
                                            <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                                <span class="input-group-select d-flex align-items-center justify-content-end">
                                                    <div class="step-minus cursor-pointer disable-click"><i class="fal fa-minus-circle"></i></div>
                                                    <input type="number" min="0" value="0" name="yacht_childNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                    <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                </span>
                                            </div>
                                            <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                <span class="dropdown-select-text text-nowrap">Trẻ em (dưới 2 tuổi)</span>
                                                <span class="input-group-select d-flex align-items-center justify-content-end">
                                                    <div class="step-minus cursor-pointer disable-click"><i class="fal fa-minus-circle"></i></div>
                                                    <input type="number" min="0" value="0" name="yacht_childNum2" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                    <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                </span>
                                            </div>
                                            <div class="dropdown-select-footer font-title text-primary font-17pt py-2 px-3 border-top">
                                                <button class="btn btn-primary-gradient font-title btn-block px-3 py-12px">Đồng ý</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-medium-space">
                                    <div class="col-sm-12 col-md-6 col-lg-3 mb-xs-3 mb-sm-3 mb-lg-0">
                                        <div class="form-group mb-0">
                                            <div class="input-group float-label-input">
                                                <div class="input-group-prepend m-0">
                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                    </span>
                                                </div>
                                                <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                                    <span>Chọn điểm đến</span>
                                                    <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="yacht_place" required>
                                                        <option value="">....</option>
                                                        @if ($list_place_yacht)
                                                        @foreach ($list_place_yacht as $place_yacht)
                                                        <option value="{{ $place_yacht->id }}">{{ $place_yacht->name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3 mb-xs-3 mb-sm-3 mb-lg-0">
                                        <div class="form-group mb-0">
                                            <div class="input-group float-label-input">
                                                <div class="input-group-prepend m-0">
                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                        <i class="far fa-calendar text-primary"></i>
                                                    </span>
                                                </div>
                                                <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                                    <input type="text" placeholder=" " class="text-primary yacht-date-picker" name="yacht_book_date">
                                                    <span>Ngày khởi hành </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3 mb-xs-3 mb-sm-3 mb-md-0 mb-lg-0">
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
                                                        <option value="1">1 ngày</option>
                                                        <option value="2">2 ngày</option>
                                                        <option value="3">3 ngày</option>
                                                        <option value="4">4 ngày</option>
                                                        <option value="5">5 ngày</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3 mb-xs-3 mb-sm-3 mb-md-0 mb-lg-0">
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
                                                        <option value="1">1 </option>
                                                        <option value="2">2 </option>
                                                        <option value="3">3 </option>
                                                        <option value="4">4 </option>
                                                        <option value="5">5 </option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                        <button class="btn btn-primary-gradient font-title font-17pt py-12px px-5 col-sm-12 col-md-6 col-lg-3 col-xl-2 mx-auto mt-sm-2 mt-md-4 mt-lg-4">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade py-5 px-3" id="booking-combo" role="tabpanel">
                            <form action="{{ route('post_search_combo') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="text-right">
                                    <div class="d-inline-block position-relative text-success room-person-select mb-4">
                                        <div class="dropdown dropdownPersonRoom d-inline-block dropdown-select-combo ml-auto">
                                            <button class="btn bg-transparent p-0 border-0 no-active-focus text-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="total-person"></span> Hành khách <i class="fal fa-chevron-down text-success ml-1"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton">
                                                <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="1" name="combo_adultNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer disable-click"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="0" name="combo_childNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                                    </span>
                                                </div>
                                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                                    <span class="dropdown-select-text text-nowrap">Trẻ em (dưới 2 tuổi)</span>
                                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                                        <div class="step-minus cursor-pointer disable-click"><i class="fal fa-minus-circle"></i></div>
                                                        <input type="number" min="0" value="0" name="combo_childNum2" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
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
                                <div class="row row-medium-space booking-input">
                                    <div class="col-sm-12 col-md-12 col-lg-6 mb-sm-3 mb-lg-0">
                                        <div class="form-group mb-0">
                                            <div class="input-group float-label-input">
                                                <div class="input-group-prepend m-0">
                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                    </span>
                                                </div>
                                                <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                                    <span>Chọn điểm đến</span>
                                                    <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="combo_place_end">
                                                        @if ($list_place_tour)
                                                        @foreach ($list_place_tour as $place_tour)
                                                        <option value="{{ $place_tour->id }}">{{ $place_tour->name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3 mb-sm-3 mb-lg-0">
                                        <div class="form-group mb-0">
                                            <div class="input-group float-label-input">
                                                <div class="input-group-prepend m-0">
                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                        <i class="far fa-calendar text-primary"></i>
                                                    </span>
                                                </div>
                                                <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                                    <input type="text" placeholder=" " class="text-primary date-picker-tour" name="combo_date">
                                                    <span>Ngày khởi hành</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <div class="form-group mb-0">
                                            <div class="input-group float-label-input">
                                                <div class="input-group-prepend m-0">
                                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                    </span>
                                                </div>
                                                <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                                    <span>Khởi hành từ</span>
                                                    <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="combo_place_start">
                                                        @if ($list_place_tour)
                                                        @foreach ($list_place_tour as $place_tour)
                                                        <option value="{{ $place_tour->id }}">{{ $place_tour->name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                        <button class="btn btn-primary-gradient font-title font-17pt py-12px px-5 col-sm-12 col-md-6 col-lg-3 col-xl-2 mx-auto mt-sm-2 mt-md-4 mt-lg-4">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="combo-booking-container pt-5">
        <div class="container">
            <div class="font-title-bold font-md-title">Du lịch cùng Halobay</div>
            <p class="my-3">Các tài nguyên giúp bạn đi du lịch thông minh, từng bước</p>
            <div class="row halobay-service">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="combo-booking-intro-item bg-white h-100 border radius-md mb-sm-3 p-3">
                        <div class="font-title font-20pt">Luôn có giá tốt</div>
                        <p class="mb-0">Với nhiều khuyến mãi, ưu đãi hấp dẫn, khách hàng sẽ đặt được dịch vụ có giá tốt nhất</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="combo-booking-intro-item bg-white h-100 border radius-md mb-sm-3 p-3">
                        <div class="font-title font-20pt">Đảm bảo chất lượng</div>
                        <p class="mb-0">Liên kết chặn chẽ với đối tác, khảo sát định kỳ để đảm bảo chất lượng tốt nhất</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="combo-booking-intro-item bg-white h-100 border radius-md p-3">
                        <div class="font-title font-20pt">Hỗ trợ tận tình - chu đáo</div>
                        <p class="mb-0">Đặt lợi ích khách hàng lên trên hết, chúng tôi hỗ trợ khách hàng nhanh và chính xác nhất.</p>
                    </div>
                </div>
            </div>
            @if ($cate_home)
            @foreach ($cate_home as $val)
            @if ($val->ordinal == 1)
            <div class="font-title-bold font-md-title mt-5">{{ $val->name }}</div>
            <p class="mt-2 mb-3">{{ $val->description }}</p>
            <div class="row halobay-tour-intro">
                @if ($val->tourTypes[0]->ordinal == 1)
                <div class="col-sm-12 col-md-6 col-lg-8 mb-sm-3 mb-md-0">
                    <div class="overflow-hidden radius-lg bg-white border h-100">
                        <img src="{{ asset($val->tourTypes[0]->imgUrl) }}" class="img-fluid w-100 object-fit-cover booking-idea-img-lg">
                        <div class="p-3">
                            <div class="font-title font-sm-title text-trim-line text-one-line">{{ $val->tourTypes[0]->name }}</div>
                            <p class="mt-1 mb-0 text-trim-line text-two-line">{{ $val->tourTypes[0]->description }}</p>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="h-100 d-flex flex-column justify-content-between">
                        @if ($val->tourTypes[1]->ordinal == 2)
                        <div class="d-flex overflow-hidden radius-lg bg-white border mb-3" style="display: inline-block !important;">
                            <div class="w-35" style="float: left; height: 165px">
                                <img src="{{ asset($val->tourTypes[1]->imgUrl) }}" class="img-fluid w-100 object-fit-cover" style="height: 100%">
                            </div>
                            <div class="w-65 d-flex align-items-center" style="height: 165px;">
                                <div class="p-3">
                                    <div class="font-title font-sm-title text-trim-line text-one-line">{{ $val->tourTypes[1]->name }}</div>
                                    <p class="mt-1 mb-0 text-trim-line text-two-line">{{ $val->tourTypes[1]->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($val->tourTypes[2]->ordinal == 3)
                        <div class="d-flex overflow-hidden radius-lg bg-white border" style="display: inline-block !important;">
                            <div class="w-35" style="float: left; height: 165px">
                                <img src="{{ asset($val->tourTypes[2]->imgUrl) }}" class="img-fluid w-100 object-fit-cover" style="height: 100%">
                            </div>
                            <div class="w-65 d-flex align-items-center" style="height: 165px;">
                                <div class="p-3">
                                    <div class="font-title font-sm-title text-trim-line text-one-line">{{ $val->tourTypes[2]->name }}</div>
                                    <p class="mt-1 mb-0 text-trim-line text-two-line">{{ $val->tourTypes[2]->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="font-title-bold font-md-title mt-5">{{ $val->name }}</div>
            <p class="mt-2 mb-3">{{ $val->description }}</p>
            @foreach($val->tourTypes as $v)
            @if ($v->status == 1)
            <div class="booking-introduce-explore radius-lg d-flex align-items-end p-4" style="background-image:url('{{ $v->imgUrl }}')">
                <div class="text-white">
                    <div class="font-title font-sm-title text-trim-line text-one-line">{{ $v->name }}</div>
                    <p class="mt-2 mb-0 text-trim-line text-two-line">{{ $v->description }}</p>
                </div>
            </div>
            @endif
            @endforeach
            @endif
            @endforeach
            @endif
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('frontend/js/amlich.js') }}"></script>
<script>
    // sessionStorage.setItem("hotel_adultNum", 1);
    // sessionStorage.setItem("hotel_ChildNum", 0);
    // sessionStorage.setItem("hotel_ChildNum2", 0);
    // sessionStorage.setItem("hotel_single_room", 1);
    // sessionStorage.setItem("hotel_double_room", 0);
    // sessionStorage.setItem("start_date_hotel", 0);
    // sessionStorage.setItem("end_date_hotel", 0);
    $('.search-flight').on('click', function() {
        const form = $(this).closest('form');
        if (form.find('select[name="begin_place_2_way"] option:selected').val() == form.find('select[name="end_place_2_way"] option:selected').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Điểm đến không được trùng điểm đi",
            });
            return false;
        }
        const date1 = form.find('input[name="two_way_start_date"]').val();
        const date2 = form.find('input[name="two_way_end_date"]').val();
        if (process(date1) > process(date2)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ngày về phải lớn hơn hoặc bằng ngày xuất phát!",
            });
            return false;
        }
        if (form.find('input[name="two_way_adt"]').val() < form.find('input[name="two_way_inf"]').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Số lượng khách trẻ sơ sinh phải nhỏ hơn hoặc bằng số lượng khách người lớn",
            });
            return false;
        }
        $(this).submit();
    });
    let time = $('.date-range-airplane-twoway').val();;
    $('.date-range-airplane-twoway').on('showCalendar.daterangepicker', function(ev, picker) {
        time = $('.date-range-airplane-twoway').val();
        $('.date-airplane').daterangepicker({
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
    $('.date-airplane').daterangepicker({
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
    $('.date-hotel-start').on('showCalendar.daterangepicker', function(ev, picker) {
        time = $('.date-hotel-start').val();
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
</script>
@endsection