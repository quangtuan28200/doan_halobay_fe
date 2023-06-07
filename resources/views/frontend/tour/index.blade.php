@extends('frontend.layouts.layout')
@section('body')
<section class="tour-booking">
    <div class="tour-booking-info bg-white py-3">
        <div class="container">
            <form action="{{ route('post_search_tour') }}" method="POST">
                {{ csrf_field() }}
                <div class="row row-medium-space">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="d-inline-block text-success room-person-select mb-3">
                            <div class="dropdown dropdownPersonRoom ml-auto">
                                <button class="btn bg-transparent p-0 border-0 no-active-focus text-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="total-person"></span> Hành khách <i class="fal fa-chevron-down text-success ml-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton">
                                    <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                    <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                        <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                        <span class="input-group-select d-flex align-items-center justify-content-end">
                                            <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                            <input type="number" min="0" value="{{ $info['tour_adultNum'] }}" name="tour_adultNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                            <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                        </span>
                                    </div>
                                    <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                        <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                        <span class="input-group-select d-flex align-items-center justify-content-end">
                                            <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                            <input type="number" min="0" value="{{ $info['tour_childNum'] }}" name="tour_childNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                            <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                        </span>
                                    </div>
                                    <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                        <span class="dropdown-select-text text-nowrap">Trẻ em (dưới 2 tuổi)</span>
                                        <span class="input-group-select d-flex align-items-center justify-content-end">
                                            <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                            <input type="number" min="0" value="{{ $info['tour_childNum2'] }}" name="tour_childNum2" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
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
                    <div class="col-sm-12 col-md-4 col-lg-4 mb-xs-3 mb-sm-3">
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
                                        <option value="{{ $place_tour->id }}" @if ($place_tour->id == $info['tour_place_start']) selected @endif>{{ $place_tour->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3 mb-xs-3 mb-sm-3">
                        <div class="form-group mb-0">
                            <div class="input-group float-label-input">
                                <div class="input-group-prepend m-0">
                                    <span class="input-group-text bg-transparent pr-0 border-right-0">
                                        <i class="far fa-calendar text-primary"></i>
                                    </span>
                                </div>
                                <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                    <input type="text" placeholder=" " class="text-primary date-picker-tour" name="tour_date" value="{{ $info['tour_date'] }}">
                                    <span>Ngày khởi hành</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3 mb-xs-3 mb-sm-3">
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
                                        <option value="{{ $place_tour->id }}" @if ($place_tour->id == $info['tour_place_end']) selected @endif>{{ $place_tour->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2">
                        <button class="btn btn-primary-gradient font-title btn-block py-12px">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @yield('tour-booking-content')
</section>
@endsection