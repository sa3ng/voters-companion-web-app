var globaleditor = undefined;

var candidateBtn = "[name='editCandidate']"
var candidateName = "#CK-candidate"
var candidateBtnDesc = "[name='editDesc']"
var candidateDesc = "#CK-desc"

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

var selectorBtn7 = "[name='editPlatform']"
var selectorContainer7 = "#CK-platform"

debugger;
var selectorBtn8 = "[name='editAccomplishments']"
var selectorContainer8 = "#CK-accomplishments"

var selectorBtn9 = "[name='editOrg']"
var selectorContainer9 = "#CK-org"



// ORIGINAL HTML STRINGS TO BE COMPARED WITH
var ckOriginBirthdayHTML = $.trim($(selectorContainer1).html());
var ckOriginBirthplaceHTML = $.trim($(selectorContainer2).html());
var ckOriginMaritalHTML = $.trim($(selectorContainer3).html());
var ckOriginEducationHTML = $.trim($(selectorContainer4).html());
var ckOriginWorkHTML = $.trim($(selectorContainer5).html());
var ckOriginCriminalHTML = $.trim($(selectorContainer6).html());
//other tabs
var ckOriginPlatformHTML = $.trim($(selectorContainer7).html());
var ckOriginAccomplishmentsHTML = $.trim($(selectorContainer8).html());
var ckOriginOrgHTML = $.trim($(selectorContainer9).html());

function newEdit($param) {
    if (globaleditor) {
        // DESTROY THE CKEDITOR OBJECT ASSIGNED TO globaleditor
        globaleditor.destroy();
        // UNDEFINE globaleditor VALUE
        globaleditor = undefined;
    }
}

$(function () {

    // CANDIDATES PAGE
    $(candidateBtn).click(function (e) {
        e.preventDefault();
        newEdit($(candidateName));

        if (($(candidateName).is(":visible"))) {
            ClassicEditor
                .create(document.querySelector(candidateName))
                .then(editor => {
                    console.log("Created", editor);
                    globaleditor = editor;
                })
                .catch(error => {
                    console.log(error.stack);
                })
        }
    });

    $(candidateBtnDesc).click(function (e) {
        e.preventDefault();
        newEdit($(candidateDesc));

        if (($(candidateDesc).is(":visible"))) {
            ClassicEditor
                .create(document.querySelector(candidateDesc))
                .then(editor => {
                    console.log("Created", editor);
                    globaleditor = editor;
                })
                .catch(error => {
                    console.log(error.stack);
                })
        }
    });



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

    $(selectorBtn7).click(function (e) {
        e.preventDefault();
        newEdit($(selectorContainer7));

        if (($(selectorContainer7).is(":visible"))) {
            ClassicEditor
                .create(document.querySelector(selectorContainer7))
                .then(editor => {
                    console.log("Created", editor);
                    globaleditor = editor;
                })
                .catch(error => {
                    console.log(error.stack);
                })
        }
    });

    $(selectorBtn8).click(function (e) {
        e.preventDefault();
        newEdit($(selectorContainer8));

        if (($(selectorContainer8).is(":visible"))) {
            ClassicEditor
                .create(document.querySelector(selectorContainer8))
                .then(editor => {
                    console.log("Created", editor);
                    globaleditor = editor;
                })
                .catch(error => {
                    console.log(error.stack);
                })
        }
    });

    $(selectorBtn9).click(function (e) {
        e.preventDefault();
        newEdit($(selectorContainer9));

        if (($(selectorContainer9).is(":visible"))) {
            ClassicEditor
                .create(document.querySelector(selectorContainer9))
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

        // CANDIDATE PARAMATER TO SUBMIT TO IN THE DB
        let candidate = $("[name='done']").data("target-candidate");
        formData.append
            (
                "candidate",
                candidate
            );


        let ckNewBirthdayHTML = $.trim($(selectorContainer1).html());
        let ckNewBirthplaceHTML = $.trim($(selectorContainer2).html());
        let ckNewMaritalHTML = $.trim($(selectorContainer3).html());
        let ckNewEducationHTML = $.trim($(selectorContainer4).html());
        let ckNewWorkHTML = $.trim($(selectorContainer5).html());
        let ckNewCriminalHTML = $.trim($(selectorContainer6).html());

        let ckNewAccomplishmentsHTML = $.trim($(selectorContainer8).html());
        /* ----------------------------------------------------------------
        CHECK CHANGES TO PREP FOR AJAX; SEND ONES THAT ARE ACTUALLY CHANGED 
        ---------------------------------------------------------------- */
        if (ckNewBirthdayHTML.valueOf()
            != ckOriginBirthdayHTML.valueOf()) {
            formData.append("birthday", ckNewBirthdayHTML);
        }

        if (ckNewBirthplaceHTML.valueOf() !=
            ckOriginBirthplaceHTML.valueOf()) {
            formData.append("birthplace", ckNewBirthplaceHTML);
        }

        // COMMENTED OUT BCOZ CURRENTLY UNDEFINED
        // if (ckNewMaritalHTML.valueOf()
        //     != ckOriginMaritalHTML.valueOf()) {
        //     formData.append("marital", ckNewMaritalHTML);
        // }

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

        if (ckNewAccomplishmentsHTML.valueOf()
            != ckOriginAccomplishmentsHTML.valueOf()) {
            formData.append("accomplishments", ckNewAccomplishmentsHTML);
        }

        if (ckNewPlatformHTML.valueOf()
            != ckOriginPlatformHTML.valueOf()) {
            formData.append("platform", ckNewPlatformHTML);
        }

        if (ckNewOrgHTML.valueOf()
            != ckOriginOrgHTML.valueOf()) {
            formData.append("org", ckNewOrgHTML);
        }



        if ($("[name='religion-select'] option:selected").text()
            != $("[name='religion-text']").text()) {
            formData.append
                (
                    "religion",
                    $("[name='religion-select']").val()
                );

            $("[name='religion-text']")
                .text(
                    $("[name='religion-select'] option:selected").text()
                );
        }
        /* ----------------------------------------------------------------
        CHECK CHANGES TO PREP FOR AJAX; SEND ONES THAT ARE ACTUALLY CHANGED 
        ---------------------------------------------------------------- */

        $.ajax({
            type: "post",
            url: "../phpScripts/candidate_edit.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response === "OK") {
                    alert("Candidate Edited Successfully");
                }
                else {
                    alert("Something went wrong");
                    console.log(response);
                }
            }
        });


    });


});