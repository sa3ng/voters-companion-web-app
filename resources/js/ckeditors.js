var globaleditor = undefined;

var selectorBtn1 = "[name='editBirthday']"
var selectorContainer1 = "#CK-birthday"

var selectorBtn2 = "[name='editBirthplace']"
var selectorContainer2 = "#CK-birthplace"

var selectorBtn3 = "[name='editMarital']"
var selectorContainer3 = "#CK-marital"

var selectorBtn4 = "[name='editEdu']"
var selectorContainer4 = "#CK-education"

var selectorBtn5 = "[name='editWE']"
var selectorContainer5 = "#CK-work"

var selectorBtn6 = "[name='editCR']"
var selectorContainer6 = "#CK-criminal"

// ORIGINAL HTML STRINGS TO BE COMPARED WITH
var ckOriginBirthdayHTML = $(selectorContainer1).html();
var ckOriginBirthplaceHTML = $(selectorContainer2).html();
var ckOriginMaritalHTML = $(selectorContainer3).html();
var ckOriginEducationHTML = $(selectorContainer4).html();
var ckOriginWorkHTML = $(selectorContainer5).html();
var ckOriginCriminalHTML = $(selectorContainer6).html();

function newEdit($param) {
    if (globaleditor) {
        // DESTROY THE CKEDITOR OBJECT ASSIGNED TO globaleditor
        globaleditor.destroy();
        // UNDEFINE globaleditor VALUE
        globaleditor = undefined;
    }
}

$(function () {

    $(selectorBtn1).click(function (e) {
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

        // SUBMIT DATA HERE THROUGH AJAX

        let formData = new FormData();

        var ckNewBirthdayHTML = $.trim($(selectorContainer1).html());
        var ckNewBirthplaceHTML = $.trim($(selectorContainer2).html());
        var ckNewMaritalHTML = $.trim($(selectorContainer3).html());
        var ckNewEducationHTML = $.trim($(selectorContainer4).html());
        var ckNewWorkHTML = $.trim($(selectorContainer5).html());
        var ckNewCriminalHTML = $.trim($(selectorContainer6).html());

        // CHECK CHANGES TO PREP FOR AJAX
        if (ckNewBirthdayHTML.valueOf()
            != ckOriginBirthdayHTML.valueOf()) {
            formData.append("birthday", ckNewBirthdayHTML);
        }

        if (ckNewBirthplaceHTML.valueOf() !=
            ckOriginBirthplaceHTML.valueOf()) {
            formData.append("birthplace", ckNewBirthdayHTML);
        }

        if (ckNewMaritalHTML.valueOf()
            != ckOriginMaritalHTML.valueOf()) {
            formData.append("marital", ckNewBirthdayHTML);
        }

        if (ckNewEducationHTML.valueOf()
            != ckOriginEducationHTML.valueOf()) {
            formData.append("education", ckNewEducationHTML);
        }

        if (ckNewWorkHTML.valueOf()
            != ckOriginWorkHTML.valueOf()) {
            formData.append("work", ckNewWorkHTML);
        }

        if (ckNewCriminalHTML.valueOf()
            != ckOriginCriminalHTML.valueOf()) {
            formData.append("criminal", ckNewCriminalHTML);
        }

        if ($("[name='religion-select'] option:selected").text()
            != $("[name='religion-text']").text()) {
            formData.append
                (
                    "religion",
                    $("[name='religion-select'] option:selected").text()
                );
        }


    });


});