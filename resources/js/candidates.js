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
  let candidateModalForm = "#candidate-modal-form";
  $(candidateModalForm).submit(function (e) {

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
      dataType: "json",

      success: function (response) {
        console.log(response);
        alert("Basic Candidate Info has been registered!");
        document.location.reload();
      }
    });
  });
});



