@php
$userRate = null;
$userId = null;
$userImg = null;
$rateList = $rateData['rateList'];
if($user){
$userId = $user->id;
$userImg = $user->imageUrl;
$rateList = array_filter($rateList, function ($rate) use ($userId) {
return $rate->userId != $userId;
});
foreach ($rateData['rateList'] as $rate) {
if ($rate->userId == $userId) {
$userRate = $rate;
break;
}
}
}
@endphp
<div class="rated-list-sidebar smooth-transition position-fixed d-flex align-items-center">
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
                            <div class="font-title-bold">{{$rateData['rateAverage']}} / 5</div>
                            <div class="font-title-bold my-2">{{$rateData['rateLabel']}}</div>
                            <div class="font-15pt">{{$rateData['rateCount']}} đánh giá</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="bg-white p-3">
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Tuyệt vời</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{$rateData['rateQualityProgress']['great']}}%" aria-valuenow="{{$rateData['rateQualityProgress']['great']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">{{$rateData['rateQualityCount']['great']}}</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Rất tốt</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{$rateData['rateQualityProgress']['good']}}%" aria-valuenow="{{$rateData['rateQualityProgress']['good']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">{{$rateData['rateQualityCount']['good']}}</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Bình thường</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{$rateData['rateQualityProgress']['normal']}}%" aria-valuenow="{{$rateData['rateQualityProgress']['normal']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">{{$rateData['rateQualityCount']['normal']}}</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Tạm được</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{$rateData['rateQualityProgress']['ok']}}%" aria-valuenow="{{$rateData['rateQualityProgress']['ok']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">{{$rateData['rateQualityCount']['ok']}}</span>
                        </div>
                        <div class="hotel-sidebar-rate-item font-title text-primary d-flex align-items-center justify-content-between mb-5px">
                            <span class="text-nowrap font-13pt w-35">Không thích</span>
                            <div class="progress-rated-item w-55">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{$rateData['rateQualityProgress']['bad']}}%" aria-valuenow="{{$rateData['rateQualityProgress']['bad']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <span class="font-13pt w-10 text-center">{{$rateData['rateQualityCount']['bad']}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- @if($user && $userRate)
        <div class="hidden form-rateUpdate-container">
            <div class="font-title-bold font-20pt mb-2 mt-3">Đánh giá của bạn</div>
            <div class="row rated-emotion row-medium-space">
                <div class="col">
                    <div data-rate-num="1" class="rated-emotion-item text-center font-14pt cursor-pointer {{$userRate->rate == 1 ? 'active' : ''}}">
                        <img src="{{ asset('frontend/img/rated-emo-sad.png') }}" class="img-fluid mb-2 mx-auto">
                        <img src="{{ asset('frontend/img/rated-emo-sad-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                        <div>Không thích</div>
                    </div>
                </div>
                <div class="col">
                    <div data-rate-num="2" class="rated-emotion-item text-center font-14pt cursor-pointer {{$userRate->rate == 2 ? 'active' : ''}}">
                        <img src="{{ asset('frontend/img/rated-emo-sceptic.png') }}" class="img-fluid mb-2 mx-auto">
                        <img src="{{ asset('frontend/img/rated-emo-sceptic-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                        <div>Tạm được</div>
                    </div>
                </div>
                <div class="col">
                    <div data-rate-num="3" class="rated-emotion-item text-center font-14pt cursor-pointer {{$userRate->rate == 3 ? 'active' : ''}}">
                        <img src="{{ asset('frontend/img/rated-emo-happy.png') }}" class="img-fluid mb-2 mx-auto">
                        <img src="{{ asset('frontend/img/rated-emo-happy-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                        <div>Bình thường</div>
                    </div>
                </div>
                <div class="col">
                    <div data-rate-num="4" class="rated-emotion-item text-center font-14pt cursor-pointer {{$userRate->rate == 4 ? 'active' : ''}}">
                        <img src="{{ asset('frontend/img/rated-emo-good.png') }}" class="img-fluid mb-2 mx-auto">
                        <img src="{{ asset('frontend/img/rated-emo-good-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                        <div>Rất tốt</div>
                    </div>
                </div>
                <div class="col">
                    <div data-rate-num="5" class="rated-emotion-item text-center font-14pt cursor-pointer {{$userRate->rate == 5 ? 'active' : ''}}">
                        <img src="{{ asset('frontend/img/rated-emo-excellen.png') }}" class="img-fluid mb-2 mx-auto">
                        <img src="{{ asset('frontend/img/rated-emo-excellen-active.png') }}" class="img-fluid rated-emo-active mb-2 mx-auto">
                        <div>Tuyệt vời</div>
                    </div>
                </div>
                <form id="form-rate-update-sidebar" class="col-sm-12 col-md-12 col-lg-12 mt-3">
                    <div class="form-group mb-5px">
                        <div class="form-group mb-0">
                            <label class="matter-textfield-filled d-block border-0">
                                <input name="name-rate" type="text" placeholder=" " required readonly value="{{$user ? $user->fullName : ''}}" />
                                <span>Tên của bạn</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-5px">
                        <div class="form-group mb-0">
                            <label class="matter-textfield-filled d-block border-0">
                                <input name="email-rate" type="Email" placeholder=" " required readonly value="{{$user ? $user->email : ''}}" />
                                <span>Email</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-5px">
                        <div class="form-group mb-0">
                            <label class="matter-textfield-filled d-block border-0">
                                <input name="phone-rate" type="tel" pattern="[0-9]{10}" placeholder=" " required readonly value="{{$user ? $user->phone : ''}}" />
                                <span>Số điện thoại</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-5px">
                        <div class="form-group mb-0">
                            <label class="matter-textfield-filled d-block border-0">
                                <textarea name="content-rate" placeholder=" " rows="4" required>{{$userRate ? $userRate->content : ''}}</textarea>
                                <span>Nội dung đánh giá</span>
                            </label>
                        </div>
                    </div>
                    <input name="detailId-rate" type="hidden" value="{{$rateData['detailId']}}" />
                    <input name="rateId" type="hidden" value="{{$userRate ? $userRate->id : 0}}" />
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary-gradient btn-formUpdate-rate font-title px-5">Cập nhật đánh giá</button>
                    </div>
                </form>
            </div>
        </div>
        @endif -->
        @if($userRate)
        <div class="d-flex align-items-center justify-content-between">
            <div class="font-title-bold font-20pt mb-2 mt-3">Đánh giá của bạn</div>
            <!-- <button class="btn btn-update-rate p-0 border-0 bg-transparent text-primary edit-rated font-14pt">Chỉnh sửa đánh giá <i class="fas fa-edit"></i></button> -->
        </div>
        <div class="rated-item bg-white px-3 py-2 mb-1 box-shadow">
            <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                <div class="rated-item-user d-flex align-items-center">
                    <img src="{{ $userImg ?: asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                    <div class="rated-item-user-info">
                        <span class="font-title text-capitalize">{{ $userRate->name }}</span>
                        <span>{{ date('d/m/Y',strtotime($userRate->createDate)) }}</span>
                    </div>
                </div>
                <div class="rated-item-info font-18pt">
                    <span class="text-success mr-2">{{ App\Helpers\CommonFunctions::rateNumberToText($userRate->rate) }}</span>
                    <span class="font-title">{{ $userRate->rate }}/5</span>
                </div>
            </div>
            <p class="mb-1 mt-2">{{ $userRate->content }}</p>
        </div>
        @endif

        @if ($rateList)
        <div class="font-title-bold font-20pt mb-2 mt-3">Đánh giá khách hàng</div>
        <div class="list-rated hotel-rated-list">
            @foreach ($rateList as $rated)
            <div class="rated-item bg-white px-3 py-2 mb-1 box-shadow">
                <div class="rated-item-header d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize">{{ $rated->name }}</span>
                            <span>{{ date('d/m/Y',strtotime($rated->createDate)) }}</span>
                        </div>
                    </div>
                    <div class="rated-item-info font-18pt">
                        <span class="text-success mr-2">{{ App\Helpers\CommonFunctions::rateNumberToText($rated->rate) }}</span>
                        <span class="font-title">{{ $rated->rate }}/5</span>
                    </div>
                </div>
                <p class="mb-1 mt-2">{{ $rated->content }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>