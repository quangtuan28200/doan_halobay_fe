<div class="row yacht-detail-list-contact placeholder-color row-small-space">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="d-flex align-items-center justify-content-between">
            <div class="font-title font-22pt py-3">Thông tin liên hệ</div>
            <!-- <label class="d-flex align-items-center font-14pt mb-0">
                <div class="mr-2">Yêu cầu xuất hóa đơn</div>
                <div class="matter-checkbox mb-0">
                    <input type="checkbox" name="is_vat">
                    <span></span>
                </div>
            </label> -->
        </div>
        <p class="mb-4">Thông tin có dấu (*) là bắt buộc phải nhập. Xin quý khách vui lòng kiểm tra kỹ thông tin email, số điện thoại để tránh bị sai sót</p>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group mb-5px">
            <span class="star-required">*</span>
            <select class="selectpicker form-control h-auto py-12px bg-white" name="gender">
                <option value="0">Quý danh</option>
                <option value="1">Ông</option>
                <option value="2">Bà</option>
                <option value="3">Anh</option>
                <option value="4">Chị</option>
            </select>
            <span class="hidden">Bạn chưa chọn quý danh</span>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group mb-5px">
            <span class="star-required">*</span>
            <div class="input-group">
                <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" name="full_name" placeholder="Tên của bạn">
            </div>
            <span class="hidden">Bạn chưa nhập tên</span>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group mb-5px">
            <span class="star-required">*</span>
            <select class="selectpicker form-control h-auto py-12px bg-white" name="city_id">
                <option value="0">Thành Phố</option>
                @if ($list_place_city)
                @foreach ($list_place_city as $place_city)
                <option value="{{ $place_city->id }}">{{ $place_city->name }}</option>
                @endforeach
                @endif
            </select>
            <span class="hidden">Bạn chưa chọn thành phố</span>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group mb-5px">
            <span class="star-required">*</span>
            <div class="input-group">
                <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" name="address" placeholder="Địa chỉ cụ thể">
            </div>
            <span class="hidden">Bạn chưa nhập địa chỉ</span>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group mb-5px">
            <span class="star-required">*</span>
            <div class="input-group">
                <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" name="phone_number" placeholder="Số điện thoại">
            </div>
            <span class="hidden">Bạn chưa nhập số điện thoại</span>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group mb-5px">
            <span class="star-required">*</span>
            <div class="input-group">
                <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" name="email" placeholder="Email">
            </div>
            <span class="hidden">Bạn chưa nhập email liên hệ</span>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <textarea class="form-control border-0 rounded-0" name="content" placeholder="Nội dung yêu cầu" rows="4"></textarea>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 vat hide">
        <div class="form-group mb-5px">
            <div class="input-group">
                <input type="number" class="form-control border-0 h-auto no-active-focus py-12px" placeholder="Mã số thuế (*)" name="tax_code">
            </div>
            <span class="hidden">Bạn chưa nhập mã số thuế</span>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 vat hide">
        <div class="form-group mb-5px">
            <div class="input-group">
                <input type="text" class="form-control border-0 h-auto no-active-focus py-12px" placeholder="Tên công ty (*)" name="company_name">
            </div>
            <span class="hidden">Bạn chưa nhập tên công ty</span>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 vat hide">
        <div class="form-group mb-5px">
            <div class="input-group">
                <input type="email" class="form-control border-0 h-auto no-active-focus py-12px" placeholder="Địa chỉ (*)" name="company_address">
            </div>
            <span class="hidden">Bạn chưa nhập địa chỉ công ty</span>
        </div>
    </div>
</div>