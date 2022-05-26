function checkPasswordInput() {
    // If passwords aren't the same, disable submit button
    if ($("#pass-register").val().normalize() != $("#re-pass-register").val().normalize()) {
        $("#pass-register").addClass("is-danger");
        $("#re-pass-register").addClass("is-danger");

        $('[name=error-pass]').removeClass("hidden");

        $("#register-submits").prop('disabled', true);
    } else {
        $("#pass-register").removeClass("is-danger");
        $("#re-pass-register").removeClass("is-danger");

        $("[name=error-pass]").addClass("hidden");

        $("#register-submits").prop('disabled', false);
    }
}

function noSpace() {
    id = "#" + this.id;

    value = $(id).val();

    console.log(id + " : " + value);

    $(id).val($(id).val().trim());
}

// JQuery Main
$(function () {

    // Trim on unfocus text area
    $('input').on('blur', function () {
        id = "#" + this.id;
        value = $(id).val();
        if (id != "#register-submits")
            $(id).val($(id).val().trim());
    });

    // Trim on demand per keystroke
    $('#pass-register').on('input', noSpace);
    $('#re-pass-register').on('input', noSpace);

    // Compare passwords per keystroke
    $('#pass-register').on('input', checkPasswordInput);
    $('#re-pass-register').on('input', checkPasswordInput);

    console.log('loaded');
    $("#register-form").submit(function (e) {
        e.preventDefault();

        var formData = new FormData();
        formData.append("email-register", $("#email-register").val());
        formData.append("user-register", $("#user-register").val());
        formData.append("pass-register", $("#pass-register").val());

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
            // dataType: 'json',
            success: function (response) {
                // window.location.assign("../phpPages/index.php")

                if (response == "OK") {
                    alert("account created");
                    window.location.replace("../phpPages/index.php");
                } else if (response == "USERNAME") {
                    $("#error-user").removeClass("hidden");
                    $("#user-register").addClass("is-danger");

                    $("#error-email").addClass("hidden");
                    $("#email-register").removeClass("is-danger");
                }
                else if (response == "EMAIL") {
                    $("#error-email").removeClass("hidden");
                    $("#email-register").addClass("is-danger");

                    $("#error-user").addClass("hidden");
                    $("#user-register").removeClass("is-danger");
                }
                else {
                    alert("SOMETHING HAPPENED");
                }
            }
        });
    });
});

