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
                            <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="" data-bank-content="<b>Ngân hàng thương mại cổ phần Ngoại thương Việt Nam – Vietcombank</b><br>Tên tài khoản: Công ty cổ phần thương mại Tachudu<br>Số tài khoản: 27910006262696<br>Chi nhánh: Hà Nội">
                                <div class="border-check-success border border-success position-absolute h-100"></div>
                                <input type="radio" name="select-bank-tranfer" value="vietcombank" hidden>
                                <img src="{{ asset('frontend/img/bank-logo/Vietcom.png') }}" class="img-fluid" style="height: 150px; object-fit: contain;">
                            </label>
                        </div>
                        <div class="col">
                            <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="" data-bank-content="<b>Ngân hàng TMCP Kỹ thương Việt Nam - Techcombank</b><br>Tên tài khoản: Phạm Thị Hằng<br>Số tài khoản: 19033377222020<br>Chi nhánh: Hoàn Kiếm">
                                <div class="border-check-success border border-success position-absolute h-100"></div>
                                <input type="radio" name="select-bank-tranfer" value="techcombank" hidden>
                                <img src="{{ asset('frontend/img/bank-logo/techcombank-logo.png') }}" class="img-fluid" style="height: 150px; object-fit: contain;">
                            </label>
                        </div>
                        <div class="col">
                            <label class="d-block position-relative select-bank-item cursor-pointer" data-bank-title="" data-bank-content="<b>Ngân hàng Đầu tư và Phát triển Việt Nam – BIDV</b><br>Tên tài khoản: Công ty cổ phần thương mại Tachudu<br>Số tài khoản: 27910006262696<br>Chi nhánh: Hà Nội">
                                <div class="border-check-success border border-success position-absolute h-100"></div>
                                <input type="radio" name="select-bank-tranfer" value="BIDV" hidden>
                                <img src="{{ asset('frontend/img/bank-logo/BIDV.png') }}" class="img-fluid" style="height: 150px; object-fit: contain;">
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
                        <span class="font-medium mr-2">Địa chỉ:</span>Tầng 4, tòa nhà Times Tower, số 35 Lê Văn Lương , Phường Nhân Chính, Quận Thanh Xuân, Thành phố Hà Nội
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
    <div class="col-sm-12 col-md-12 col-lg-12 checkbox-payment-method mb-5px">
        <div class="d-flex align-items-center justify-content-between pl-3 py-3 pr-2 border-bottom bg-white">
            <div>Thanh toán Online</div>
            <label class="matter-checkbox mb-0">
                <input type="checkbox" class="paymentMethodCheck officePayMethod" name="payment_method" value="4">
                <span></span>
            </label>
        </div>
        <div class="checkbox-payment-item">
            <div class="p-3 bg-white">
                <div class="vnpay_payment online_payment">
                    <img src="{{ asset('frontend/img/bank-logo/vnpay.png') }}" class="img-fluid" style="height: 150px; object-fit: contain;">
                    <div style="text-align: center;">Thanh toán VNPay</div>
                </div>
            </div>
        </div>
    </div>
</div>