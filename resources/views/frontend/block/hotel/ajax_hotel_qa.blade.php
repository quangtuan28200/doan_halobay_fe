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