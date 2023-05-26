@extends('frontend.combo.index')
@section('combo-booking-content')
<div class="combo-booking-detail container py-3">
    <div class="font-title font-md-title font-title-bold mb-2">{{ $combo->title }}</div>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div><span class="font-title">{{ $combo->rateAverage }} / 5</span> ({{ $combo->rateCount }} đánh giá)</div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 text-md-right text-lg-right text-xl-right">
            <div>
                <span class="text-line-through text-muted font-14pt mr-3">{{ number_format($combo->price, 0, ',', '.') }} VND</span>
                <span class="text-success font-title-bold font-md-title">{{ number_format($combo->priceDisplay, 0, ',', '.') }} VND</span>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="combo-detail-info-img">
        <div class="get-image d-none">
            @if ($combo->comboImages)
            @foreach ($combo->comboImages as $image)
            <div class="combo-detail-image-item position-relative">
                <a data-fancybox="combo-image-list" href="{{ asset($image->imageUrl) }}">
                    <img src="{{ asset($image->imageUrl) }}" class="img-fluid w-100 object-fit-cover">
                </a>
            </div>
            @endforeach
            @endif
        </div>
        <div class="row show-list-image row-small-space mt-3">
            <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="large-image"></div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="small-image h-100 d-flex flex-column justify-content-between"></div>
            </div>
        </div>
    </div>
    <div class="row row-small-space mt-3">
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="combo-detail-info-tab nav-tab-sticky-parent ">
                <nav class="nav-tab-sticky bg-gray">
                    <div class="nav nav-tabs nav-tab-scroll custom-nav-tab combo-detail-nav-tab border-0 position-relative">
                        <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent py-3 active" href="#combo-detail-tab-overview" role="tab">Tổng quan</a>
                        <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent py-3" href="#combo-detail-tab-schedule" role="tab">Lịch trình</a>
                        <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent py-3" href="#combo-detail-tab-price" role="tab">Bảng giá</a>
                        <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent py-3" href="#combo-detail-tab-rated" role="tab">Đánh giá</a>
                        <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent py-3" href="#combo-detail-tab-qa" role="tab">Hỏi dáp</a>
                    </div>
                </nav>
                <div class="combo-detail-tab-content">
                    <div class="py-3" id="combo-detail-tab-overview">
                        <div class="tab-content-item mb-4">
                            <h5 class="font-sm-title font-title-bold mb-4">Tổng quan Combo</h5>
                            <div class="bg-white p-3 mb-1 box-shadow">
                                {!! $combo->content !!}
                            </div>
                            <div class="bg-white p-3 mb-1 box-shadow">
                                {!! $combo->highlight !!}
                            </div>
                        </div>
                    </div>
                    <div class="pb-3" id="combo-detail-tab-schedule">
                        <div class="tab-content-item mb-4">
                            <h5 class="font-sm-title font-title-bold mb-4">Lịch trình</h5>
                            @foreach ($combo->comboSchedules as $comboSchedules)
                            <div class="schedule-item mb-5px box-shadow">
                                <div class="schedule-item-header text-white bg-primary-gradient d-flex align-items-center justify-content-between p-3" data-toggle="collapse" data-target="#schedule-item-{{$comboSchedules->id}}">
                                    <div>
                                        <span class="text-nowrap mr-4">Ngày {{ $comboSchedules->dayNo }} :
                                            <span class="text-uppercase">{{ $comboSchedules->title }}</span>
                                    </div>
                                    <i class="far fa-chevron-down smooth-transition"></i>
                                </div>
                                <div id="schedule-item-{{$comboSchedules->id}}" class="schedule-item-body bg-white collapse show">
                                    <div class="p-3">
                                        {!! $comboSchedules->content !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="pb-3" id="combo-detail-tab-price">
                        <div class="tab-content-item mb-4">
                            <h5 class="font-sm-title font-title-bold mb-4">Bảng giá</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap font-title">Điểm khởi hành</th>
                                            <th class="text-nowrap font-title">Ngày khởi hành</th>
                                            <th class="text-nowrap font-title">Bảng giá</th>
                                            <th class="text-nowrap font-title"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($combo->comboPrice as $comboPrice)
                                        <tr>
                                            <td class="text-nowrap">{{ $comboPrice->departurePlace }}</td>
                                            <td class="text-nowrap">{{ $comboPrice->startDate }} - {{ $comboPrice->endDate }} ({{ $comboPrice->noted }})</td>
                                            <td class="font-title text-success text-nowrap">{{ $comboPrice->priceDisplay != null ? number_format($comboPrice->priceDisplay, 0, ',', '.') : number_format($comboPrice->price, 0, ',', '.') }} VND</td>
                                            <td class="text-nowrap"> <a href="{{ route('book_combo', ['slug' => $combo->link]) }}" class="btn btn-primary-gradient btn-block">Đặt ngay</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="pb-3" id="combo-detail-tab-rated">
                        <div class="tab-content-item mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="font-sm-title font-title-bold mb-0">Đánh giá</h5>
                                <a href="#" class="text-primary">Xem thêm</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between bg-white p-3">
                                <div><span class="font-title-bold mr-3">4.4 / 5</span><span class="text-success">Rất tốt</span></div>
                                <div>10 đánh giá</div>
                            </div>
                            <div class="text-right"><button class="btn btn-primary-gradient px-5 mt-3 mb-2">Viết đánh giá</button></div>
                            <div class="list-rated combo-rated">
                                <div class="rated-item bg-white px-3 py-2 mb-1">
                                    <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                        <div class="rated-item-user d-flex align-items-center">
                                            <img src="img/avatar-demo.jpg" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                            <div class="rated-item-user-info">
                                                <span class="font-title text-capitalize">huyen truong</span>
                                                <span>12/01/2021</span>
                                            </div>
                                        </div>
                                        <div class="rated-item-info font-18pt">
                                            <span class="font-title mr-2">4.4/5</span>
                                            <span class="text-success">Rất tốt</span>
                                        </div>
                                    </div>
                                    <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
                                </div>
                                <div class="rated-item bg-white px-3 py-2 mb-1">
                                    <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                        <div class="rated-item-user d-flex align-items-center">
                                            <img src="img/avatar-demo.jpg" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                            <div class="rated-item-user-info">
                                                <span class="font-title text-capitalize">huyen truong</span>
                                                <span>12/01/2021</span>
                                            </div>
                                        </div>
                                        <div class="rated-item-info font-18pt">
                                            <span class="font-title mr-2">4.4/5</span>
                                            <span class="text-success">Rất tốt</span>
                                        </div>
                                    </div>
                                    <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
                                </div>
                                <div class="rated-item bg-white px-3 py-2 mb-1">
                                    <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                        <div class="rated-item-user d-flex align-items-center">
                                            <img src="img/avatar-demo.jpg" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                            <div class="rated-item-user-info">
                                                <span class="font-title text-capitalize">huyen truong</span>
                                                <span>12/01/2021</span>
                                            </div>
                                        </div>
                                        <div class="rated-item-info font-18pt">
                                            <span class="font-title mr-2">4.4/5</span>
                                            <span class="text-success">Rất tốt</span>
                                        </div>
                                    </div>
                                    <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
                                </div>
                                <div class="rated-item bg-white px-3 py-2 mb-1">
                                    <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                        <div class="rated-item-user d-flex align-items-center">
                                            <img src="img/avatar-demo.jpg" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                            <div class="rated-item-user-info">
                                                <span class="font-title text-capitalize">huyen truong</span>
                                                <span>12/01/2021</span>
                                            </div>
                                        </div>
                                        <div class="rated-item-info font-18pt">
                                            <span class="font-title mr-2">4.4/5</span>
                                            <span class="text-success">Rất tốt</span>
                                        </div>
                                    </div>
                                    <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
                                </div>
                                <div class="rated-item bg-white px-3 py-2 mb-1">
                                    <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                        <div class="rated-item-user d-flex align-items-center">
                                            <img src="img/avatar-demo.jpg" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                            <div class="rated-item-user-info">
                                                <span class="font-title text-capitalize">huyen truong</span>
                                                <span>12/01/2021</span>
                                            </div>
                                        </div>
                                        <div class="rated-item-info font-18pt">
                                            <span class="font-title mr-2">4.4/5</span>
                                            <span class="text-success">Rất tốt</span>
                                        </div>
                                    </div>
                                    <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-3" id="combo-detail-tab-qa">
                        <div class="tab-content-item mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="font-sm-title font-title-bold mb-0">Hỏi đáp</h5>
                                <a href="#" class="text-primary">Xem thêm</a>
                            </div>
                            <div class="question-answer-item bg-white">
                                <div class="question-item border-bottom p-3">
                                    <div class="rated-item-user d-flex align-items-center">
                                        <img src="img/avatar-demo.jpg" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                        <div class="rated-item-user-info">
                                            <span class="font-title text-capitalize">huyen truong</span>
                                            <span>12/01/2021</span>
                                        </div>
                                    </div>
                                    <div class="question-item-content">
                                        <p class="mb-0 mt-2">Cho em hỏi thuê xe máy luôn của khách sạn thì thủ tục thế nào ạ ?</p>
                                    </div>
                                </div>
                                <div class="answer-item border-bottom p-3">
                                    Cảm ơn bạn đã gửi câu hỏi cho chúng tôi, chúng tôi trả lời như sau: Hiện khách sạn không có xe máy cho thuê, nếu bạn cần thuê xe. Chúng tôi sẽ hỗ trợ thuê cho bạn mà không cần thủ tục gì. Thân ái...
                                </div>
                            </div>
                            <div class="question-answer-item bg-white">
                                <div class="question-item border-bottom p-3">
                                    <div class="rated-item-user d-flex align-items-center">
                                        <img src="img/avatar-demo.jpg" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                        <div class="rated-item-user-info">
                                            <span class="font-title text-capitalize">huyen truong</span>
                                            <span>12/01/2021</span>
                                        </div>
                                    </div>
                                    <div class="question-item-content">
                                        <p class="mb-0 mt-2">Cho em hỏi thuê xe máy luôn của khách sạn thì thủ tục thế nào ạ ?</p>
                                    </div>
                                </div>
                                <div class="answer-item border-bottom p-3">
                                    Cảm ơn bạn đã gửi câu hỏi cho chúng tôi, chúng tôi trả lời như sau: Hiện khách sạn không có xe máy cho thuê, nếu bạn cần thuê xe. Chúng tôi sẽ hỗ trợ thuê cho bạn mà không cần thủ tục gì. Thân ái...
                                </div>
                            </div>
                            <div class="text-right"><button class="btn btn-primary-gradient px-5 mt-3 mb-2">Đặt câu hỏi</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 benefit-hotel-info d-xs-none d-sm-none d-md-block d-lg-block d-xl-block sidebar-sticky-parent">
            <div class="card combo-booking-detail-info border-0 m-0 shadow-none sidebar-sticky">
                <div class="card-header font-17pt bg-white font-title text-center p-3">Thông tin combo</div>
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between">
                        <div class="font-title">Khởi hành</div>
                        <div>{{ $combo->comboPrice[0]->departurePlace }}</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="font-title">Điểm đến</div>
                        <div>Cát Bà</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="font-title">Thời gian</div>
                        <div class="text-right">{{$combo->dayNum}} ngày, {{$combo->nightNum}} đêm</div>
                    </div>
                </div>
                <div class="card-footer bg-white p-3">
                    <div class="font-title">Combo bao gồm:</div>
                    @foreach ($combo->comboIncludes as $comboIncludes)
                    <div>✔ {{ $comboIncludes->name }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('frontend/sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('frontend/sweetalert2/sweetalert2.min.css') }}">
<script>
    $('input[name=hotel_adultNum]').val(parseInt(sessionStorage.getItem("hotel_adultNum")));
    $('input[name=hotel_childNum]').val(parseInt(sessionStorage.getItem("hotel_childNum")));
    $('input[name=hotel_childNum2]').val(parseInt(sessionStorage.getItem("hotel_childNum2")));
    $('input[name=hotel_single_room]').val(parseInt(sessionStorage.getItem("hotel_single_room")));
    $('input[name=hotel_double_room]').val(parseInt(sessionStorage.getItem("hotel_double_room")));
    $('.date-range-booking-start').val(sessionStorage.getItem("start_date_hotel"));
    $('.date-range-booking-end').val(sessionStorage.getItem("end_date_hotel"));

    $('body').on('click', '.book_room_hotel', function() {
        const array_room = [];
        const array_number = [];
        const url = $(this).data('url');
        const start_date_hotel = sessionStorage.getItem("start_date_hotel");
        const end_date_hotel = sessionStorage.getItem("end_date_hotel");
        const number_hotel_adultNum = parseInt($('input[name=hotel_adultNum]').val());
        const hotel_childNum = parseInt($('input[name=hotel_childNum]').val());
        const hotel_childNum2 = parseInt($('input[name=hotel_childNum2]').val());
        $('.room_hotel').each(function() {
            const room_id = $(this).data('id-room');
            const active = parseInt($(this).find('select option:selected').val());
            if (active != '' || active != 0) {
                array_room.push(room_id);
                array_number.push(active);
            }
        });
        if (array_number.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Bạn chưa chọn phòng",
            });
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'post_book_room',
            type: "POST",
            data: {
                array_room: array_room,
                array_number: array_number,
                url: url,
                start_date_hotel: start_date_hotel,
                end_date_hotel: end_date_hotel,
                number_hotel_adultNum: number_hotel_adultNum,
                hotel_childNum: hotel_childNum,
                hotel_childNum2: hotel_childNum2
            },
            success: function(response) {
                window.location.href = "book-room-hotel";
            }
        });
    });
</script>
@endsection