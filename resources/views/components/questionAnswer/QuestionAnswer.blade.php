@php
$userQuestion = null;
$userId = null;
$userImg = null;
$qaList = $qaData['qaList'];
if($user){
$userId = $user->id;
$userImg = $user->imageUrl;
$qaList = array_filter($qaList, function ($qa) use ($userId) {
return $qa->userId != $userId;
});
foreach ($qaData['qaList'] as $qa) {
if ($qa->userId == $userId) {
$userQuestion = $qa;
break;
}
}
}
@endphp
<div class="question-answer-sidebar smooth-transition position-fixed d-flex align-items-center">
    <div class="question-answer-sidebar-close cursor-pointer bg-primary text-white border border-white border-right-0 align-self-start position-relative py-2 px-3">
        <i class="fal fa-times"></i>
    </div>
    <div class="hotel-booking-item bg-gray w-100 h-100 py-5 px-3">
        @if($user && !$userQuestion)
        <div class="font-title-bold font-sm-title mb-2">Hỏi đáp</div>
        <div class="dropdown-divider mb-3"></div>
        <div class="row">
            <form id="form-qa" class="col-sm-12 col-md-12 col-lg-12 mt-3">
                <div class="form-group mb-5px">
                    <label class="matter-textfield-filled d-block border-0">
                        <input name="name-qa" type="text" placeholder=" " required readonly value="{{$user ? $user->fullName : ''}}">
                        <span>Tên của bạn</span>
                    </label>
                </div>
                <div class="form-group mb-5px">
                    <label class="matter-textfield-filled d-block border-0">
                        <input name="email-qa" type="email" placeholder=" " required readonly value="{{$user ? $user->email : ''}}">
                        <span>Email</span>
                    </label>
                </div>
                <div class="form-group mb-5px">
                    <label class="matter-textfield-filled d-block border-0">
                        <input name="phone-qa" type="tel" pattern="[0-9]{10}" placeholder=" " required readonly value="{{$user ? $user->phone : ''}}">
                        <span>Số điện thoại</span>
                    </label>
                </div>
                <div class="form-group mb-5px">
                    <label class="matter-textfield-filled d-block border-0">
                        <textarea name="content-qa" placeholder=" " rows="4" required></textarea>
                        <span>Nội dung hỏi đáp</span>
                    </label>
                </div>
                <input name="detailId-qa" type="hidden" value="{{$qaData['detailId']}}" />
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary-gradient font-title px-5 mb-3">Gửi câu hỏi</button>
                </div>
            </form>
        </div>
        @endif
        @if($user && $userQuestion)
        <div class="hidden form-quesUpdate-container">
            <div class="font-title-bold font-sm-title mb-2">Hỏi đáp</div>
            <div class="dropdown-divider mb-3"></div>
            <div class="row">
                <form id="form-ques-update" class="col-sm-12 col-md-12 col-lg-12 mt-3">
                    <div class="form-group mb-5px">
                        <label class="matter-textfield-filled d-block border-0">
                            <input name="name-qa" type="text" placeholder=" " required readonly value="{{$user ? $user->fullName : ''}}">
                            <span>Tên của bạn</span>
                        </label>
                    </div>
                    <div class="form-group mb-5px">
                        <label class="matter-textfield-filled d-block border-0">
                            <input name="email-qa" type="email" placeholder=" " required readonly value="{{$user ? $user->email : ''}}">
                            <span>Email</span>
                        </label>
                    </div>
                    <div class="form-group mb-5px">
                        <label class="matter-textfield-filled d-block border-0">
                            <input name="phone-qa" type="tel" pattern="[0-9]{10}" placeholder=" " required readonly value="{{$user ? $user->phone : ''}}">
                            <span>Số điện thoại</span>
                        </label>
                    </div>
                    <div class="form-group mb-5px">
                        <label class="matter-textfield-filled d-block border-0">
                            <textarea name="content-qa" placeholder=" " rows="4" required>{{$userQuestion->question ?: ''}}</textarea>
                            <span>Nội dung hỏi đáp</span>
                        </label>
                    </div>
                    <input name="detailId-qa" type="hidden" value="{{$qaData['detailId']}}" />
                    <input name="questionId" type="hidden" value="{{$userQuestion ? $userQuestion->id : 0}}" />
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary-gradient font-title px-5 mb-3">Cập nhật câu hỏi</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        @if ($userQuestion)
        <!-- <div class="font-title-bold font-20pt mb-2 mt-3">Câu hỏi của bạn</div> -->
        <div class="d-flex align-items-center justify-content-between">
            <div class="font-title-bold font-20pt mb-2 mt-3">Câu hỏi của bạn</div>
            <button class="btn btn-update-ques p-0 border-0 bg-transparent text-primary edit-rated font-14pt">Chỉnh sửa câu hỏi <i class="fas fa-edit"></i></button>
        </div>
        <div class="question-answer-item bg-white box-shadow mb-1">
            <div class="question-item border-bottom p-3">
                <div class="rated-item-user d-flex align-items-center">
                    <img src="{{ $userImg ?: asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                    <div class="rated-item-user-info">
                        <span class="font-title text-capitalize mr-2">{{$userQuestion->name}}</span>
                        <span>{{ date('d/m/Y',strtotime($userQuestion->createDate)) }}</span>
                    </div>
                </div>
                <div class="question-item-content">
                    <p class="mb-0 mt-2">{{$userQuestion->question}}</p>
                </div>
            </div>
            @if ($userQuestion->answerId)
            <div class="answer-item border-bottom p-3">
                <p>{{$userQuestion->answer}}</p>
                <span class="font-title text-capitalize">Admin - {{ date('d/m/Y',strtotime($userQuestion->answerDate)) }}</span>
            </div>
            @endif
        </div>
        @endif

        <div class="font-title-bold font-20pt mb-2 mt-3">Câu hỏi của khách hàng</div>
        <div class="tab-content-item hotel-qa-list">
            @if ($qaList)
            @foreach ($qaList as $qa)
            <div class="question-answer-item bg-white box-shadow mb-1">
                <div class="question-item border-bottom p-3">
                    <div class="rated-item-user d-flex align-items-center">
                        <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="img-fluid rated-item-avatar rounded-circle border mr-3">
                        <div class="rated-item-user-info">
                            <span class="font-title text-capitalize mr-2">{{$qa->name}}</span>
                            <span>{{ date('d/m/Y',strtotime($qa->createDate)) }}</span>
                        </div>
                    </div>
                    <div class="question-item-content">
                        <p class="mb-0 mt-2">{{$qa->question}}</p>
                    </div>
                </div>
                @if ($qa->answerId)
                <div class="answer-item border-bottom p-3">
                    <p>{{$qa->answer}}</p>
                    <span class="font-title text-capitalize">Admin - {{ date('d/m/Y',strtotime($qa->answerDate)) }}</span>
                </div>
                @endif
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>