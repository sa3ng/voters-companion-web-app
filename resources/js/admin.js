$(function () {
    $("button").click(function (e) {
        e.preventDefault();
        let roleText = $((this)).text();

        $($(this).parent().parent().parent().children("[data-label='Role']"))
            .text(roleText);
    });
});