// JQuery main
$(function () {
    $("form").submit(function (e) {
        e.preventDefault();

        var formData = new FormData();
        formData.append("email-input", $("[name='email-input']").val());
        formData.append("pass-input", $("[name='pass-input']").val());
        if ($('input.checkbox_check').is(':checked')) {
            formData.append("remember-check", $("[name='remember-check']").val());
        }

        // AJAX REQUEST ON FORM SUBMIT
        $.ajax({
            type: "post",
            url: $(this).attr("action"),
            data: formData,
            /*
            WHEN submitting data with the 'FormData' 
            type, HAVE THESE TWO LINES 
            */
            contentType: false,
            processData: false,
            // WHEN CHANGING COOKIE VALUES THROUGH REQUESTS, HAVE THIS LINE
            xhrFields: {
                withCredentials: true
            },
            // WHEN RETURNING A RESPONSE THAT IS A JSON, HAVE THIS LINE
            dataType: 'json',
            success: function (response) {
                if (response.email_error == 1) {
                    $("#email-error").removeClass("hidden");
                    $("[name='email-input']").addClass("is-danger");

                    $("#pass-error").addClass("hidden");
                    $("[name='pass-input']").removeClass("is-danger");
                }
                else if (response.pass_error == 1) {
                    $("#pass-error").removeClass("hidden");
                    $("[name='pass-input']").addClass("is-danger");

                    $("#email-error").addClass("hidden");
                    $("[name='email-input']").removeClass("is-danger");
                }
                else
                    window.location.replace("../phpPages/usrPage.php");

            }
        });
    });

    /*     $("input").blur(function (e) {
            e.preventDefault();
            console.log("Value:" + ' ' + $(this).val() + " Name: " + $(this).attr('name'));
        }); */
});