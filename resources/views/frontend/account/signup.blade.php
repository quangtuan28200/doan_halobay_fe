@extends('frontend.layouts.layout')
@section('body')
<section class="signup py-5">
    <div class="container">
        <div class="list-news-main-title font-md-title d-flex align-items-center justify-content-between border-bottom pb-2 mb-4">
            <span class="font-title-bold">Đăng ký ngay</span>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                <div class="signup-benefit bg-white text-center h-100 py-4 px-3">
                    <img src="{{ asset('frontend/img/sign-in.svg') }}" class="img-fluid">
                    <div class="benefit-item-title text-uppercase font-title font-20pt my-4">đăng ký miễn phí</div>
                    <div class="benefit-item-content">
                        Dù là Đăng ký Đại lý hay Cộng tác viên, bạn cũng đều không mất bất cứ khoản chi phí nào. Đăng ký
                        miễn phí, tại sao không?
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                <div class="signup-benefit bg-white text-center h-100 py-4 px-3">
                    <img src="{{ asset('frontend/img/christmas-present.svg') }}" class="img-fluid">
                    <div class="benefit-item-title text-uppercase font-title font-20pt my-4">ưu đãi hấp dẫn</div>
                    <div class="benefit-item-content">
                        Chương trình ưu đãi không giới hạn thời gian dành riêng cho hệ thống thành viên của chúng tôi
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                <div class="signup-benefit bg-white text-center h-100 py-4 px-3">
                    <img src="{{ asset('frontend/img/business-and-finance.svg') }}" class="img-fluid">
                    <div class="benefit-item-title text-uppercase font-title font-20pt my-4">vươn tới thành công</div>
                    <div class="benefit-item-content">
                        Hãy đi cùng chúng tôi. Chúng tôi luôn đồng hành
                        Cùng bạn để đi đến thành công!
                    </div>
                </div>
            </div>
        </div>
        <div class="list-news-main-title font-md-title d-flex align-items-center justify-content-between border-bottom pb-2 mb-4 mt-2">
            <span class="font-title-bold">Lựa chọn hình thức liên kết</span>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                <div class="signup-benefit bg-white text-center h-100 py-4 px-3">
                    <img src="{{ asset('frontend/img/verified.svg') }}" class="img-fluid">
                    <div class="benefit-item-title text-uppercase font-title font-20pt my-4">Đại lý du lịch</div>
                    <div class="benefit-item-content mb-4">
                        Bạn sẽ nhận được chính sách ưu đãi dành riêng cho Đại lý du lịch sẽ được gửi
                        đến bạn khi đăng ký hoàn tất.
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">
                        <a href="{{ route('signup_agency') }}" class="btn btn-primary-gradient font-title btn-block py-12px">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                <div class="signup-benefit bg-white text-center h-100 py-4 px-3">
                    <img src="{{ asset('frontend/img/verified.svg') }}" class="img-fluid">
                    <div class="benefit-item-title text-uppercase font-title font-20pt my-4">Cộng tác viên</div>
                    <div class="benefit-item-content mb-4">
                        Bạn sẽ nhận được chính sách ưu đãi dành riêng cho Cộng tác viên du lịch sẽ
                        được gửi đến bạn khi đăng ký hoàn tất.
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">
                        <a href="{{ route('signup_collaborators') }}" class="btn btn-primary-gradient font-title btn-block py-12px">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                <div class="signup-benefit bg-white text-center h-100 py-4 px-3">
                    <img src="{{ asset('frontend/img/verified.svg') }}" class="img-fluid">
                    <div class="benefit-item-title text-uppercase font-title font-20pt my-4">Người dùng</div>
                    <div class="benefit-item-content mb-4">
                        Bạn sẽ nhận được chính sách ưu đãi dành riêng cho Người dùng sẽ được gửi
                        đến bạn khi đăng ký hoàn tất.
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">
                        <a href="{{ route('signup_user_normal') }}" class="btn btn-primary-gradient font-title btn-block py-12px">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')

@endsection