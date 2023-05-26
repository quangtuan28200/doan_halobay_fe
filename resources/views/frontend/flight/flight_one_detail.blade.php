@extends('frontend.layouts.layout')
@section('body')
<section class="combo-booking-list">
    <div class="airplane-booking-info py-3">
        <div class="container">
            <form action="{{ route('book_flight_one') }}" method="POST">
                {{ csrf_field() }}
                <div class="font-title font-md-title font-title-bold">Chi tiết đặt vé</div>
                <div class="dropdown-divider mb-3"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-9 airplane-booking-info-left">
                        <div class="row row-small-space">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="airplane-info-detail w-100">
                                    <div class="airplane-ticket-info-header w-100 bg-white mb-5px">
                                        <div class="d-flex align-items-center justify-content-between p-2">
                                            <div class="text-center d-flex align-items-center flex-wrap">
                                                <div class="font-title">{{ $lists[0]['startPoint'] }}</div>
                                                <img src="{{ asset('frontend/img/airplane-icon.png') }}" class="img-fluid mx-4" width="25">
                                                <div class="font-title">{{ $lists[0]['endPoint'] }}</div>
                                            </div>
                                            <img src="{{ asset($lists[0]['logo']) }}" class="img-fluid" width="100">
                                        </div>
                                        <input type="hidden" name="session" value="{{ $flight_one->session }}">
                                        <input type="hidden" name="flight_value_one" value="{{ $flight_one->listFareData[0]->listFlight[0]->flightValue }}">
                                        <input type="hidden" name="flight_id_one" value="{{ $flight_one->listFareData[0]->fareDataId }}">
                                        <input type="hidden" name="flight_leg_one" value="{{ $flight_one->listFareData[0]->leg }}">
                                        <div class="airplane-ticket-sub-info d-flex align-items-center justify-content-between w-100 p-2 bg-white">
                                            <span>{{ Carbon\Carbon::parse($lists[0]['start_date'])->format('d/m/Y') }}</span>
                                            <span>{{ Carbon\Carbon::parse($lists[0]['start_date'])->format('H:i') }}</span>
                                            <span>{{ $lists[0]['flightNumber'] }}</span>
                                        </div>
                                    </div>
                                    <div class="airplane-ticket-info-body w-100">
                                        <div class="airplane-ticket-info-item w-100 d-flex align-items-center justify-content-between bg-white mb-5px p-2">
                                            <span>Giá vé người lớn</span>
                                            <span class="font-title-bold">{{ number_format($flight_one->listFareData[0]->fareAdt, 0, ',', '.') }} VND</span>
                                        </div>
                                        <div class="airplane-ticket-info-item w-100 d-flex align-items-center justify-content-between bg-white mb-5px p-2">
                                            <span>Giá vé trẻ em</span>
                                            <span class="font-title-bold">{{ number_format($flight_one->listFareData[0]->fareChd, 0, ',', '.') }} VND</span>
                                        </div>
                                        <div class="airplane-ticket-info-item w-100 d-flex align-items-center justify-content-between bg-white mb-5px p-2">
                                            <span>Giá vé em bé</span>
                                            <span class="font-title-bold">{{ number_format($flight_one->listFareData[0]->fareInf, 0, ',', '.') }} VND</span>
                                        </div>
                                        <div class="airplane-ticket-info-item w-100 d-flex align-items-center justify-content-between bg-white mb-5px p-2">
                                            <span>Thuế + phí</span>
                                            <span class="font-title-bold">{{ number_format($flight_one->total_fee_service, 0, ',', '.') }} VND</span>
                                        </div>
                                        <div class="airplane-ticket-info-item w-100 d-flex align-items-center justify-content-between bg-white mb-5px p-2">
                                            <span>Hành Lý / {{ $flight_one->listFareData[0]->listFlight[0]->listSegment[0]->handBaggage }}</span>
                                            <span class="font-title-bold">Miễn phí</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="row placeholder-color airplane-contact-info row-small-space">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="font-title font-22pt py-3">Thông tin liên hệ</div>
                                    <label class="d-flex align-items-center font-14pt mb-0">
                                        <div class="mr-2">Yêu cầu xuất hóa đơn</div>
                                        <div class="matter-checkbox mb-0">
                                            <input type="checkbox" name="is_vat">
                                            <span></span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group mb-5px">
                                    <select class="selectpicker form-control h-auto py-12px bg-white" name="contact_gender">
                                        <option value="0">Quý danh</option>
                                        <option value="1">Ông</option>
                                        <option value="2">Bà</option>
                                    </select>
                                    <span class="hidden">Bạn chưa chọn quý danh</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group mb-5px">
                                    <div class="input-group">
                                        <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" placeholder="Họ (Yêu cầu: Viết không dấu)" name="first_name_contact">
                                    </div>
                                    <span class="hidden">Bạn chưa nhập họ</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-5">
                                <div class="form-group mb-5px">
                                    <div class="input-group">
                                        <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" placeholder="Tên và tên đệm(Yêu cầu: Viết không dấu)" name="last_name_contact">
                                    </div>
                                    <span class="hidden">Bạn chưa nhập tên và tên đệm</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group mb-5px">
                                    <div class="input-group">
                                        <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" placeholder="Điện thoại" name="phone_number_contact">
                                    </div>
                                    <span class="hidden">Bạn chưa nhập số điện thoại</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group mb-5px">
                                    <div class="input-group">
                                        <input type="email" class="form-control border-0 h-auto no-active-focus py-12px" placeholder="Email" name="email_contact">
                                    </div>
                                    <span class="hidden">Bạn chưa nhập email liên hệ</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <textarea class="form-control border-0 rounded-0" placeholder="Địa chỉ (Không bắt buộc phải nhập)" rows="4" name="address_contact"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 vat hide">
                                <div class="form-group mb-5px">
                                    <div class="input-group">
                                        <input type="number" class="form-control border-0 h-auto no-active-focus py-12px" placeholder="Mã số thuế (*)" name="tax_code">
                                    </div>
                                    <span class="hidden">Bạn chưa nhập mã số thuế</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 vat hide">
                                <div class="form-group mb-5px">
                                    <div class="input-group">
                                        <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" placeholder="Tên công ty (*)" name="company_name">
                                    </div>
                                    <span class="hidden">Bạn chưa nhập tên công ty</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 vat hide">
                                <div class="form-group mb-5px">
                                    <div class="input-group">
                                        <input type="email" class="form-control border-0 h-auto no-active-focus py-12px" placeholder="Địa chỉ (*)" name="company_address">
                                    </div>
                                    <span class="hidden">Bạn chưa nhập địa chỉ công ty</span>
                                </div>
                            </div>
                        </div>
                        <div class="placeholder-color list-user-info">
                            @for ($i=0; $i < $flight_one->listFareData[0]->adt; $i ++)
                            <div class="row row-small-space user-info-item">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="font-title font-22pt py-3">Người lớn {{ $i + 1 }}</div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group mb-5px">
                                        <select class="selectpicker form-control h-auto py-12px bg-white" name="gender[]">
                                            <option>Quý danh</option>
                                            <option value="1">Ông</option>
                                            <option value="2">Bà</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4 mb-5px">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control border-0 h-auto py-12px" placeholder="Họ (Yêu cầu: Viết không dấu)" name="first_name[]">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5 col-lg-5 mb-5px">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control border-0 h-auto py-12px" placeholder="Tên và tên đệm (Yêu cầu: Viết không dấu)" name="last_name[]">
                                    </div>
                                </div>
                                <input type="hidden" name="type[]" value="ADT">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group mb-5px">
                                        <select class="form-control h-auto py-12px bg-white add_handbags" name="handbags_one[]">
                                            <option value="0" data-price="0">Hành lý ký gửi mua thêm</option>
                                            @if ($hand_bag_one->message == " " || $hand_bag_one->message == null)
                                            @foreach ($hand_bag_one->listBaggage as $list)
                                            <option value="{{ $list->Airline . '-' . $list->Leg . '-' . $list->Route . '-' . $list->Code . '-' . $list->Currency . '-' . $list->Name . '-' . $list->Price . '-' . $list->Value }}" data-price="{{ $list->Price }}">{{ $list->Name . ' (' . number_format($list->Price, 0, ',', '.') . ' VND)' }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endfor
                            @for ($i=0; $i < $flight_one->listFareData[0]->chd; $i ++)
                            <div class="row row-small-space user-info-item">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="font-title font-22pt py-3">Trẻ em {{ $i + 1 }}</div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group mb-5px">
                                        <select class="selectpicker form-control h-auto py-12px bg-white" name="gender[]">
                                            <option>Quý danh</option>
                                            <option value="1">Ông</option>
                                            <option value="2">Bà</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4 mb-5px">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control border-0 h-auto py-12px" placeholder="Họ (Yêu cầu: Viết không dấu)" name="first_name[]">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5 col-lg-5 mb-5px">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control border-0 h-auto py-12px" placeholder="Tên và tên đệm (Yêu cầu: Viết không dấu)" name="last_name[]">
                                    </div>
                                </div>
                                <input type="hidden" name="type[]" value="CHD">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group mb-5px">
                                        <select class="form-control h-auto py-12px bg-white add_handbags" name="handbags_one[]">
                                            <option value="0" data-price="0">Hành lý ký gửi mua thêm</option>
                                            @foreach ($hand_bag_one->listBaggage as $list)
                                            <option value="{{ $list->Airline . '-' . $list->Leg . '-' . $list->Route . '-' . $list->Code . '-' . $list->Currency . '-' . $list->Name . '-' . $list->Price . '-' . $list->Value }}" data-price="{{ $list->Price }}">{{ $list->Name . ' (' . number_format($list->Price, 0, ',', '.') . ' VND)' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endfor
                            @for ($i=0; $i < $flight_one->listFareData[0]->inf; $i ++)
                            <div class="row row-small-space user-info-item">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="font-title font-22pt py-3">Em bé {{ $i + 1 }}</div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group mb-5px">
                                        <select class="selectpicker form-control h-auto py-12px bg-white" name="gender[]">
                                            <option>Quý danh</option>
                                            <option value="1">Ông</option>
                                            <option value="2">Bà</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4 mb-5px">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control border-0 h-auto py-12px" placeholder="Họ (Yêu cầu: Viết không dấu)" name="first_name[]">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5 col-lg-5 mb-5px">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control border-0 h-auto py-12px" placeholder="Tên và tên đệm (Yêu cầu: Viết không dấu)" name="last_name[]">
                                    </div>
                                </div>
                                <input type="hidden" name="type[]" value="INF">
                            </div>
                            @endfor
                        </div>
                        @include('frontend.block.payment_method')
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3 airplane-booking-right">
                        <div class="payment-info">
                            <div class="payment-info-header">
                                <div class="font-title p-3 bg-white text-center font-18pt mb-1">Thông tin thanh toán</div>
                            </div>
                            <div class="payment-info-body">
                                <ul class="list-group">
                                    <div class="py-2 px-3 font-title bg-white">Giá vé chuyến đi</div>
                                    <li class="list-group-item font-15pt d-flex align-items-center justify-content-between border-0 py-2 px-3 mt-1 mb-5px">
                                        <div>Giá vé người lớn</div>
                                        <div>{{ number_format($flight_one->listFareData[0]->fareAdt, 0, ',', '.') }} VND</div>
                                    </li>
                                    <li class="list-group-item font-15pt d-flex align-items-center justify-content-between border-0 py-2 px-3 mb-5px">
                                        <div>Giá vé trẻ em</div>
                                        <div>{{ number_format($flight_one->listFareData[0]->fareChd, 0, ',', '.') }} VND</div>
                                    </li>
                                    <li class="list-group-item font-15pt d-flex align-items-center justify-content-between border-0 py-2 px-3 mb-5px">
                                        <div>Giá vé em bé</div>
                                        <div>{{ number_format($flight_one->listFareData[0]->fareInf, 0, ',', '.') }} VND</div>
                                    </li>
                                    <li class="list-group-item font-15pt d-flex align-items-center justify-content-between border-0 py-2 px-3 mb-5px">
                                        <div>Thuế phí</div>
                                        <div>{{ number_format($flight_one->total_fee_service, 0, ',', '.') }} VND</div>
                                    </li>
                                    <li class="list-group-item font-15pt d-flex align-items-center justify-content-between border-0 py-2 px-3 mb-5px">
                                        <div>Hành lý / {{ $flight_one->listFareData[0]->listFlight[0]->listSegment[0]->handBaggage }}</div>
                                        <div>Miễn phí</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="paymanet-info-footer">
                                <div class="d-flex align-items-center bg-white justify-content-between mb-1 py-2 px-3">
                                    <div>Tổng</div>
                                    <div class="text-success font-title total" data-price="{{ $flight_one->total }}">{{ number_format(($flight_one->total), 0, ',', '.') }} VND</div>
                                </div>
                                <div class="p-3 text-danger bg-white text-right mb-5px">* Giá bao gồm thuế và phí</div>
                            </div>
                        </div>
                        <div class="payment-info mb-1">
                            <div class="payment-info-header">
                                <div class="font-title p-3 bg-white text-center font-18pt border-bottom">Điều kiện vé chuyến đi</div>
                            </div>
                            <div class="payment-info-body p-3 bg-white">
                                @foreach ($fare_conditions as $val)
                                    <h6>{{ $val->nameAirline }}</h6>
                                    {!! $val->conditions !!}
                                @endforeach
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
<script>
    $('body').on('change', '.add_handbags', function () {
        const total = $('.total').data('price');
        let price;
        $('.add_handbags').each(function (key, value) {
            price = $('option:selected', value).data('price');
        })
        $('.total').html(accounting.formatMoney(total + price, '', 0, '.', ',') + ' VND');
    });
    $('body').on('click', '.btn-submit', function() {
        let error = 0; 
        const form = $(this).closest('form');
        const first_name_contact = form.find('input[name=first_name_contact]').val();
        if (checkInput(form, first_name_contact, 'first_name_contact') === 0) error++;
        const last_name_contact = form.find('input[name=last_name_contact]').val();
        if (checkInput(form, last_name_contact, 'last_name_contact') === 0) error++;
        const phone_number_contact = form.find('input[name=phone_number_contact]').val();
        if (checkInput(form, phone_number_contact, 'phone_number_contact') === 0) error++;
        const email_contact = form.find('input[name=email_contact]').val();
        if (checkInput(form, email_contact, 'email_contact') === 0) error++;
        const contact_gender = form.find('select[name=contact_gender] option:selected').val();
        if (checkSelect(form, contact_gender, 'contact_gender') === 0) error++;
        const payment_method = $('input[name=payment_method]:checked').val();
        $('.user-info-item').each(function() {
            const gender = $(this).find('select[name=gender] option:selected').val();
        });
        if (error !== 0) {
            $("html,body").animate({
                scrollTop: $('.airplane-contact-info').offset().top, 
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