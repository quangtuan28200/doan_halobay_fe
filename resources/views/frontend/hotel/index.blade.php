@extends('frontend.layouts.layout')
@section('body')
<section class="hotel-booking">
    <div class="hotel-booking-info bg-white py-3">
        <div class="container">
            <form action="{{ route('search-hotel') }}" method="POST" autocomplete="off">
                {{ csrf_field() }}

                <div class="row row-medium-space booking-input">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="text-success room-person-select mb-3">
                            <div class="dropdown dropdownPersonRoom d-inline-block ml-auto">
                                <button class="btn bg-transparent p-0 border-0 no-active-focus text-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="total-person">1</span> người, <span class="total-room">1</span> phòng <i class="fal fa-chevron-down text-success ml-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton">
                                    <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                    <div class="dropdown-item border-0 d-flex justify-content-between bg-white">
                                        <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                        <span class="input-group-select d-flex align-items-center justify-content-end">
                                            <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                            <input type="number" min="0" value="{{ $info['hotel_adultNum'] }}" name="hotel_adultNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                            <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                        </span>
                                    </div>
                                    <div class="dropdown-item border-0 d-flex justify-content-between bg-white">
                                        <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                        <span class="input-group-select d-flex align-items-center justify-content-end">
                                            <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                            <input type="number" min="0" value="{{ $info['hotel_childNum'] }}" name="hotel_childNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                            <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                        </span>
                                    </div>
                                    <div class="dropdown-item border-0 d-flex justify-content-between bg-white">
                                        <span class="dropdown-select-text text-nowrap">Trẻ em (dưới 2 tuổi)</span>
                                        <span class="input-group-select d-flex align-items-center justify-content-end">
                                            <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                            <input type="number" min="0" value="{{ $info['hotel_childNum2'] }}" name="hotel_childNum2" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                            <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                        </span>
                                    </div>
                                    <div class="dropdown-select-header font-title text-primary font-17pt py-2 px-3 border-top border-bottom">Số phòng</div>
                                    <div class="dropdown-item border-0 d-flex justify-content-between bg-white">
                                        <span class="dropdown-select-text text-nowrap">Phòng đơn</span>
                                        <span class="input-group-select d-flex align-items-center justify-content-end">
                                            <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                            <input type="number" min="0" value="{{ $info['hotel_single_room'] }}" name="hotel_single_room" class="input-step-fill room-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                            <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                        </span>
                                    </div>
                                    <div class="dropdown-item border-0 d-flex justify-content-between bg-white">
                                        <span class="dropdown-select-text text-nowrap">Phòng đôi</span>
                                        <span class="input-group-select d-flex align-items-center justify-content-end">
                                            <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                            <input type="number" min="0" value="{{ $info['hotel_double_room'] }}" name="hotel_double_room" class="input-step-fill room-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
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
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group mb-0">
                            <div class="input-group float-label-input">
                                <div class="input-group-prepend m-0">
                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                    </span>
                                </div>
                                <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                    <span>Chọn điểm đến</span>
                                    <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="placeId_hotel">
                                        @if ($list_place_hotel)
                                        @foreach ($list_place_hotel as $place_hotel)
                                        <option value="{{ $place_hotel->id }}" @if ($place_hotel->id == $info['placeId_hotel']) selected @endif>{{ $place_hotel->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-group mb-0">
                            <div class="input-group float-label-input">
                                <div class="input-group-prepend m-0">
                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                        <i class="far fa-calendar text-primary"></i>
                                    </span>
                                </div>
                                <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                    <input type="text" placeholder=" " class="text-primary date-hotel-start" name="start_date_hotel" value="{{ $info['start_date_hotel'] }}" />
                                    <span>Nhận phòng</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-group mb-0">
                            <div class="input-group float-label-input">
                                <div class="input-group-prepend m-0">
                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                        <i class="far fa-calendar text-primary"></i>
                                    </span>
                                </div>
                                <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                    <input type="text" placeholder=" " class="text-primary date-hotel-end" name="end_date_hotel" value="{{ $info['end_date_hotel'] }}" />
                                    <span>Trả phòng</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2">
                        <button type="submit" class="btn btn-primary-gradient font-title btn-block py-12px">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @yield('hotel-booking-content')
</section>
@endsection