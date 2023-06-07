@extends('frontend.tour.index')
@section('tour-booking-content')
<div class="tour-booking-list-container container py-3">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-9 tour-booking-list-left">
            <div class="place-search">
                <div class="place-search-container d-md-block d-lg-flex d-xl-flex align-items-center justify-content-end">
                    <!-- <div class="font-title font-20pt font-title-bold">{{$info['tour_place_end']}}</div> -->
                    <div class="mt-xs-3 w-xs-100 w-sm-100 w-50 w-md-75 d-md-block d-flex align-items-center justify-content-between">
                        <div class="form-group w-sm-75 mb-0 mt-2">
                            <label class="matter-textfield-filled d-block">
                                <input id="tourName" type="text" placeholder=" ">
                                <span>Tìm kiếm theo tên <p class="text-muted d-xs-none d-inline-block">(VD: Halobay tour)</p></span>
                            </label>
                        </div>
                        <div class="font-22pt toggle-filter-mobile d-xs-block d-sm-block d-md-none d-lg-none d-xl-none font-title-bold ml-2">Lọc bởi</div>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div id="data-tour">
                <div class="search-result d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between py-3">
                    <div>@if ($list_tour->total) {{ $list_tour->total }} @else 0 @endif Kết quả tìm kiếm</div>
                    <div>Giá cơ bản cho một người lớn</div>
                </div>
                <div class="list-rated list-tour-booking">
                    @if ($list_tour->tourList)
                    @foreach ($list_tour->tourList as $tour)
                    <a class="rated-item bg-white text-dark text-decoration-none d-block mb-2 box-shadow" href="tour/{{ $tour->link }}.html">
                        <div class="rated-item-body">
                            <div class="rated-item-hotel tour-booking-container">
                                <div class="row no-gutters">
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="rated-item-hotel-img h-100 position-relative">
                                            <img src="{{ asset($tour->imageUrl) }}" class="img-fluid w-100 object-fit-cover">
                                            <!-- <div class="wishlist-icon position-absolute circle-icon-md rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fas fa-heart text-danger icon-wishlist"></i>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-8">
                                        <div class="rated-item-hotel-info d-flex flex-column justify-content-between h-100 p-3">
                                            <div class="rated-item-hotel-header d-flex justify-content-between">
                                                <div>
                                                    <div class="font-title text-capitalize font-20pt">
                                                        {{ $tour->title }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tour-booking-short-info">
                                                <div class="rated-item-hotel-body text-md-right text-xs-right text-sm-right text-lg-right text-xl-right d-md-flex d-lg-flex d-xl-flex align-items-center justify-content-between">
                                                    <div class="text-success font-16pt align-self-end">Hủy miễn phí</div>
                                                    <div>
                                                        @if ($tour->price !== $tour->priceDiscount)
                                                        <div class="text-line-through text-muted">{{ number_format($tour->price, 0, ',', '.') }} VND</div>
                                                        @endif
                                                        <div class="font-title text-success font-sm-title">{{ number_format($tour->priceDiscount, 0, ',', '.') }} VND</div>
                                                    </div>
                                                </div>
                                                <div class="rated-item-hotel-footer d-flex justify-content-between">
                                                    <div class="font-18pt">
                                                        <div><span class="font-title mr-2">{{ $tour->tourRate }} / 5</span>({{ $tour->feedbackCount }} đánh giá)</div>
                                                    </div>
                                                    <div class="align-self-end">Bao gồm thuế và phí</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 tour-booking-right d-xs-none d-sm-none d-md-block d-lg-block d-xl-block">
            <div class="font-title-bold font-20pt py-3 mb-2">Lọc bởi</div>
            @include('components.ListTourFilter.ListTourFilter', ['list_filter' => $list_filter])
        </div>
    </div>

    @include('components.pagination')
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // load data tour
        const load_data_tour = function(dataFilter) {
            // console.log(dataFilter)
            $('.overlay-loader').show();
            $.ajax({
                url: '/load-data-tour',
                type: "GET",
                data: dataFilter,
                success: function(response) {
                    // console.log('response', response.data)
                    $('#data-tour').html(response.data);
                    $('.pagination').html(response.pagination);
                    $("html,body").scrollTop(200);
                    $('.overlay-loader').hide();
                }
            });
        }

        // get data filter
        const getDataFilter = function() {
            const dayNum = parseInt($('.dayNum:checked').val()) || null;
            const orderBy = parseInt($('.orderBy:checked').val()) || null;
            const continentId = parseInt($('.continentId:checked').val()) || null;
            const placeId = parseInt($('.placeId:checked').val()) || null;
            const tourCategory = parseInt($('.tourCategory:checked').val()) || null;
            const tourType = parseInt($('.tourType:checked').val()) || null;
            const actionType = parseInt($('.actionType:checked').val()) || null;
            const tourName = $('#tourName').val() || null;

            const dataFilter = {
                dayNum,
                orderBy,
                continentId,
                placeId,
                tourCategory,
                tourType,
                actionType,
                tourName
            }

            return dataFilter;
        }

        // click filter
        $('body').on('click', '.filterItem', function() {
            const dataFilterInit = getDataFilter();

            const isChecked = $(this).is(':checked');
            const filterType = $(this).attr('class').split(' ')[0];
            const filterValue = isChecked ? parseInt($(this).val()) : null;

            const dataFilter = {
                ...dataFilterInit,
                [filterType]: filterValue
            }

            load_data_tour(dataFilter);
        });

        // search tour name
        var delay = (function() {
            var timer = 0;
            return function(callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })()

        $('#tourName').on('keydown', function() {
            delay(function() {
                const tourName = $('#tourName').val();
                const dataFilter = getDataFilter();
                load_data_tour({
                    ...dataFilter,
                    tourName
                });
            }, 1000);
        });

        // pagination
        $('body').on('click', '.page-link', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            const dataFilter = getDataFilter();

            load_data_tour({
                ...dataFilter,
                page
            });
        });
    });
</script>
@endsection