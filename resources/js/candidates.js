document.addEventListener('DOMContentLoaded', () => {
  // Functions to open and close a modal
  function openModal($el) {
    $el.classList.add('is-active');
  }

  function closeModal($el) {
    $el.classList.remove('is-active');
  }

  function closeAllModals() {
    (document.querySelectorAll('.modal') || []).forEach(($modal) => {
      closeModal($modal);
    });
  }

  // Add a click event on buttons to open a specific modal
  (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
    const modal = $trigger.dataset.target;
    const $target = document.getElementById(modal);

    $trigger.addEventListener('click', () => {
      openModal($target);
    });
  });

  // Add a click event on various child elements to close the parent modal
  (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
    const $target = $close.closest('.modal');

    $close.addEventListener('click', () => {
      closeModal($target);
    });
  });

  // Add a keyboard event to close all modals
  document.addEventListener('keydown', (event) => {
    const e = event || window.event;

    if (e.keyCode === 27) { // Escape key
      closeAllModals();
    }
  });
});

$(function () {
  let candidateCreateModalForm = "#candidate-modal-form";
  $(candidateCreateModalForm).submit(function (e) {

    let formData = new FormData();
    formData.append("c-cand-name", $("[name='c-cand-name']").val());
    formData.append("c-cand-num", $("[name='c-cand-num']").val());
    formData.append("c-cand-pos", $("[name='c-cand-pos']").val());
    formData.append("c-cand-desc", $("[name='c-cand-desc']").val());

    e.preventDefault();

    $.ajax({

      type: $(this).attr("method"),
      url: $(this).attr("action"),
      data: formData,
      contentType: false,
      processData: false,

      success: function (response) {
        console.log(response);
        if (response == "BAD_NAME")
          alert("Invalid Name. Have a valid name for the candidate");

        if (response == "NAME_IN_DB")
          alert("Name is present in DB. Edit that instance instead or consider deleting that same name instance");

        if (response == "CANDIDATE_NUM_EXISTS_IN_POSITION")
          alert("Candidate Number is already used in selected position.");

        if (response == "OK") {
          alert("Basic Candidate Info has been registered!");
          document.location.reload();
        }
      }
    });
  });

  let candidateEditButtons = "[name='edit-candidate-button']";
  $(candidateEditButtons).click(function (e) {
    e.preventDefault();

    // Parent container of button and container for the target texts
    console.log($(this).parent());
    // Candidate Name Container
    let candidateName = $(this).parent().children('.title');
    // Candidate Description Container
    let candidateDesc = $(this).parent().children('.subtitle');
    // Candidate Image Container
    let candidateImage = $(this).parent().parent().children('div').children('figure').children('img');

    /* -------------------------------------------------------------------- 
    We have to get the candidate ID to be editted in the db through
    the 'Learn More' URL
    -------------------------------------------------------------------- */
    // let candidateLink = $("[name='candidate-link']").attr("href");
    let candidateLink = $($(this)
      .parent().parent().parent()
      .children(".card-footer").children("p").children("span")
      .children("a")).attr("href");

    console.log(candidateLink);

    /* 
    we only pass window.location here to make a decoy url to get the 
    search param value of cid
    */
    let candidateLinkURL = new URL(
      candidateLink,
      window.location
    );
    let cid = candidateLinkURL.searchParams.get("cid");
    //---------------------------------------------------------------------

    // setting values to edit form
    let editModalCandidateName = "[name='e-cand-name']";
    $(editModalCandidateName).val($(candidateName).text());
    let editModalCandidateDescription = "[name='e-cand-desc']";
    $(editModalCandidateDescription).val($(candidateDesc).text());
    let editModalHiddenID = "[name='e-cand-num']";
    $(editModalHiddenID).val(cid);

    let = editModalImgOut = "[name='e-cand-img-out']";
    let editModalImgIn = "[name='e-cand-img-in']";
    $(editModalImgOut).attr('src', $(candidateImage).attr('src'));
    //---------------------------------------------------------------------
  });

  let candidateEditModalForm = "#candidate-edit-modal-form";
  $(candidateEditModalForm).submit(function (e) {
    e.preventDefault();

    let formData = new FormData();

    let editModalCandidateName = "[name='e-cand-name']";
    let editModalCandidateDescription = "[name='e-cand-desc']";
    let editModalHiddenID = "[name='e-cand-num']";
    let editModalImgIn = "[name='e-cand-img-in']";


    formData.append("candidate_desc", $(editModalCandidateDescription).val().trim());
    formData.append("candidate_id", $(editModalHiddenID).val());


    if ($(editModalImgIn).prop('files').length > 0) {
      if (checkImage($(editModalImgIn))) {
        formData.append("candidate_image", $(editModalImgIn).prop('files')[0]);
      }
    }

    /*--------------------------------------------------------------------- 
    Need to check if the name part of the form is disabled;
    if disabled, do not submit name for validation,
    else, submit for client and server sided validation
    ---------------------------------------------------------------------*/
    let alerted = 0;
    if (!($(editModalCandidateName).attr("disabled"))) {
      if ($(editModalCandidateName).val().toUpperCase().trim() != "") {
        formData.append("candidate_name", $(editModalCandidateName).val().toUpperCase().trim());
      }
      else {
        alert("Name must not be empty");
        alerted = 1;
      }
    }
    //---------------------------------------------------------------------

    if (alerted == 0) { //if no alert was present, do AJAX
      //submit to ajax
      $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response === "OK") {
            alert("Basic Candidate Info has been edited!");
            window.location.reload();
          } else if (response === "NAME_IN_DB")
            alert("Name is already present in DB. Please input a different name or consider deleting that same name instance");
          else if (response == "ERROR_UPLOAD")
            alert("There was an error uploading the file. Try again later");
          else {
            alert("UNEXPECTED ERROR: SOMETHING WENT WRONG");
            console.log(response);
          }
        }
      });
    } else {
      alerted = 0;
    }

  });

  let editModalCheckBoxName = "[name='e-cand-name-check']";
  $(editModalCheckBoxName).change(function (e) {
    e.preventDefault();
    let editModalCandidateName = "[name='e-cand-name']";
    if ($(this).is(":checked")) {
      $(editModalCandidateName).attr("disabled", true);
    } else {
      $(editModalCandidateName).removeAttr("disabled");
    }
  });

  let candidateImgInput = "[name='e-cand-img-in']";
  $(candidateImgInput).change(function (e) {
    e.preventDefault();
    // container for what you should see when something is uploaded
    let = candidateImgOutput = "[name='e-cand-img-out']";
    if (checkImage($(this)))
      $(candidateImgOutput).attr('src', URL.createObjectURL($(this).prop('files')[0]));
    else {
      alert("Invalid File! Upload a valid image file");
      $(candidateImgOutput).attr('src', "../resources/images/candidate_generic/generic.png");
    }
  });

  /*-----------------------------------------------------------------------
  Helper functions for 'candidateImgInput' selector
  -----------------------------------------------------------------------*/
  /*
    check the file type using this function; 
    The context should be a selector that directs to a HTMLInputElement
   */
  function checkImage(context) {
    if (
      context.prop('files')[0].type === "image/png"
      || context.prop('files')[0].type === "image/jpg"
      || context.prop('files')[0].type === "image/jpeg"
    ) return true;

    return false;
  }
  //-----------------------------------------------------------------------

  let candidateDeleteLinks = "[name='candidate-delete-link']";
  $(candidateDeleteLinks).click(function (e) {
    e.preventDefault();
    if (confirm("Are you sure you want to delete this candidate?")) {
      let formData = new FormData();
      formData.append("candidate_name", $(this).data("name"));

      $.ajax({
        type: "post",
        url: "../phpScripts/candidate_delete.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          window.location.reload();
        }
      });
    }
  });
});



