@extends('frontend.layouts.layout')
@section('body')
<style>
    .star-required {
        color: red;
        position: absolute;
        left: 5px;
        z-index: 20;
        top: 15px;
    }
</style>
<section class="combo-booking-list">
    <div class="hotel-booking-info py-3">
        <div class="container">
            <form action="{{ route('book_room_in_yacht') }}" method="POST">
                {{ csrf_field() }}
                <div class="font-title font-md-title font-title-bold">Chi tiết đặt phòng</div>
                <div class="dropdown-divider mb-3"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-9 hotel-booking-info-left">
                        <div class="row combo-detail-info bg-white no-gutters mb-5px">
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <img src="{{ asset($hotel->avatarUrl) }}" class="img-fluid w-100 object-fit-cover">
                            </div>
                            <div class="col-sm-12 col-md-7 col-lg-8">
                                <div class="h-100 p-3">
                                    <div class="font-title-bold font-sm-title">{{ $hotel->name }}</div>
                                    <div class="my-3"><span class="font-title"> Địa chỉ : </span> Thanh Xuân - Hà Nội</div>
                                    <div><span class="font-title">Nhận phòng:</span> {{ \Carbon\Carbon::createFromFormat('d/m/Y', \Session::get("yacht_book_date"))->format('l') }} , {{ \Carbon\Carbon::createFromFormat('d/m/Y', \Session::get("yacht_book_date"))->format('d/m/Y') }} </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <p class="text-danger mb-0 p-3">Xin vui lòng xem lại các phòng bạn đã đặt. Mỗi giường phụ (nếu có) sẽ tính phí và áp dụng cho 1 người lớn hoặc 1 trẻ em</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table mobile-table table-yacht-price hotel-info-table bg-white">
                                <thead class="mb-5px">
                                    <th class="font-title text-uppercase text-nowrap">stt</th>
                                    <th class="font-title text-uppercase text-nowrap">loại phòng</th>
                                    <th class="font-title text-uppercase text-nowrap">điều kiện phòng</th>
                                    <th class="font-title text-uppercase text-nowrap">giá 1 đêm</th>
                                </thead>
                                <tbody>
                                    @if ($room_yacht)
                                    @foreach ($room_yacht as $room)
                                    <tr>
                                        <td data-label="STT">Phòng {{ $loop->index + 1 }}</td>
                                        <td data-label="Loại phòng" class="font-title">{{ $room->name }}</td>
                                        <td data-label="Điều kiện phòng">
                                            <div>{{ $room->adultNum }} người lớn, {{ $room->childNum }} trẻ em</div>
                                            <div>{{ $room->area }} m2</div>
                                            <button class="bg-transparent p-0 border-0 text-primary text-underline no-active-focus view-yacht-rule text-nowrap" data-id-room="{{ $room->id }}">Quy định đặt phòng</button>
                                        </td>
                                        <td data-label="Giá 1 đêm" class="text-success font-title">{{ number_format($room->priceDefaultDiscount, 0, ',', '.') }} VND</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row yacht-detail-list-contact placeholder-color row-small-space">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="font-title font-22pt py-3">Thông tin liên hệ</div>
                                </div>
                                <p class="mb-4">Thông tin có dấu (*) là bắt buộc phải nhập. Xin quý khách vui lòng kiểm tra kỹ thông tin email, số điện thoại để tránh bị sai sót</p>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group mb-5px">
                                    <span class="star-required">*</span>
                                    <select class="selectpicker form-control h-auto py-12px bg-white" name="gender">
                                        <option value="0">Quý danh</option>
                                        <option value="1">Ông</option>
                                        <option value="2">Bà</option>
                                        <option value="3">Anh</option>
                                        <option value="4">Chị</option>
                                    </select>
                                    <span class="hidden">Bạn chưa chọn quý danh</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group mb-5px">
                                    <span class="star-required">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" name="full_name" placeholder="Tên của bạn">
                                    </div>
                                    <span class="hidden">Bạn chưa nhập tên</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group mb-5px">
                                    <span class="star-required">*</span>
                                    <select class="selectpicker form-control h-auto py-12px bg-white" name="city_id">
                                        <option value="0">Thành Phố</option>
                                        @if ($list_place_hotel)
                                        @foreach ($list_place_hotel as $place_hotel)
                                        <option value="{{ $place_hotel->id }}">{{ $place_hotel->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span class="hidden">Bạn chưa chọn thành phố</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group mb-5px">
                                    <span class="star-required">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" name="address" placeholder="Địa chỉ cụ thể">
                                    </div>
                                    <span class="hidden">Bạn chưa nhập địa chỉ</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group mb-5px">
                                    <span class="star-required">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" name="phone_number" placeholder="Số điện thoại">
                                    </div>
                                    <span class="hidden">Bạn chưa nhập số điện thoại</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group mb-5px">
                                    <span class="star-required">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" name="email" placeholder="Email">
                                    </div>
                                    <span class="hidden">Bạn chưa nhập email liên hệ</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <textarea class="form-control border-0 rounded-0" name="content" placeholder="Nội dung yêu cầu" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row yacht-detail-list-payment row-small-space">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                    <div class="font-title font-22pt py-3">Hình thức thanh toán</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 checkbox-payment-method mb-5px">
                                <div class="d-flex align-items-center justify-content-between pl-3 py-3 pr-2 border-bottom bg-white">
                                    <div>Chuyển khoản ngân hàng</div>
                                    <label class="matter-checkbox mb-0">
                                        <input type="checkbox" class="paymentMethodCheck bankTranferMethod" name="payment_method" value="1">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="checkbox-payment-item">
                                    <div class="payment-method-bank p-3 bg-white">
                                        <div><span>Mẫu nội dung chuyển khoản</span>:"Truong Thi Huyen, thanh toan khach san","Truong Thi Huyen, thanh toan dat tuor",...</div>
                                        <div class="font-title">Các tài khoản ngân hàng HaloBay</div>
                                        <div>
                                            <div class="row bank-list payment-bank-logo mt-3">
                                                <div class="col">
                                                    <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="Ngân hàng VP Bank" data-bank-content="Chinh nhánh sở giao dịch<br>Số TK: 1912 777 357777<br>Chủ tài khoản: Công ty HaloBay">
                                                        <div class="border-check-success border border-success position-absolute h-100"></div>
                                                        <input type="radio" name="select-bank-tranfer" value="vpbank" hidden>
                                                        <img src="{{ asset('frontend/img/bank-logo/vpbank-logo.png') }}" class="img-fluid">
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="Ngân hàng TechcomBank" data-bank-content="Chinh nhánh sở giao dịch<br>Số TK: <br>Chủ tài khoản: Công ty HaloBay">
                                                        <div class="border-check-success border border-success position-absolute h-100"></div>
                                                        <input type="radio" name="select-bank-tranfer" value="techcombank" hidden>
                                                        <img src="{{ asset('frontend/img/bank-logo/techcombank-logo.png') }}" class="img-fluid">
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="Ngân hàng Đông Á Bank" data-bank-content="Chinh nhánh sở giao dịch<br>Số TK: <br>Chủ tài khoản: Công ty HaloBay">
                                                        <div class="border-check-success border border-success position-absolute h-100"></div>
                                                        <input type="radio" name="select-bank-tranfer" value="dongabank" hidden>
                                                        <img src="{{ asset('frontend/img/bank-logo/dongabank-logo.png') }}" class="img-fluid">
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="Ngân hàng ACB" data-bank-content="Chinh nhánh sở giao dịch<br>Số TK: <br>Chủ tài khoản: Công ty HaloBay">
                                                        <div class="border-check-success border border-success position-absolute h-100"></div>
                                                        <input type="radio" name="select-bank-tranfer" value="acb" hidden>
                                                        <img src="{{ asset('frontend/img/bank-logo/acb-logo.png') }}" class="img-fluid">
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="Ngân hàng VP Bank" data-bank-content="Chinh nhánh sở giao dịch<br>Số TK: 1912 777 357777<br>Chủ tài khoản: Công ty HaloBay">
                                                        <div class="border-check-success border border-success position-absolute h-100"></div>
                                                        <input type="radio" name="select-bank-tranfer" value="vpbank" hidden>
                                                        <img src="{{ asset('frontend/img/bank-logo/vpbank-logo.png') }}" class="img-fluid">
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="Ngân hàng VP Bank" data-bank-content="Chinh nhánh sở giao dịch<br>Số TK: 1912 777 357777<br>Chủ tài khoản: Công ty HaloBay">
                                                        <div class="border-check-success border border-success position-absolute h-100"></div>
                                                        <input type="radio" name="select-bank-tranfer" value="vpbank" hidden>
                                                        <img src="{{ asset('frontend/img/bank-logo/vpbank-logo.png') }}" class="img-fluid">
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="Ngân hàng TechcomBank" data-bank-content="Chinh nhánh sở giao dịch<br>Số TK: <br>Chủ tài khoản: Công ty HaloBay">
                                                        <div class="border-check-success border border-success position-absolute h-100"></div>
                                                        <input type="radio" name="select-bank-tranfer" value="techcombank" hidden>
                                                        <img src="{{ asset('frontend/img/bank-logo/techcombank-logo.png') }}" class="img-fluid">
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="Ngân hàng Đông Á Bank" data-bank-content="Chinh nhánh sở giao dịch<br>Số TK: <br>Chủ tài khoản: Công ty HaloBay">
                                                        <div class="border-check-success border border-success position-absolute h-100"></div>
                                                        <input type="radio" name="select-bank-tranfer" value="dongabank" hidden>
                                                        <img src="{{ asset('frontend/img/bank-logo/dongabank-logo.png') }}" class="img-fluid">
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="Ngân hàng ACB" data-bank-content="Chinh nhánh sở giao dịch<br>Số TK: <br>Chủ tài khoản: Công ty HaloBay">
                                                        <div class="border-check-success border border-success position-absolute h-100"></div>
                                                        <input type="radio" name="select-bank-tranfer" value="acb" hidden>
                                                        <img src="{{ asset('frontend/img/bank-logo/acb-logo.png') }}" class="img-fluid">
                                                    </label>
                                                </div>
                                                <div class="col">
                                                    <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="Ngân hàng VP Bank" data-bank-content="Chinh nhánh sở giao dịch<br>Số TK: 1912 777 357777<br>Chủ tài khoản: Công ty HaloBay">
                                                        <div class="border-check-success border border-success position-absolute h-100"></div>
                                                        <input type="radio" name="select-bank-tranfer" value="vpbank" hidden>
                                                        <img src="{{ asset('frontend/img/bank-logo/vpbank-logo.png') }}" class="img-fluid">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="d-flex bank-item-info mt-3">
                                                <div class="font-title bank-name-title mr-4"></div>
                                                <div class="bank-content"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 checkbox-payment-method mb-5px">
                                <div class="d-flex align-items-center justify-content-between pl-3 py-3 pr-2 border-bottom bg-white">
                                    <div>Thanh toán tại khách sạn</div>
                                    <label class="matter-checkbox mb-0">
                                        <input type="checkbox" class="paymentMethodCheck homePayMethod" name="payment_method" value="2">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="font-title checkbox-payment-item bg-white">
                                    <div class="p-3">Quý khách có thể thanh toán trực tiếp tại khách sạn</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 checkbox-payment-method mb-5px">
                                <div class="d-flex align-items-center justify-content-between pl-3 py-3 pr-2 border-bottom bg-white">
                                    <div>Thanh toán trực tiếp tại văn phòng Halobay</div>
                                    <label class="matter-checkbox mb-0">
                                        <input type="checkbox" class="paymentMethodCheck officePayMethod" name="payment_method" value="3">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="checkbox-payment-item">
                                    <div class="p-3 bg-white">
                                        <div class="font-title">Địa chỉ văn phòng HaloBay</div>
                                        <div class="font-title font-22pt my-2">Văn phòng Hà Nội</div>
                                        <div class="contact-form-info">
                                            <div class="contact-form-info-item d-flex align-items-center mb-2">
                                                <i class="fal fa-map-marker-alt contact-form-icon rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2"></i>
                                                <span class="font-medium mr-2">Địa chỉ:</span>278 Lạch Tray, Ngô Quyền, Hải Phòng
                                            </div>
                                            <div class="contact-form-info-item d-flex align-items-center mb-2">
                                                <i class="fal fa-phone-volume contact-form-icon rounded-circle bg-primary text-white d-flex align-items-center justify-content-center icon-contact-rotate mr-2"></i>
                                                <span class="font-medium mr-2">Hotline:</span>0902.555.369
                                            </div>
                                            <div class="contact-form-info-item d-flex align-items-center mb-2">
                                                <i class="fal fa-envelope contact-form-icon rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2"></i>
                                                <span class="font-medium mr-2">Email:</span>Halobay@gmail.com
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    <div class="text-success font-title">{{ number_format($total, 0, ',', '.') }} CND</div>
                                </div>
                                <div class="p-3 text-danger bg-white text-right mb-5px">* Giá bao gồm thuế và phí</div>
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 font-15pt h-auto py-12px" placeholder="Nhập mã giảm giá">
                                    <div class="input-group-append">
                                        <button class="input-group-text btn-primary-gradient font-title font-15pt py-12px apply-coupon-code">Áp dụng</button>
                                    </div>
                                </div>
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
    $('body').on('click', '.btn-submit', function() {
        let error = 0;
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
        } else {
            if (payment_method == undefined) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Bạn chưa chọn phương thức thanh toán",
                });
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // $.ajax({
            //     url: 'book_room_in_yacht',
            //     type: "POST",
            //     data: form.serialize() + '&extraBed=' + extraBed,
            //     success: function(response) {
            //         console.log('response', response);
            //     }
            // });
            form.submit();
        }
    });
</script>
@endsection