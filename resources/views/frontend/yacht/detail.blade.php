@extends('frontend.layouts.layout')
@section('body')
<div class="backdrop backdrop-toggle-event position-fixed"></div>
<div class="backdrop hotel-booking-backdrop position-fixed"></div>
<div class="backdrop yacht-rule-backdrop position-fixed"></div>
<div class="yacht-rule-container smooth-transition position-fixed d-flex align-items-center">
    <div class="yacht-rule-close cursor-pointer bg-primary text-white border border-white border-right-0 align-self-start position-relative py-2 px-3">
        <i class="fal fa-times"></i>
    </div>
    <div class="yacht-rule-item bg-white py-5 px-3" id="info_room">

    </div>
</div>
<div class="hotel-rated-container smooth-transition position-fixed d-flex align-items-center">
    <div class="hotel-rated-close cursor-pointer bg-primary text-white border border-white border-right-0 align-self-start position-relative py-2 px-3">
        <i class="fal fa-times"></i>
    </div>
    <div class="hotel-booking-item bg-gray w-100 h-100 py-5 px-3">
        <div class="font-title-bold font-sm-title mb-2">Đánh giá</div>
        <div class="dropdown-divider mb-3"></div>
        <div>
            <div class="row no-gutters">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="bg-primary-gradient text-white font-20pt text-center d-flex align-items-center justify-content-center h-100 p-3">
                        <div>
                            <div class="font-title-bold">4.4 / 5</div>
                            <div class="font-title-bold my-2">Tuyệt vời</div>
                            <div class="font-15pt">10 đánh giá</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="bg-white p-3">
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Tuyệt vời</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">9</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Rất tốt</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">1</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Bình thường</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">0</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Tạm được</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">0</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Không thích</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="font-title-bold font-20pt mb-2 mt-3">Đánh giá của bạn</div>
        <div class="row rated-emotion row-medium-space">
            <div class="col">
                <div class="rated-emotion-item text-center active font-14pt">
                    <img src="{{ asset('frontend/img/rated-emo-sad.png') }}" class="img-fluid mb-2 mx-auto">
                    <img src="{{ asset('frontend/img/rated-emo-sad-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                    <div>Không thích</div>
                </div>
            </div>
            <div class="col">
                <div class="rated-emotion-item text-center font-14pt cursor-pointer">
                    <img src="{{ asset('frontend/img/rated-emo-sceptic.png') }}" class="img-fluid mb-2 mx-auto">
                    <img src="{{ asset('frontend/img/rated-emo-sceptic-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                    <div>Tạm được</div>
                </div>
            </div>
            <div class="col">
                <div class="rated-emotion-item text-center font-14pt cursor-pointer">
                    <img src="{{ asset('frontend/img/rated-emo-happy.png') }}" class="img-fluid mb-2 mx-auto">
                    <img src="{{ asset('frontend/img/rated-emo-happy-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                    <div>Bình thường</div>
                </div>
            </div>
            <div class="col">
                <div class="rated-emotion-item text-center font-14pt cursor-pointer">
                    <img src="{{ asset('frontend/img/rated-emo-good.png') }}" class="img-fluid mb-2 mx-auto">
                    <img src="{{ asset('frontend/img/rated-emo-good-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                    <div>Rất tốt</div>
                </div>
            </div>
            <div class="col">
                <div class="rated-emotion-item text-center font-14pt cursor-pointer">
                    <img src="{{ asset('frontend/img/rated-emo-excellen.png') }}" class="img-fluid mb-2 mx-auto">
                    <img src="{{ asset('frontend/img/rated-emo-excellen-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                    <div>Tuyệt vời</div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                <div class="form-group mb-5px">
                    <div class="form-group mb-0">
                        <label class="matter-textfield-filled d-block border-0">
                            <input type="text" placeholder=" " />
                            <span>Tên của bạn</span>
                        </label>
                    </div>
                </div>
                <div class="form-group mb-5px">
                    <div class="form-group mb-0">
                        <label class="matter-textfield-filled d-block border-0">
                            <input type="Email" placeholder=" " />
                            <span>Email</span>
                        </label>
                    </div>
                </div>
                <div class="form-group mb-5px">
                    <div class="form-group mb-0">
                        <label class="matter-textfield-filled d-block border-0">
                            <input type="number" placeholder=" " />
                            <span>Số điện thoại</span>
                        </label>
                    </div>
                </div>
                <div class="form-group mb-5px">
                    <div class="form-group mb-0">
                        <label class="matter-textfield-filled d-block border-0">
                            <textarea placeholder=" " rows="4"></textarea>
                            <span>Nội dung đánh giá</span>
                        </label>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-primary-gradient font-title px-5">Gửi đánh giá</button>
                </div>
            </div>
        </div>
        <div class="font-title-bold font-20pt mb-2 mt-3">Đánh giá khách hàng</div>
        <div class="list-rated combo-rated">
            <div class="rated-item bg-white px-3 py-2 mb-1">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="font-title mr-2">4.4/5</span>
                        <span class="text-success">Rất tốt</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
            </div>
            <div class="rated-item bg-white px-3 py-2 mb-1">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="font-title mr-2">4.4/5</span>
                        <span class="text-success">Rất tốt</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
            </div>
            <div class="rated-item bg-white px-3 py-2 mb-1">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="font-title mr-2">4.4/5</span>
                        <span class="text-success">Rất tốt</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
            </div>
            <div class="rated-item bg-white px-3 py-2 mb-1">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="font-title mr-2">4.4/5</span>
                        <span class="text-success">Rất tốt</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
            </div>
            <div class="rated-item bg-white px-3 py-2 mb-1">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="font-title mr-2">4.4/5</span>
                        <span class="text-success">Rất tốt</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
            </div>
        </div>
    </div>
</div>
<div class="hotel-rated-list-sidebar smooth-transition position-fixed d-flex align-items-center">
    <div class="hotel-rated-list-close cursor-pointer bg-primary text-white border border-white border-right-0 align-self-start position-relative py-2 px-3">
        <i class="fal fa-times"></i>
    </div>
    <div class="hotel-booking-item bg-gray w-100 h-100 py-5 px-3">
        <div class="font-title-bold font-sm-title mb-2">Đánh giá</div>
        <div class="dropdown-divider mb-3"></div>
        <div>
            <div class="row no-gutters">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="bg-primary-gradient text-white font-20pt text-center d-flex align-items-center justify-content-center h-100 p-3">
                        <div>
                            <div class="font-title-bold">4.4 / 5</div>
                            <div class="font-title-bold my-2">Tuyệt vời</div>
                            <div class="font-15pt">10 đánh giá</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="bg-white p-3">
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Tuyệt vời</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">9</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Rất tốt</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">1</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Bình thường</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">0</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Tạm được</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">0</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Không thích</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <div class="font-title-bold font-20pt mb-2 mt-3">Đánh giá của bạn</div>
            <button class="btn p-0 border-0 bg-transparent text-primary edit-rated font-14pt">Chỉnh sửa đánh giá</button>
        </div>
        <div class="rated-item bg-white px-3 py-2 mb-1">
            <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                <div class="rated-item-user d-flex align-items-center">
                    <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                    <div class="rated-item-user-info">
                        <span class="font-title text-capitalize">huyen truong</span>
                        <span>12/01/2021</span>
                    </div>
                </div>
                <div class="rated-item-info font-18pt">
                    <span class="font-title mr-2">4.4/5</span>
                    <span class="text-success">Rất tốt</span>
                </div>
            </div>
            <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
        </div>
        <div class="font-title-bold font-20pt mb-2 mt-3">Đánh giá khách hàng</div>
        <div class="list-rated combo-rated">
            <div class="rated-item bg-white px-3 py-2 mb-1">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="font-title mr-2">4.4/5</span>
                        <span class="text-success">Rất tốt</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
            </div>
            <div class="rated-item bg-white px-3 py-2 mb-1">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="font-title mr-2">4.4/5</span>
                        <span class="text-success">Rất tốt</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
            </div>
            <div class="rated-item bg-white px-3 py-2 mb-1">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="font-title mr-2">4.4/5</span>
                        <span class="text-success">Rất tốt</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
            </div>
            <div class="rated-item bg-white px-3 py-2 mb-1">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="font-title mr-2">4.4/5</span>
                        <span class="text-success">Rất tốt</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
            </div>
            <div class="rated-item bg-white px-3 py-2 mb-1">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="font-title mr-2">4.4/5</span>
                        <span class="text-success">Rất tốt</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
            </div>
        </div>
    </div>
</div>
<div class="question-answer-sidebar smooth-transition position-fixed d-flex align-items-center">
    <div class="question-answer-sidebar-close cursor-pointer bg-primary text-white border border-white border-right-0 align-self-start position-relative py-2 px-3">
        <i class="fal fa-times"></i>
    </div>
    <div class="hotel-booking-item bg-gray w-100 h-100 py-5 px-3">
        <div class="font-title-bold font-sm-title mb-2">Hỏi đáp</div>
        <div class="dropdown-divider mb-3"></div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                <div class="form-group mb-5px">
                    <label class="matter-textfield-filled d-block border-0">
                        <input type="text" placeholder=" ">
                        <span>Tên của bạn</span>
                    </label>
                </div>
                <div class="form-group mb-5px">
                    <label class="matter-textfield-filled d-block border-0">
                        <input type="text" placeholder=" ">
                        <span>Email</span>
                    </label>
                </div>
                <div class="form-group mb-5px">
                    <label class="matter-textfield-filled d-block border-0">
                        <input type="number" placeholder=" ">
                        <span>Số điện thoại</span>
                    </label>
                </div>
                <div class="form-group mb-5px">
                    <label class="matter-textfield-filled d-block border-0">
                        <textarea placeholder=" " rows="4"></textarea>
                        <span>Nội dung hỏi đáp</span>
                    </label>
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-primary-gradient font-title px-5 mb-3">Gửi câu hỏi</button>
                </div>
            </div>
        </div>
        <div class="question-answer-item bg-white">
            <div class="question-item border-bottom p-3">
                <div class="rated-item-user d-flex align-items-center  justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <button class="btn bg-transparent p-0 border-0 text-primary text-underline edit-question-answer">Chỉnh sửa hỏi đáp</button>
                </div>
                <div class="question-item-content">
                    <p class="mb-0 mt-2">Cho em hỏi thuê xe máy luôn của khách sạn thì thủ tục thế nào ạ ?</p>
                </div>
            </div>
            <div class="answer-item p-3">
                Cảm ơn bạn đã gửi câu hỏi cho chúng tôi, chúng tôi trả lời như sau: Hiện khách sạn không có xe máy cho thuê, nếu bạn cần thuê xe. Chúng tôi sẽ hỗ trợ thuê cho bạn mà không cần thủ tục gì. Thân ái...
            </div>
            <div class="font-title px-3 pb-3">Admin - 12/01/2021</div>
        </div>
        <div class="font-title-bold font-20pt mb-2 mt-3">Câu hỏi của khách hàng</div>
        <div class="tab-content-item">
            <div class="question-answer-item bg-white">
                <div class="question-item border-bottom p-3">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <div class="question-item-content">
                        <p class="mb-0 mt-2">Cho em hỏi thuê xe máy luôn của khách sạn thì thủ tục thế nào ạ ?</p>
                    </div>
                </div>
                <div class="answer-item p-3">
                    Cảm ơn bạn đã gửi câu hỏi cho chúng tôi, chúng tôi trả lời như sau: Hiện khách sạn không có xe máy cho thuê, nếu bạn cần thuê xe. Chúng tôi sẽ hỗ trợ thuê cho bạn mà không cần thủ tục gì. Thân ái...
                </div>
                <div class="font-title px-3 pb-3">Admin - 12/01/2021</div>
            </div>
            <div class="question-answer-item bg-white">
                <div class="question-item border-bottom p-3">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">huyen truong</span>
                            <span>12/01/2021</span>
                        </div>
                    </div>
                    <div class="question-item-content">
                        <p class="mb-0 mt-2">Cho em hỏi thuê xe máy luôn của khách sạn thì thủ tục thế nào ạ ?</p>
                    </div>
                </div>
                <div class="answer-item p-3">
                    Cảm ơn bạn đã gửi câu hỏi cho chúng tôi, chúng tôi trả lời như sau: Hiện khách sạn không có xe máy cho thuê, nếu bạn cần thuê xe. Chúng tôi sẽ hỗ trợ thuê cho bạn mà không cần thủ tục gì. Thân ái...
                </div>
                <div class="font-title px-3 pb-3">Admin - 12/01/2021</div>
            </div>
        </div>
    </div>
</div>
<section class="hotel-detail-info">
    <div class="hotel-booking-info bg-white py-3">
        <div class="container">
            <div class="row row-medium-space booking-input">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="text-success room-person-select d-inline-block mb-3">
                        <div class="dropdown dropdownPersonRoom ml-auto">
                            <button class="btn bg-transparent p-0 border-0 no-active-focus text-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="total-person">1</span> người, <span class="total-room">1</span> phòng <i class="fal fa-chevron-down text-success ml-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-select-option smooth-transition radius-md shadow-sm p-0" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-header font-title text-primary font-17pt py-2 px-3 border-bottom">Hành khách</div>
                                <div class="dropdown-item border-0 d-flex justify-content-between bg-white">
                                    <span class="dropdown-select-text text-nowrap">Người lớn</span>
                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                        <input type="number" min="0" value="" name="yacht_adultNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                    </span>
                                </div>
                                <div class="dropdown-item border-0 d-flex justify-content-between bg-white">
                                    <span class="dropdown-select-text text-nowrap">Trẻ em (2 - 12 tuổi)</span>
                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                        <input type="number" min="0" value="0" name="yacht_childNum" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                    </span>
                                </div>
                                <div class="dropdown-item border-0 d-flex justify-content-between bg-white">
                                    <span class="dropdown-select-text text-nowrap">Trẻ em (dưới 2 tuổi)</span>
                                    <span class="input-group-select d-flex align-items-center justify-content-end">
                                        <div class="step-minus cursor-pointer"><i class="fal fa-minus-circle"></i></div>
                                        <input type="number" min="0" value="0" name="yacht_childNum2" class="input-step-fill person-number-item font-15pt border-0 bg-transparent no-active-focus text-center w-20 mx-3">
                                        <div class="step-plus cursor-pointer"><i class="fal fa-plus-circle"></i></div>
                                    </span>
                                </div>
                                <div class="dropdown-select-footer font-title text-primary font-17pt py-2 px-3 border-top">
                                    <button class="btn btn-primary-gradient font-title btn-block px-3 py-12px">Đồng ý</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="row row-medium-space">
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-xs-3 mb-sm-3 mb-md-3 mb-lg-0">
                            <div class="form-group mb-0">
                                <div class="input-group float-label-input">
                                    <div class="input-group-prepend m-0">
                                        <span class="input-group-text bg-transparent pr-0 border-right-0">
                                            <i class="fas fa-map-marker-alt text-primary"></i>
                                        </span>
                                    </div>
                                    <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                        <span>Chọn điểm đến</span>
                                        <select class="selectpicker form-control h-auto py-12px bg-white" name="yacht_place">
                                            @if ($list_place_yacht)
                                            @foreach ($list_place_yacht as $place_yacht)
                                            <option value="{{ $place_yacht->id }}">{{ $place_yacht->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-xs-3 mb-sm-3 mb-md-3 mb-lg-0">
                            <div class="form-group mb-0">
                                <div class="input-group float-label-input">
                                    <div class="input-group-prepend m-0">
                                        <span class="input-group-text bg-transparent pr-0 border-right-0">
                                            <i class="far fa-calendar text-primary"></i>
                                        </span>
                                    </div>
                                    <label class="matter-textfield-filled form-control d-block h-auto p-0 mb-0">
                                        <input type="text" placeholder=" " class="text-primary yacht-date-picker" name="yacht_book_date">
                                        <span>Ngày khởi hành</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="row row-medium-space">
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-xs-3 mb-sm-3 mb-md-3 mb-lg-0">
                            <div class="form-group mb-0">
                                <div class="input-group float-label-input">
                                    <div class="input-group-prepend m-0">
                                        <span class="input-group-text bg-transparent pr-0 border-right-0">
                                            <i class="far fa-calendar text-primary"></i>
                                        </span>
                                    </div>
                                    <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                        <span>Thời gian</span>
                                        <select class="selectpicker form-control h-auto py-12px bg-white" name="yacht_number_day">
                                            <option value="1">1 ngày</option>
                                            <option value="2">2 ngày</option>
                                            <option value="3">3 ngày</option>
                                            <option value="4">4 ngày</option>
                                            <option value="5">5 ngày</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-xs-3 mb-sm-3 mb-md-3 mb-lg-0">
                            <div class="form-group mb-0">
                                <div class="input-group float-label-input">
                                    <div class="input-group-prepend m-0">
                                        <span class="input-group-text bg-transparent pr-0 border-right-0">
                                            <i class="fas fa-star text-primary"></i>
                                        </span>
                                    </div>
                                    <label class="matter-textfield-filled select-matter form-control d-block h-auto p-0 mb-0">
                                        <span>Hạng sao</span>
                                        <select class="selectpicker form-control h-auto py-12px bg-white" name="yacht_number_star">
                                            <option value="1">1 </option>
                                            <option value="2">2 </option>
                                            <option value="3">3 </option>
                                            <option value="4">4 </option>
                                            <option value="5">5 </option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 col-lg-2">
                    <button class="btn btn-primary-gradient font-title btn-block py-12px">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="yacht-booking-detail py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="font-title font-md-title font-title-bold mb-2">{{ $hotel->name }}</div>
                <div class="star-rating text-nowrap w-xs-100">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="h-100 d-flex align-items-center"><span class="font-title">{{ $hotel->rateAverage }} / 5</span> ({{ $hotel->rateCount }} đánh giá)</div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 text-md-right text-lg-right text-xl-right">
                    <div>
                        <span class="text-line-through text-muted font-14pt mr-3">{{ number_format($hotel->price, 0, ',', '.') }} VND</span>
                        <span class="text-success font-title-bold font-md-title">{{ number_format($hotel->priceDiscount, 0, ',', '.') }} VND</span>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="combo-detail-info-img">
                <div class="get-image d-none">
                    @if ($hotel->lstImage)
                    @foreach ($hotel->lstImage as $image)
                    <div class="combo-detail-image-item position-relative">
                        <a data-fancybox="combo-image-list" href="{{ $image->imageUrl }}">
                            <img src="{{ asset($image->imageUrl) }}" class="img-fluid w-100 object-fit-cover">
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="row show-list-image row-small-space mt-3">
                    <div class="col-sm-12 col-md-8 col-lg-9">
                        <div class="large-image"></div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <div class="small-image h-100 d-flex flex-md-column justify-content-between"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-9">
                    <div class="combo-detail-info-tab nav-tab-sticky-parent mt-3">
                        <nav class="nav-tab-sticky bg-gray">
                            <div class="nav nav-tabs nav-tab-scroll custom-nav-tab hotel-detail-nav border-0 position-relative flex-nowrap">
                                <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent text-nowrap py-3 active" href="#yacht-tab-room-class">Hạng phòng</a>
                                <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent text-nowrap py-3" href="#yacht-tab-journey">Lịch trình</a>
                                <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent text-nowrap py-3" href="#yacht-tab-rule">Quy định</a>
                                <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent text-nowrap py-3" href="#yacht-tab-rated">Đánh giá</a>
                                <a class="nav-link text-center font-title font-17pt position-relative border-0 bg-transparent text-nowrap py-3" href="#yacht-tab-qa">Hỏi dáp</a>
                            </div>
                        </nav>
                        <div class="combo-detail-tab-content">
                            <div class="py-3" id="yacht-tab-room-class">
                                <div class="tab-content-item mb-4">
                                    <p class="mb-3">
                                        {!! $hotel->description !!}
                                    </p>
                                    <div class="hotel-benefit-mobile d-xs-block d-sm-block d-md-none d-lg-none d-xl-none"></div>
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-xs-3 mt-sm-3 mb-4">
                                        <h5 class="font-sm-title font-title-bold mb-0">Hạng phòng</h5>
                                        <button class="btn btn-primary-gradient font-title hotel-booking-detail-btn mt-xs-3 mt-md-0 mt-lg-0 w-xs-100 px-5 book_room_hotel" data-url="{{ $hotel->url }}">Đặt phòng</button>
                                    </div>
                                    <div class="row room-class-list">
                                        @if ($hotel->lstRoom)
                                        @foreach ($hotel->lstRoom as $lstRoom)
                                        <div class="col-sm-12 col-md-12 col-lg-12 room-class-item mb-5px room_hotel" data-id-room="{{ $lstRoom->id }}">
                                            <div class="row no-gutters">
                                                <div class="col-sm-12 col-md-12 col-lg-4">
                                                    <div class="room-class-img h-100 bg-white">
                                                        <img src="{{ asset('frontend/img/yacht-room-class-demo.png') }}" class="img-fluid w-100 object-fit-cover">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-8">
                                                    <div class="bg-white h-100 p-3">
                                                        <div class="d-flex justify-content-between flex-wrap">
                                                            <div class="room-class-item-left">
                                                                <div class="font-title">{{ $lstRoom->name }}</div>
                                                                <div><i class="fal fa-user-friends w-10"></i> {{ $lstRoom->adultNum }} người lớn, {{ $lstRoom->childNum }} trẻ em</div>
                                                                <div><i class="fal fa-object-group w-10"></i> {{ $lstRoom->area }} m2</div>
                                                                <div><i class="fal fa-bed-alt w-10"></i> {{ $lstRoom->bedDescription }}</div>
                                                                <div class="text-danger mt-2">Bao gồm các bữa ăn trên tàu và phí dịch vụ</div>
                                                            </div>
                                                            <div class="room-class-item-right w-xs-100 text-xs-right">
                                                                <span class="text-line-through text-muted font-16pt text-old-price mr-2">{{ number_format($lstRoom->priceDefault, 0, ',', '.') }} VND</span>
                                                                <span class="text-success font-title-bold text-new-price font-21pt">{{ number_format($lstRoom->priceDefaultDiscount, 0, ',', '.') }} VND</span>
                                                                <div class="text-right">/ 2 người lớn</div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                            <button class="btn bg-transparent border-0 px-0 py-2 text-primary no-active-focus view-hotel-room-info" data-id-room="{{  $lstRoom->id }}">Xem chi tiết phòng</button>
                                                            <select class="selectpicker select-room-dropdown w-auto border-primary bg-transparent radius-sm">
                                                                <option value="0">Chọn phòng</option>
                                                                <option value="1">1 phòng</option>
                                                                <option value="2">2 phòng</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="pb-3" id="yacht-tab-journey">
                                <div class="tab-content-item mb-4">
                                    <h5 class="font-sm-title font-title-bold mb-4">Lịch trình</h5>
                                    @foreach ($hotel->lstSchedule as $schedule)
                                    <div class="schedule-item mb-5px">
                                        <div class="schedule-item-header text-white bg-primary-gradient d-flex align-items-center justify-content-between p-3" data-toggle="collapse" data-target="#schedule-item-first">
                                            <div>
                                                <span class="text-nowrap mr-4">Ngày {{ $schedule->dayNo }} :
                                                    <span class="text-uppercase">{{ $schedule->title }}</span>
                                            </div>
                                            <i class="far fa-chevron-down smooth-transition"></i>
                                        </div>
                                        <div id="schedule-item-first" class="schedule-item-body bg-white collapse show">
                                            <div class="p-3">
                                                {!! $schedule->content !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="pb-3" id="yacht-tab-rule">
                                <div class="tab-content-item mb-4">
                                    <h5 class="font-sm-title font-title-bold mb-4">Quy định</h5>
                                    @if ($hotel->yachtDescription)
                                    <div class="yacht-detail-rule">
                                        <div class="yacht-detail-rule-item d-flex bg-white mb-5px p-3">
                                            <div class="font-title yacht-detail-rule-item-title w-30">Thời gian nhận phòng
                                            </div>
                                            <div class="yacht-detail-rule-item-content w-70">
                                                {{ $hotel->yachtDescription->checkinTime }}
                                            </div>
                                        </div>
                                        <div class="yacht-detail-rule-item d-flex bg-white mb-5px p-3">
                                            <div class="font-title yacht-detail-rule-item-title w-30">Thời gian nhận phòng
                                            </div>
                                            <div class="yacht-detail-rule-item-content w-70">
                                                {{ $hotel->yachtDescription->checkoutTime }}
                                            </div>
                                        </div>
                                        <div class="yacht-detail-rule-item d-flex bg-white mb-5px p-3">
                                            <div class="font-title yacht-detail-rule-item-title w-30">Quy định nhận phòng
                                            </div>
                                            <div class="yacht-detail-rule-item-content w-70">
                                                {!! $hotel->yachtDescription->checkinRegulation !!}
                                            </div>
                                        </div>
                                        <div class="yacht-detail-rule-item d-flex bg-white mb-5px p-3">
                                            <div class="font-title yacht-detail-rule-item-title w-30">Quy định hủy/đổi đặt phòng
                                            </div>
                                            <div class="yacht-detail-rule-item-content w-70">
                                                {!! $hotel->yachtDescription->cancelSwapRegulation !!}
                                            </div>
                                        </div>
                                        <div class="yacht-detail-rule-item d-flex bg-white mb-5px p-3">
                                            <div class="font-title yacht-detail-rule-item-title w-30">Trẻ em và giường phụ
                                            </div>
                                            <div class="yacht-detail-rule-item-content w-70">
                                                {!! $hotel->yachtDescription->childrenRegulation !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="pb-3" id="yacht-tab-rated">
                                <div class="tab-content-item mb-4">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h5 class="font-sm-title font-title-bold mb-0">Đánh giá</h5>
                                        <button class="btn bg-transparent p-0 border-0 text-primary view-hotel-rated-sidebar">Xem thêm</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between bg-white p-3">
                                        <div><span class="font-title-bold mr-3">4.4 / 5</span><span class="text-success">Rất tốt</span></div>
                                        <div>10 đánh giá</div>
                                    </div>
                                    <div class="text-right"><button class="btn btn-primary-gradient write-rated-comment px-5 mt-3 mb-2">Viết đánh giá</button></div>
                                    <div class="list-rated combo-rated">
                                        <div class="rated-item bg-white px-3 py-2 mb-1">
                                            <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                                <div class="rated-item-user d-flex align-items-center">
                                                    <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                                    <div class="rated-item-user-info">
                                                        <span class="font-title text-capitalize">huyen truong</span>
                                                        <span>12/01/2021</span>
                                                    </div>
                                                </div>
                                                <div class="rated-item-info font-18pt">
                                                    <span class="font-title mr-2">4.4/5</span>
                                                    <span class="text-success">Rất tốt</span>
                                                </div>
                                            </div>
                                            <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
                                        </div>
                                        <div class="rated-item bg-white px-3 py-2 mb-1">
                                            <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                                <div class="rated-item-user d-flex align-items-center">
                                                    <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                                    <div class="rated-item-user-info">
                                                        <span class="font-title text-capitalize">huyen truong</span>
                                                        <span>12/01/2021</span>
                                                    </div>
                                                </div>
                                                <div class="rated-item-info font-18pt">
                                                    <span class="font-title mr-2">4.4/5</span>
                                                    <span class="text-success">Rất tốt</span>
                                                </div>
                                            </div>
                                            <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
                                        </div>
                                        <div class="rated-item bg-white px-3 py-2 mb-1">
                                            <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                                <div class="rated-item-user d-flex align-items-center">
                                                    <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                                    <div class="rated-item-user-info">
                                                        <span class="font-title text-capitalize">huyen truong</span>
                                                        <span>12/01/2021</span>
                                                    </div>
                                                </div>
                                                <div class="rated-item-info font-18pt">
                                                    <span class="font-title mr-2">4.4/5</span>
                                                    <span class="text-success">Rất tốt</span>
                                                </div>
                                            </div>
                                            <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
                                        </div>
                                        <div class="rated-item bg-white px-3 py-2 mb-1">
                                            <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                                <div class="rated-item-user d-flex align-items-center">
                                                    <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                                    <div class="rated-item-user-info">
                                                        <span class="font-title text-capitalize">huyen truong</span>
                                                        <span>12/01/2021</span>
                                                    </div>
                                                </div>
                                                <div class="rated-item-info font-18pt">
                                                    <span class="font-title mr-2">4.4/5</span>
                                                    <span class="text-success">Rất tốt</span>
                                                </div>
                                            </div>
                                            <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
                                        </div>
                                        <div class="rated-item bg-white px-3 py-2 mb-1">
                                            <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                                <div class="rated-item-user d-flex align-items-center">
                                                    <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                                    <div class="rated-item-user-info">
                                                        <span class="font-title text-capitalize">huyen truong</span>
                                                        <span>12/01/2021</span>
                                                    </div>
                                                </div>
                                                <div class="rated-item-info font-18pt">
                                                    <span class="font-title mr-2">4.4/5</span>
                                                    <span class="text-success">Rất tốt</span>
                                                </div>
                                            </div>
                                            <p class="mb-1 mt-2">Khách sạn mới tiện nghi giá 5 sao nhưng giá bình dân, nhân viên tư vấn nhiệt tình, nếu ra Hà Nội sẽ tiếp tục ủng hộ</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-0" id="yacht-tab-qa">
                                <div class="tab-content-item mb-4">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h5 class="font-sm-title font-title-bold mb-0">Hỏi đáp</h5>
                                        <button class="btn bg-transparent p-0 border-0 text-primary view-quesion-answer-sidebar">Xem thêm</button>
                                    </div>
                                    <div class="question-answer-item bg-white">
                                        <div class="question-item border-bottom p-3">
                                            <div class="rated-item-user d-flex align-items-center">
                                                <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                                <div class="rated-item-user-info">
                                                    <span class="font-title text-capitalize">huyen truong</span>
                                                    <span>12/01/2021</span>
                                                </div>
                                            </div>
                                            <div class="question-item-content">
                                                <p class="mb-0 mt-2">Cho em hỏi thuê xe máy luôn của khách sạn thì thủ tục thế nào ạ ?</p>
                                            </div>
                                        </div>
                                        <div class="answer-item border-bottom p-3">
                                            Cảm ơn bạn đã gửi câu hỏi cho chúng tôi, chúng tôi trả lời như sau: Hiện khách sạn không có xe máy cho thuê, nếu bạn cần thuê xe. Chúng tôi sẽ hỗ trợ thuê cho bạn mà không cần thủ tục gì. Thân ái...
                                        </div>
                                    </div>
                                    <div class="question-answer-item bg-white">
                                        <div class="question-item border-bottom p-3">
                                            <div class="rated-item-user d-flex align-items-center">
                                                <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                                                <div class="rated-item-user-info">
                                                    <span class="font-title text-capitalize">huyen truong</span>
                                                    <span>12/01/2021</span>
                                                </div>
                                            </div>
                                            <div class="question-item-content">
                                                <p class="mb-0 mt-2">Cho em hỏi thuê xe máy luôn của khách sạn thì thủ tục thế nào ạ ?</p>
                                            </div>
                                        </div>
                                        <div class="answer-item border-bottom p-3">
                                            Cảm ơn bạn đã gửi câu hỏi cho chúng tôi, chúng tôi trả lời như sau: Hiện khách sạn không có xe máy cho thuê, nếu bạn cần thuê xe. Chúng tôi sẽ hỗ trợ thuê cho bạn mà không cần thủ tục gì. Thân ái...
                                        </div>
                                    </div>
                                    <div class="text-right"><button class="btn btn-primary-gradient add-question px-5 mt-3 mb-2">Đặt câu hỏi</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3 benefit-hotel-info d-xs-none d-sm-none d-md-block d-lg-block d-xl-block sidebar-sticky-parent">
                    <div class="card combo-booking-detail-info border-0 m-0 shadow-none sidebar-sticky mt-3">
                        <div class="card-header font-17pt bg-white font-title text-center p-3">Thông tin khách sạn</div>
                        <div class="card-body yacht-convenient d-flex flex-wrap align-items-center position-relative p-0">
                            @if ($hotel->lstUtiliti)
                            @foreach ($hotel->lstUtiliti as $utiliti)
                            <div class="w-50 py-3 px-2 bg-white text-center yacht-convenient-item border-bottom">
                                <img src="{{ asset('frontend/img/yacht-building-icon.png') }}" class="img-fluid mb-2">
                                <div class="font-title font-13pt">{{ $utiliti->utilitiName }}</div>
                            </div>
                            @endforeach
                            @endif
                            <div class="w-50 py-3 px-2 bg-white text-center yacht-convenient-item border-bottom">
                                <img src="{{ asset('frontend/img/yacht-food-icon.png') }}" class="img-fluid mb-2">
                                <div class="font-title font-13pt">Ăn sáng miễn phí</div>
                            </div>
                            <div class="w-50 py-3 px-2 bg-white text-center yacht-convenient-item border-bottom">
                                <img src="{{ asset('frontend/img/yacht-building-icon.png') }}" class="img-fluid mb-2">
                                <div class="font-title font-13pt">30 Phòng Vip</div>
                            </div>
                            <div class="w-50 py-3 px-2 bg-white text-center yacht-convenient-item border-bottom">
                                <img src="{{ asset('frontend/img/yacht-wifi-icon.png') }}" class="img-fluid mb-2">
                                <div class="font-title font-13pt">Wifi miễn phí</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('frontend/sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('frontend/sweetalert2/sweetalert2.min.css') }}">
<script>
    $('input[name=yacht_adultNum]').val(parseInt(sessionStorage.getItem("yacht_adultNum")));
    $('input[name=yacht_childNum]').val(parseInt(sessionStorage.getItem("yacht_childNum")));
    $('input[name=yacht_childNum2]').val(parseInt(sessionStorage.getItem("yacht_childNum2")));
    $('.yacht-date-picker').val(sessionStorage.getItem("yacht_book_date"));
    $('select[name=yacht_place]> option[value="' + sessionStorage.getItem("end_date_hotel") + '"]').prop("selected", true);
    $('select[name=yacht_number_day]> option[value="' + sessionStorage.getItem("yacht_number_day") + '"]').prop("selected", true);
    $('select[name=yacht_number_star]> option[value="' + sessionStorage.getItem("yacht_number_star") + '"]').prop("selected", true);
    $('.view-hotel-room-info').on('click', function() {
        const id_room = $(this).data('id-room');
        $.ajax({
            url: '/load-data-room-in-yacht' + '/' + id_room,
            type: "GET",
            success: function(response) {
                $('#info_room').html(response.data);
            }
        });
    });
    $('body').on('click', '.book_room_hotel', function() {
        const array_room = [];
        const array_number = [];
        const url = $(this).data('url');
        const yacht_book_date = sessionStorage.getItem("yacht_book_date");
        const yacht_adultNum = parseInt($('input[name=yacht_adultNum]').val());
        const yacht_childNum = parseInt($('input[name=yacht_childNum]').val());
        const yacht_childNum2 = parseInt($('input[name=yacht_childNum2]').val());
        $('.room_hotel').each(function() {
            const room_id = $(this).data('id-room');
            const active = parseInt($(this).find('select option:selected').val());
            if (active != '' || active != 0) {
                array_room.push(room_id);
                array_number.push(active);
            }
        });
        if (array_number.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Bạn chưa chọn phòng",
            });
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'post_book_room_in_yacht',
            type: "POST",
            data: {
                array_room: array_room,
                array_number: array_number,
                url: url,
                yacht_book_date: yacht_book_date,
                yacht_adultNum: yacht_adultNum,
                yacht_childNum: yacht_childNum,
                yacht_childNum2: yacht_childNum2
            },
            success: function(response) {
                window.location.href = "book-room-yacht";
            }
        });
    });
</script>
@endsection