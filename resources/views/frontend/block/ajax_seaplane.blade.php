<table class="seaplane-table-list table mb-0">
    <tbody>
        @if (count($list_seaplane) > 0)
        @foreach ($list_seaplane as $seaplane)
        <tr class="font-17pt seaplane-item-booking">
            <td class="p-0 align-middle w-15">
                <img src="{{ asset('frontend/img/seaplane-logo-demo.png') }}" class="img-fluid h-auto">
            </td>
            <td class="text-center align-middle p-0 w-15">{{ $seaplane->code }}</td>
            <td class="font-title-bold text-center align-middle text-primary p-0 w-40 text-nowrap">{{ $seaplane->startTime }} - {{ $seaplane->endTime }}</td>
            <td class="seaplane_price font-title-bold text-center align-middle text-danger p-0 w-15 text-nowrap" data-seaplane-price="{{$seaplane->fareAdt}}">{{ number_format($seaplane->fareAdt, 0, ',', '.') }} đ</td>
            <td class="text-right align-middle py-0 px-1 w-15">
                <a href="{{ route('book_seaplane', ['slug' => $seaplane->id]) }}" class="btn btn-primary-gradient">Chọn</a>
            </td>
        </tr>
        @endforeach
        @else
        <tr class="font-17pt seaplane-item-booking">
            <td class="p-0 align-middle w-15" style="text-align: center;">
                <img src="{{ asset('images/boat.svg') }}" alt="" sizes="" class="mt-15px">
                <h5> Không có dữ liệu</h5>
            </td>

        </tr>
        @endif

    </tbody>
</table>