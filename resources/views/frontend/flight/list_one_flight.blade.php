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
<div class="airplane-sidebar-info d-xs-block d-sm-block d-md-none d-lg-none d-xl-none smooth-transition w-100 position-fixed top-0 left-0 right-0 bg-gray overflow-y-auto">
    <div class="d-flex align-items-center justify-content-between p-3">
        <span class="font-title-bold font-20pt">Thông tin chi tiết</span>
        <span class="close-airplane-info font-18pt">Đóng</span>
    </div>
    <div class="dropdown-divider my-3"></div>
    <div class="airplane-info-mobile"></div>
    <div class="airplane-info-mobile-footer position-absolute bottom-0 left-0 right-0 py-2 px-3"></div>
</div>
<section class="airplane-booking-list">
    <div class="airplane-booking-info bg-white py-3">
        <div class="container">
            <form action="{{ route('post_search_flight') }}" method="POST">
                {{ csrf_field() }}
                <div class="row row-medium-space">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="dropdown dropdownPersonRoom ml-auto d-inline-block mb-3">
                            <button class="btn bg-transparent p-0 border-0 no-active-focus text-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <span class="airplane-ticket-type">Một chiều</span>
                                <i class="fal fa-chevron-down text-success ml-1 mr-3"></i> -->
                                <span class="total-person"></span> người
                                <i class="fal fa-chevron-down text-success ml-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                    <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                        <input type="number" min="0" value="{{$info['two_way_adt']}}" name="two_way_adt" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                    </span>
                                </div>
                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                    <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                        <input type="number" min="0" value="{{$info['way_chd']}}" name="way_chd" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                    </span>
                                </div>
                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                    <span class="dropdown-select-text text-nowrap">Trẻ em (dưới 2 tuổi)</span>
                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                        <input type="number" min="0" value="{{$info['two_way_inf']}}" name="two_way_inf" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                    </span>
                                </div>
                                <div class="dropdown-select-footer font-title text-primary font-17pt py-2 px-3 border-top">
                                    <button class="btn btn-primary-gradient font-title btn-block px-3 py-12px">Đồng ý</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-7">
                        <div class="row row-medium-space align-items-center airplane-swap-input">
                            <div class="col mb-xs-3 mb-sm-3">
                                <div class="form-group mb-0">
                                    <div class="input-group float-label-input">
                                        <div class="input-group-prepend m-0">
                                            <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                            </span>
                                        </div>
                                        <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                            <span>Chọn điểm đi</span>
                                            <select class="selectpicker form-control h-auto py-12px bg-white" name="begin_place_2_way">
                                                @foreach ($list_place_flight as $place_area_flight)
                                                <optgroup label="{{ $place_area_flight->name }}">
                                                    @foreach ($place_area_flight->sub_list as $place)
                                                    <option value="{{ $place->code }}" @if($place->code == $info['begin_place_2_way']) selected @endif>{{ $place->name }} ({{ $place->code }})</option>
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
                            <div class="col mb-xs-3 mb-sm-3">
                                <div class="form-group mb-0">
                                    <div class="input-group float-label-input">
                                        <div class="input-group-prepend m-0">
                                            <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                            </span>
                                        </div>
                                        <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                            <span>Chọn điểm đến</span>
                                            <select class="selectpicker form-control h-auto py-12px bg-white" name="end_place_2_way">
                                                @foreach ($list_place_flight as $place_area_flight)
                                                <optgroup label="{{ $place_area_flight->name }}">
                                                    @foreach ($place_area_flight->sub_list as $place)
                                                    <option value="{{ $place->code }}" @if($place->code == $info['end_place_2_way']) selected @endif>{{ $place->name }} ({{ $place->code }})</option>
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
                        <div class="row row-medium-space airplane-select-datetime">
                            <div class="col-sm-12 col-md-12 col-lg-7 mb-xs-3 mb-sm-3">
                                <div class="form-group mb-0">
                                    <div class="input-group float-label-input">
                                        <div class="input-group-prepend m-0">
                                            <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                <i class="far fa-calendar text-primary"></i>
                                            </span>
                                        </div>
                                        <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                            <input type="text" placeholder=" " value="{{ $info['way_start_date'] }}" class="text-primary date-range-airplane-oneway" name="way_start_date">
                                            <span>Ngày đi</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-5 mb-xs-3 mb-sm-3">
                                <button type="submit" class="btn btn-primary-gradient font-title btn-block py-12px search-flight">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="combo-booking-list-container container py-3">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-9 combo-booking-list-left">
                <!-- <div class="place-search">
                    <div class="place-search-container d-md-flex d-lg-flex d-xl-flex flex-md-wrap align-items-center justify-content-between">
                        <div class="font-title font-20pt font-title-bold d-flex align-items-center justify-content-xs-between justify-content-sm-between justify-content-md-start justify-content-lg-start justify-content-xl-start">
                            <span>Hà Nội</span>
                            <img src="{{ asset('frontend/img/airplane-icon.png') }}" width="25" class="img-fluid mx-4">
                            <span>Hồ Chí Minh</span>
                        </div>
                        <div class="mt-xs-3 w-xs-100 w-sm-100 w-50 w-md-75 d-md-block d-flex align-items-center justify-content-between">
                            <div class="form-group w-sm-75 mb-0 mt-2">
                                <label class="matter-textfield-filled d-block">
                                    <input type="text" placeholder=" ">
                                    <span>Tìm kiếm theo tên <p class="text-muted d-xs-none d-inline-block">(VD: Halobay Tour)</p></span>
                                </label>
                            </div>
                            <div class="font-20pt toggle-filter-mobile d-xs-block d-sm-block d-md-none d-lg-none d-xl-none font-title-bold text-nowrap ml-2">Lọc bởi</div>
                        </div>
                    </div>
                </div> -->
                <div class="dropdown-divider"></div>
                <div class="row list-airplane airplane-oneway row-small-space" id="data_flight">
                    <input type="hidden" value="{{ $info['two_way_adt'] }}" name="two_way_adt_hide">
                    <input type="hidden" value="{{ $info['way_chd'] }}" name="two_way_chd_hide">
                    <input type="hidden" value="{{ $info['two_way_inf'] }}" name="two_way_inf_hide">
                    <input type="hidden" value="{{ $info['begin_place_2_way'] }}" name="begin_place_2_way_hide">
                    <input type="hidden" value="{{ $info['end_place_2_way'] }}" name="end_place_2_way_hide">
                    <input type="hidden" value="{{ $info['way_start_date'] }}" name="two_way_start_date_hide">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="list-airplane-container">
                            <div class="list-airplane-header bg-primary text-center text-white py-2 px-3">
                                <div class="d-flex align-items-center justify-content-center font-title">
                                    <span>{{ $lists[0]['info']['startPoint'] }}</span>
                                    <img src="{{ asset('frontend/img/airplane-icon-white.png') }}" width="25" class="img-fluid mx-5 mx-xs-2 mx-sm-3">
                                    <span>{{ $lists[0]['info']['endPoint'] }}</span>
                                </div>
                                <div class="mt-1">{{ $lists[0]['info']['date'] }}</div>
                            </div>
                            <div class="card-body border p-0">
                                <!-- <nav class="border-top">
                                    <div class="nav nav-tabs airplane-ticket-go-nav airplane-oneway-nav" role="tablist">
                                        @foreach ($lists[0]['info']['list_days'] as $list_day)
                                        <a class="nav-link text-center border-0 rounded-0 font-12pt px-2 py-1 @if ($list_day['status'] == 1) active @endif change_day_flight" href="javascript:void(0)" data-value="{{ $list_day['full_day'] }}">
                                            <div>{{ $list_day['stuff'] }}</div>
                                            <div>Ngày {{ $list_day['day'] }}</div>
                                            <div style="color: red;">{{ $list_day['min_price'] ? $list_day['min_price'] . VND : "" }} </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </nav> -->
                                <div class="tab-content airplane-go-tab-content">
                                    <div class="tab-pane fade show active" id="airplane-ticket-go-day-1" role="tabpanel">
                                        <div class="airplane-item-list-container">
                                            @if (isset($lists[0]['list_flight']))
                                            @foreach ($lists[0]['list_flight'] as $flight)
                                            <div class="airplane-item">
                                                <div class="d-flex align-items-center justify-content-between airplane-item-content bg-gray-gradient py-2 px-2">
                                                    <div class="w-15 airplane-ticket-logo">
                                                        <img src="{{ asset($flight->listFlight[0]->icon) }}" class="img-fluid">
                                                    </div>
                                                    <div class="w-85 d-flex align-items-center justify-content-between flex-wrap airplane-ticket-info airplane-ticket-oneway">
                                                        <div class="text-center align-middle p-0 w-10">{{ $flight->listFlight[0]->flightNumber }}</div>
                                                        <div class="font-title-bold text-center align-middle text-primary font-title-bold p-0 w-15">{{ Carbon\Carbon::parse($flight->listFlight[0]->listSegment[0]->startTime)->format('H:i') }}</div>
                                                        <div class="font-title-bold text-center align-middle p-0 w-10">7KG</div>
                                                        <div class="text-center align-middle text-danger font-title-bold text-nowrap py-0 px-1 w-25">
                                                            {{ number_format($flight->fareAdt, 0, ',', '.') }} VNĐ
                                                        </div>
                                                        <div class="text-right text-lg-center align-middle py-0 px-1 w-10 d-xs-none d-sm-none d-md-block d-lg-block d-xl-block">
                                                            <button class="circle-icon-sm btn border-0 p-0 btn-secondary d-flex align-items-center justify-content-center text-white show-info-airplane rounded mx-auto">
                                                                <i class="far fa-plus icon-plus"></i>
                                                                <i class="far fa-minus icon-minus"></i>
                                                            </button>
                                                        </div>
                                                        <div class="text-right align-middle py-0 px-1 w-15">
                                                            <a href="javascript:void(0)" class="btn btn-primary-gradient mr-1 check-air_plane" data-session="{{ $session }}" data-value="{{ $flight->listFlight[0]->flightValue }}" data-faredataid="{{ $flight->fareDataId }}">Chọn</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-white show-detail-two hide" data-value="{{ $session }}" data-value="{{ $flight->listFlight[0]->flightValue }}" data-faredataid="{{ $flight->fareDataId }}">
                                                    <div class="py-2 px-3">
                                                        <div class="text-right">Hạng vé <span class="font-title">{{ $flight->listFlight[0]->groupClass }}</span></div>
                                                        <div class="dropdown-divider"></div>
                                                        <div class="airplane-item-short-info">
                                                            <div class="d-flex">
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="text-primary mb-1">Loại vé</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="text-primary mb-1">SL</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="text-primary mb-1">Giá vé</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="text-primary mb-1">Thuế & phí</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="text-primary mb-1">Tổng</div>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-divider"></div>
                                                            <div class="d-flex">
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">Người lớn</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ $flight->adt }}</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format($flight->fareAdt, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format(($flight->taxAdt + $flight->feeAdt + $flight->serviceFee), 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format(($flight->fareAdt + $flight->taxAdt + $flight->feeAdt + $flight->serviceFee) * $flight->adt, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                            </div>
                                                            @if ($flight->chd > 0)
                                                            <div class="dropdown-divider"></div>
                                                            <div class="d-flex">
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">Trẻ em</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ $flight->chd }}</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title"> {{ number_format($flight->fareChd, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format(($flight->taxChd + $flight->feeChd + $flight->serviceFee), 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format(($flight->fareChd + $flight->taxChd + $flight->feeChd + $flight->serviceFee) * $flight->chd, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @if ($flight->inf > 0)
                                                            <div class="dropdown-divider"></div>
                                                            <div class="d-flex">
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">Em bé</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ $flight->inf }}</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title"> {{ number_format($flight->fareInf, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format(($flight->taxInf + $flight->feeInf + $flight->serviceFee), 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format(($flight->fareInf + $flight->taxInf + $flight->feeInf + $flight->serviceFee) * $flight->inf, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div class="dropdown-divider"></div>
                                                            <div class="d-flex">
                                                                <div class="w-20 text-center font-13pt px-1" style="width: 100%;font-size: 18px;">
                                                                    <div class="text-primary mb-1" style="    float: left;">Tổng</div>
                                                                    <div class="font-title" style="text-align: right;">{{ number_format(($flight->fareAdt + $flight->taxAdt + $flight->feeAdt + $flight->serviceFee) * $flight->adt + ($flight->fareChd + $flight->taxChd + $flight->feeChd + $flight->serviceFee) * $flight->chd + ($flight->fareInf + $flight->taxInf + $flight->feeInf + $flight->serviceFee) * $flight->inf, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="airplane-item-info bg-white">
                                                    <div class="py-2 px-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="w-55 d-flex align-items-center justify-content-between font-title">
                                                                <span>{{ $lists[0]['info']['startPoint'] }}</span>
                                                                <span>{{ Carbon\Carbon::parse($flight->listFlight[0]->listSegment[0]->startTime)->format('H:i') }}</span>
                                                            </div>
                                                            <div class="w-40 d-flex align-items-center justify-content-between font-title">
                                                                <span>{{ Carbon\Carbon::parse($flight->listFlight[0]->listSegment[0]->startTime)->format('d/m/Y') }}</span>
                                                                <span class="font-title">{{$flight->listFlight[0]->airPortStart}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>{{ App\Helpers\CommonFunctions::convertTimeToMinutes($flight->listFlight[0]->listSegment[0]->startTime, $flight->listFlight[0]->listSegment[0]->endTime) }}</span>
                                                            <span class="airplane-line"></span>
                                                            <span>A{{ $flight->listFlight[0]->listSegment[0]->plane }}</span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="w-55 d-flex align-items-center justify-content-between font-title">
                                                                <span>{{ $lists[0]['info']['endPoint'] }}</span>
                                                                <span>{{ Carbon\Carbon::parse($flight->listFlight[0]->listSegment[0]->endTime)->format('H:i') }}</span>
                                                            </div>
                                                            <div class="w-40 d-flex align-items-center justify-content-between font-title">
                                                                <span>{{ Carbon\Carbon::parse($flight->listFlight[0]->listSegment[0]->endTime)->format('d/m/Y') }}</span>
                                                                <span class="font-title">{{$flight->listFlight[0]->airPortEnd}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <span>Chuyến bay</span>
                                                                <span class="font-title">{{ $flight->listFlight[0]->listSegment[0]->flightNumber }}</span>
                                                            </div>
                                                            <div>Hạng vé <span class="font-title">{{ $flight->listFlight[0]->groupClass }}</span></div>
                                                        </div>
                                                        <div class="dropdown-divider"></div>
                                                        <div class="airplane-item-short-info">
                                                            <div class="d-flex">
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="text-primary mb-1">Loại vé</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="text-primary mb-1">SL</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="text-primary mb-1">Giá vé</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="text-primary mb-1">Thuế & phí</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="text-primary mb-1">Tổng</div>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-divider"></div>
                                                            <div class="d-flex">
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">Người lớn</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ $flight->adt }}</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format($flight->fareAdt, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format(($flight->taxAdt + $flight->feeAdt + $flight->serviceFee), 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format(($flight->fareAdt + $flight->taxAdt + $flight->feeAdt + $flight->serviceFee) * $flight->adt, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                            </div>
                                                            @if ($flight->chd > 0)
                                                            <div class="dropdown-divider"></div>
                                                            <div class="d-flex">
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">Trẻ em</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ $flight->chd }}</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title"> {{ number_format($flight->fareChd, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format(($flight->taxChd + $flight->feeChd + $flight->serviceFee), 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format(($flight->fareChd + $flight->taxChd + $flight->feeChd + $flight->serviceFee) * $flight->chd, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @if ($flight->inf > 0)
                                                            <div class="dropdown-divider"></div>
                                                            <div class="d-flex">
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">Em bé</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ $flight->inf }}</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title"> {{ number_format($flight->fareInf, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format(($flight->taxInf + $flight->feeInf + $flight->serviceFee), 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                                <div class="w-20 text-center font-13pt px-1">
                                                                    <div class="font-title">{{ number_format(($flight->fareInf + $flight->taxInf + $flight->feeInf + $flight->serviceFee) * $flight->inf, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div class="dropdown-divider"></div>
                                                            <div class="d-flex">
                                                                <div class="w-20 text-center font-13pt px-1" style="width: 100%;font-size: 18px;">
                                                                    <div class="text-primary mb-1" style="    float: left;">Tổng</div>
                                                                    <div class="font-title" style="text-align: right;">{{ number_format(($flight->fareAdt + $flight->taxAdt + $flight->feeAdt + $flight->serviceFee) * $flight->adt + ($flight->fareChd + $flight->taxChd + $flight->feeChd + $flight->serviceFee) * $flight->chd + ($flight->fareInf + $flight->taxInf + $flight->feeInf + $flight->serviceFee) * $flight->inf, 0, ',', '.') }} VNĐ</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            Không có chuyến bay nào
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    <input class="orderBy" type="checkbox" value="0" checked>
                                    <span>HaloBay đề xuất</span>
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
                            <div class="matter-checkbox-item">
                                <label class="matter-checkbox">
                                    <input class="orderBy" type="checkbox" value="3">
                                    <span>Thời gian khởi hành</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="filter-item-container">
                        <div class="filter-item-group mb-4">
                            <div class="font-title-bold font-18pt mb-2">Chế độ hiển thị</div>
                            <div class="matter-checkbox-item">
                                <label class="matter-checkbox">
                                    <input type="checkbox" class="view_mode" value="0" checked>
                                    <span>Giá cơ bản cho một người lớn</span>
                                </label>
                            </div>
                            <div class="matter-checkbox-item">
                                <label class="matter-checkbox">
                                    <input type="checkbox" class="view_mode" value="1">
                                    <span>Giá gồm thuế và chi phí cho một người lớn</span>
                                </label>
                            </div>
                        </div>
                    </div> -->
                    <div class="filter-item-container">
                        <div class="filter-item-group mb-4">
                            <div class="font-title-bold font-18pt mb-2">Hãng hàng không</div>
                            <div class="matter-checkbox-item">
                                <label class="matter-checkbox">
                                    <input class="airline_company" type="checkbox" value="0" checked>
                                    <span>Tất cả các hãng máy bay</span>
                                </label>
                            </div>
                            <div class="matter-checkbox-item">
                                <label class="matter-checkbox">
                                    <input class="airline_company" type="checkbox" value="VN">
                                    <span>Vietnam Airlines</span>
                                </label>
                            </div>
                            <div class="matter-checkbox-item">
                                <label class="matter-checkbox">
                                    <input class="airline_company" type="checkbox" value="QH">
                                    <span>BamBooAirWay</span>
                                </label>
                            </div>
                            <div class="matter-checkbox-item">
                                <label class="matter-checkbox">
                                    <input class="airline_company" type="checkbox" value="VJ">
                                    <span>VietjetAir</span>
                                </label>
                            </div>
                            <!-- <div class="matter-checkbox-item">
                                <label class="matter-checkbox">
                                    <input class="airline_company" type="checkbox" value="VU">
                                    <span>Vietravel Airlines</span>
                                </label>
                            </div> -->
                            <!-- <div class="matter-checkbox-item">
                                <label class="matter-checkbox">
                                    <input class="airline_company" type="checkbox" value="BL">
                                    <span>Pacific Airlines</span>
                                </label>
                            </div> -->
                        </div>
                    </div>
                    <div class="filter-item-container">
                        <div class="filter-item-group mb-4">
                            <div class="font-title-bold font-18pt mb-2">Thời gian khởi hành</div>
                            <div class="row row-medium-space airplane-time-flight">
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                                    <div class="p-1 bg-white border radius-sm border-secondary text-center overflow-hidden airplane-time-flight-item" data-value="1">
                                        <img src="{{ asset('frontend/img/flight-morning-icon.png') }}" class="img-fluid" width="20">
                                        <div class="font-title font-15pt">Sáng sớm</div>
                                        <div class="font-13pt">(00:00 - 04:59 sáng)</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                                    <div class="p-1 bg-white border radius-sm border-secondary text-center overflow-hidden airplane-time-flight-item" data-value="2">
                                        <img src="{{ asset('frontend/img/flight-morning-icon-2.png') }}" class="img-fluid" width="20">
                                        <div class="font-title font-15pt">Buổi sáng</div>
                                        <div class="font-13pt">(05:00 - 11:59 sáng)</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="p-1 bg-white border radius-sm border-secondary text-center overflow-hidden airplane-time-flight-item" data-value="3">
                                        <img src="{{ asset('frontend/img/flight-afternoon-icon.png') }}" class="img-fluid" width="20">
                                        <div class="font-title font-15pt">Buổi chiều</div>
                                        <div class="font-13pt">(12:00 - 17:59 sáng)</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="p-1 bg-white border radius-sm border-secondary text-center overflow-hidden airplane-time-flight-item" data-value="4">
                                        <img src="{{ asset('frontend/img/flight-night-icon.png') }}" class="img-fluid" width="20">
                                        <div class="font-title font-15pt">Buổi tối</div>
                                        <div class="font-13pt">(18:00 - 23:59 sáng)</div>
                                    </div>
                                </div>
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
    const load_data_flight = function(params) {
        $('.overlay-loader').show();
        $.ajax({
            url: '/load-data-one-way-flight',
            type: "GET",
            data: {
                orderBy: params['orderBy'],
                timer: params['timer'],
                airline_company: params['airline_company'],
                two_way_adt: params['two_way_adt'],
                way_chd: params['two_way_chd'],
                two_way_inf: params['two_way_inf'],
                begin_place_2_way: params['begin_place_2_way'],
                end_place_2_way: params['end_place_2_way'],
                way_start_date: params['two_way_start_date'],
                view_mode: params['view_mode']
            },
            success: function(response) {
                if (response.status != 1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.data,
                    });
                } else {
                    $('#data_flight').html(response.data);
                }
                $("html,body").scrollTop(200);
                $('.overlay-loader').hide();
            }
        });
    }
    $('.orderBy [value=0]').prop('checked', true);
    $('body').on('click', '.orderBy', function() {
        $('.orderBy').prop('checked', false);
        $(this).prop('checked', true);
        const orderBy = $(this).val();
        let timer = 0;
        $.each($('.airplane-time-flight-item'), function(value, key) {
            if ($(this).hasClass('active')) timer = $(this).data('value');
        })
        let view_mode = 0;
        $.each($('.view_mode'), function(value, key) {
            if ($(this).is(':checked')) {
                view_mode = $(this).val();
            }
        });
        let airline_company;
        $.each($('.airline_company'), function(value, key) {
            if ($(this).is(':checked')) {
                airline_company = $(this).val();
            } else {
                airline_company = 0;
            }
        })
        const two_way_adt = $('input[name=two_way_adt_hide]').val();
        const two_way_chd = $('input[name=two_way_chd_hide]').val();
        const two_way_inf = $('input[name=two_way_inf_hide]').val();
        const begin_place_2_way = $('input[name=begin_place_2_way_hide]').val();
        const end_place_2_way = $('input[name=end_place_2_way_hide]').val();
        const two_way_start_date = $('input[name=two_way_start_date_hide]').val();
        load_data_flight({
            orderBy: orderBy,
            timer: timer,
            airline_company: airline_company,
            two_way_adt: two_way_adt,
            two_way_chd: two_way_chd,
            two_way_inf: two_way_inf,
            begin_place_2_way: begin_place_2_way,
            end_place_2_way: end_place_2_way,
            two_way_start_date: two_way_start_date,
            view_mode: view_mode
        })
    });
    $('body').on('click', '.airplane-time-flight-item', function() {
        let orderBy;
        $.each($('.orderBy'), function(value, key) {
            if ($(this).is(':checked')) {
                orderBy = $(this).val();
            } else {
                orderBy = 0;
            }
        });
        let view_mode = 0;
        $.each($('.view_mode'), function(value, key) {
            if ($(this).is(':checked')) {
                view_mode = $(this).val();
            }
        });
        const timer = $(this).data('value');
        let airline_company;
        $.each($('.airline_company'), function(value, key) {
            if ($(this).is(':checked')) {
                airline_company = $(this).val();
            } else {
                airline_company = 0;
            }
        })
        const two_way_adt = $('input[name=two_way_adt_hide]').val();
        const two_way_chd = $('input[name=two_way_chd_hide]').val();
        const two_way_inf = $('input[name=two_way_inf_hide]').val();
        const begin_place_2_way = $('input[name=begin_place_2_way_hide]').val();
        const end_place_2_way = $('input[name=end_place_2_way_hide]').val();
        const two_way_start_date = $('input[name=two_way_start_date_hide]').val();
        $('#data_flight').html('');
        load_data_flight({
            orderBy: orderBy,
            timer: timer,
            airline_company: airline_company,
            two_way_adt: two_way_adt,
            two_way_chd: two_way_chd,
            two_way_inf: two_way_inf,
            begin_place_2_way: begin_place_2_way,
            end_place_2_way: end_place_2_way,
            two_way_start_date: two_way_start_date,
            view_mode: view_mode
        })
    });
    $('body').on('click', '.airline_company', function() {
        const orderBy = $('.orderBy:checked').val();
        let timer = 0;
        $.each($('.airplane-time-flight-item'), function(value, key) {
            if ($(this).hasClass('active')) timer = $(this).data('value');
        });
        let view_mode = 0;
        $.each($('.view_mode'), function(value, key) {
            if ($(this).is(':checked')) {
                view_mode = $(this).val();
            }
        });
        const airline_company = $(this).is(':checked') ? $(this).val() : 0;
        const two_way_adt = $('input[name=two_way_adt_hide]').val();
        const two_way_chd = $('input[name=two_way_chd_hide]').val();
        const two_way_inf = $('input[name=two_way_inf_hide]').val();
        const begin_place_2_way = $('input[name=begin_place_2_way_hide]').val();
        const end_place_2_way = $('input[name=end_place_2_way_hide]').val();
        const two_way_start_date = $('input[name=two_way_start_date_hide]').val();
        $('#data_flight').html('');
        load_data_flight({
            orderBy: orderBy,
            timer: timer,
            airline_company: airline_company,
            two_way_adt: two_way_adt,
            two_way_chd: two_way_chd,
            two_way_inf: two_way_inf,
            begin_place_2_way: begin_place_2_way,
            end_place_2_way: end_place_2_way,
            two_way_start_date: two_way_start_date,
            view_mode: view_mode
        })
    });
    $('body').on('click', '.change_day_flight', function() {
        const orderBy = $(this).val();
        let timer = 0;
        $.each($('.airplane-time-flight-item'), function(value, key) {
            if ($(this).hasClass('active')) timer = $(this).data('value');
        });
        let view_mode = 0;
        $.each($('.view_mode'), function(value, key) {
            if ($(this).is(':checked')) {
                view_mode = $(this).val();
            }
        });
        let airline_company;
        $.each($('.airline_company'), function(value, key) {
            if ($(this).is(':checked')) {
                airline_company = $(this).val();
            } else {
                airline_company = 0;
            }
        })
        const two_way_adt = $('input[name=two_way_adt_hide]').val();
        const two_way_chd = $('input[name=two_way_chd_hide]').val();
        const two_way_inf = $('input[name=two_way_inf_hide]').val();
        const begin_place_2_way = $('input[name=begin_place_2_way_hide]').val();
        const end_place_2_way = $('input[name=end_place_2_way_hide]').val();
        const two_way_start_date = $(this).data('value');
        load_data_flight({
            orderBy: orderBy,
            timer: timer,
            airline_company: airline_company,
            two_way_adt: two_way_adt,
            two_way_chd: two_way_chd,
            two_way_inf: two_way_inf,
            begin_place_2_way: begin_place_2_way,
            end_place_2_way: end_place_2_way,
            two_way_start_date: two_way_start_date,
            view_mode: view_mode
        })
    });
    $('body').on('click', '.view_mode', function() {
        const view_mode = $(this).val();
        let timer = 0;
        $.each($('.airplane-time-flight-item'), function(value, key) {
            if ($(this).hasClass('active')) timer = $(this).data('value');
        });
        let airline_company;
        $.each($('.airline_company'), function(value, key) {
            if ($(this).is(':checked')) {
                airline_company = $(this).val();
            } else {
                airline_company = 0;
            }
        });
        const orderBy = 0;
        const two_way_adt = $('input[name=two_way_adt_hide]').val();
        const two_way_chd = $('input[name=two_way_chd_hide]').val();
        const two_way_inf = $('input[name=two_way_inf_hide]').val();
        const begin_place_2_way = $('input[name=begin_place_2_way_hide]').val();
        const end_place_2_way = $('input[name=end_place_2_way_hide]').val();
        const two_way_start_date = $('input[name=two_way_start_date_hide]').val();
        load_data_flight({
            orderBy: orderBy,
            timer: timer,
            airline_company: airline_company,
            two_way_adt: two_way_adt,
            two_way_chd: two_way_chd,
            two_way_inf: two_way_inf,
            begin_place_2_way: begin_place_2_way,
            end_place_2_way: end_place_2_way,
            two_way_start_date: two_way_start_date,
            view_mode: view_mode
        })
    });
    $('body').on('click', '.check-air_plane', function() {
        const _this = $(this);
        // $('.show-detail-one').removeClass('show');
        // $('.show-detail-one').addClass('hide');
        // $('.check-air_plane').html('Chọn');
        // $('.check-air_plane').removeClass('is_check_air_flight');
        // _this.parent().parent().parent().next().removeClass('hide');
        // _this.parent().parent().parent().next().addClass('show');
        // _this.html('<i class="fas fa-check"></i>');
        // _this.addClass('is_check_air_flight');
        const session_one = _this.data('session');
        const flight_value_one = _this.data('value');
        const flight_id_one = _this.data('faredataid');
        const route = "{{ route('flight_one_booking') }}";

        window.location.href = route + '?form_session=' + session_one + '&form_value=' + flight_value_one + '&form_id=' + flight_id_one;
    });
</script>
@endsection