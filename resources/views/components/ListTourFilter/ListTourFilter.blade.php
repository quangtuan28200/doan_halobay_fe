<div class="filter-list">
    <!-- <label for="slider-range" class="font-title-bold font-18pt">Hành trình</label>
                <input type="range" class="custom-range dayNum filterItem" min="1" max="10" step="1" id="slider-range">
                <div class="font-title range-date-text d-flex align-items-center justify-content-between mb-4">
                    <div>1 ngày</div>
                    <div>3 ngày</div>
                    <div>10 ngày</div>
                </div> -->
    <div class="filter-item-container mb-2">
        <div class="filter-item-group mb-4">
            <div class="font-title-bold font-18pt mb-2">Thời gian</div>
            <div class="matter-checkbox-item">
                <label class="matter-checkbox">
                    <input class="dayNum filterItem" type="checkbox" value="1">
                    <span>2-5 Ngày</span>
                </label>
            </div>
            <div class="matter-checkbox-item">
                <label class="matter-checkbox">
                    <input class="dayNum filterItem" type="checkbox" value="2">
                    <span>5-10 Ngày</span>
                </label>
            </div>
        </div>
    </div>

    <div class="filter-item-container mb-2">
        <div class="filter-item-group mb-4">
            <div class="font-title-bold font-18pt mb-2">Sắp xếp</div>
            <div class="matter-checkbox-item">
                <label class="matter-checkbox">
                    <input class="orderBy filterItem" type="checkbox" value="1">
                    <span>Giá từ thấp đến cao</span>
                </label>
            </div>
            <div class="matter-checkbox-item">
                <label class="matter-checkbox">
                    <input class="orderBy filterItem" type="checkbox" value="2">
                    <span>Giá từ cao đến thấp</span>
                </label>
            </div>
        </div>
    </div>

    <div class="filter-item-container mb-2">
        <div class="font-title-bold font-18pt mb-2">Điểm đến</div>
        <div class="filter-item-group">
            <div class="font-title-bold text-primary font-18pt mb-2">Du lịch quốc tế</div>
            <div class="collapseWrap">
                @if ($list_filter)
                @foreach ($list_filter->continentsList as $continentsList)
                <div class="matter-checkbox-item">
                    <label class="matter-checkbox">
                        <input class="continentId filterItem" type="checkbox" value="{{$continentsList->id}}">
                        <span>{{$continentsList->name}}</span>
                    </label>
                </div>
                @endforeach
                @endif
            </div>

            <div class="see_more mb-2 mt-2">
                <span class="mr-2" style="color: #41A03A">Xem thêm</span>
                <i style="color: #41A03A" class="fa fa-caret-down mb-1" aria-hidden="true"></i>
            </div>
        </div>
        <div class="filter-item-group">
            <div class="font-title-bold text-primary font-18pt mb-2">Du lịch trong nước</div>
            <div class="collapseWrap">
                @if ($list_filter)
                @foreach ($list_filter->placesList as $placesList)
                <div class="matter-checkbox-item">
                    <label class="matter-checkbox">
                        <input class="placeId filterItem" type="checkbox" value="{{$placesList->id}}">
                        <span>{{$placesList->name}}</span>
                    </label>
                </div>
                @endforeach
                @endif
            </div>

            <div class="see_more mb-2 mt-2">
                <span class="mr-2" style="color: #41A03A">Xem thêm</span>
                <i style="color: #41A03A" class="fa fa-caret-down mb-1" aria-hidden="true"></i>
            </div>
        </div>
    </div>

    <div class="filter-item-container mb-2">
        <div class="filter-item-group">
            <div class="font-title-bold font-18pt mb-2">Danh mục du lịch</div>
            <div class="collapseWrap">
                @if ($list_filter)
                @foreach ($list_filter->tourCategoryList as $tourCategoryList)
                <div class="matter-checkbox-item">
                    <label class="matter-checkbox">
                        <input class="tourCategory filterItem" type="checkbox" value="{{$tourCategoryList->id}}">
                        <span>{{$tourCategoryList->name}}</span>
                    </label>
                </div>
                @endforeach
                @endif
            </div>

            <div class="see_more mb-2 mt-2">
                <span class="mr-2" style="color: #41A03A">Xem thêm</span>
                <i style="color: #41A03A" class="fa fa-caret-down mb-1" aria-hidden="true"></i>
            </div>
        </div>
    </div>

    <div class="filter-item-container mb-2">
        <div class="filter-item-group">
            <div class="font-title-bold font-18pt mb-2">Loại hình du lịch</div>
            <div class="collapseWrap">
                @if ($list_filter)
                @foreach ($list_filter->tourTypeList as $tourTypeList)
                @if ($tourTypeList->status)
                <div class="matter-checkbox-item">
                    <label class="matter-checkbox">
                        <input class="tourType filterItem" type="checkbox" value="{{$tourTypeList->id}}">
                        <span>{{$tourTypeList->name}}</span>
                    </label>
                </div>
                @endif
                @endforeach
                @endif
            </div>

            <div class="see_more mb-2 mt-2">
                <span class="mr-2" style="color: #41A03A">Xem thêm</span>
                <i style="color: #41A03A" class="fa fa-caret-down mb-1" aria-hidden="true"></i>
            </div>
        </div>
    </div>

    <div class="filter-item-container mb-2">
        <div class="filter-item-group">
            <div class="font-title-bold font-18pt mb-2">Hoạt động du lịch</div>
            <div class="collapseWrap">
                @if ($list_filter)
                @foreach ($list_filter->tourActionList as $tourActionList)
                <div class="matter-checkbox-item">
                    <label class="matter-checkbox">
                        <input class="actionType filterItem" type="checkbox" value="{{$tourActionList->id}}">
                        <span>{{$tourActionList->name}}</span>
                    </label>
                </div>
                @endforeach
                @endif
            </div>

            <div class="see_more mb-2 mt-2">
                <span class="mr-2" style="color: #41A03A">Xem thêm</span>
                <i style="color: #41A03A" class="fa fa-caret-down mb-1" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</div>