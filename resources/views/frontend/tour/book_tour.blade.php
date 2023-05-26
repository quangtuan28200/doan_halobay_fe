@extends('frontend.layouts.layout')
@section('body')
<section class="combo-booking-list">
    <div class="combo-booking-detail py-3">
        <form action="{{ route('post_book_tour') }}" method="POST">
            {{ csrf_field() }}
            <div class="container">
                <div class="font-title font-md-title font-title-bold">Chi tiết đặt tour</div>
                <input type="hidden" name="tour_url" value="{{ $tour->link }}">
                <div class="dropdown-divider mb-3"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-9 combo-booking-detail-left">
                        <div class="row combo-detail-info bg-white no-gutters">
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <img src="{{ asset($tour->imageUrl) }}" class="img-fluid w-100 object-fit-cover h-100">
                            </div>
                            <div class="col-sm-12 col-md-7 col-lg-8">
                                <div class="h-100 p-3 d-flex flex-column justify-content-between">
                                    <div class="font-title-bold font-sm-title">{{ $tour->title }}</div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6 my-3">
                                            <div><span class="font-title-bold">Ngày khởi hành: </span>{{ $tour->tourPrices[0]->startDate }}</div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 my-3">
                                            <div><span class="font-title-bold">Nơi khởi hành: </span>{{ $tour->startPlace->name }}</div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div><span class="font-title-bold">Ngày kết thúc: </span>{{ $tour->tourPrices[0]->endDate }}</div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div><span class="font-title-bold">Nơi kết thúc: </span>{{ $tour->tourPlace[0]->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row combo-detail-select-date row-small-space">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="font-title font-22pt py-3">Chọn ngày khởi hành</div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="select-date-travel bg-white mb-5px">
                                    <div class="input-group">
                                        <select class="form-control h-auto py-12px bg-white" name="comboPrice">
                                            @if ($tour->tourPrices)
                                            @foreach ($tour->tourPrices as $tourPrices)
                                            <option value="{{ $tourPrices->id }}" data-percentdiscount="{{ $tourPrices->percentDiscount }}" data-price="{{ $tourPrices->price }}" data-pricedisplay="{{ $tourPrices->price }}" data-priceyoung="{{ $tourPrices->priceChild }}" data-pricechildren="{{ $tourPrices->priceChild2 }}">Từ {{ $tourPrices->startDate  }} Đến {{ $tourPrices->endDate }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <!-- <div class="form-group mb-5px">
                                    <select class="form-control h-auto py-12px bg-white">
                                        <option>Tiêu chuẩn</option>
                                        <option>Tiêu chuẩn 1</option>
                                        <option>Tiêu chuẩn 2</option>
                                    </select>
                                </div> -->
                            </div>
                        </div>
                        <div class="row combo-detail-list-customer row-small-space">
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-xs-3 mb-sm-3">
                                <div class="d-block d-sm-block d-md-block d-lg-flex d-xl-flex align-items-center justify-content-between">
                                    <div class="font-title font-22pt py-3">Danh sách khách hàng đi tour</div>
                                    <div>
                                        <label class="d-flex justify-content-sm-between cursor-pointer mb-0">
                                            <span class="mr-1">Bạn có thể cho chúng tôi biết danh sách đoàn đi của mình không?</span>
                                            <div class="tourCustomerListCheck matter-checkbox m-0">
                                                <input type="checkbox" name="is_list_customer">
                                                <span></span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group mb-5px">
                                    <input type="number" min="0" class="form-control py-12px h-auto border-0" placeholder="Nhập số người lớn" name="number_adultNum">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group mb-5px">
                                    <input type="number" min="0" class="form-control py-12px h-auto border-0" placeholder="Nhập số trẻ em" name="number_childNum">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group mb-5px">
                                    <input type="number" min="0" class="form-control py-12px h-auto border-0" placeholder="Nhập số trẻ nhỏ" name="number_childNum2">
                                </div>
                            </div>
                        </div>
                        <div class="list-user-info">
                            <div id="list_customer">

                            </div>
                        </div>
                        @include('frontend.block.info_contact')
                        @include('frontend.block.payment_method')
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3 combo-booking-detail-right">
                        <div class="payment-info">
                            <div class="payment-info-header">
                                <div class="font-title p-3 px-md-3 px-lg-3 bg-white text-center font-18pt mb-1">Thông tin thanh toán</div>
                            </div>
                            <div class="payment-info-body">
                                <ul class="list-group">
                                    <li class="list-group-item font-14pt d-flex align-items-center justify-content-between border-0 mb-1 py-2 px-md-2 px-lg-3">
                                        <div>Giá cho người lớn</div>
                                        <div class="text-danger number_adultNum"></div>
                                        <div class="price_adultNum"></div>
                                    </li>
                                    <li class="list-group-item font-14pt d-flex align-items-center justify-content-between border-0 mb-1 py-2 px-md-2 px-lg-3">
                                        <div>Giá cho trẻ em</div>
                                        <div class="text-danger number_childNum"></div>
                                        <div class="price_childNum"></div>
                                    </li>
                                    <li class="list-group-item font-14pt d-flex align-items-center justify-content-between border-0 mb-1 py-2 px-md-2 px-lg-3">
                                        <div>Giá cho trẻ nhỏ</div>
                                        <div class="text-danger number_childNum2"></div>
                                        <div class="price_childNum2"></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="paymanet-info-footer">
                                <div class="d-flex align-items-center bg-white justify-content-between mb-1 py-2 px-md-2 px-lg-3 px-3">
                                    <div>Tổng</div>
                                    <div class="price-wrap">
                                        <span class="text-success price-current font-title price-format-dot total"></span>
                                        <span class="new-price font-title text-success"></span>
                                    </div>
                                </div>
                                <!-- <div class="p-3 text-danger bg-white text-right mb-5px">* Giá bao gồm thuế và phí</div>
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 font-15pt h-auto py-12px coupon-code-input" placeholder="Nhập mã giảm giá">
                                    <div class="input-group-append">
                                        <button type="button" class="input-group-text btn-primary-gradient font-title font-15pt py-12px apply-coupon">Áp dụng</button>
                                    </div>
                                </div>
                                <div class="w-100 font-15pt font-title check-coupon-text mt-2"></div> -->
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
                    <button type="button" class="btn btn-primary-gradient btn-block py-12px font-title btn-submit">Hoàn thành đặt tour</button>
                </div>
            </div>
        </form>

    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('frontend/sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('frontend/sweetalert2/sweetalert2.min.css') }}">
<script>
    const show_list_customer = function(number) {
        console.log(number)
        let html = '';
        for (let i = 1; i <= number; i++) {
            html += `  <div class="row row-small-space user-info-item">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="font-title font-22pt pb-3">Hành khách ${i}</div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-5px">
                                    <div class="form-group mb-0">
                                        <select class=" form-control h-auto pd-10 bg-white" name="customer_gender[]">
                                            <option value="0">Quý danh</option>
                                            <option value="1">Ông</option>
                                            <option value="2">Bà</option>
                                            <option value="3">Anh</option>
                                            <option value="4">Chị</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-5px">
                                    <span class="star-required">*</span>
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control border-0 h-auto py-12px customer_name" placeholder="Họ tên" name="customer_name[]" required>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-5px">
                                    <div class="input-group">
                                        <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" placeholder="Số điện thoại" name="customer_phone[]">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-5px">
                                    <div class="input-group">
                                        <input type="email" class="form-control border-0 h-auto no-active-focus py-12px" placeholder="Email" name="customer_mail[]">
                                    </div>
                                </div>
                            </div>`;
        }
        if ($('input[name=is_list_customer').is(':checked')) {
            return html;
        } else {
            return '';
        }
    }

    $('body').on('click', 'input[name=is_list_customer]', function() {
        const number_adultNum = $('input[name=number_adultNum]').val() != '' ? parseInt($('input[name=number_adultNum]').val()) : 0;
        const number_childNum = $('input[name=number_childNum]').val() != '' ? parseInt($('input[name=number_childNum]').val()) : 0;
        const number_childNum2 = $('input[name=number_childNum2]').val() != '' ? parseInt($('input[name=number_childNum2]').val()) : 0;
        const html = show_list_customer(number_adultNum + number_childNum + number_childNum);
        $('#list_customer').html(html);
        calc();
    });
    $('input[name=number_adultNum],input[name=number_childNum],input[name=number_childNum2]').on('change', function() {
        const number_adultNum = $('input[name=number_adultNum]').val() != '' ? parseInt($('input[name=number_adultNum]').val()) : 0;
        const number_childNum = $('input[name=number_childNum]').val() != '' ? parseInt($('input[name=number_childNum]').val()) : 0;
        const number_childNum2 = $('input[name=number_childNum2]').val() != '' ? parseInt($('input[name=number_childNum2]').val()) : 0;
        const html = show_list_customer(number_adultNum + number_childNum + number_childNum2);
        $('#list_customer').html(html);
        calc();
    });
    $('body').on('click', '.btn-submit', function() {
        if (calc()) return false;
        let error = 0;
        let error_customer_name = 0;
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
        if (error !== 0) {
            $("html,body").animate({
                scrollTop: $('.yacht-detail-list-contact').offset().top,
                scrollLeft: 0
            }, 600);
        } else if (payment_method == undefined) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Bạn chưa chọn phương thức thanh toán",
            });
        } else {
            if ($('input[name=is_vat').is(':checked')) {
                const tax_code = form.find('input[name=tax_code]').val();
                if (checkInput(form, tax_code, 'tax_code') === 0) error++;
                const company_name = form.find('input[name=company_name]').val();
                if (checkInput(form, company_name, 'company_name') === 0) error++;
                const company_address = form.find('input[name=company_address]').val();
                if (checkInput(form, company_address, 'company_address') === 0) error++;
            }
            if (error !== 0) {
                $("html,body").animate({
                    scrollTop: $('textarea[name=content]').offset().top,
                    scrollLeft: 0
                }, 600);
            } else {
                if ($('input[name=is_list_customer').is(':checked')) {
                    $('.customer_name').each(function() {
                        const val = $(this).val();
                        if (val == "" || val == undefined) {
                            error_customer_name++;
                        }
                    });
                }
                if (error_customer_name != 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Bạn chưa nhập tên trong thông tin hành khách",
                    });
                } else {
                    form.submit();
                }
            }
        }
    });
</script>
@endsection