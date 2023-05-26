@extends('frontend.layouts.layout')
@section('body')
<section class="contact">
    <div>
        <img src="{{ asset('frontend/img/introduce-banner.png') }}" class="img-fluid w-100">
    </div>
    <div class="container">
        <div class="row position-relative bg-white contact-container no-gutters">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="contact-form bg-white py-4 px-3">
                    <div class="font-title border-bottom font-md-title pb-3">Liên hệ với chúng tôi</div>
                    <div class="font-medium my-3">Văn phòng Hà Nội</div>
                    <div class="contact-form-info">
                        <div class="contact-form-info-item mb-2">
                            <i class="fal fa-map-marker-alt contact-form-icon rounded-circle bg-primary text-white mr-2"></i>
                            <span class="font-medium text-nowrap mr-2">Địa chỉ:</span>Tầng 4, tòa nhà Times Tower, số 35 Lê Văn Lương , Phường Nhân Chính, Quận Thanh Xuân, Thành phố Hà Nội, Việt Nam
                        </div>
                        <div class="contact-form-info-item mb-2">
                            <i class="fal fa-phone-volume contact-form-icon rounded-circle bg-primary text-white icon-contact-rotate mr-2"></i>
                            <span class="font-medium text-nowrap mr-2">Hotline:</span>0902.555.369
                        </div>
                        <div class="contact-form-info-item mb-2">
                            <i class="fal fa-envelope contact-form-icon rounded-circle bg-primary text-white mr-2"></i>
                            <span class="font-medium text-nowrap mr-2">Email:</span>Halobay@gmail.com
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <!-- <div class="contact-iframe">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3728.933184652391!2d106.69524941492935!3d20.834404386103913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a7a9fb6dd61bd%3A0x85762a537bab59c!2zMjc1IEzhuqFjaCBUcmF5LCDEkOG6sW5nIEdpYW5nLCBOZ8O0IFF1eeG7gW4sIEjhuqNpIFBow7JuZw!5e0!3m2!1svi!2s!4v1614584293894!5m2!1svi!2s" class="w-100" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div> -->
                <div class="contact-iframe" style="width: 100%">
                    <iframe width="100%" height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=s%E1%BB%91%2035%20L%C3%AA%20V%C4%83n%20L%C6%B0%C6%A1ng%20,%20Ph%C6%B0%E1%BB%9Dng%20Nh%C3%A2n%20Ch%C3%ADnh,%20Qu%E1%BA%ADn%20Thanh%20Xu%C3%A2n,%20Th%C3%A0nh%20ph%E1%BB%91%20H%C3%A0%20N%E1%BB%99i,%20Vi%E1%BB%87t%20Nam+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                        <a href="https://www.maps.ie/distance-area-calculator.html">measure area map</a>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')

@endsection