<input type="hidden" value="{{ $info['two_way_adt'] }}" name="two_way_adt_hide">
    <input type="hidden" value="{{ $info['way_chd'] }}" name="two_way_chd_hide">
    <input type="hidden" value="{{ $info['two_way_inf'] }}" name="two_way_inf_hide">
    <input type="hidden" value="{{ $info['begin_place_2_way'] }}" name="begin_place_2_way_hide">
    <input type="hidden" value="{{ $info['end_place_2_way'] }}" name="end_place_2_way_hide">
    <input type="hidden" value="{{ $info['way_start_date'] }}" name="two_way_start_date_hide">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="list-airplane-container">
            <div class="list-airplane-header bg-primary text-center text-white py-2 px-3">
                <div class="d-flex align-items-center justify-content-center font-title">
                    <span>{{ $lists[0]['info']['startPoint'] }}</span>
                    <img src="{{ asset('frontend/img/airplane-icon-white.png') }}" width="25" class="img-fluid mx-5 mx-xs-2 mx-sm-3">
                    <span>{{ $lists[0]['info']['endPoint'] }}</span>
                </div>
                <div class="mt-1">{{ $lists[0]['info']['date'] }}</div>
            </div>
            <div class="card-body border p-0">
                <nav class="border-top">
                    <div class="nav nav-tabs airplane-ticket-go-nav airplane-oneway-nav" role="tablist">
                        @foreach ($lists[0]['info']['list_days'] as $list_day)
                        <a class="nav-link text-center border-0 rounded-0 font-12pt px-2 py-1 @if ($list_day['status'] == 1) active @endif @if (Carbon\Carbon::createFromFormat('d/m/Y', $list_day['full_day'])->gt(Carbon\Carbon::now())) change_day_flight @endif " href="javascript:void(0)" data-value="{{ $list_day['full_day'] }}">
                            <div>{{ $list_day['stuff'] }}</div>
                            <div>Ngày {{ $list_day['day'] }}</div>
                        </a>
                        @endforeach
                    </div>
                </nav>
                <div class="tab-content airplane-go-tab-content">
                    <div class="tab-pane fade show active" id="airplane-ticket-go-day-1" role="tabpanel">
                        <div class="airplane-item-list-container">
                            @if (isset($lists[0]['list_flight']))
                                @foreach ($lists[0]['list_flight'] as $flight)
                                <div class="airplane-item">
                                    <div class="d-flex align-items-center justify-content-between airplane-item-content bg-gray-gradient pr-1">
                                        <div class="w-15 airplane-ticket-logo">
                                            <img src="{{ asset($flight->listFlight[0]->icon) }}" class="img-fluid">
                                        </div>
                                        <div class="w-85 d-flex align-items-center justify-content-between flex-wrap airplane-ticket-info airplane-ticket-oneway">
                                            <div class="text-center align-middle p-0 w-10">{{ $flight->listFlight[0]->flightNumber }}</div>
                                            <div class="font-title-bold text-center align-middle text-primary font-title-bold p-0 w-15">{{ Carbon\Carbon::parse($flight->listFlight[0]->listSegment[0]->startTime)->format('H:i') }}</div>
                                            <div class="font-title-bold text-center align-middle p-0 w-10">{{ $flight->listFlight[0]->listSegment[0]->handBaggage }}</div>
                                            <div class="text-center align-middle text-danger font-title-bold text-nowrap py-0 px-1 w-25">
                                            {{ $view_mode == 0 ? number_format($flight->fareAdt, 0, ',', '.') : number_format($flight->fareAdt + $flight->taxAdt + $flight->feeAdt + $flight->serviceFee, 0, ',', '.')  }} VNĐ
                                            </div>
                                            <div class="text-right text-lg-center align-middle py-0 px-1 w-10 d-xs-none d-sm-none d-md-block d-lg-block d-xl-block">
                                                <button class="circle-icon-sm btn border-0 p-0 btn-secondary d-flex align-items-center justify-content-center text-white show-info-airplane rounded mx-auto">
                                                    <i class="far fa-plus icon-plus"></i>
                                                    <i class="far fa-minus icon-minus"></i>
                                                </button>
                                            </div>
                                            <div class="text-right align-middle py-0 px-1 w-15">
                                                <a href="javascript:void(0)" class="btn btn-primary-gradient mr-1 check-air_plane" data-session="{{ $session }}" data-value="{{ $flight->listFlight[0]->flightValue }}" data-faredataid="{{ $flight->fareDataId }}">Chọn</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white show-detail-two hide" data-value="{{ $session }}" data-value="{{ $flight->listFlight[0]->flightValue }}" data-faredataid="{{ $flight->fareDataId }}">
                                        <div class="py-2 px-3">
                                            <div class="text-right">Loại vé <span class="font-title">{{ $flight->listFlight[0]->groupClass }}</span></div>
                                            <div class="dropdown-divider"></div>
                                            <div class="airplane-item-short-info">
                                                <div class="d-flex">
                                                    <div class="w-25 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Loại vé</div>
                                                        <div class="font-title">{{ $flight->adt }} Người lớn, {{ $flight->chd }} Trẻ em, {{ $flight->inf }} Em bé</div>
                                                    </div>
                                                    <!-- <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">SL</div>
                                                        <div class="font-title">{{ $flight->adt }}</div>
                                                    </div> -->
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Giá vé</div>
                                                        <div class="font-title"> {{ number_format(($flight->fareAdt + $flight->fareChd + $flight->fareInf), 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Thuế phí</div>
                                                        <div class="font-title">{{ number_format(($flight->taxAdt + $flight->feeAdt + $flight->serviceFee) * $flight->adt + ($flight->taxChd + $flight->feeChd + $flight->serviceFee) * $flight->chd + ($flight->taxInf + $flight->feeInf + $flight->serviceFee) * $flight->inf, 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Tổng</div>
                                                        <div class="font-title">{{ number_format(($flight->fareAdt + $flight->taxAdt + $flight->feeAdt + $flight->serviceFee) * $flight->adt + ($flight->fareChd + $flight->taxChd + $flight->feeChd + $flight->serviceFee) * $flight->chd + ($flight->fareInf + $flight->taxInf + $flight->feeInf + $flight->serviceFee) * $flight->inf, 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="airplane-item-info bg-white">
                                        <div class="py-2 px-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="w-55 d-flex align-items-center justify-content-between font-title">
                                                    <span>{{ $lists[0]['info']['startPoint'] }}</span>
                                                    <span>{{ Carbon\Carbon::parse($flight->listFlight[0]->listSegment[0]->startTime)->format('H:i') }}</span>
                                                </div>
                                                <div class="w-40 d-flex align-items-center justify-content-between font-title">
                                                    <span>{{ Carbon\Carbon::parse($flight->listFlight[0]->listSegment[0]->startTime)->format('d/m/Y') }}</span>
                                                    <span class="font-title">Nội bài</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span>{{ App\Helpers\CommonFunctions::convertTimeToMinutes($flight->listFlight[0]->listSegment[0]->startTime, $flight->listFlight[0]->listSegment[0]->endTime) }}</span>
                                                <span class="airplane-line"></span>
                                                <span>A{{ $flight->listFlight[0]->listSegment[0]->plane }}</span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="w-55 d-flex align-items-center justify-content-between font-title">
                                                    <span>{{ $lists[0]['info']['endPoint'] }}</span>
                                                    <span>{{ Carbon\Carbon::parse($flight->listFlight[0]->listSegment[0]->endTime)->format('H:i') }}</span>
                                                </div>
                                                <div class="w-40 d-flex align-items-center justify-content-between font-title">
                                                    <span>Chuyến bay</span>
                                                    <span class="font-title">{{ $flight->listFlight[0]->listSegment[0]->flightNumber }}</span>
                                                </div>
                                            </div>
                                            <div class="text-right">Loại vé <span class="font-title">{{ $flight->listFlight[0]->groupClass }}</span></div>
                                            <div class="dropdown-divider"></div>
                                            <div class="airplane-item-short-info">
                                                <div class="d-flex">
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Loại vé</div>
                                                        <div class="font-title">Người lớn</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">SL</div>
                                                        <div class="font-title">{{ $flight->adt }}</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Giá vé</div>
                                                        <div class="font-title">{{ number_format($flight->fareAdt, 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Thuế phí</div>
                                                        <div class="font-title">{{ number_format(($flight->taxAdt + $flight->feeAdt + $flight->serviceFee), 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Tổng</div>
                                                        <div class="font-title">{{ number_format(($flight->fareAdt + $flight->taxAdt + $flight->feeAdt + $flight->serviceFee) * $flight->adt, 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                </div>
                                                @if ($flight->chd > 0)
                                                <div class="d-flex">
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Loại vé</div>
                                                        <div class="font-title">Trẻ em</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">SL</div>
                                                        <div class="font-title">{{ $flight->chd }}</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Giá vé</div>
                                                        <div class="font-title"> {{ number_format($flight->fareChd, 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Thuế phí</div>
                                                        <div class="font-title">{{ number_format(($flight->taxChd + $flight->feeChd + $flight->serviceFee), 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Tổng</div>
                                                        <div class="font-title">{{ number_format(($flight->fareChd + $flight->taxChd + $flight->feeChd + $flight->serviceFee) * $flight->chd, 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($flight->inf > 0)
                                                <div class="d-flex">
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Loại vé</div>
                                                        <div class="font-title">Em bé</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">SL</div>
                                                        <div class="font-title">{{ $flight->inf }}</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Giá vé</div>
                                                        <div class="font-title"> {{ number_format($flight->fareInf, 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Thuế phí</div>
                                                        <div class="font-title">{{ number_format(($flight->taxInf + $flight->feeInf + $flight->serviceFee), 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                    <div class="w-20 text-center font-13pt px-1">
                                                        <div class="text-primary mb-1">Tổng</div>
                                                        <div class="font-title">{{ number_format(($flight->fareInf + $flight->taxInf + $flight->feeInf + $flight->serviceFee) * $flight->inf, 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="d-flex">
                                                    <div class="w-20 text-center font-13pt px-1" style="width: 100%;font-size: 18px;">
                                                        <div class="text-primary mb-1" style="    float: left;">Tổng</div>
                                                        <div class="font-title" style="text-align: right;">{{ number_format(($flight->fareAdt + $flight->taxAdt + $flight->feeAdt + $flight->serviceFee) * $flight->adt + ($flight->fareChd + $flight->taxChd + $flight->feeChd + $flight->serviceFee) * $flight->chd + ($flight->fareInf + $flight->taxInf + $flight->feeInf + $flight->serviceFee) * $flight->inf, 0, ',', '.') }} VNĐ</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                Không có chuyến bay nào
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>