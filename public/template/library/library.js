(function ($) {
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr("content");
    // var document = $(document);

    HT.switchery = () => {
        $(".js-switch").each(function () {
            var swichery = new Switchery(this, { color: "#1AB394" });
        });
    };

    HT.select2 = () => {
        if ($(".setupSelect2").length) {
            $(".setupSelect2").select2();
        }
    };

    HT.changeStatus = () => {
        if ($(".status").length) {
            $(document).on("change", ".status", function () {
                let _this = $(this);
                let option = {
                    value: _this.val(),
                    modelId: _this.attr("data-modelId"),
                    model: _this.attr("data-model"),
                    field: _this.attr("data-field"),
                    _token,
                };

                $.ajax({
                    url: "/ajax/dashboard/changeStatus", // URL của tệp xử lý dữ liệu trên máy chủ
                    type: "POST",
                    data: option,
                    dataType: "json",
                    success: function (res) {
                        console.log(res);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("Lỗi: " + textStatus + " " + errorThrown);
                    },
                });
            });
        }
    };

    HT.checkAll = () => {
        if ($("#checkAll").length) {
            $(document).on("click", "#checkAll", function () {
                let isChecked = $(this).prop("checked");
                $(".checkBoxItem").prop("checked", isChecked);
                $(".checkBoxItem").each(function () {
                    let _this = $(this);
                    HT.changeBackground(_this);
                });
            });
        }
    };

    HT.checkBoxItem = () => {
        if ($(".checkBoxItem").length) {
            $(document).on("click", ".checkBoxItem", function () {
                let _this = $(this);
                HT.changeBackground(_this);
                HT.allChecked();
            });
        }
    };

    HT.changeBackground = (option) => {
        let isChecked = option.prop("checked");
        if (isChecked) {
            option.closest("tr").addClass("active-bg");
        } else {
            option.closest("tr").removeClass("active-bg");
        }
    };

    HT.allChecked = () => {
        let allChecked =
            $(".checkBoxItem:checked").length === $(".checkBoxItem").length;
        $("#checkAll").prop("checked", allChecked);
    };

    HT.changeStatusAll = () => {
        if ($(".changeStatusAll").length) {
            $(document).on("click", ".changeStatusAll", function (e) {
                let _this = $(this);
                let id = [];
                $(".checkBoxItem").each(function () {
                    let checkBox = $(this);
                    if (checkBox.prop("checked")) {
                        id.push(checkBox.val());
                    }
                });

                let option = {
                    id,
                    value: _this.attr("data-value"),
                    model: _this.attr("data-model"),
                    field: _this.attr("data-field"),
                    _token,
                };

                $.ajax({
                    url: "/ajax/dashboard/changeStatusAll", // URL của tệp xử lý dữ liệu trên máy chủ
                    type: "POST",
                    data: option,
                    dataType: "json",
                    success: function (res) {
                        console.log(res);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("Lỗi: " + textStatus + " " + errorThrown);
                    },
                });

                e.preventDefault();
            });
        }
    };

    $(document).ready(function () {
        HT.switchery();
        HT.select2();
        HT.changeStatus();
        HT.checkAll();
        HT.checkBoxItem();
        HT.changeStatusAll();
    });
})(jQuery);
