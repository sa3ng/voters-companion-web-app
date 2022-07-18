var globaleditor = undefined;


var selectorBtn1 = "[name='editName']"
var selectorContainer1 = "#CK-name"

var selectorBtn2 = "[name='editBio']"
var selectorContainer2 = "#CK-bio"

var selectorBtn3 = "[name='editBirthday']"
var selectorContainer3 = "#CK-birthday"

var selectorBtn4 = "[name='editUsertag']"
var selectorContainer4 = "#CK-usertag"



// ORIGINAL HTML STRINGS TO BE COMPARED WITH
var ckOriginNameHTML = $.trim($(selectorContainer1).html());
var ckOriginBioHTML = $.trim($(selectorContainer2).html());
var ckOriginBirthdayHTML = $.trim($(selectorContainer3).html());
var ckOriginUsertagHTML = $.trim($(selectorContainer4).html());


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

        /* CANDIDATE PARAMATER TO SUBMIT TO IN THE DB
        let candidate = $("[name='done']").data("target-candidate");
        formData.append
            (
                "candidate",
                candidate
            );
        */
        console.log("Hello World");

        let ckNewNameHTML = $.trim($(selectorContainer1).html());
        let ckNewBioHTML = $.trim($(selectorContainer2).html());
        let ckNewBirthdayHTML = $.trim($(selectorContainer3).html());
        let ckNewUsertagHTML = $.trim($(selectorContainer4).html());
       

        /* ----------------------------------------------------------------
        CHECK CHANGES TO PREP FOR AJAX; SEND ONES THAT ARE ACTUALLY CHANGED 
        ---------------------------------------------------------------- */
        if (ckNewNameHTML.valueOf()
            != ckOriginNameHTML.valueOf()) {
            formData.append("full_name", ckNewNameHTML);
        }

        if (ckNewBioHTML.valueOf() 
            != ckOriginBioHTML.valueOf()) {
            formData.append("bio", ckNewBioHTML);
        }
      
        if (ckNewUsertagHTML.valueOf()
            != ckOriginUsertagHTML.valueOf()) {
            formData.append("user_tag", ckNewUsertagHTML);
        }

        if (ckNewBirthdayHTML.valueOf()
            != ckOriginBirthdayHTML.valueOf()) {
            formData.append("birthday", ckNewBirthdayHTML);
        }

        /* ----------------------------------------------------------------
        CHECK CHANGES TO PREP FOR AJAX; SEND ONES THAT ARE ACTUALLY CHANGED 
        ---------------------------------------------------------------- */
      
        $.ajax({
            type: "post",
            url: '../phpScripts/userpage_edit.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response === "OK") {
                    alert("Info Edited Successfully!");
                    window.location.reload();
                }
                else {
                    alert("Something went wrong");
                    console.log(response);
                }
            }
        });

       
    });


});