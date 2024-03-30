$(function () {
  $("[name='like-button']").click(function (e) {
    e.preventDefault();

    let thisObj = $(this);
    let classToCheck = "active-like";
    if (thisObj.hasClass(classToCheck)) {
      thisObj.toggleClass(classToCheck);
      thisObj
        .children("[name='like-count']")
        .text(
          parseInt(thisObj.children("[name='like-count']").text().trim()) - 1
        );

      let formdata = new FormData();
      formdata.append("post_id", thisObj.data("post-id"));
    
      thisObj.toggleClass("transparent");
      thisObj.toggleClass("blue");

      $.ajax({
        type: "post",
        url: "../phpScripts/remove_like.php",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
          if(response == "OK")
          {
            console.log("like was removed");
          }
          else
            console.log(response);
        }
      });
    } else {
      thisObj.toggleClass(classToCheck);
      thisObj
        .children("[name='like-count']")
        .text(
          parseInt(thisObj.children("[name='like-count']").text().trim()) + 1
        );

      let formdata = new FormData();
      formdata.append("post_id", thisObj.data("post-id"));

      thisObj.toggleClass("transparent");
      thisObj.toggleClass("blue");

      $.ajax({
        type: "post",
        url: "../phpScripts/add_like.php",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
          if(response == "OK")
          {
            console.log("like was added");
          }
          else
          console.log(response);
        }
      });
    }
  });
});
