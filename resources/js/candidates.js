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
        if (response == "BAD_NAME") {
          alert("Invalid Name. Have a valid name for the candidate");
        }

        if (response == "NAME_IN_DB") {
          alert("Name is present in DB. Edit that instance instead or consider deleting that same name instance");
        }

        if (response == "CANDIDATE_NUM_EXISTS_IN_POSITION") {
          alert("Candidate Number is already used in selected position.");
        }


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

    /* -------------------------------------------------------------------- 
    We have to get the candidate ID to be editted in the db through
    the 'Learn More' URL
    -------------------------------------------------------------------- */
    // let candidateLink = $("[name='candidate-link']").attr("href");
    let candidateLink = $($(this)
      .parent().parent().parent()
      .children(".card-footer").children("p").children("span")
      .children("a")).attr("href");

    debugger;
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
    //---------------------------------------------------------------------

  });

  let candidateEditModalForm = "#candidate-edit-modal-form";
  $(candidateEditModalForm).submit(function (e) {
    e.preventDefault();

    let formData = new FormData();

    let editModalCandidateName = "[name='e-cand-name']";
    let editModalCandidateDescription = "[name='e-cand-desc']";
    let editModalHiddenID = "[name='e-cand-num']";

    formData.append("candidate_name", $(editModalCandidateName).val().toUpperCase().trim());
    formData.append("candidate_desc", $(editModalCandidateDescription).val().trim());
    formData.append("candidate_id", $(editModalHiddenID).val());

    // Client-side validation
    if (formData.get("candidate_name") == "") {
      alert("Name must not be empty");
    }
    // else, submit to ajax
    else {
      $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response === "NAME_IN_DB")
            alert("Name is already present in DB. Please input a different name or consider deleting that same name instance");
          if (response === "OK") {
            alert("Basic Candidate Info has been edited!");
            window.location.reload();
          } else {
            alert("something went wrong");
            console.log(response);
          }
        }
      });
    }
  });
});



