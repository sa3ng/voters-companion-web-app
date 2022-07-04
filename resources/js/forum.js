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

      thisObj.toggleClass("transparent");
      thisObj.toggleClass("blue");
    } else {
      thisObj.toggleClass(classToCheck);
      thisObj
        .children("[name='like-count']")
        .text(
          parseInt(thisObj.children("[name='like-count']").text().trim()) + 1
        );

      thisObj.toggleClass("transparent");
      thisObj.toggleClass("blue");
    }
  });
});
