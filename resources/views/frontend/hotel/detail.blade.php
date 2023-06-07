@extends('frontend.hotel.index')
@section('hotel-booking-content')
@include('components.rate.RateContainer', ['rateData' => $rateData, 'user' => $user ?: null])
@include('components.rate.RatedListSidebar', ['rateData' => $rateData, 'user' => $user ?: null])
<!-- @include('components.questionAnswer.QuestionAnswer', ['qaData' => $qaData, 'user' => $user ?: null]) -->
<div class="room-detail-sidebar smooth-transition position-fixed d-flex align-items-center">
    <div class="room-detail-sidebar-close cursor-pointer bg-primary text-white border border-white border-right-0 align-self-start position-relative py-2 px-3">
        <i class="fal fa-times"></i>
    </div>
    <div id="info_room" class="hotel-booking-item bg-gray w-100 h-100 py-5 px-3"></div>
</div>

<div class="hotel-booking-detail container py-3">
    @if(Session::has('token'))
    <input type="hidden" name="userToken" value="1">
    @endif
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <div class="font-title font-md-title font-title-bold mb-2">{{ $hotel->name }}</div>
        <div class="star-rating text-nowrap w-xs-100">
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="h-100 d-flex align-items-center"><span class="font-title">{{ $rateData['rateAverage'] }} / 5</span><span class="ml-2">({{ $rateData['rateCount'] }} đánh giá)</span></div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 text-md-right text-lg-right text-xl-right">
            <div>
                <span class="text-line-through text-muted font-14pt mr-3">{{ number_format($hotel->price, 0, ',', '.') }} VND</span>
                <span class="text-success font-title-bold font-md-title">{{ number_format($hotel->priceDiscount, 0, ',', '.') }} VND</span>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="combo-detail-info-img">
        <div class="get-image d-none">
            @if ($hotel->lstImage)
            @foreach ($hotel->lstImage as $image)
            <div class="combo-detail-image-item position-relative">
                <a data-fancybox="combo-image-list" href="{{ $image->imageUrl }}">
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
                <div class="small-image h-100 d-flex flex-md-column justify-content-between"></div>
            </div>
        </div>
    </div>
    <div class="row row-small-space mt-3">
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="combo-detail-info-tab nav-tab-sticky-parent">
                <nav class="nav-tab-sticky bg-gray">
                    <div class="nav nav-tabs nav-tab-scroll custom-nav-tab hotel-detail-nav border-0 position-relative flex-nowrap">
                        <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent text-nowrap py-3 active" href="#hotel-tab-room">Giới thiệu</a>
                        <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent text-nowrap py-3" href="#hotel-tab-room-class">Hạng phòng</a>
                        <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent text-nowrap py-3" href="#hotel-tab-info">Thông tin</a>
                        <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent text-nowrap py-3" href="#hotel-tab-rated">Đánh giá</a>
                        <!-- <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent text-nowrap py-3" href="#hotel-tab-qa">Hỏi dáp</a> -->
                    </div>
                </nav>
                <div class="combo-detail-tab-content">
                    <div class="hotelDescription mt-4 pb-3 mb-4" id="hotel-tab-room">
                        <!-- Button trigger modal -->
                        <a href="#" data-toggle="modal" data-target="#exampleModal">
                            <span style="font-weight: 600; color: #2c3d84">{!! $hotel->address !!}</span> - <span style="color: #488bf8;">XEM BẢN ĐỒ</span>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 65%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Khách sạn {{ $hotel->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! $hotel->map !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="solid">
                        {!! $hotel->description !!}
                    </div>
                    <div class="hotel-benefit-mobile d-xs-block d-sm-block d-md-none d-lg-none d-xl-none"></div>

                    <div class="pb-3" id="hotel-tab-room-class">
                        <div class="tab-content-item mb-4">
                            <div class="d-flex align-items-center justify-content-between flex-wrap mb-4">
                                <h5 class="font-sm-title font-title-bold mb-0">Hạng phòng</h5>
                                <!-- <a class="btn btn-primary-gradient font-title hotel-booking-detail-btn mt-xs-3 mt-md-0 mt-lg-0 w-xs-100 px-5 book_room_hotel" data-url="{{ $hotel->url }}" href="#">Đặt phòng</a> -->
                                <button class="book_room_hotel btn btn-primary-gradient px-5 mt-3 mb-2" data-url="{{ $hotel->url }}">Đặt phòng</button>
                            </div>
                            <div class="room-class-list">
                                @if ($hotel->lstRoom)
                                @foreach ($hotel->lstRoom as $lstRoom)
                                <div class="room_hotel mb-2 box-shadow" data-id-room="{{ $lstRoom->id }}">
                                    <div class="row no-gutters">
                                        <div class="col-sm-12 col-md-12 col-lg-4 pl-0">
                                            <div class="room-class-img h-100 bg-white">
                                                <img src="{{ $lstRoom->imageUrl ?: asset(\Config::get('constants.IMAGES_DEFAULT.HOTEL.ROOM_CLASS')) }}" class="img-fluid h-100 object-fit-cover">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-8">
                                            <div class="bg-white h-100 p-3">
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="room-class-item-left">
                                                        <h5 class="font-title">{{ $lstRoom->name }}</h5>
                                                        <div><i class="fal fa-user-friends w-10"></i> {{ $lstRoom->adultNum }} người lớn, {{ $lstRoom->childNum }} trẻ em</div>
                                                        <div><i class="fal fa-object-group w-10"></i> {{ $lstRoom->area }} m2</div>
                                                        <div><i class="fal fa-bed-alt w-10"></i> {{ $lstRoom->bedDescription }}</div>
                                                        <div class="text-danger mt-2">Bao gồm ăn sáng, thuế VAT và phí dịch vụ</div>
                                                    </div>
                                                    <div class="room-class-item-right w-xs-100 text-xs-right">
                                                        <span class="text-line-through text-muted font-16pt text-old-price mr-2">{{ number_format($lstRoom->priceDefault, 0, ',', '.') }} VND</span>
                                                        <span class="text-success font-title-bold text-new-price font-21pt">{{ number_format($lstRoom->priceDefaultDiscount, 0, ',', '.') }} VND</span>
                                                        <div class="text-right">/Mỗi đêm</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                    <button class="btn bg-transparent border-0 px-0 py-2 text-primary no-active-focus view-hotel-room-info" data-id-room="{{  $lstRoom->id }}">Xem chi tiết phòng</button>
                                                    <select class="selectpicker select-room-dropdown w-auto border-primary bg-transparent radius-sm">
                                                        <option value="0">Chọn phòng</option>
                                                        <option value="1">1 phòng</option>
                                                        <option value="2">2 phòng</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="pb-3" id="hotel-tab-info">
                        <div class="tab-content-item mb-4">
                            <h5 class="font-sm-title font-title-bold mb-4">Thông tin</h5>
                            @if ($hotel->hotelDescription)
                            <div class="hotel-detail-rule">
                                <div class="hotel-detail-rule-item d-flex bg-white mb-5px p-3 box-shadow">
                                    <div class="font-title hotel-detail-rule-item-title w-30">Thời gian nhận phòng
                                    </div>
                                    <div class="hotel-detail-rule-item-content w-70">
                                        {{ $hotel->hotelDescription->checkinTime }}
                                    </div>
                                </div>
                                <div class="hotel-detail-rule-item d-flex bg-white mb-5px p-3 box-shadow">
                                    <div class="font-title hotel-detail-rule-item-title w-30">Thời gian trả phòng
                                    </div>
                                    <div class="hotel-detail-rule-item-content w-70">
                                        {{ $hotel->hotelDescription->checkoutTime }}
                                    </div>
                                </div>
                                <div class="hotel-detail-rule-item d-flex bg-white mb-5px p-3 box-shadow">
                                    <div class="font-title hotel-detail-rule-item-title w-30">Quy định nhận phòng
                                    </div>
                                    <div class="hotel-detail-rule-item-content w-70">
                                        {!! $hotel->hotelDescription->checkinRegulation !!}
                                    </div>
                                </div>
                                <div class="hotel-detail-rule-item d-flex bg-white mb-5px p-3 box-shadow">
                                    <div class="font-title hotel-detail-rule-item-title w-30">Quy định hủy/đổi đặt phòng
                                    </div>
                                    <div class="hotel-detail-rule-item-content w-70">
                                        {!! $hotel->hotelDescription->cancelSwapRegulation !!}
                                    </div>
                                </div>
                                <div class="hotel-detail-rule-item d-flex bg-white mb-5px p-3 box-shadow">
                                    <div class="font-title hotel-detail-rule-item-title w-30">Trẻ em và giường phụ
                                    </div>
                                    <div class="hotel-detail-rule-item-content w-70">
                                        {!! $hotel->hotelDescription->childrenRegulation !!}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="pb-3" id="hotel-tab-rated">
                        <div class="tab-content-item mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="font-sm-title font-title-bold mb-0">Đánh giá</h5>
                                <button class="btn bg-transparent p-0 border-0 text-primary view-rated-sidebar">Xem thêm</button>
                            </div>
                            <div class="d-flex align-items-center justify-content-between bg-white p-3">
                                <div><span class="font-title-bold mr-3">{{ $rateData['rateAverage'] }} / 5</span><span class="text-success">{{$rateData['rateLabel']}}</span></div>
                                <div>({{ $rateData['rateCount'] }} đánh giá)</div>
                            </div>
                            <div class="text-right"><button class="btn btn-primary-gradient write-rated-comment px-5 mt-3 mb-2">Viết đánh giá</button></div>
                            <div class="list-rated hotel-rated-list">
                                @if ($rateData['rateListLimit'])
                                @foreach ($rateData['rateListLimit'] as $rated)
                                <div class="rated-item bg-white px-3 py-2 mb-1 box-shadow">
                                    <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                        <div class="rated-item-user d-flex align-items-center">
                                            <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                            <div class="rated-item-user-info">
                                                <span class="font-title text-capitalize">{{ $rated->name }}</span>
                                                <span>{{ date('d/m/Y',strtotime($rated->createDate)) }}</span>
                                            </div>
                                        </div>
                                        <div class="rated-item-info font-18pt">
                                            <span class="text-success mr-2">{{ App\Helpers\CommonFunctions::rateNumberToText($rated->rate) }}</span>
                                            <span class="font-title">{{ $rated->rate }}/5</span>
                                        </div>
                                    </div>
                                    <p class="mb-1 mt-2">{{ $rated->content }}</p>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- <div class="p-0" id="hotel-tab-qa">
                        <div class="tab-content-item mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="font-sm-title font-title-bold mb-0">Hỏi đáp</h5>
                                <button class="btn bg-transparent p-0 border-0 text-primary view-quesion-answer-sidebar">Xem thêm</button>
                            </div>

                            <div class="hotel-qa-list">
                                @if ($qaData['qaListLimit'])
                                @foreach ($qaData['qaListLimit'] as $qa)
                                <div class="question-answer-item bg-white box-shadow mb-1">
                                    <div class="question-item border-bottom p-3">
                                        <div class="rated-item-user d-flex align-items-center">
                                            <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                            <div class="rated-item-user-info">
                                                <span class="font-title text-capitalize mr-2">{{$qa->name}}</span>
                                                <span>{{ date('d/m/Y',strtotime($qa->createDate)) }}</span>
                                            </div>
                                        </div>
                                        <div class="question-item-content">
                                            <p class="mb-0 mt-2">{{$qa->question}}</p>
                                        </div>
                                    </div>
                                    @if ($qa->answerId)
                                    <div class="answer-item border-bottom p-3">
                                        <p>{{$qa->answer}}</p>
                                        <span class="font-title text-capitalize">Admin - {{ date('d/m/Y',strtotime($qa->answerDate)) }}</span>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="text-right"><button class="btn btn-primary-gradient add-question px-5 mt-3 mb-2">Đặt câu hỏi</button></div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 benefit-hotel-info d-xs-none d-sm-none d-md-block d-lg-block d-xl-block sidebar-sticky-parent">
            <div class="card combo-booking-detail-info border-0 m-0 shadow-none sidebar-sticky">
                <div class="card-header font-17pt bg-white font-title text-center p-3">Thông tin khách sạn</div>
                <div class="card-body hotel-convenient d-flex flex-wrap align-items-center position-relative p-0">
                    @if ($hotel->lstUtiliti)
                    @foreach ($hotel->lstUtiliti as $utiliti)
                    <div class="w-50 py-3 px-2 bg-white text-center hotel-convenient-item border-bottom border-right">
                        <img src="{{ $utiliti->iconUrl }}" class="img-fluid mb-2" style="height: 40px;">
                        <div class="font-title font-13pt">{{ $utiliti->utilitiName }}</div>
                    </div>
                    @endforeach
                    @endif
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
    // $('input[name=hotel_adultNum]').val(parseInt(sessionStorage.getItem("hotel_adultNum")));
    // $('input[name=hotel_childNum]').val(parseInt(sessionStorage.getItem("hotel_childNum")));
    // $('input[name=hotel_childNum2]').val(parseInt(sessionStorage.getItem("hotel_childNum2")));
    // $('input[name=hotel_single_room]').val(parseInt(sessionStorage.getItem("hotel_single_room")));
    // $('input[name=hotel_double_room]').val(parseInt(sessionStorage.getItem("hotel_double_room")));
    // $('.date-range-booking-start').val(sessionStorage.getItem("start_date_hotel"));
    // $('.date-range-booking-end').val(sessionStorage.getItem("end_date_hotel"));
    $(document).ready(function() {
        // load data room in hotel
        $('.view-hotel-room-info').on('click', function() {
            $('.overlay-loader').show();
            const id_room = $(this).data('id-room');
            $.ajax({
                url: '/load-data-room-in-hotel' + '/' + id_room,
                type: "GET",
                success: function(response) {
                    // console.log(response.data)
                    $('.overlay-loader').hide();
                    if (response.success) {
                        $('#info_room').html(response.data);
                        $(".backdrop-modal").fadeIn(300);
                        $(".room-detail-sidebar").addClass("active");
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $('.overlay-loader').hide();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Có lỗi xảy ra, vui lòng thử lại sau",
                    });
                }
            });
        });

        // Select all »a« elements with a parent class »links« and add a function that is executed on click
        $('.nav-link').on('click', function(e) {
            // Define variable of the clicked »a« element (»this«) and get its href value.
            var href = $(this).attr('href');

            // Run a scroll animation to the position of the element which has the same id like the href value.
            $('html, body').animate({
                scrollTop: $(href).offset().top - 80
            }, '0');

            // Prevent the browser from showing the attribute name of the clicked link in the address bar
            e.preventDefault();
        });

        // book_room_hotel
        $('body').on('click', '.book_room_hotel', function() {
            const room_id_list = [];
            const room_num_list = [];
            const url = $(this).data('url');
            const start_date_hotel = $("input[name=start_date_hotel]").val();
            const end_date_hotel = $("input[name=end_date_hotel]").val();
            const hotel_adultNum = parseInt($('input[name=hotel_adultNum]').val());
            const hotel_childNum = parseInt($('input[name=hotel_childNum]').val());
            const hotel_childNum2 = parseInt($('input[name=hotel_childNum2]').val());
            $('.room_hotel').each(function() {
                const room_id = $(this).data('id-room');
                const active = parseInt($(this).find('select option:selected').val());
                if (active != '' || active != 0) {
                    room_id_list.push(room_id);
                    room_num_list.push(active);
                }
            });
            const data = {
                room_id_list,
                room_num_list,
                url,
                start_date_hotel,
                end_date_hotel,
                hotel_adultNum,
                hotel_childNum,
                hotel_childNum2
            }
            // console.log('data: ', data)
            if (room_num_list.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Bạn chưa chọn phòng",
                });
                return false;
            }
            $('.overlay-loader').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'post_book_room',
                type: "POST",
                data: data,
                success: function(response) {
                    $('.overlay-loader').hide();
                    window.location.href = "book-room-hotel";
                }
            });
        });

        // show rate modal
        $(".write-rated-comment").on("click", function() {
            const is_auth = $("input[name=userToken]").val() === '1' ? true : false;
            if (!is_auth) {
                Swal.fire({
                    icon: 'warning',
                    title: "Thông báo",
                    text: "Bạn cần đăng nhập để thực hiện chức năng này",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Đăng nhập",
                    cancelButtonText: "Để sau",
                }).then(function(res) {
                    if (res.isConfirmed) {
                        window.location.href = "{{ route('login') }}"
                    } else {
                        return false;
                    }
                })
            } else {
                $(".backdrop-modal").fadeIn(300);
                $(".form-rateUpdate-container").addClass("hidden");
                $(".btn-update-rate").html(
                    'Chỉnh sửa đánh giá <i class="fas fa-edit"></i>'
                );
                $(".rated-container").addClass("active");
            }
        });
    });
</script>
@endsection