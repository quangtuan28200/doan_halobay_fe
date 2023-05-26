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