(function ($) {
    "use strict";
    var HT = {};
    var document = $(document);

    HT.switchery = () => {
        $(".js-switch").each(function () {
            var swichery = new Switchery(this, { color: "#1AB394" });
        });
    };

    HT.select2 = () => {
        $(".setupSelect2").select2();
    };

    document.ready(function () {
        HT.switchery();
        HT.select2();
    });
})(jQuery);
