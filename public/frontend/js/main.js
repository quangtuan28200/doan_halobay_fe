$(document).ready(function () {
    var scroll = new SmoothScroll('.nav-tab-scroll a[href*="#"]', {
        topOnEmptyHash: false,
        customEasing: function (time) {
            return time < 0.5 ? 2 * time * time : -1 + (4 - 2 * time) * time;
        },
    });

    if ($(".nav-tab-sticky").length == 1) {
        new PrettyScroll(".nav-tab-sticky", {
            container: ".nav-tab-sticky-parent",
            breakpoint: 575,
            offsetBottom: 20,
            condition: () => true,
        });
    }

    if ($(".sidebar-sticky").length == 1) {
        new PrettyScroll(".sidebar-sticky", {
            container: ".sidebar-sticky-parent",
            breakpoint: 575,
            offsetBottom: 20,
            condition: () => true,
        });
    }

    // Hiển thị thông báo khi xác nhận đăng ký
    $(".confirmSignupButton").on("click", function () {
        $("#signupConfirmModal").modal("show");
    });

    // Sự kiện hiển thị menu navbar trên mobile
    $(".navbar-toggler").on("click", function () {
        $(".backdrop-toggle-event").fadeToggle();
    });
    $(".backdrop-toggle-event").on("click", function () {
        $(".backdrop-toggle-event").fadeOut();
        $(".navbar-collapse").collapse("hide");
    });

    // Hiệu ứng dấu mũi tên khi click
    $(".collapse.show").each(function () {
        $(this)
            .parents(".account-info-item")
            .find(".account-info-item-toggle i")
            .addClass("icon-account-rotate");
    });

    // Xoay dấu mũi tên khi click
    $(".account-info-item-toggle").on("click", function () {
        $(this).find("i").toggleClass("icon-account-rotate");
    });

    // Hiện thị danh mục tin tức trong trang chi tiết trên mobile
    var newCategoryMobile = $(
        ".news-sidebar-related-news .news-category"
    ).html();
    $(".sidebar-news-mobile").append("" + newCategoryMobile + "");

    // Bố cục ảnh phần chi tiết đặt
    var allImage = $(".get-image").html();
    var firstImage = $(".get-image .combo-detail-image-item").first();
    $(".large-image").append(firstImage);
    $(".small-image").append(allImage);
    $(".small-image .combo-detail-image-item").first().remove();
    $(".get-image").empty();
    var allImageShow = $(".show-list-image .combo-detail-image-item").length;
    $(".small-image .combo-detail-image-item:nth-child(3)").append(
        '<div class="view-all-image position-absolute text-white font-title h-100 d-flex align-items-center justify-content-center">Xem tất cả ' +
        allImageShow +
        " ảnh</div>"
    );

    // Ẩn/Hiện thông tin lịch trình
    $(".schedule-item-header").on("click", function () {
        $(this).find("i").toggleClass("icon-rotate-180");
    });

    // $(".schedule-item-body.collapse.show").each(function () {
    //     $(this)
    //         .parents(".schedule-item")
    //         .find(".schedule-item-header i")
    //         .addClass("icon-rotate-180");
    // });

    // Hiện ảnh khi upload ảnh đại diện
    $(".input-upload-hide").hide();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(".img-display-avatar").attr("src", e.target.result);
                $(".input-upload-hide").show();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".change-avatar").on("click", function () {
        $(".upload-avatar-input").click();
    });

    $(".upload-avatar-input").change(function () {
        readURL(this);
    });

    // Hiển thị ảnh khi upload CMND ở phần đăng ký CTV
    var showPreivewImageCardInfo = function (input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function (event) {
                    $(
                        $.parseHTML(
                            '<img class="account-user-img img-fluid radius-md mr-2">'
                        )
                    )
                        .attr("src", event.target.result)
                        .appendTo(placeToInsertImagePreview);
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $(".upload-user-card").on("click", function () {
        $(".img-card-upload").trigger("click");
    });

    $(".img-card-upload").on("change", function () {
        $(".account-user-img-placeholder").empty();
        showPreivewImageCardInfo(this, "div.account-user-img-placeholder");
    });

    // Hiển thị ảnh khi upload CMND ở phần đăng ký CTV
    var showPreivewImageCardSignUp = function (
        input,
        placeToInsertImagePreview
    ) {
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function (event) {
                    $(
                        $.parseHTML(
                            '<img class="img-fluid imgCardInfoUpload d-block radius-sm">'
                        )
                    )
                        .attr("src", event.target.result)
                        .appendTo(placeToInsertImagePreview);
                    $(".card-info-upload-placeholder").addClass("d-flex");
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $(".uploadPersonCardBtn").on("click", function () {
        $(".inputCardPlace").trigger("click");
    });

    $(".inputCardPlace").on("change", function () {
        showPreivewImageCardSignUp(this, "div.card-info-upload-placeholder");
    });

    // Tạo hiệu ứng slider khi click dropdown menu user trên các thiết bị di động
    if ($(window).width() <= 790) {
        $(".dropdown-slide-toggle").on("click", function () {
            $(".backdrop-toggle-event").fadeToggle();
            $(this)
                .parents(".dropdown-user-account")
                .find(".dropdown-menu")
                .slideDown(500);
        });

        $(".backdrop-toggle-event").on("click", function () {
            $(".backdrop-toggle-event").fadeOut();
            $(".dropdown-user-account .dropdown-menu").slideUp(500);
        });

        var navbarContainerWidth = $(".navbar .container").outerWidth() - 30;
        $(".navbar-collapse").css("width", "" + navbarContainerWidth + "px");
        $(".dropdown-user-account .dropdown-menu").css(
            "width",
            "" + navbarContainerWidth + "px"
        );
    }

    if ($(window).width() <= 575) {
        var navbarContainerWidth = $(".navbar .container").outerWidth();
        $(".navbar-collapse").css("width", "" + navbarContainerWidth + "px");
        $(".dropdown-user-account .dropdown-menu").css(
            "width",
            "" + navbarContainerWidth + "px"
        );
    }

    // Sự kiện active khi click đánh giá sao
    $(".btn-star-rating").on("click", function () {
        $(".btn-star-rating").removeClass("active");
        $(this).prevAll().addClass("active");
        $(this).addClass("active");
    });

    // Sự kiện thêm dấu gạch ngang khi click nav-link
    $(".nav-tab-scroll .nav-link").on("click", function () {
        $(".nav-tab-scroll .nav-link").removeClass("active");
        $(this).addClass("active");
    });

    // Sự kiện check khi chưa xác định ngày
    $(".no-date-choose").on("change", function () {
        if ($(this).is(":checked")) {
            $(".no-date-choose-toggle").hide();
            $(".date-choose-input").addClass("pe-none");
        } else {
            $(".no-date-choose-toggle").show();
            $(".date-choose-input").removeClass("pe-none");
        }
    });

    // Hàm định dạng gi
    function formatPriceNumber(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $(".price-format-dot").text(
        formatPriceNumber($(".price-format-dot").text())
    );

    // Sự kiện check mã giảm giá
    $(".apply-coupon").on("click", function () {
        var couponValue = $(".coupon-code-input");
        if (couponValue.val() == "ABC123") {
            $(".check-coupon-text").addClass("text-success");
            $(".check-coupon-text").text(
                "Áp mã giảm giá thành công, bạn đã được giảm 30% trên tổng giá"
            );
            var newPrice = parseInt(
                $(".price-current").text().replace(/\./g, "")
            );
            $(".new-price").text(formatPriceNumber("" + newPrice * 0.3 + ""));
            $(".price-current").addClass("old-price");
        } else {
            $(".check-coupon-text").removeClass("text-success");
            $(".check-coupon-text").addClass("text-danger");
            $(".check-coupon-text").text(
                "Rất tiếc! Không thể tìm thấy mã voucher này. Bạn vui lòng kiểm tra lại mã và hạn sử dụng nhé."
            );
        }
    });

    // Hiển thị thông tin khách sạn trên mobile
    var benefitHotelList = $(".benefit-hotel-info").html();
    $(".hotel-benefit-mobile").append(benefitHotelList);

    // Chặn dropdown tắt khi click
    $(".input-step-fill").each(function () {
        if ($(this).val() == 0) {
            $(this)
                .parents(".input-group-select")
                .find(".step-minus")
                .addClass("disable-click");
        }
    });

    $(".dropdown-select-footer button").on("click", function (e) {
        e.preventDefault();
        $(this).parents(".dropdownPersonRoom").dropdown("hide");
    });

    $(".dropdown-select-option").on("click", function (e) {
        e.stopPropagation();
    });
    $('input[name="airplane-class"]').on("change", function () {
        if ($(".ticket-airplane-normal").is(":checked")) {
            $(".ticket-type").text("Vé thường");
        } else if ($(".ticket-airplane-vip").is(":checked")) {
            $(".ticket-type").text("Thương gia");
        }
    });
    $(".dropdownPersonRoom").each(function () {
        var totalPerson = 0;
        var totalRoom = 0;
        var iPerson;
        for (
            iPerson = 0;
            iPerson < $(this).find(".person-number-item").length;
            iPerson++
        ) {
            totalPerson += Number(
                $(this).find(".person-number-item").eq(iPerson).val()
            );
        }
        $(this).find(".total-person").text(totalPerson);

        var iRoom;
        for (
            iRoom = 0;
            iRoom < $(this).find(".room-number-item").length;
            iRoom++
        ) {
            totalRoom += Number(
                $(this).find(".room-number-item").eq(iRoom).val()
            );
        }
        $(this).find(".total-room").text(totalRoom);
    });
    $(".step-minus").on("click", function (e) {
        e.stopPropagation();
        $(this)
            .parents(".input-group-select")
            .find(".input-step-fill")[0]
            .stepDown(1);
        var inputNumberPerson = $(this)
            .parents(".input-group-select")
            .find(".input-step-fill");
        if (inputNumberPerson.val() == 0) {
            $(this).addClass("disable-click");
        }

        var totalPerson = 0;
        var totalRoom = 0;

        var iPerson;
        for (
            iPerson = 0;
            iPerson <
            $(this).parents(".dropdownPersonRoom").find(".person-number-item")
                .length;
            iPerson++
        ) {
            totalPerson += Number(
                $(this)
                    .parents(".dropdownPersonRoom")
                    .find(".person-number-item")
                    .eq(iPerson)
                    .val()
            );
        }
        $(this)
            .parents(".dropdownPersonRoom")
            .find(".total-person")
            .text(totalPerson);

        var iRoom;
        for (
            iRoom = 0;
            iRoom <
            $(this).parents(".dropdownPersonRoom").find(".room-number-item")
                .length;
            iRoom++
        ) {
            totalRoom += Number(
                $(this)
                    .parents(".dropdownPersonRoom")
                    .find(".room-number-item")
                    .eq(iRoom)
                    .val()
            );
        }
        $(this)
            .parents(".dropdownPersonRoom")
            .find(".total-room")
            .text(totalRoom);
    });

    $(".step-plus").on("click", function (e) {
        e.stopPropagation();
        $(this)
            .parents(".input-group-select")
            .find(".input-step-fill")[0]
            .stepUp(1);
        $(this)
            .parents(".input-group-select")
            .find(".step-minus")
            .removeClass("disable-click");
        const name = $(this)
            .parents(".input-group-select")
            .find(".input-step-fill")
            .attr("name");
        var totalPerson = 0;
        var totalRoom = 0;
        var iPerson;
        for (
            iPerson = 0;
            iPerson <
            $(this).parents(".dropdownPersonRoom").find(".person-number-item")
                .length;
            iPerson++
        ) {
            totalPerson += Number(
                $(this)
                    .parents(".dropdownPersonRoom")
                    .find(".person-number-item")
                    .eq(iPerson)
                    .val()
            );
        }
        $(this)
            .parents(".dropdownPersonRoom")
            .find(".total-person")
            .text(totalPerson);
        var iRoom;
        for (
            iRoom = 0;
            iRoom <
            $(this).parents(".dropdownPersonRoom").find(".room-number-item")
                .length;
            iRoom++
        ) {
            totalRoom += Number(
                $(this)
                    .parents(".dropdownPersonRoom")
                    .find(".room-number-item")
                    .eq(iRoom)
                    .val()
            );
        }
        $(this)
            .parents(".dropdownPersonRoom")
            .find(".total-room")
            .text(totalRoom);
    });
    // Hàm lấy ngày tiếp theo của ngày hiện tại
    var currentDate = moment(new Date()).utc().format();
    var expirationDate = moment(currentDate).format("DD/MM/YYYY");
    // Sự kiện hiển thị chọn ngày bắt đầu, ngày kết thúc
    $(
        ".yacht-date-picker,.date-range-airplane-oneway,.date-picker-tour,.tour-detail-date-picker,.user-birthday-picker,.combo-detail-picker-date,.date-range-airplane-twoway,.date-hotel-start"
    ).daterangepicker({
        minDate: "" + expirationDate + "",
        singleDatePicker: true,
        locale: {
            format: "DD/MM/YYYY",
            separator: " / ",
            applyLabel: "Apply",
            cancelLabel: "Cancel",
            fromLabel: "From",
            toLabel: "To",
            customRangeLabel: "Custom",
            weekLabel: "W",
            daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
            monthNames: [
                "Tháng 1 - ",
                "Tháng 2 - ",
                "Tháng 3 - ",
                "Tháng 4 - ",
                "Tháng 5 - ",
                "Tháng 6 - ",
                "Tháng 7 - ",
                "Tháng 8 - ",
                "Tháng 9 - ",
                "Tháng 10 - ",
                "Tháng 11 - ",
                "Tháng 12 - ",
            ],
            firstDay: 1,
        },
        autoApply: true,
    });
    $(
        ".yacht-date-picker,.date-range-airplane-oneway,.date-picker-tour,.tour-detail-date-picker,.user-birthday-picker,.combo-detail-picker-date,.date-range-airplane-twoway,.date-hotel-start"
    ).on("showCalendar.daterangepicker", function (ev, picker) {
        $(".drp-header").remove();
    });
    $("body").on(
        "focus",
        ".date-range-booking-start,.date-range-seaplane-start",
        function () {
            const _this = $(this);
            const start_date = $(".date-range-booking-start").val();
            const end_date = $(".date-range-booking-end").val();
            const start_date_hotel = sessionStorage.getItem("start_date_hotel");
            const end_date_hotel = sessionStorage.getItem("end_date_hotel");
            _this.daterangepicker({
                minDate: "" + expirationDate + "",
                opens: "left",
                locale: {
                    format: "DD/MM/YYYY",
                    daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                    monthNames: [
                        "Tháng 1 - ",
                        "Tháng 2 - ",
                        "Tháng 3 - ",
                        "Tháng 4 - ",
                        "Tháng 5 - ",
                        "Tháng 6 - ",
                        "Tháng 7 - ",
                        "Tháng 8 - ",
                        "Tháng 9 - ",
                        "Tháng 10 - ",
                        "Tháng 11 - ",
                        "Tháng 12 - ",
                    ],
                },
            });
            if (start_date_hotel == "0") {
                if (start_date != "") {
                    _this.data("daterangepicker").setStartDate(start_date);
                    _this.data("daterangepicker").setEndDate(end_date);
                }
            } else {
                if (start_date != "") {
                    _this.data("daterangepicker").setStartDate(start_date);
                    _this.data("daterangepicker").setEndDate(end_date);
                } else {
                    _this
                        .data("daterangepicker")
                        .setStartDate(start_date_hotel);
                    _this.data("daterangepicker").setEndDate(end_date_hotel);
                }
            }
            _this.on("showCalendar.daterangepicker", function (ev, picker) {
                $("td.off.disabled").removeClass("active end-date");
            });
            _this.on("showCalendar.daterangepicker", function (ev, picker) {
                $(".drp-header").remove();
                $(".daterangepicker").prepend(
                    '<div class="drp-header d-flex align-items-center border-bottom py-2 px-3">\
                                <div class="d-flex align-items-center">\
                                    <i class="far fa-calendar text-primary mr-2"></i>\
                                    <div>\
                                        <div class="font-13pt mb-1">Nhận phòng</div>\
                                        <div class="dateRangeStart text-primary font-14pt"></div>\
                                    </div>\
                                </div>\
                                <i class="far fa-chevron-right text-primary mx-3"></i>\
                                <div class="d-flex align-items-center">\
                                    <i class="far fa-calendar text-primary mr-2"></i>\
                                    <div>\
                                        <div class="font-13pt mb-1">Trả phòng</div>\
                                        <div class="dateRangeEnd text-primary font-14pt"></div>\
                                    </div>\
                                </div>\
                            </div>'
                );
                if (start_date_hotel == "0") {
                    if (start_date != "") {
                        $(".dateRangeStart").html(start_date);
                        $(".dateRangeEnd").html(end_date);
                    } else {
                        $(".dateRangeStart").html(
                            _this
                                .data("daterangepicker")
                                .startDate.format("DD/MM/YYYY")
                        );
                        $(".dateRangeEnd").html(
                            _this
                                .data("daterangepicker")
                                .endDate.format("DD/MM/YYYY")
                        );
                    }
                } else {
                    if (start_date != "") {
                        $(".dateRangeStart").html(start_date);
                        $(".dateRangeEnd").html(end_date);
                    } else {
                        $(".dateRangeStart").html(start_date_hotel);
                        $(".dateRangeEnd").html(end_date_hotel);
                    }
                }
                $(".drp-buttons").addClass("text-center");
                $(".drp-buttons").html(
                    '<button class="applyBtn btn btn-sm btn-primary-gradient font-title-bold text-white h-auto py-2 font-sm-title col-sm-12 col-md-8 col-lg-5 mx-auto" type="button">Đồng ý</button>'
                );
            });
            _this.on("hide.daterangepicker", function (ev, picker) {
                _this.val(
                    "" +
                    _this
                        .data("daterangepicker")
                        .startDate.format("DD/MM/YYYY") +
                    ""
                );
                $(".date-range-booking-end, .date-range-airplane-end").val(
                    "" +
                    _this
                        .data("daterangepicker")
                        .endDate.format("DD/MM/YYYY") +
                    ""
                );
            });
            if (_this.length >= 1) {
                _this.val(
                    "" +
                    _this
                        .data("daterangepicker")
                        .startDate.format("DD/MM/YYYY") +
                    ""
                );
            }
            if (start_date_hotel != "0") {
                $(this).val(start_date_hotel);
                $(".date-range-booking-end, .date-range-airplane-end").val(
                    end_date_hotel
                );
            }
        }
    );
    $("body").on("focus", ".date-range-airplane-start", function () {
        const _this = $(this);
        const start_date = $(".date-range-airplane-start").val();
        const end_date = $(".date-range-airplane-end").val();
        //const start_date_hotel = sessionStorage.getItem("start_date_hotel");
        //const end_date_hotel = sessionStorage.getItem("end_date_hotel");
        _this.daterangepicker({
            minDate: "" + expirationDate + "",
            opens: "left",
            locale: {
                format: "DD/MM/YYYY",
                daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                monthNames: [
                    "Tháng 1 - ",
                    "Tháng 2 - ",
                    "Tháng 3 - ",
                    "Tháng 4 - ",
                    "Tháng 5 - ",
                    "Tháng 6 - ",
                    "Tháng 7 - ",
                    "Tháng 8 - ",
                    "Tháng 9 - ",
                    "Tháng 10 - ",
                    "Tháng 11 - ",
                    "Tháng 12 - ",
                ],
            },
        });
        if (start_date != "") {
            _this.data("daterangepicker").setStartDate(start_date);
            _this.data("daterangepicker").setEndDate(end_date);
        }
        _this.on("showCalendar.daterangepicker", function (ev, picker) {
            $("td.off.disabled").removeClass("active end-date");
        });
        _this.on("showCalendar.daterangepicker", function (ev, picker) {
            $(".drp-header").remove();
            $(".daterangepicker").prepend(
                '<div class="drp-header d-flex align-items-center border-bottom py-2 px-3">\
                                <div class="d-flex align-items-center">\
                                    <i class="far fa-calendar text-primary mr-2"></i>\
                                    <div>\
                                        <div class="font-13pt mb-1">Ngày đi</div>\
                                        <div class="dateRangeStart text-primary font-14pt"></div>\
                                    </div>\
                                </div>\
                                <i class="far fa-chevron-right text-primary mx-3"></i>\
                                <div class="d-flex align-items-center">\
                                    <i class="far fa-calendar text-primary mr-2"></i>\
                                    <div>\
                                        <div class="font-13pt mb-1">Ngày về</div>\
                                        <div class="dateRangeEnd text-primary font-14pt"></div>\
                                    </div>\
                                </div>\
                            </div>'
            );
            if (start_date != "") {
                $(".dateRangeStart").html(start_date);
                $(".dateRangeEnd").html(end_date);
            } else {
                $(".dateRangeStart").html(
                    _this.data("daterangepicker").startDate.format("DD/MM/YYYY")
                );
                $(".dateRangeEnd").html(
                    _this.data("daterangepicker").endDate.format("DD/MM/YYYY")
                );
            }
            $(".drp-buttons").addClass("text-center");
            $(".drp-buttons").html(
                '<button class="applyBtn btn btn-sm btn-primary-gradient font-title-bold text-white h-auto py-2 font-sm-title col-sm-12 col-md-8 col-lg-5 mx-auto" type="button">Đồng ý</button>'
            );
        });
        _this.on("hide.daterangepicker", function (ev, picker) {
            _this.val(
                "" +
                _this
                    .data("daterangepicker")
                    .startDate.format("DD/MM/YYYY") +
                ""
            );
            $(".date-range-airplane-end").val(
                "" +
                _this.data("daterangepicker").endDate.format("DD/MM/YYYY") +
                ""
            );
        });
        if (_this.length >= 1) {
            _this.val(
                "" +
                _this
                    .data("daterangepicker")
                    .startDate.format("DD/MM/YYYY") +
                ""
            );
        }
        $(this).val(start_date);
        $(".date-range-airplane-end").val(end_date);
    });

    $(".yacht-date-picker,.date-picker-tour").on(
        "showCalendar.daterangepicker",
        function (ev, picker) {
            $(".drp-header").remove();
        }
    );

    // Checkbox radio airplane
    $('input[name="airplane-class"]').on("change", function () {
        if ($(this).is(":checked")) {
            $(".airplane-class-check")
                .find("i")
                .removeClass("d-block")
                .addClass("d-none");
            $(this)
                .parents(".airplane-class-check")
                .find("i")
                .removeClass("d-none")
                .addClass("d-block");
        }
    });

    $('input[name="airplane-class"]').each(function () {
        if ($(this).is(":checked")) {
            $(".airplane-class-check")
                .find("i")
                .removeClass("d-block")
                .addClass("d-none");
            $(this)
                .parents(".airplane-class-check")
                .find("i")
                .removeClass("d-none")
                .addClass("d-block");
        }
    });

    // Ngày đặt vé máy bay

    $(".date-range-airplane-start").on(
        "showCalendar.daterangepicker",
        function (ev, picker) {
            $(".drp-header").remove();
            $(".daterangepicker").prepend(
                '<div class="drp-header d-flex align-items-center border-bottom py-2 px-3">\
                            <div class="d-flex align-items-center">\
                                <i class="far fa-calendar text-primary mr-2"></i>\
                                <div>\
                                    <div class="font-13pt mb-1">Ngày đi</div>\
                                    <div class="dateRangeAirplaneStart text-primary font-14pt"></div>\
                                </div>\
                            </div>\
                            <i class="far fa-chevron-right text-primary mx-3"></i>\
                            <div class="d-flex align-items-center">\
                                <i class="far fa-calendar text-primary mr-2"></i>\
                                <div>\
                                    <div class="font-13pt mb-1">Ngày về</div>\
                                    <div class="dateRangeAirplaneEnd text-primary font-14pt"></div>\
                                </div>\
                            </div>\
                        </div>'
            );
            $(".dateRangeAirplaneStart").html(
                $(".date-range-airplane-start")
                    .data("daterangepicker")
                    .startDate.format("DD/MM/YYYY")
            );
            $(".dateRangeAirplaneEnd").html(
                $(".date-range-airplane-start")
                    .data("daterangepicker")
                    .endDate.format("DD/MM/YYYY")
            );
            $(".drp-buttons").addClass("text-center");
            $(".drp-buttons").html(
                '<button class="applyBtn btn btn-sm btn-primary-gradient font-title-bold text-white h-auto py-2 font-sm-title col-sm-12 col-md-8 col-lg-5 mx-auto" type="button">Đồng ý</button>'
            );
        }
    );

    $(".date-range-airplane-start").on(
        "hide.daterangepicker",
        function (ev, picker) {
            $(".date-range-airplane-start").val(
                "" +
                $(".date-range-airplane-start")
                    .data("daterangepicker")
                    .startDate.format("DD/MM/YYYY") +
                ""
            );
            $(".date-range-airplane-end").val(
                "" +
                $(".date-range-airplane-start")
                    .data("daterangepicker")
                    .endDate.format("DD/MM/YYYY") +
                ""
            );
        }
    );

    $(".date-range-airplane-start").on(
        "apply.daterangepicker",
        function (ev, picker) {
            $(".date-range-airplane-start").val(
                "" +
                $(".date-range-airplane-start")
                    .data("daterangepicker")
                    .startDate.format("DD/MM/YYYY") +
                ""
            );
            $(".date-range-airplane-end").val(
                "" +
                $(".date-range-airplane-start")
                    .data("daterangepicker")
                    .endDate.format("DD/MM/YYYY") +
                ""
            );
        }
    );

    // Ngày đặt thủy phi cơ

    $(".date-range-seaplane-start").on(
        "showCalendar.daterangepicker",
        function (ev, picker) {
            $(".drp-header").remove();
            $(".daterangepicker").prepend(
                '<div class="drp-header d-flex align-items-center border-bottom py-2 px-3">\
                            <div class="d-flex align-items-center">\
                                <i class="far fa-calendar text-primary mr-2"></i>\
                                <div>\
                                    <div class="font-13pt mb-1">Ngày đi</div>\
                                    <div class="dateRangeSeaplaneStart text-primary font-14pt"></div>\
                                </div>\
                            </div>\
                            <i class="far fa-chevron-right text-primary mx-3"></i>\
                            <div class="d-flex align-items-center">\
                                <i class="far fa-calendar text-primary mr-2"></i>\
                                <div>\
                                    <div class="font-13pt mb-1">Ngày về</div>\
                                    <div class="dateRangeSeaplaneEnd text-primary font-14pt"></div>\
                                </div>\
                            </div>\
                        </div>'
            );
            $(".dateRangeSeaplaneStart").html(
                $(".date-range-seaplane-start")
                    .data("daterangepicker")
                    .startDate.format("DD/MM/YYYY")
            );
            $(".dateRangeSeaplaneEnd").html(
                $(".date-range-seaplane-start")
                    .data("daterangepicker")
                    .endDate.format("DD/MM/YYYY")
            );
            $(".drp-buttons").addClass("text-center");
            $(".drp-buttons").html(
                '<button class="applyBtn btn btn-sm btn-primary-gradient font-title-bold text-white h-auto py-2 font-sm-title col-sm-12 col-md-8 col-lg-5 mx-auto" type="button">Đồng ý</button>'
            );
        }
    );

    $(".date-range-seaplane-start").on(
        "hide.daterangepicker",
        function (ev, picker) {
            $(".date-range-seaplane-start").val(
                "" +
                $(".date-range-seaplane-start")
                    .data("daterangepicker")
                    .startDate.format("DD/MM/YYYY") +
                ""
            );
            $(".date-range-seaplane-end").val(
                "" +
                $(".date-range-seaplane-start")
                    .data("daterangepicker")
                    .endDate.format("DD/MM/YYYY") +
                ""
            );
        }
    );

    $(".date-range-seaplane-start").on(
        "apply.daterangepicker",
        function (ev, picker) {
            $(".date-range-seaplane-start").val(
                "" +
                $(".date-range-seaplane-start")
                    .data("daterangepicker")
                    .startDate.format("DD/MM/YYYY") +
                ""
            );
            $(".date-range-seaplane-end").val(
                "" +
                $(".date-range-seaplane-start")
                    .data("daterangepicker")
                    .endDate.format("DD/MM/YYYY") +
                ""
            );
        }
    );

    // Kiểm tra url hiển thị đúng tab đang mở
    $("body").on("click", ".footer-link-action", function () {
        var hashIdTabOnLoad = $(this).data("link");
        setTimeout(function () {
            var url = window.location.pathname;
            if (url != "" && url != "/") {
                sessionStorage.setItem("url_tab", hashIdTabOnLoad);
                window.location.href = "/";
            }
            $(
                '.combo-booking-nav .nav-link[href="' + hashIdTabOnLoad + '"]'
            ).tab("show");
        }, 500);
    });
    $(document).ready(function () {
        const url_tab = sessionStorage.getItem("url_tab");
        if (url_tab != "" && url_tab != "/") {
            sessionStorage.setItem("url_tab", "/");
        }
        $('.combo-booking-nav .nav-link[href="' + url_tab + '"]').tab("show");
    });

    // Rangerslider tour
    $("#rangerSliderDate").ionRangeSlider({
        min: 1,
        max: 10,
        from: 5,
    });

    // Hiển thị thông tin vé máy bay trên mobile

    if ($(window).width() <= 700) {
        $(".airplane-ticket-info").on("click", function () {
            var airplaneItemInfo = $(this)
                .parents(".airplane-item")
                .find(".airplane-item-info")
                .html();
            var airplaneItemButton = $(this).find("div:last-child").html();
            console.log(airplaneItemButton);
            $(".airplane-info-mobile").html(airplaneItemInfo);
            $(".airplane-sidebar-info").addClass("active");
            $(".airplane-info-mobile-footer").html(airplaneItemButton);
            $(".airplane-info-mobile-footer a.btn").addClass(
                "btn-block font-title font-16pt py-2 m-0"
            );
        });
        $(".close-airplane-info").on("click", function () {
            $(".airplane-sidebar-info").removeClass("active");
            $(".airplane-info-mobile").empty();
        });
    }

    // Sự kiện click vào thời gian bay
    $(".airplane-time-flight-item").on("click", function () {
        $(".airplane-time-flight-item").removeClass("active");
        $(this).addClass("active");
    });

    // Sự kiện hiển thị quy đinh phòng du thuyền
    $(".view-yacht-rule,.view-tour-detail-info,.view-hotel-room-info").on(
        "click",
        function () {
            $(".yacht-rule-backdrop").fadeIn(300);
            $(".yacht-rule-container").addClass("active");
        }
    );

    $(".yacht-rule-backdrop,.yacht-rule-close").on("click", function () {
        $(".yacht-rule-backdrop").fadeOut(300);
        $(".yacht-rule-container").removeClass("active");
    });

    // Hiển thị bộ lọc trên điện thoại
    var filterListContent = $(".filter-list").html();
    $(".filter-mobile-content").html(filterListContent);

    $(".toggle-filter-mobile").on("click", function () {
        $(".filter-mobile").addClass("active");
    });

    $(".close-filter-mobile").on("click", function () {
        $(".filter-mobile").removeClass("active");
    });

    // Sự kiện checkbox 1 lần
    $(".matter-checkbox-item .matter-checkbox input").on("change", function () {
        if ($(this).is(":checked")) {
            $(this)
                .parents(".filter-item-group")
                .find(".matter-checkbox input")
                .prop("checked", false);
            $(this).prop("checked", true);
        }
    });

    // Sự kiện hiển thị khi áp dụng mã thất bại
    $(".apply-coupon-code").on("click", function () {
        $("#appleCodeFail").modal("show");
    });

    // Sự kiện hiển thị đánh giá, qa modal
    $(".view-rated-sidebar").on("click", function () {
        $(".backdrop-modal").fadeIn(300);
        $(".form-rateUpdate-container").addClass("hidden");
        $(".btn-update-rate").html(
            'Chỉnh sửa đánh giá <i class="fas fa-edit"></i>'
        );
        $(".rated-list-sidebar").addClass("active");
    });

    $(".backdrop-modal,.hotel-rated-list-close").on("click", function () {
        $(".backdrop-modal").fadeOut(300);
        $(".rated-list-sidebar").removeClass("active");
    });

    $(".backdrop-modal,.hotel-rated-close").on("click", function () {
        $(".backdrop-modal").fadeOut(300);
        $(".rated-container").removeClass("active");
    });

    $(".view-quesion-answer-sidebar,.add-question").on("click", function () {
        $(".backdrop-modal").fadeIn(300);
        $(".form-quesUpdate-container").addClass("hidden");
        $(".btn-update-ques").html(
            'Chỉnh sửa đánh giá <i class="fas fa-edit"></i>'
        );
        $(".question-answer-sidebar").addClass("active");
    });

    $(".backdrop-modal,.question-answer-sidebar-close").on(
        "click",
        function () {
            $(".backdrop-modal").fadeOut(300);
            $(".question-answer-sidebar").removeClass("active");
        }
    );

    $(".backdrop-modal,.room-detail-sidebar-close").on("click", function () {
        $(".backdrop-modal").fadeOut(300);
        $(".room-detail-sidebar").removeClass("active");
    });

    // Sự kiện khi click chọn ngây hàng hiện ra border và dấu check ở góc trên cùng bên phải
    $(".select-bank-item").on("click", function () {
        $(".select-bank-item").removeClass("active");
        $(this).addClass("active");
    });

    $(".select-bank-item").each(function () {
        $(this)
            .find("input[checked]")
            .parents(".select-bank-item")
            .addClass("active");
    });

    // Sự kiện khi click đánh giá bằng icon cảm xúc
    $(".rated-emotion-item").on("click", function () {
        $(".rated-emotion-item").removeClass("active");
        $(this).addClass("active");
    });

    // Sự kiện thay đổi tên và thông tin tài khoản khi chọn ngân hàng
    $(".select-bank-item").on("click", function () {
        var bankTitle = $(this).data("bank-title");
        var bankContent = $(this).data("bank-content");
        $(".bank-name-title").text("" + bankTitle + "");
        $(".bank-content").html("" + bankContent + "");
    });

    // Hiển thị nội dung chuyển khoản khi click vào các ô checkbox tương ứng
    $(".paymentMethodCheck").on("change", function () {
        if ($(this).is(":checked")) {
            $(".paymentMethodCheck").prop("checked", false);
            $(this).prop("checked", true);
            $(".checkbox-payment-item").slideUp();
            $(this)
                .parents(".checkbox-payment-method")
                .find(".checkbox-payment-item")
                .slideDown();
        } else {
            $(this)
                .parents(".checkbox-payment-method")
                .find(".checkbox-payment-item")
                .slideUp();
        }
    });

    // Sự kiện hiển thị thông tin chuyến bay
    $("body").on("click", ".show-info-airplane", function () {
        $(this).toggleClass("active");
        $(this)
            .parents(".airplane-item")
            .find(".airplane-item-info")
            .slideToggle();
    });

    // Sự kiện hiển thị thông báo khi click hủy đặt phòng khách sạn
    $(".cancel-booking-btn").on("click", function () {
        $("#cancelBookingModal").modal("show");
    });

    //
    $.fancybox.defaults.hash = false;
});
const checkInput = function (form, param, input_name) {
    if (param === "" || param === undefined) {
        form.find(`input[name=${input_name}]`)
            .parent()
            .next()
            .removeClass("hidden");
        form.find(`input[name=${input_name}]`)
            .parent()
            .next()
            .addClass("error_res");
        return 0;
    } else {
        form.find(`input[name=${input_name}]`)
            .parent()
            .next()
            .removeClass("error_res");
        form.find(`input[name=${input_name}]`)
            .parent()
            .next()
            .addClass("hidden");
        return 1;
    }
};
const checkSelect = function (form, param, input_name) {
    if (input_name == "extraBed[]") return false;
    if (param === "0" || param === undefined) {
        form.find(`select[name=${input_name}]`)
            .parent()
            .next()
            .removeClass("hidden");
        form.find(`select[name=${input_name}]`)
            .parent()
            .next()
            .addClass("error_res");
        return 0;
    } else {
        form.find(`select[name=${input_name}]`)
            .parent()
            .next()
            .removeClass("error_res");
        form.find(`select[name=${input_name}]`)
            .parent()
            .next()
            .addClass("hidden");
        return 1;
    }
};
$("input").on("change", function () {
    const form = $(this).closest("form");
    const param = $(this).val();
    const input_name = $(this).attr("name");
    checkInput(form, param, input_name);
});
$("select").on("change", function () {
    const form = $(this).closest("form");
    const param = $(this).val();
    const input_name = $(this).attr("name");
    checkSelect(form, param, input_name);
});
$("body").on("click", "input[name=is_vat]", function () {
    if ($(this).is(":checked")) {
        $(".vat").removeClass("hide");
    } else {
        $(".vat").addClass("hide");
    }
});
const calc = function () {
    const number_adultNum =
        $("input[name=number_adultNum]").val() != ""
            ? parseInt($("input[name=number_adultNum]").val())
            : 0;
    const number_childNum =
        $("input[name=number_childNum]").val() != ""
            ? parseInt($("input[name=number_childNum]").val())
            : 0;
    const number_childNum2 =
        $("input[name=number_childNum2]").val() != ""
            ? parseInt($("input[name=number_childNum2]").val())
            : 0;
    const price_adultNum = $("select[name=comboPrice] option:selected").data(
        "price"
    );
    const price_sale_adultNum = $(
        "select[name=comboPrice] option:selected"
    ).data("pricedisplay");
    const price_childNum = $("select[name=comboPrice] option:selected").data(
        "priceyoung"
    );
    const price_childNum2 = $("select[name=comboPrice] option:selected").data(
        "pricechildren"
    );
    const percentDiscount = $("select[name=comboPrice] option:selected").data(
        "percentdiscount"
    );
    if (number_adultNum == 0) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Bạn chưa chọn người lớn đi cùng",
        });
        return true;
    } else {
        $(".number_adultNum").html("x" + number_adultNum);
        let total_adultNum = 0;
        if (percentDiscount != 0) {
            total_adultNum =
                (price_sale_adultNum != 0
                    ? price_sale_adultNum
                    : price_adultNum) *
                (1 - percentDiscount / 100) *
                number_adultNum;
        } else {
            total_adultNum =
                (price_sale_adultNum != 0
                    ? price_sale_adultNum
                    : price_adultNum) * number_adultNum;
        }
        let total_childNum = 0;
        let total_childNum2 = 0;
        $(".price_adultNum").html(
            accounting.formatMoney(total_adultNum, "", 0, ".", ",") + " VND"
        );
        if (number_childNum != 0) {
            $(".number_childNum").html("x" + number_childNum);
            if (percentDiscount != 0) {
                total_childNum =
                    number_childNum *
                    (1 - percentDiscount / 100) *
                    price_childNum;
            } else {
                total_childNum = number_childNum * price_childNum;
            }
            $(".price_childNum").html(
                accounting.formatMoney(total_childNum, "", 0, ".", ",") + " VND"
            );
        } else {
            $(".number_childNum").html("");
            $(".price_childNum").html("");
        }
        if (number_childNum2 != 0) {
            $(".number_childNum2").html("x" + number_childNum2);
            if (percentDiscount != 0) {
                total_childNum2 =
                    number_childNum2 *
                    (1 - percentDiscount / 100) *
                    price_childNum2;
            } else {
                total_childNum2 = number_childNum2 * price_childNum2;
            }
            $(".price_childNum2").html(
                accounting.formatMoney(total_childNum2, "", 0, ".", ",") +
                " VND"
            );
        } else {
            $(".number_childNum2").html("");
            $(".price_childNum2").html("");
        }
        $(".total").html(
            accounting.formatMoney(
                total_adultNum + total_childNum + total_childNum2,
                "",
                0,
                ".",
                ","
            ) + " VND"
        );
        return false;
    }
};
const process = function (date) {
    var parts = date.split("/");
    return new Date(parts[2], parts[1] - 1, parts[0]);
};
$("body").on("click", ".logout", function () {
    $.ajax({
        url: "/tai-khoan/logout",
        type: "GET",
        success: function (response) {
            window.location.href = "/";
        },
    });
});

// see more

//get height of all .collapseWrap
$(".collapseWrap").each(function () {
    const height = $(this).height();
    if (height > 125) {
        $(this).addClass("colapse");
    } else {
        $(this).parent().find(".see_more").addClass("hidden");
    }
});

//click see more
$(".see_more span").click(function (e) {
    e.preventDefault();
    $(this).text() === "Xem thêm"
        ? $(this).text("Thu gọn")
        : $(this).text("Xem thêm");
    $(this).parent().find("i").toggleClass("fa-caret-down fa-caret-up");
    $(this).parent().parent().find(".collapseWrap").toggleClass("expanse");
});

// create rate
$("#form-rate").submit(function (event) {
    event.preventDefault();
    $button = $(this).find("button[type=submit]");
    // $(".overlay-loader").show();
    const detailId = $("input[name=detailId-rate]").val();
    const name = $("input[name=name-rate]").val();
    const email = $("input[name=email-rate]").val();
    const phone = $("input[name=phone-rate]").val();
    const content = $("textarea[name=content-rate]").val();
    const rate = $(".rated-emotion-item.active").data("rate-num") || 5;

    const data = {
        detailId,
        name,
        email,
        phone,
        content,
        rate,
        userId: null,
    };

    $button.attr("disabled", true);
    $button.html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/create-rate-hotel",
        type: "POST",
        data: data,
        success: function (res) {
            $button.attr("disabled", false);
            $button.html("Gửi đánh giá");
            // $(".overlay-loader").hide();
            $("#form-rate")[0].reset();
            // console.log('res: ', res)
            if (res.success) {
                Swal.fire({
                    icon: "success",
                    title: "Thành công",
                    text: res.message,
                }).then(function () {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Đánh giá thất bại",
                    text: res.message,
                });
            }
        },
        error: function (xhr, status, error) {
            $(".overlay-loader").hide();
            $("#form-rate")[0].reset();
            Swal.fire({
                icon: "error",
                title: "Đánh giá thất bại",
                text: "Có lỗi xảy ra, vui lòng thử lại sau",
            });
        },
    });
});

// create question
$("#form-qa").submit(function (event) {
    event.preventDefault();
    $button = $(this).find("button[type=submit]");
    // $(".overlay-loader").show();
    const detailId = $("input[name=detailId-qa]").val();
    const name = $("input[name=name-qa]").val();
    const email = $("input[name=email-qa]").val();
    const phone = $("input[name=phone-qa]").val();
    const question = $("textarea[name=content-qa]").val();

    const data = {
        detailId,
        name,
        email,
        phone,
        question,
    };

    // console.log(data)
    $button.attr("disabled", true);
    $button.html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/create-question-hotel",
        type: "POST",
        data: data,
        success: function (res) {
            $button.attr("disabled", false);
            $button.html("Gửi câu hỏi");
            // $(".overlay-loader").hide();
            $("#form-qa")[0].reset();
            // console.log('res: ', res)
            if (res.success) {
                Swal.fire({
                    icon: "success",
                    title: "Thành công",
                    text: res.message,
                }).then(function () {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Gửi câu hỏi thất bại",
                    text: res.message,
                });
            }
        },
        error: function (xhr, status, error) {
            $(".overlay-loader").hide();
            $("#form-qa")[0].reset();
            Swal.fire({
                icon: "error",
                title: "Gửi câu hỏi thất bại",
                text: "Có lỗi xảy ra, vui lòng thử lại sau",
            });
        },
    });
});

//toggle form update ques
$(".btn-update-ques").click(function (e) {
    e.preventDefault();
    const form = $(".form-quesUpdate-container");
    if (form.hasClass("hidden")) {
        $(this).html('Huỷ chỉnh sửa <i class="fas fa-times"></i>');
        form.removeClass("hidden");
        form.addClass("show");
    } else {
        $(this).html('Chỉnh sửa đánh giá <i class="fas fa-edit"></i>');
        form.removeClass("show");
        form.addClass("hidden");
    }
});

//toggle form update rate
$(".btn-update-rate").click(function (e) {
    e.preventDefault();
    const form = $(".form-rateUpdate-container");
    if (form.hasClass("hidden")) {
        $(this).html('Huỷ chỉnh sửa <i class="fas fa-times"></i>');
        form.removeClass("hidden");
        form.addClass("show");
    } else {
        $(this).html('Chỉnh sửa đánh giá <i class="fas fa-edit"></i>');
        form.removeClass("show");
        form.addClass("hidden");
    }
});

//update rate
$("#form-rate-update").submit(function (event) {
    event.preventDefault();
    $button = $(this).find("button[type=submit]");
    // $(".overlay-loader").show();
    const rateId = $("input[name=rateId]").val();
    const detailId = $("input[name=detailId-rate]").val();
    const name = $("input[name=name-rate]").val();
    const email = $("input[name=email-rate]").val();
    const phone = $("input[name=phone-rate]").val();
    const content = $("textarea[name=content-rate]").val();
    const rate = $(".rated-emotion-item.active").data("rate-num") || 5;

    const data = {
        rateId,
        detailId,
        name,
        email,
        phone,
        content,
        rate,
    };

    console.log(data);

    $button.attr("disabled", true);
    $button.html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/update-rate-hotel",
        type: "POST",
        data: data,
        success: function (res) {
            $button.attr("disabled", false);
            $button.html("Cập nhật đánh giá");
            // $(".overlay-loader").hide();
            // console.log('res: ', res)
            if (res.success) {
                Swal.fire({
                    icon: "success",
                    title: "Thành công",
                    text: res.message,
                }).then(function () {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Cập nhật đánh giá thất bại",
                    text: res.message,
                });
            }
        },
        error: function (xhr, status, error) {
            $(".overlay-loader").hide();
            $("#form-rate")[0].reset();
            Swal.fire({
                icon: "error",
                title: "Cập nhật đánh giá thất bại",
                text: "Có lỗi xảy ra, vui lòng thử lại sau",
            });
        },
    });
});

$("#form-rate-update-sidebar").submit(function (event) {
    event.preventDefault();
    $button = $(this).find("button[type=submit]");
    // $(".overlay-loader").show();
    const rateId = $("input[name=rateId]").val();
    const detailId = $("input[name=detailId-rate]").val();
    const name = $("input[name=name-rate]").val();
    const email = $("input[name=email-rate]").val();
    const phone = $("input[name=phone-rate]").val();
    const content = $("textarea[name=content-rate]").val();
    const rate = $(".rated-emotion-item.active").data("rate-num") || 5;

    const data = {
        rateId,
        detailId,
        name,
        email,
        phone,
        content,
        rate,
    };

    console.log(data);

    $button.attr("disabled", true);
    $button.html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/update-rate-hotel",
        type: "POST",
        data: data,
        success: function (res) {
            $button.attr("disabled", false);
            $button.html("Cập nhật đánh giá");
            // $(".overlay-loader").hide();
            // console.log('res: ', res)
            if (res.success) {
                Swal.fire({
                    icon: "success",
                    title: "Thành công",
                    text: res.message,
                }).then(function () {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Cập nhật đánh giá thất bại",
                    text: res.message,
                });
            }
        },
        error: function (xhr, status, error) {
            $(".overlay-loader").hide();
            $("#form-rate")[0].reset();
            Swal.fire({
                icon: "error",
                title: "Cập nhật đánh giá thất bại",
                text: "Có lỗi xảy ra, vui lòng thử lại sau",
            });
        },
    });
});

//update ques
$("#form-ques-update").submit(function (event) {
    event.preventDefault();
    $button = $(this).find("button[type=submit]");
    // $(".overlay-loader").show();
    const questionId = $("input[name=questionId]").val();
    const detailId = $("input[name=detailId-qa]").val();
    const name = $("input[name=name-qa]").val();
    const email = $("input[name=email-qa]").val();
    const phone = $("input[name=phone-qa]").val();
    const question = $("textarea[name=content-qa]").val();

    const data = {
        questionId,
        detailId,
        name,
        email,
        phone,
        question,
    };

    // console.log(data)
    $button.attr("disabled", true);
    $button.html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/update-question-hotel",
        type: "POST",
        data: data,
        success: function (res) {
            $button.attr("disabled", false);
            $button.html("Cập nhật câu hỏi");
            // $(".overlay-loader").hide();
            // console.log('res: ', res)
            if (res.success) {
                Swal.fire({
                    icon: "success",
                    title: "Thành công",
                    text: res.message,
                }).then(function () {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Cập nhật câu hỏi thất bại",
                    text: res.message,
                });
            }
        },
        error: function (xhr, status, error) {
            $(".overlay-loader").hide();
            $("#form-qa")[0].reset();
            Swal.fire({
                icon: "error",
                title: "Cập nhật câu hỏi thất bại",
                text: "Có lỗi xảy ra, vui lòng thử lại sau",
            });
        },
    });
});


