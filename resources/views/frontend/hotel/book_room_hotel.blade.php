@extends('frontend.layouts.layout')
@section('body')
@php
\Carbon\Carbon::setLocale('vn');
$dayStart = \Carbon\Carbon::createFromFormat('d/m/Y', $start_date_hotel)->format('l');
$dateStartFormated = \Carbon\Carbon::createFromFormat('d/m/Y', $start_date_hotel)->format('d/m/Y');
$dayEnd = \Carbon\Carbon::createFromFormat('d/m/Y', $end_date_hotel)->format('l');
$dateEndFormated = \Carbon\Carbon::createFromFormat('d/m/Y', $end_date_hotel)->format('d/m/Y');
@endphp
<div class="room-detail-sidebar smooth-transition position-fixed d-flex align-items-center">
    <div class="room-detail-sidebar-close cursor-pointer bg-primary text-white border border-white border-right-0 align-self-start position-relative py-2 px-3">
        <i class="fal fa-times"></i>
    </div>
    <div id="info_room" class="hotel-booking-item bg-gray w-100 h-100 py-5 px-3"></div>
</div>
<section class="combo-booking-list">
    <div class="hotel-booking-info py-3">
        <div class="container">
            <form action="{{ route('book_room_in_hotel') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="payment_for" value="hotel">
                <div class="font-title font-md-title font-title-bold">Chi tiết đặt phòng</div>
                <div class="dropdown-divider mb-3"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-9 hotel-booking-info-left">
                        <div class="row combo-detail-info bg-white no-gutters mb-5px">
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <img src="{{ asset($hotel->avatarUrl ?: \Config::get('constants.IMAGES_DEFAULT.HOTEL.HOTEL_LIST')) }}" class="img-fluid w-100 object-fit-cover">
                            </div>
                            <div class="col-sm-12 col-md-7 col-lg-8">
                                <div class="h-100 p-3">
                                    <div class="font-title-bold font-sm-title">{{ $hotel->name }}</div>
                                    <div class="my-3"><span class="font-title"> Địa chỉ : </span> Thanh Xuân - Hà Nội</div>
                                    <div><span class="font-title">Nhận phòng:</span> {{ $dayStart }}, {{ $dateStartFormated }} - Trả phòng : {{ $dayEnd }}, {{ $dateEndFormated }}</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <!-- <p class="text-danger mb-0 p-3">Xin vui lòng xem lại các phòng bạn đã đặt. Mỗi giường phụ (nếu có) sẽ tính phí và áp dụng cho 1 người lớn hoặc 1 trẻ em</p> -->
                                <p class="text-danger mb-0 p-3">Xin vui lòng xem lại các phòng bạn đã đặt.</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table mobile-table table-yacht-price hotel-info-table bg-white">
                                <thead class="mb-5px">
                                    <th class="font-title text-uppercase text-nowrap">stt</th>
                                    <th class="font-title text-uppercase text-nowrap">loại phòng</th>
                                    <th class="font-title text-uppercase text-nowrap">điều kiện phòng</th>
                                    <!-- <th class="font-title text-uppercase text-nowrap">Giường phụ</th> -->
                                    <th class="font-title text-uppercase text-nowrap">giá 1 đêm</th>
                                </thead>
                                <tbody>
                                    @if ($room_hotel)
                                    @foreach ($room_hotel as $room)
                                    <tr>
                                        <td data-label="STT">Phòng {{ $loop->index + 1 }}</td>
                                        <td data-label="Loại phòng" class="font-title">{{ $room->name }}</td>
                                        <td data-label="Điều kiện phòng">
                                            <div>{{ $room->adultNum }} người lớn, {{ $room->childNum }} trẻ em</div>
                                            <div>{{ $room->area }} m2</div>
                                            <button class="bg-transparent p-0 border-0 text-primary text-underline no-active-focus view-room-rule text-nowrap" data-id-room="{{ $room->id }}">Quy định đặt phòng</button>
                                        </td>
                                        <!-- <td data-label="Giường phụ">
                                            <div class="dropdown add-bed-hotel extraBed">
                                                <select class="selectpicker select-room-dropdown w-auto border-primary bg-transparent radius-sm" name="extraBed[]">
                                                    <option value="0">Thêm giường phụ</option>
                                                    <option value="1">Thêm 1 giường</option>
                                                    <option value="2">Thêm 2 giường</option>
                                                </select>
                                            </div>
                                        </td> -->
                                        <td data-label="Giá 1 đêm" class="text-success font-title">{{ number_format($room->priceDefaultDiscount, 0, ',', '.') }} VND</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @include('frontend.block.info_contact')
                        @include('frontend.block.payment_method')
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3 hotel-booking-right">
                        <div class="payment-info">
                            <div class="payment-info-header">
                                <div class="font-title px-md-2 p-3 bg-white text-center font-20pt mb-1">Thông tin thanh toán</div>
                            </div>
                            <div class="payment-info-body">
                                <ul class="list-group">
                                    @if ($info_payment)
                                    @foreach ($info_payment as $info)
                                    <li class="list-group-item font-15pt d-flex align-items-center justify-content-between border-0 mb-1 py-2 px-3 px-md-2 px-lg-3">
                                        <div class="w-md-50">{{ $info['number_room'] }} {{ $info['name_room'] }}</div>
                                        <div class="w-md-50 text-md-right">{{ number_format($info['price'], 0, ',', '.') }} VND</div>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="payment-info-footer">
                                <div class="d-flex align-items-center bg-white justify-content-between mb-1 py-2 px-3 px-md-2 px-lg-3">
                                    <div>Tổng</div>
                                    <input type="hidden" name="payment_money" value="{{$total}}">
                                    <div class="text-success font-title">{{ number_format($total, 0, ',', '.') }} CND</div>
                                </div>
                                <div class="p-3 text-danger bg-white text-right mb-5px">* Giá bao gồm thuế và phí</div>
                                <!-- <div class="input-group">
                                    <input type="text" class="form-control border-0 font-15pt h-auto py-12px" placeholder="Nhập mã giảm giá">
                                    <div class="input-group-append">
                                        <button class="input-group-text btn-primary-gradient font-title font-15pt py-12px apply-coupon-code">Áp dụng</button>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider my-4"></div>
                <div>
                    <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
                    <span class="text-danger">Khi quý khách nhấn nút "Hoàn thành" cũng đồng nghĩ là Quý khách đã đồng ý với các điều khoản và và điều kiện về đặt dịch vụ trên website của chúng tôi</span>
                </div>
                <div class="text-center col-sm-12 col-md-8 col-lg-3 mx-auto mt-4">
                    <button type="button" class="btn btn-primary-gradient btn-block py-12px font-title btn-submit">Hoàn thành đặt phòng</button>
                </div>
            </form>

        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('frontend/sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('frontend/sweetalert2/sweetalert2.min.css') }}">
<script>
    $(document).ready(function() {
        $('.view-room-rule').on('click', function(e) {
            e.preventDefault();
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

        // booking hotel
        $('body').on('click', '.btn-submit', function() {
            let error = 0;
            let errorInvoice = 0;
            const form = $(this).closest('form');
            const full_name = form.find('input[name=full_name]').val();
            if (checkInput(form, full_name, 'full_name') === 0) error++;
            const address = form.find('input[name=address]').val();
            if (checkInput(form, address, 'address') === 0) error++;
            const phone_number = form.find('input[name=phone_number]').val();
            if (checkInput(form, phone_number, 'phone_number') === 0) error++;
            const email = form.find('input[name=email]').val();
            if (checkInput(form, email, 'email') === 0) error++;
            const content = form.find('textarea[name=content]').val();
            const gender = form.find('select[name=gender] option:selected').val();
            if (checkSelect(form, gender, 'gender') === 0) error++;
            const city_id = form.find('select[name=city_id] option:selected').val();
            if (checkSelect(form, city_id, 'city_id') === 0) error++;
            if ($('input[name=is_vat').is(':checked')) {
                const tax_code = form.find('input[name=tax_code]').val();
                if (checkInput(form, tax_code, 'tax_code') === 0) errorInvoice++;
                const company_name = form.find('input[name=company_name]').val();
                if (checkInput(form, company_name, 'company_name') === 0) errorInvoice++;
                const company_address = form.find('input[name=company_address]').val();
                if (checkInput(form, company_address, 'company_address') === 0) errorInvoice++;
            }
            const payment_method = $('input[name=payment_method]:checked').val();
            const extraBed = [];
            $('.extraBed').each(function() {
                const val = $(this).find('select[name=extraBed] option:selected').val();
                extraBed.push(val);
            })
            if (error !== 0) {
                $("html,body").animate({
                    scrollTop: $('.yacht-detail-list-contact').offset().top,
                    scrollLeft: 0
                }, 600);
            } else if (errorInvoice !== 0) {
                $("html,body").animate({
                    scrollTop: $('textarea[name=content]').offset().top,
                    scrollLeft: 0
                }, 600);
            } else if (payment_method == undefined) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Bạn chưa chọn phương thức thanh toán",
                });
            } else if (payment_method == 4) {
                // PopupCenter("", "popupWindow", 600, 600);
                // form.attr('target', 'popupWindow');
                form.attr('action', "{{ route('init_vnpay_payment') }}");
                form.submit();
            } else {
                form.submit();
            }
        });

        function PopupCenter(pageURL, title, w, h) {
            var left = (screen.width / 2) - (w / 2);
            var top = (screen.height / 2) - (h / 2);
            var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
            return targetWin;
        }

        // // thanh toan vnpay
        // $('.vnpay_payment').click(function(e) {
        //     e.preventDefault();
        //     const form = $(this).closest('form');

        //     PopupCenter("", "popupWindow", 600, 600);
        //     form.attr('target', 'popupWindow');
        //     form.attr('action', "{{ route('vnpay_payment') }}");
        //     form.submit();
        // });
    });
</script>
@endsection