@extends('frontend.layouts.layout')
@section('body')
<section class="combo-booking-list">
    <div class="combo-booking-detail py-3">
        <form action="{{ route('post_book_combo') }}" method="POST">
        {{ csrf_field() }}
            <div class="container">
                <div class="font-title font-md-title font-title-bold">Chi tiết đặt combo</div>
                <input type="hidden" name="combo_url" value="{{ $combo->link }}">
                <div class="dropdown-divider mb-3"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-9 combo-booking-detail-left">
                        <div class="row combo-detail-info bg-white no-gutters">
                            <div class="col-sm-12 col-md-5 col-lg-4">
                                <img src="{{ asset($combo->imageUrl) }}" class="img-fluid w-100 object-fit-cover">
                            </div>
                            <div class="col-sm-12 col-md-7 col-lg-8">
                                <div class="h-100 p-3 d-flex flex-column justify-content-between">
                                    <div class="font-title-bold font-sm-title">{{ $combo->title }}</div>
                                    <div><span class="font-title">Khởi hành từ:</span> {{ $combo->comboPrice[0]->departurePlace }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row combo-detail-select-date">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="font-title font-22pt py-3">Chọn ngày khởi hành</div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-xs-3">
                                <div class="select-date-travel bg-white">
                                    <div class="input-group">
                                        <!-- <input type="text" class="form-control border-0 h-auto no-active-focus combo-detail-picker-date py-12px date-choose-input" placeholder="22/01/2021"> -->
                                        <!-- <div class="input-group-append no-date-choose-toggle">
                                            <span class="input-group-text bg-white border-0">
                                                <i class="far fa-calendar text-primary"></i>
                                            </span>
                                        </div> -->
                                        <select class="form-control h-auto py-12px bg-white" name="comboPrice">
                                            @if ($combo->comboPrice)
                                                @foreach ($combo->comboPrice as $comboPrice)
                                                <option value="{{ $comboPrice->id }}" data-percentdiscount="0" data-price="{{ $comboPrice->price }}" data-pricedisplay="{{ $comboPrice->priceDisplay }}" data-priceyoung="{{ $comboPrice->priceYoung }}" data-pricechildren="{{ $comboPrice->priceChildren }}"  >Từ {{ \App\Helpers\CommonFunctions::convertTime($comboPrice->startDate)  }} Đến {{ \App\Helpers\CommonFunctions::convertTime($comboPrice->endDate) }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="h-100 d-flex align-items-center">
                                    <label class="matter-checkbox mb-0 ml-auto">
                                        <input type="checkbox" class="no-date-choose">
                                        <span>Chưa xác định khởi hành</span>
                                    </label>
                                </div>
                            </div> -->
                        </div>
                        <div class="row combo-detail-list-customer row-small-space placeholder-color">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="font-title font-22pt py-3">Danh sách khách hàng</div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 mb-5px">
                                <div class="form-group mb-0">
                                    <input type="number" min="0" class="form-control py-3 h-auto border-0" placeholder="Nhập số người lớn" name="number_adultNum">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 mb-5px">
                                <div class="form-group mb-0">
                                    <input type="number" min="0" class="form-control py-3 h-auto border-0" placeholder="Nhập số trẻ em" name="number_childNum">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group mb-0">
                                    <input type="number" min="0" class="form-control py-3 h-auto border-0" placeholder="Nhập số trẻ nhỏ" name="number_childNum2">
                                </div>
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
                                <div class="p-3 text-danger bg-white text-right mb-5px">* Giá bao gồm thuế và phí</div>
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 font-15pt h-auto py-12px coupon-code-input" placeholder="Nhập mã giảm giá">
                                    <div class="input-group-append">
                                        <button type="button" class="input-group-text btn-primary-gradient font-title font-15pt py-12px apply-coupon">Áp dụng</button>
                                    </div>
                                </div>
                                <div class="w-100 font-15pt font-title check-coupon-text mt-2"></div>
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
                    <button type="button" class="btn btn-primary-gradient btn-block py-12px font-title btn-submit">Hoàn thành đặt combo</button>
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
    $('input[name=number_adultNum],input[name=number_childNum],input[name=number_childNum2]').on('change', function() {
        calc();
    });
    $('select[name=comboPrice]').on('change', function() {
        calc();
    });
    $('body').on('click', '.btn-submit', function() {
        if (calc()) return false;
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
        if (error !== 0) {
            $("html,body").animate({
                scrollTop: $('.yacht-detail-list-contact').offset().top, 
                scrollLeft: 0
            },600);
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
                    },600);
            } else {
                form.submit();
            }
        }
    });
</script>
@endsection