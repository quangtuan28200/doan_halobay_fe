@extends('frontend.layouts.layout')
@section('body')
<div class="booking-fail">
    <div class="container">
        <div class="booking-success-container bg-white mt-2 p-4">
            <div class="text-center">
                <img src="{{ asset('frontend/img/booking-failed-img.svg') }}" class="img-fluid mb-4">
                <div class="col-sm-12 col-md-10 col-lg-7 mx-auto">
                    <div class="font-title font-sm-title text-primary mb-3">Đặt dịch vụ không thành công!</div>
                    <p class="mb-0">Cảm ơn<span class="font-title ml-2">{{ $full_name }} !</span></p>
                    <p class="mb-0">Quy trình đặt dịch vụ của quý khách không thành công. Xin vui lòng thử lại hoặc liên hệ với Halobay theo thông tin sau để được hỗ trợ:</p>
                    <div class="font-title font-20pt my-3">
                        Công ty CP Thương mại Dịch vụ Halobay
                    </div>
                    <div class="contact-form-info">
                        <div class="contact-form-info-item d-flex align-items-center mb-2">
                            <i class="fal fa-phone-volume contact-form-icon rounded-circle bg-primary text-white d-flex align-items-center justify-content-center icon-contact-rotate mr-2"></i>
                            <span class="font-medium mr-2">Hotline:</span><span class="text-underline">0902.555.369</span>
                        </div>
                        <div class="contact-form-info-item d-flex align-items-center mb-2">
                            <i class="fal fa-envelope contact-form-icon rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2"></i>
                            <span class="font-medium mr-2">Email:</span>booking@halobay.vn
                        </div>
                        <div class="contact-form-info-item d-flex mb-2">
                            <i class="fal fa-map-marker-alt contact-form-icon rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2"></i>
                            <span class="font-medium text-nowrap mr-2">Địa chỉ:</span>Tầng 2, Tòa T25T2, Nguyễn Thị Thập, Quận Cầu Giấy, Thành phố Hà Nội
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection