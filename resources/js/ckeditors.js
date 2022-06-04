var globaleditor = undefined;

var selectorBtn1 = "[name='editBirthday']"
var selectorContainer1 = "#CK-birthday"

var selectorBtn2 = "[name='editBirthplace']"
var selectorContainer2 = "#CK-birthplace"

var selectorBtn3 = "[name='editMartial']"
var selectorContainer3 = "#CK-martial"

var selectorBtn4 = "[name='editEdu']"
var selectorContainer4 = "#CK-education"

var selectorBtn5 = "[name='editWE']"
var selectorContainer5 = "#CK-work"

var selectorBtn6 = "[name='editCR']"
var selectorContainer6 = "#CK-criminal"

 function newEdit($param) {
        if (globaleditor) {
            // DESTROY THE CKEDITOR OBJECT ASSIGNED TO globaleditor
            globaleditor.destroy();
            // UNDEFINE globaleditor VALUE
            globaleditor = undefined;
        }
 }

$(function () {

    $(selectorBtn1).click(function (e)  {
        e.preventDefault();
        newEdit($(selectorContainer1));

        // CHECK IF THE ID EDITOR IS VISIBLE, IF VISIBLE, CREATE EDITOR
        if (($(selectorContainer1).is(":visible"))) {
            ClassicEditor
                .create(document.querySelector(selectorContainer1))
                .then(editor => {
                    console.log("Created", editor);
                    globaleditor = editor;
                })
                .catch(error => {
                    console.log(error.stack);
                })
        }
    });

    $(selectorBtn2).click(function (e) {
        e.preventDefault();
        newEdit($(selectorContainer2));

        if (($(selectorContainer2).is(":visible"))) {
            ClassicEditor
                .create(document.querySelector(selectorContainer2))
                .then(editor => {
                    console.log("Created", editor);
                    globaleditor = editor;
                })
                .catch(error => {
                    console.log(error.stack);
                })
        }
    });

    $(selectorBtn3).click(function (e) {
        e.preventDefault();
        newEdit($(selectorContainer3));

        if (($(selectorContainer3).is(":visible"))) {
            ClassicEditor
                .create(document.querySelector(selectorContainer3))
                .then(editor => {
                    console.log("Created", editor);
                    globaleditor = editor;
                })
                .catch(error => {
                    console.log(error.stack);
                })
        }
    });

    $(selectorBtn4).click(function (e) {
        e.preventDefault();
        newEdit($(selectorContainer4));

        if (($(selectorContainer4).is(":visible"))) {
            ClassicEditor
                .create(document.querySelector(selectorContainer4))
                .then(editor => {
                    console.log("Created", editor);
                    globaleditor = editor;
                })
                .catch(error => {
                    console.log(error.stack);
                })
        }
    });

    $(selectorBtn5).click(function (e) {
        e.preventDefault();
        newEdit($(selectorContainer5));

        if (($(selectorContainer5).is(":visible"))) {
            ClassicEditor
                .create(document.querySelector(selectorContainer5))
                .then(editor => {
                    console.log("Created", editor);
                    globaleditor = editor;
                })
                .catch(error => {
                    console.log(error.stack);
                })
        }
    });

    $(selectorBtn6).click(function (e) {
        e.preventDefault();
        newEdit($(selectorContainer6));

        if (($(selectorContainer6).is(":visible"))) {
            ClassicEditor
                .create(document.querySelector(selectorContainer6))
                .then(editor => {
                    console.log("Created", editor);
                    globaleditor = editor;
                })
                .catch(error => {
                    console.log(error.stack);
                })
        }
    });

    $("[name='done']").click(function (e) {
        e.preventDefault();
        if (globaleditor) {
            // DESTROY THE CKEDITOR OBJECT ASSIGNED TO globaleditor
            globaleditor.destroy();
            // UNDEFINE globaleditor VALUE
            globaleditor = undefined;
        }
    });


});