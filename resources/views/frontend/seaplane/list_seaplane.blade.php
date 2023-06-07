@extends('frontend.layouts.layout')
@section('body')
<section class="seaplane-booking-list">
    <div class="seaplane-booking-info bg-white py-3">
        <div class="container">
            <form action="{{ route('post_search_seaplane') }}" method="POST">
                {{ csrf_field() }}
                <div class="row row-medium-space">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="dropdown dropdownPersonRoom d-inline-block ml-auto mb-3">
                            <button class="btn bg-transparent p-0 border-0 no-active-focus text-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="total-person"></span> Hành khách <i class="fal fa-chevron-down text-success ml-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                    <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                        <input type="number" min="0" name="seaplane_adultNum" value="{{$info['seaplane_adultNum']}}" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                    </span>
                                </div>
                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                    <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                        <input type="number" min="0" name="seaplane_childNum" value="{{$info['seaplane_childNum']}}" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                    </span>
                                </div>
                                <div class="dropdown-item border-0 px-3 d-flex justify-content-between bg-white">
                                    <span class="dropdown-select-text text-nowrap">Trẻ em (dưới 2 tuổi)</span>
                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                        <input type="number" min="0" name="seaplane_childNum2" value="{{$info['seaplane_childNum2']}}" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                    </span>
                                </div>
                                <div class="dropdown-select-footer font-title text-primary font-17pt py-2 px-3 border-top">
                                    <button class="btn btn-primary-gradient font-title btn-block px-3 py-12px">Đồng ý</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
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
                                            <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="startPlace">
                                                @if ($list_place_seaplane)
                                                @foreach ($list_place_seaplane as $seaplane)
                                                <option value="{{ $seaplane->id }}" @if ($seaplane->id == $info['startPlace']) selected @endif>{{ $seaplane->name }}</option>
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
                                            <select class="selectpicker form-control h-auto py-12px bg-white" data-live-search="true" name="endPlace">
                                                @if ($list_place_seaplane)
                                                @foreach ($list_place_seaplane as $seaplane)
                                                <option value="{{ $seaplane->id }}" @if ($seaplane->id == $info['endPlace']) selected @endif>{{ $seaplane->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="row row-medium-space airplane-select-datetime">
                            <div class="col-sm-12 col-md-12 col-lg-6 mb-xs-3 mb-sm-3">
                                <div class="form-group mb-0">
                                    <div class="input-group float-label-input">
                                        <div class="input-group-prepend m-0">
                                            <span class="input-group-text bg-transparent pr-0 border-right-0">
                                                <i class="far fa-calendar text-primary"></i>
                                            </span>
                                        </div>
                                        <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                            <input type="text" placeholder=" " class="text-primary date-picker-tour" name="startDate" value="{{ $info['startDate'] }}">
                                            <span>Ngày đi</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <button class="btn btn-primary-gradient font-title btn-block py-12px">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="seaplane-booking-detail py-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-9 combo-booking-detail-left">
                    <div class="place-search">
                        <div class="place-search-container d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                            <div class="font-title font-20pt font-title-bold d-flex align-items-center justify-content-xs-between justify-content-sm-between justify-content-md-start justify-content-lg-start justify-content-xl-start">
                                <div>{{ $place[0]->name }}</div>
                                <div><img src="{{ asset('frontend/img/seaplane-black.svg') }}" class="img-fluid mx-4" width="18"></div>
                                <div>{{ $place[1]->name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider mt-3 mb-2"></div>
                    <div class="search-result d-sm-flex d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between py-3">
                        <div>{{count($list_seaplane)}} Kết quả tìm kiếm</div>
                        <div>Giá cơ bản cho một người lớn</div>
                    </div>
                    <div class="card border-0 seaplane-list">
                        <div class="card-header text-center bg-primary-medium text-white px-3 py-2">
                            <div class="text-center text-white">
                                <span class="font-18pt text-uppercase font-title">{{ $place[0]->name }}</span>
                                <img src="{{ asset('frontend/img/seaplane-white.svg') }}" width="20" class="img-fluid mt-n1 mx-3">
                                <span class="font-18pt text-uppercase font-title">{{ $place[1]->name }}</span>
                                <div class="mt-1">{{ $data['startDateString'] }}</div>
                            </div>
                            <!-- <div>Thứ 5 ngày 21/01/2021, tức 25/11 âm lịch</div> -->
                        </div>
                        <div class="card-body border p-0">
                            <nav class="border-top">
                                <div class="nav nav-tabs seaplane-nav-tab" role="tablist">
                                    @foreach ($list_days as $day)
                                    <a class="nav-link text-center border-0 rounded-0 font-15pt px-2 py-1 @if ($day['status'] == 1) active @endif searchDate" data-date="{{ $day['full_day'] }}" data-toggle="tab" href="#seaplane-nav-1" role="tab">
                                        <div>{{ $day['stuff'] }}</div>
                                        <div>Ngày {{ $day['day'] }}</div>
                                    </a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                                    <table class="seaplane-table-list table mb-0">
                                        <tbody>
                                            @if (count($list_seaplane) > 0)
                                            @foreach ($list_seaplane as $index => $seaplane)
                                            <tr class="font-17pt seaplane-item-booking" index="{{$index}}">
                                                <td class="p-0 align-middle w-15">
                                                    <img src="{{ asset('frontend/img/seaplane-logo-demo.png') }}" class="img-fluid h-auto">
                                                </td>
                                                <td class="text-center align-middle p-0 w-15">{{ $seaplane->code }}</td>
                                                <td class="start-date font-title-bold text-center align-middle text-primary p-0 w-40 text-nowrap" start-date-value="{{Carbon\Carbon::parse($seaplane->startTime)->timestamp}}">{{ $seaplane->startTime }} - {{ $seaplane->endTime }}</td>
                                                <td class="seaplane_price font-title-bold text-center align-middle text-danger p-0 w-15 text-nowrap" data-seaplane-price="{{$seaplane->fareAdt}}">{{ number_format($seaplane->fareAdt, 0, ',', '.') }} đ</td>
                                                <td class="text-right align-middle py-0 px-1 w-15">
                                                    <a href="{{ route('book_seaplane', ['slug' => $seaplane->id]) }}" class="btn btn-primary-gradient">Chọn</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr class="font-17pt seaplane-item-booking">
                                                <td class="p-0 align-middle w-15" style="text-align: center;">
                                                    <img src="{{ asset('images/boat.svg') }}" alt="" sizes="" class="mt-15px">
                                                    <h5> Không có dữ liệu</h5>
                                                </td>

                                            </tr>
                                            @endif

                                        </tbody>
                                    </table>
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
                                        <input class="orderBy" value="0" type="checkbox" checked>
                                        <span>Halobay đề xuất</span>
                                    </label>
                                </div>
                                <div class="matter-checkbox-item">
                                    <label class="matter-checkbox">
                                        <input class="orderBy" value="1" type="checkbox">
                                        <span>Giá từ cao đến thấp</span>
                                    </label>
                                </div>
                                <div class="matter-checkbox-item">
                                    <label class="matter-checkbox">
                                        <input class="orderBy" value="2" type="checkbox">
                                        <span>Giá từ thấp đến cao</span>
                                    </label>
                                </div>
                                <div class="matter-checkbox-item">
                                    <label class="matter-checkbox">
                                        <input class="orderBy" value="3" type="checkbox">
                                        <span>Thời gian khởi hành</span>
                                    </label>
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
    $(document).ready(function() {
        const load_data_seaplane = function(data) {
            // console.log(data)
            $('.overlay-loader').show();
            $.ajax({
                url: '/load-data-seaplane',
                type: "GET",
                data: data,
                success: function(response) {
                    $('#nav-home').html(response.data);
                    $("html,body").scrollTop(200);
                    $('.overlay-loader').hide();
                }
            });
        }

        // sort seaplane by price
        $('body').on('click', '.orderBy', function() {
            $('.orderBy').prop('checked', false);
            $(this).prop('checked', true);
            const orderBy = parseInt($(this).val());

            // Lấy danh sách các chuyến bay
            const listFlight = $('.seaplane-table-list tbody');

            // Sap xep danh sach
            if (orderBy === 0) {
                // Sắp xếp danh sách theo mặc định
                listFlight.children('.seaplane-item-booking').sort(function(a, b) {
                    var indexA = $(a).attr('index');
                    var indexB = $(b).attr('index');
                    return indexA - indexB;
                }).appendTo(listFlight);
            } else if (orderBy === 1) {
                // Sắp xếp danh sách theo giá vé giảm dần
                listFlight.children('.seaplane-item-booking').sort(function(a, b) {
                    var priceA = parseInt($(a).find('.seaplane_price').data('seaplane-price'));
                    var priceB = parseInt($(b).find('.seaplane_price').data('seaplane-price'));
                    return priceB - priceA;
                }).appendTo(listFlight);
            } else if (orderBy === 2) {
                // Sắp xếp danh sách theo giá vé tăng dần
                listFlight.children('.seaplane-item-booking').sort(function(a, b) {
                    var priceA = parseInt($(a).find('.seaplane_price').data('seaplane-price'));
                    var priceB = parseInt($(b).find('.seaplane_price').data('seaplane-price'));
                    return priceA - priceB;
                }).appendTo(listFlight);
            } else if (orderBy === 3) {
                // Sắp xếp danh sách theo thời gian khởi hành
                listFlight.children('.seaplane-item-booking').sort(function(a, b) {
                    var timeA = parseInt($(a).find('.start-date').attr('start-date-value'));
                    var timeB = parseInt($(b).find('.start-date').attr('start-date-value'));
                    return timeA - timeB;
                }).appendTo(listFlight);
            }
        });

        // search seaplane by date
        $('body').on('click', '.searchDate', function() {
            const seaplane_adultNum = $('input[name="seaplane_adultNum"]').val();
            const seaplane_childNum = $('input[name="seaplane_childNum"]').val();
            const seaplane_childNum2 = $('input[name="seaplane_childNum2"]').val();
            const startPlace = $('select[name="startPlace"] option:selected').val();
            const endPlace = $('select[name="endPlace"] option:selected').val();
            const startDate = $(this).data('date');
            $('input[name="startDate"]').val(startDate);

            data = {
                seaplane_adultNum,
                seaplane_childNum,
                seaplane_childNum2,
                startPlace,
                endPlace,
                startDate,
            }

            load_data_seaplane(data)
        });
    });
</script>
@endsection