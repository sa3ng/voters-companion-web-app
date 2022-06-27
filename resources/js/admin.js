$(function () {
  $("[name='edit-role']").click(function (e) {
    e.preventDefault();
    let roleText = $(this).text();

    $($(this).parent().parent().parent().children("[data-label='Role']")).text(
      roleText
    );

    /*----------------------------------------------------------------- 
        sending payload to post request so it can change the user account
        in db
        -----------------------------------------------------------------*/
    let formData = new FormData();
    formData.append(
      "role",
      $(this).parent().parent().parent().children("[data-label='Role']").text()
    );

    formData.append(
      "user",
      $(this)
        .parent()
        .parent()
        .parent()
        .children("[data-label='Username']")
        .text()
    );
    //-----------------------------------------------------------------

    $.ajax({
      type: "post",
      url: "../phpScripts/admin_edit_user_role.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        if (response === "OK") {
          console.log("Submitted");
        } else {
          console.log(response);
        }
      },
    });
  });

  $("[name='delete-user']").click(function (e) {
    e.preventDefault();

    if (confirm("Are you sure you want to delete the user?")) {
      /*----------------------------------------------------------------- 
            sending payload to post request so it can change the user account
            in db
            -----------------------------------------------------------------*/
      let formData = new FormData();
      formData.append(
        "user",
        $(this)
          .parent()
          .parent()
          .parent()
          .children("[data-label='Username']")
          .text()
      );
      //-----------------------------------------------------------------

      $.ajax({
        type: "post",
        url: "../phpScripts/admin_delete_user.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          if (response === "OK") {
            console.log("Submitted");
            window.location.reload();
          } else {
            console.log(response);
          }
        },
      });
    }
  });
});
