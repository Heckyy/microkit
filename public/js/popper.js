$(window).on("load", function () {
    var popoverOptions = {
        container: "body",
        placement: "bottom",
        html: true,
        trigger: "click",
        content: function () {
            return $("#profileContent").html();
        },
    };

    var $popover = $("#profilePopOver").popover(popoverOptions);

    // Menangani klik di luar popover
    $(document).on("click", function (e) {
        if (!$popover.is(e.target) && $popover.has(e.target).length === 0) {
            $popover.popover("hide");
        }
    });
});
