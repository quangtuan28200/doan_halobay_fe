<header>
    <div class="top-bar text-white bg-primary-gradient py-2">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="top-bar-left">
                    Chào mừng đến HaloBay!
                </div>
                <div class="top-bar-right">
                    <a href="tel:+84902555369" class="top-bar-link text-white text-decoration-none d-flex align-items-center">
                        <i class="fas fa-phone-alt font-14pt d-flex align-items-center justify-content-center rounded-circle mr-2"></i>
                        <span>0902.555.369</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-0">
        <div class="container px-sm-3 px-md-3">
            <a class="navbar-brand py-0" href="{{ url('/') }}">
                <img src="{{ asset('frontend/img/logo-main.png') }}" class="img-fluid logo-nav">
            </a>
            <button class="navbar-toggler border-0 bg-transparent no-active-focus p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-line bg-primary d-block"></span>
                <span class="navbar-toggler-line bg-primary d-block"></span>
                <span class="navbar-toggler-line bg-primary d-block"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item d-flex align-items-center justify-content-center">
                        <a class="nav-link font-medium text-primary px-3 py-4" href="{{ route('about-us') }}">Giới thiệu</a>
                    </li>
                    <li class="nav-item d-flex align-items-center justify-content-center">
                        <a class="nav-link font-medium text-primary px-3" href="{{ route('news') }}">Tin tức</a>
                    </li> -->
                    @foreach($menu_header as $header)
                    <li class="nav-item dropdown d-flex align-items-center justify-content-center">
                        @if ($header->children == null)
                        <a class="nav-link font-medium text-primary px-3 py-4" href="{{ $header->link }}">{{ $header->name }}</a>
                        @else
                        <a class="nav-link font-medium text-primary dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $header->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border: 1px solid #eee;">
                            @foreach($header->children as $header_child)
                            <a class="dropdown-item" href="{{ $header_child->link }}"> {{ $header_child->name }}</a>
                            @endforeach
                            <!-- <a class="dropdown-item" href="thong-tin-chuyen-khoan">Thông tin chuyển khoản</a>
                            <a class="dropdown-item" href="huong-dan-su-dung">Hướng dẫn sử dụng</a> -->
                        </div>
                        @endif
                    </li>
                    @endforeach
                    @if (!$user)
                    <li class="nav-item d-flex align-items-center justify-content-center">
                        <a class="nav-link font-medium text-primary px-3" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
                    <li class="nav-item d-flex align-items-center justify-content-center">
                        <a class="nav-link font-medium text-primary px-3" href="{{ route('signup') }}">Đăng ký</a>
                    </li>
                    @else
                    <li class="nav-item dropdown dropdown-user-account d-flex align-items-center justify-content-center">
                        <a class="nav-link font-medium text-primary pr-0 dropdown-slide-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="user-name">{{ $user->fullName }}</span> <img src="{{ $user->imageUrl ? asset($user->imageUrl) : asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rounded-circle shadow-sm border user-avatar object-fit-cover ml-2">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border: 1px solid #eee;">
                            <div class="dropdown-item text-center">
                                <p class="mb-1 font-medium text-primary font-16pt">Hi! {{ $user->firstName }}</p>
                                <p class="mb-0">{{ $user->email }}</p>
                            </div>
                            <a class="dropdown-item text-dark text-decoration-none" href="{{ route('account_detail') }}">Tài khoản của tôi</a>
                            <!-- <a class="dropdown-item text-dark text-decoration-none" href="history-booking-hotel.html">Lịch sử đặt</a>
                            <a class="dropdown-item text-dark text-decoration-none" href="account-rated.html">Bài đánh giá của tôi</a>
                            <a class="dropdown-item text-dark text-decoration-none" href="account-question-answer.html">Bài hỏi đáp của tôi</a>
                            <a class="dropdown-item text-dark text-decoration-none" href="account-wishlist.html">Yêu thích</a> -->
                            <div class="dropdown-item p-0">
                                <button class="btn btn-primary btnLogout py-3 rounded-0 btn-block logout">Đăng xuất</button>
                            </div>
                        </div>
                    </li>
                    @endif

                </ul>
            </div>

        </div>
    </nav>
</header>