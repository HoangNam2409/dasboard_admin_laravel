(function ($) {
    "use strict";
    var HT = {};
    // var document = $(document);

    HT.province = () => {
        $(document).on("change", ".province", function () {
            let _this = $(this);
            let province_id = _this.val();

            $.ajax({
                url: "/ajax/location/getLocation", // URL của tệp xử lý dữ liệu trên máy chủ
                type: "GET",
                data: {
                    province_id: province_id,
                },
                dataType: "json",
                success: function (data) {
                    $("result").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("Lỗi: " + textStatus + " " + errorThrown);
                },
            });
        });
    };

    $(document).ready(function () {
        HT.province();
    });
})(jQuery);
