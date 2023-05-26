@extends('frontend.layouts.layout')
@section('body')
<section class="seaplane-booking-list">
    <div class="seaplane-booking-detail py-3">
        <div class="container">
            <form action="{{ route('post_book_seaplane') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="seaplane_id" value="{{ $seaplane->id }}">
                <div class="font-title font-md-title font-title-bold">Chi tiết đặt vé</div>
                <div class="dropdown-divider mb-3"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-9 combo-booking-detail-left">
                        <div class="row detail-booking-ticket row-small-space placeholder-color">
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-5px">
                                <div class="row no-gutters bg-white">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="font-title-bold py-12px px-3 bg-white">
                                            <div class="d-flex align-items-center justify-content-md-between justify-content-xs-between">
                                                <div>{{ $seaplane->startPlace }}</div>
                                                <div><img src="{{ asset('frontend/img/seaplane-black.svg') }}" class="img-fluid mx-4" width="18"></div>
                                                <div>{{ $seaplane->endPlace }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex align-items-center justify-content-between bg-white py-12px px-3 bg-white">
                                            <div>{{ $seaplane->startTime }} - {{ $seaplane->endTime }}</div>
                                            <div class="text-uppercase">{{ $seaplane->code }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-5px">
                                <div class="form-group mb-0">
                                    <input type="number" data-price="{{ $seaplane->fareAdt }}" min="0" class="form-control border-0 round-0 bg-white h-auto py-12px" value="{{$info['seaplane_adultNum']}}" placeholder="Nhập số lượng người lớn" name="number_adt">
                                </div>
                                <span class="hidden">Bạn chưa chọn số lượng</span>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-5px">
                                <div class="form-group mb-0">
                                    <input type="number" data-price="{{ $seaplane->fareChd }}" min="0" class="form-control border-0 round-0 bg-white h-auto py-12px" value="{{$info['seaplane_childNum'] + $info['seaplane_childNum2']}}" placeholder="Nhập số lượng trẻ em" name="number_chd">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-5px">
                                <div class="d-flex align-items-center justify-content-between bg-white
                                    py-12px px-3 font-title-bold">
                                    <div>Vé người lớn</div>
                                    <div>{{ number_format($seaplane->fareAdt, 0, ',', '.') }} VND</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-5px">
                                <div class="d-flex align-items-center justify-content-between bg-white
                                    py-12px px-3 font-title-bold">
                                    <div>Vé trẻ em</div>
                                    <div>{{ number_format($seaplane->fareChd, 0, ',', '.') }} VND</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="d-flex align-items-center justify-content-between bg-white
                                    py-12px px-3 font-title-bold">
                                    <div>Tổng giá vé</div>
                                    <div class="text-success total">{{ number_format($seaplane->fareAdt, 0, ',', '.') }} VND</div>
                                </div>
                            </div>
                        </div>
                        @include('frontend.block.info_contact')
                        <div class="list-user-info placeholder-color">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="font-title font-22pt py-3">Thông tin hành khách</div>
                                <label class="d-flex align-items-center font-14pt m-0">
                                    <div class="mr-2">Danh sách đoàn</div>
                                    <div class="matter-checkbox mb-0">
                                        <input type="checkbox" name="is_list_customer">
                                        <span></span>
                                    </div>
                                </label>
                            </div>
                            <div id="list_customer">

                            </div>
                        </div>
                        @include('frontend.block.payment_method')
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3 combo-booking-detail-right">
                        <div class="payment-info">
                            <div class="payment-info-header">
                                <div class="font-title p-3 px-md-2 px-lg-3 px-xl-3 bg-white text-center font-18pt mb-1">Thông tin hủy chuyến bay</div>
                            </div>
                            <div class="payment-info-body">
                                <ul class="list-group">
                                    @foreach ($policies as $policy)
                                    <li class="list-group-item font-15pt d-flex align-items-center justify-content-between border-0 mb-1 py-2 px-3 px-md-2 px-lg-3">
                                        <div>{{ $policy->policy }}</div>
                                        <div>{{ $policy->content }}</div>
                                    </li>
                                    @endforeach
                                </ul>
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
                    <button type="button" class="btn btn-primary-gradient btn-block py-12px font-title btn-submit">Hoàn thành đặt vé</button>
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
    const show_list_customer = function(number) {
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
        const number_chd = $('input[name=number_chd]').val() != '' ? parseInt($('input[name=number_chd]').val()) : 0;
        const number_adt = parseInt($('input[name=number_adt]').val());
        const html = show_list_customer(number_chd + number_adt);
        $('#list_customer').html(html);
    });
    $('input[name=number_adt]').on('change', function() {
        const price_adt = $(this).data('price');
        const number_adt = parseInt($(this).val());
        const number_chd = $('input[name=number_chd]').val() != '' ? parseInt($('input[name=number_chd]').val()) : 0;
        const price_chd = $('input[name=number_chd]').data('price');
        const total = price_adt * number_adt + price_chd * number_chd;
        $('.total').html(accounting.formatMoney(total, '', 0, '.', ',') + ' VND');
        const html = show_list_customer(number_chd + number_adt);
        $('#list_customer').html(html);
    });
    $('input[name=number_chd]').on('change', function() {
        const price_chd = $(this).data('price');
        const number_chd = parseInt($(this).val());
        const number_adt = parseInt($('input[name=number_adt]').val());
        const price_adt = $('input[name=number_adt]').data('price');
        const total = price_adt * number_adt + price_chd * number_chd;
        $('.total').html(accounting.formatMoney(total, '', 0, '.', ',') + ' VND');
        const html = show_list_customer(number_chd + number_adt);
        $('#list_customer').html(html);
    });
    $('.btn-submit').on('click', function(e) {
        const number_chd = $('input[name=number_chd]').val();
        let error = 0;
        let error_customer_name = 0;
        const form = $(this).closest('form');
        const number_adt = $('input[name=number_adt]').val();
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
        const payment_method = $('input[name=payment_method]:checked').val();
        const city_id = form.find('select[name=city_id] option:selected').val();
        if (checkSelect(form, city_id, 'city_id') === 0) error++;
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