<div class="font-title-bold font-sm-title mb-2">{{ $room->name }}</div>
<div class="dropdown-divider mb-3"></div>
<img src="{{ $room->imageUrl ?: asset(\Config::get('constants.IMAGES_DEFAULT.HOTEL.ROOM_CLASS')) }}" class="img-fluid w-100 mb-4">
<div class="yacht-rule-content">
  {!! $room->description !!}
</div>
<div class="font-title-bold font-sm-title my-3">Tiện ích của phòng</div>
@foreach ($room->utiliti as $utiliti)
<i class="fas fa-check text-success mr-1"></i>{{ $utiliti }}<br>
@endforeach
<div class="font-title-bold font-sm-title my-3">Quy định hủy/đổi đặt phòng</div>
{!! $room->cancelSwapRegulation !!}