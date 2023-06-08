@extends('frontend.tour.index')
@section('tour-booking-content')
@php
$rateAvg = collect($tour->lstFeedback)->avg('starNum');
$rateLabel = App\Helpers\CommonFunctions::rateNumberToText($rateAvg);
$rateCount = count($tour->lstFeedback);
@endphp
<div class="rated-container smooth-transition position-fixed d-flex align-items-center">
    <div class="hotel-rated-close cursor-pointer bg-primary text-white border border-white border-right-0 align-self-start position-relative py-2 px-3">
        <i class="fal fa-times"></i>
    </div>
    <div class="hotel-booking-item bg-gray w-100 h-100 py-5 px-3">
        <div class="font-title-bold font-sm-title mb-2">Đánh giá</div>
        <div class="dropdown-divider mb-3"></div>
        <div>
            <div class="row no-gutters">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="bg-primary-gradient text-white font-20pt text-center d-flex align-items-center justify-content-center h-100 p-3">
                        <div>
                            <div class="font-title-bold">{{$rateAvg}} / 5</div>
                            <div class="font-title-bold my-2">{{$rateLabel}}</div>
                            <div class="font-15pt">{{$rateCount}} đánh giá</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="bg-white p-3">
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Tuyệt vời</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">9</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Rất tốt</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">1</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Bình thường</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">0</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Tạm được</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">0</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Không thích</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="font-title-bold font-20pt mb-2 mt-3">Đánh giá của bạn</div>
        <div class="row rated-emotion row-medium-space">
            <div class="col">
                <div data-rate-num="1" class="rated-emotion-item text-center font-14pt cursor-pointer">
                    <img src="{{ asset('frontend/img/rated-emo-sad.png') }}" class="img-fluid mb-2 mx-auto">
                    <img src="{{ asset('frontend/img/rated-emo-sad-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                    <div>Không thích</div>
                </div>
            </div>
            <div class="col">
                <div data-rate-num="2" class="rated-emotion-item text-center font-14pt cursor-pointer">
                    <img src="{{ asset('frontend/img/rated-emo-sceptic.png') }}" class="img-fluid mb-2 mx-auto">
                    <img src="{{ asset('frontend/img/rated-emo-sceptic-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                    <div>Tạm được</div>
                </div>
            </div>
            <div class="col">
                <div data-rate-num="3" class="rated-emotion-item text-center font-14pt cursor-pointer">
                    <img src="{{ asset('frontend/img/rated-emo-happy.png') }}" class="img-fluid mb-2 mx-auto">
                    <img src="{{ asset('frontend/img/rated-emo-happy-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                    <div>Bình thường</div>
                </div>
            </div>
            <div class="col">
                <div data-rate-num="4" class="rated-emotion-item text-center font-14pt cursor-pointer">
                    <img src="{{ asset('frontend/img/rated-emo-good.png') }}" class="img-fluid mb-2 mx-auto">
                    <img src="{{ asset('frontend/img/rated-emo-good-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                    <div>Rất tốt</div>
                </div>
            </div>
            <div class="col">
                <div data-rate-num="5" class="rated-emotion-item text-center font-14pt cursor-pointer active">
                    <img src="{{ asset('frontend/img/rated-emo-excellen.png') }}" class="img-fluid mb-2 mx-auto">
                    <img src="{{ asset('frontend/img/rated-emo-excellen-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                    <div>Tuyệt vời</div>
                </div>
            </div>
            <form id="form-rate" class="col-sm-12 col-md-12 col-lg-12 mt-3">
                <div class="form-group mb-5px">
                    <div class="form-group mb-0">
                        <label class="matter-textfield-filled d-block border-0">
                            <input name="name-rate" type="text" placeholder=" " required />
                            <span>Tên của bạn</span>
                        </label>
                    </div>
                </div>
                <div class="form-group mb-5px">
                    <div class="form-group mb-0">
                        <label class="matter-textfield-filled d-block border-0">
                            <input name="email-rate" type="Email" placeholder=" " required />
                            <span>Email</span>
                        </label>
                    </div>
                </div>
                <div class="form-group mb-5px">
                    <div class="form-group mb-0">
                        <label class="matter-textfield-filled d-block border-0">
                            <input name="phone-rate" type="tel" pattern="[0-9]{10}" placeholder=" " required />
                            <span>Số điện thoại</span>
                        </label>
                    </div>
                </div>
                <div class="form-group mb-5px">
                    <div class="form-group mb-0">
                        <label class="matter-textfield-filled d-block border-0">
                            <textarea name="content-rate" placeholder=" " rows="4" required></textarea>
                            <span>Nội dung đánh giá</span>
                        </label>
                    </div>
                </div>
                <input name="hotelId-rate" type="hidden" value="{{$tour->id}}" />
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary-gradient btn-create-rate font-title px-5">Gửi đánh giá</button>
                </div>
            </form>
        </div>
        <div class="font-title-bold font-20pt mb-2 mt-3">Đánh giá khách hàng</div>
        <div class="list-rated hotel-rated-list">
            @if ($tour->lstFeedback)
            @foreach ($tour->lstFeedback as $rated)
            <div class="rated-item bg-white px-3 py-2 mb-1 box-shadow">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">{{ $rated->fullName }}</span>
                            <span>{{ date('d/m/Y',strtotime($rated->feedbackDate)) }}</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="text-success mr-2">{{ App\Helpers\CommonFunctions::rateNumberToText($rated->starNum) }}</span>
                        <span class="font-title">{{ $rated->starNum }}/5</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">{{ $rated->content }}</p>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
<div class="rated-list-sidebar smooth-transition position-fixed d-flex align-items-center">
    <div class="hotel-rated-list-close cursor-pointer bg-primary text-white border border-white border-right-0 align-self-start position-relative py-2 px-3">
        <i class="fal fa-times"></i>
    </div>
    <div class="hotel-booking-item bg-gray w-100 h-100 py-5 px-3">
        <div class="font-title-bold font-sm-title mb-2">Đánh giá</div>
        <div class="dropdown-divider mb-3"></div>
        <div>
            <div class="row no-gutters">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="bg-primary-gradient text-white font-20pt text-center d-flex align-items-center justify-content-center h-100 p-3">
                        <div>
                            <div class="font-title-bold">{{$rateAvg}} / 5</div>
                            <div class="font-title-bold my-2">{{$rateLabel}}</div>
                            <div class="font-15pt">{{$rateCount}} đánh giá</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="bg-white p-3">
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Tuyệt vời</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">9</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Rất tốt</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">1</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Bình thường</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">0</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Tạm được</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">0</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Không thích</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <div class="font-title-bold font-20pt mb-2 mt-3">Đánh giá của bạn</div>
            <button class="btn p-0 border-0 bg-transparent text-primary edit-rated font-14pt">Chỉnh sửa đánh giá</button>
        </div>
        <div class="rated-item bg-white px-3 py-2 mb-1">
            <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                <div class="rated-item-user d-flex align-items-center">
                    <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
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
        <div class="font-title-bold font-20pt mb-2 mt-3">Đánh giá khách hàng</div>
        <div class="list-rated hotel-rated-list">
            @if ($tour->lstFeedback)
            @foreach ($tour->lstFeedback as $rated)
            <div class="rated-item bg-white px-3 py-2 mb-1 box-shadow">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">{{ $rated->fullName }}</span>
                            <span>{{ date('d/m/Y',strtotime($rated->feedbackDate)) }}</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="text-success mr-2">{{ App\Helpers\CommonFunctions::rateNumberToText($rated->starNum) }}</span>
                        <span class="font-title">{{ $rated->starNum }}/5</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">{{ $rated->content }}</p>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>

<div class="combo-booking-detail py-3">
    <div class="container">
        <div class="font-title font-md-title font-title-bold mb-2">{{ $tour->title }}</div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <!-- <div>
                    <span class="font-title">{{$rateAvg}} / 5</span>
                    <span class="ml-2">({{$rateCount}} đánh giá)</span>
                </div> -->
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 text-md-right text-lg-right text-xl-right">
                <div>
                    <span class="text-line-through text-muted font-14pt mr-3">{{ number_format($tour->tourPrices[0]->price, 0, ',', '.') }} VND</span>
                    <span class="text-success font-title-bold font-md-title">{{ number_format($tour->tourPrices[0]->price - ($tour->tourPrices[0]->price * $tour->tourPrices[0]->percentDiscount/100), 0, ',', '.') }} VND</span>
                </div>
            </div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="combo-detail-info-img">
            <div class="get-image d-none">
                @foreach ($tour->slides as $slide)
                <div class="combo-detail-image-item position-relative">
                    <a data-fancybox="combo-image-list" href="{{ $slide->imageUrl }}">
                        <img src="{{ $slide->imageUrl }}" class="img-fluid w-100 object-fit-cover">
                    </a>
                </div>
                @endforeach
            </div>
            <div class="row show-list-image row-small-space mt-3">
                <div class="col-sm-12 col-md-8 col-lg-9">
                    <div class="large-image"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="small-image h-100 d-flex flex-md-column justify-content-between"></div>
                </div>
            </div>
        </div>
        <div class="tour-route bg-white position-relative py-4 mt-4">
            <div class="tour-route-line mx-3"></div>
            <div class="tour-route-list d-flex align-items-center justify-content-between px-3 pb-2 box-shadow">
                <div class="tour-route-item font-title text-nowrap text-center">
                    <img src="{{ asset('frontend/img/map-place.svg') }}" class="img-fluid mb-2">
                    <div>ĐIỂM KHỞI HÀNH ({{ $tour->startPlace->name }})</div>
                </div>
                @foreach ($tour->tourPlace as $tourPlace)
                <div class="tour-route-item font-title text-nowrap text-center">
                    <img src="{{ asset('frontend/img/map-place.svg') }}" class="img-fluid mb-2">
                    <div>ĐIỂM ĐẾN ({{ $tourPlace->name }})</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="tab-content-item mb-4 mt-4">
                    <h5 class="font-sm-title font-title-bold mb-4">Tổng quan Tour</h5>
                    <div class="tour_description box-shadow">
                        <div class="bg-white p-3 mb-1">
                            {!! $tour->content !!}
                        </div>
                    </div>
                </div>
                <div class="tab-content-item mb-4">
                    <h5 class="font-sm-title font-title-bold mb-4">Lịch trình</h5>
                    @foreach ($tour->lstTourSchedule as $lstTourSchedule)
                    <div class="schedule-item mb-5px box-shadow">
                        <div class="schedule-item-header text-white bg-primary-gradient d-flex align-items-center justify-content-between p-3" data-toggle="collapse" data-target="#schedule-item-{{$lstTourSchedule->id}}">
                            <div>
                                <span class="text-nowrap mr-4">Ngày {{ $lstTourSchedule->dayNo }} :
                                    <span class="text-uppercase">{{ $lstTourSchedule->title }}</span>
                            </div>
                            <i class="far fa-chevron-down smooth-transition"></i>
                        </div>
                        <div id="schedule-item-{{$lstTourSchedule->id}}" class="schedule-item-body bg-white collapse show">
                            <div class="p-3">
                                {!! $lstTourSchedule->content !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- <div class="tab-content-item mb-4">
                    <h5 class="font-sm-title font-title-bold mb-4">Bảng giá</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr>
                                    <th class="text-nowrap font-title">Điểm khởi hành</th>
                                    <th class="text-nowrap font-title">Ngày khởi hành</th>
                                    <th class="text-nowrap font-title">Ngày kết thúc</th>
                                    <th class="text-nowrap font-title">Bảng giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tour->tourPrices as $tourPrices)
                                <tr>
                                    <td class="text-nowrap">Hà nội</td>
                                    <td class="text-nowrap">{{ $tourPrices->startDate }}</td>
                                    <td class="text-nowrap">{{ $tourPrices->endDate }}</td>
                                    <td class="font-title text-success text-nowrap">{{ number_format($tourPrices->price, 0, ',', '.') }} VND</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right" colspan="3">Tổng giá</td>
                                    <td class="font-title text-success text-nowrap">3.000.000 VNĐ</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div> -->
                <!-- <div class="tab-content-item mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="font-sm-title font-title-bold mb-0">Đánh giá</h5>
                        <button class="btn bg-transparent p-0 border-0 text-primary view-rated-sidebar">Xem thêm</button>
                    </div>
                    <div class="d-flex align-items-center justify-content-between bg-white p-3">
                        <div><span class="font-title-bold mr-3">{{$rateAvg}} / 5</span><span class="text-success">{{$rateLabel}}</span></div>
                        <div>{{$rateCount}} đánh giá</div>
                    </div>
                    <div class="text-right"><button class="btn btn-primary-gradient write-rated-comment px-5 mt-3 mb-2">Viết đánh giá</button></div>
                    <div class="list-rated combo-rated">
                        @if ($tour->lstFeedback)
                        @foreach ($tour->lstFeedback as $rated)
                        <div class="rated-item bg-white px-3 py-2 mb-1 box-shadow">
                            <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                <div class="rated-item-user d-flex align-items-center">
                                    <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                    <div class="rated-item-user-info">
                                        <span class="font-title text-capitalize">{{ $rated->fullName }}</span>
                                        <span>{{ date('d/m/Y',strtotime($rated->feedbackDate)) }}</span>
                                    </div>
                                </div>
                                <div class="rated-item-info font-18pt">
                                    <span class="text-success mr-2">{{ App\Helpers\CommonFunctions::rateNumberToText($rated->starNum) }}</span>
                                    <span class="font-title">{{ $rated->starNum }}/5</span>
                                </div>
                            </div>
                            <p class="mb-1 mt-2">{{ $rated->content }}</p>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div> -->
                <!-- <div class="tab-content-item mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="font-sm-title font-title-bold mb-0">Hỏi đáp</h5>
                        <button class="btn bg-transparent p-0 border-0 text-primary view-quesion-answer-sidebar">Xem thêm</button>
                    </div>
                    <div class="question-answer-item bg-white">
                        <div class="question-item border-bottom p-3">
                            <div class="rated-item-user d-flex align-items-center">
                                <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
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
                                <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
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
                    <div class="text-right"><button class="btn btn-primary-gradient add-question px-5 mt-3 mb-2">Đặt câu hỏi</button></div>
                </div> -->
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3">
                <h5 class="font-sm-title font-title-bold my-4 visible-hidden">Tổng quan Tour</h5>
                <div class="card combo-booking-detail-info border-0 m-0 mt-4 box-shadow">
                    <div class="card-header font-17pt bg-white font-title text-center p-3">Thông tin tour</div>
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-title">Độ dài tour</span>
                            <span>{{ $tour->dayNum }} ngày {{ $tour->nightNum }} đêm</span>
                        </div>
                        <div class="mb-2">
                            <div class="font-title">Chuyến đi bao gồm</div>
                            @if ($tour->lstIncluded)
                            @foreach ($tour->lstIncluded as $lstIncluded)
                            <p class="mb-0">✔ {{ $lstIncluded->name }}</p>
                            @endforeach
                            @endif
                        </div>
                        <div class="mb-2">
                            <div class="font-title">Chuyến đi không bao gồm</div>
                            @if ($tour->lstNotIncluded)
                            @foreach ($tour->lstNotIncluded as $lstNotIncluded)
                            <p class="mb-0">✖ {{ $lstNotIncluded->name }}</p>
                            @endforeach
                            @endif
                        </div>
                        <a href="{{ route('tour_booking', $tour->link) }}" class="btn btn-primary-gradient btn-block font-title mt-3">Đặt tour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('scripts')

    <script>
        $('input[name=hotel_adultNum]').val(parseInt(sessionStorage.getItem("hotel_adultNum")));
        $('input[name=hotel_childNum]').val(parseInt(sessionStorage.getItem("hotel_childNum")));
        $('input[name=hotel_childNum2]').val(parseInt(sessionStorage.getItem("hotel_childNum2")));
        $('input[name=hotel_single_room]').val(parseInt(sessionStorage.getItem("hotel_single_room")));
        $('input[name=hotel_double_room]').val(parseInt(sessionStorage.getItem("hotel_double_room")));
        $('.date-range-booking-start').val(sessionStorage.getItem("start_date_hotel"));
        $('.date-range-booking-end').val(sessionStorage.getItem("end_date_hotel"));
        $('.view-hotel-room-info').on('click', function() {
            const id_room = $(this).data('id-room');
            $.ajax({
                url: '/load-data-room-in-hotel' + '/' + id_room,
                type: "GET",
                success: function(response) {
                    $('#info_room').html(response.data);
                }
            });
        });
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