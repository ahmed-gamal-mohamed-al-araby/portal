var currentTabIndex = 0, // Current tab is set to be the first tab (0)
  allTabs = document.getElementsByClassName("tab"),
  subGroups = [], usedSubGroupIds = [];

// add active tab title

$('#card-header-text').text($(allTabs[currentTabIndex]).find('.tab-title').text());

// This function will display the specified tab of the form...
// stepDirection either 1 for next or -1 for back
function showTab(stepDirection, nextBtn, submitBtn) {
  allTabs[stepDirection].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (stepDirection == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (stepDirection == (allTabs.length - 1)) { // if current tab is last tab
    document.getElementById("nextBtn").innerHTML = submitBtn;
  } else {
    document.getElementById("nextBtn").innerHTML = nextBtn;
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(stepDirection)
}

// This function will figure out which tab to display
function nextPrev(stepDirection, nextBtn, submitBtn) {

  // Exit the function if any field in the current tab is invalid:
  if (stepDirection == 1 && !validateForm()) return false;

  // Hide the current tab:
  if ((currentTabIndex != allTabs.length - 1) || (currentTabIndex == allTabs.length - 1 && stepDirection == -1)) // hide tab in not the last tap
    allTabs[currentTabIndex].style.display = "none";

  // Increase or decrease the current tab by 1 depending on n (1 or -1):
  currentTabIndex = currentTabIndex + stepDirection;


  // add active tab title
  $('#card-header-text').text($(allTabs[currentTabIndex]).find('.tab-title').text());

  // submit form if you have reached the end of the form
  if (currentTabIndex == allTabs.length) {
    // ... the form gets submitted:
    $("select option").prop("disabled", false);
    document.getElementById("createSupplier").submit();
    return false;
  }

  // Otherwise, display the correct tab:
  showTab(currentTabIndex, nextBtn, submitBtn);
}

// person phone
$(".phone-require").on('keyup', function () {
  var phone1_id = $('#phone_id').val();

  var tel = $(this).val();
  if (phone1_id == +20 && tel != '') {

    var regex = /^[1]{1}[1]{1}[0-9]{8}$/;
    var regex1 = /^[1]{1}[2]{1}[0-9]{8}$/;
    var regex2 = /^[1]{1}[5]{1}[0-9]{8}$/;
    var regex3 = /^[1]{1}[0]{1}[0-9]{8}$/;

    if (regex.test(tel) || regex1.test(tel) || regex2.test(tel) || regex3.test(tel)) {
      $(this).parents().children('.tab .form-phone-invalid').css("display", "none");
    } else {
      $(this).parents().children('.tab .form-phone-invalid').css("display", "block");
    }
  } else {
    $(this).parents().children('.tab .form-phone-invalid').css("display", "none");
  }
});

// whats
$(".whats-require").on('keyup', function () {
  var phone_id = $('#phone_id').val();
  var tel = $(this).val();
  if (phone_id == +20 && tel != '') {

    var regex = /^[1]{1}[1]{1}[0-9]{8}$/;
    var regex1 = /^[1]{1}[2]{1}[0-9]{8}$/;
    var regex2 = /^[1]{1}[5]{1}[0-9]{8}$/;
    var regex3 = /^[1]{1}[0]{1}[0-9]{8}$/;


    if (regex.test(tel) || regex1.test(tel) || regex2.test(tel) || regex3.test(tel)) {
      $(this).parents().children('.tab .form-phone-invalid').css("display", "none");
    } else {
      $(this).parents().children('.tab .form-phone-invalid').css("display", "block");
    }
  } else {
    $(this).parents().children('.tab .form-phone-invalid').css("display", "none");
  }

});

// company phone
$("#company_mobile").on('keyup', function () {
  var phone_id = $('#phone_id').val();
  var tel = $(this).val();
  if (phone_id == +20 && tel != '') {
    var regex = /^[1]{1}[1]{1}[0-9]{8}$/;
    var regex1 = /^[1]{1}[2]{1}[0-9]{8}$/;
    var regex2 = /^[1]{1}[5]{1}[0-9]{8}$/;
    var regex3 = /^[1]{1}[0]{1}[0-9]{8}$/;
    var regex4 = '';

    if (regex.test(tel) || regex1.test(tel) || regex2.test(tel) || regex3.test(tel)) {
      $('.phone_vaild').css("display", "none");

    } else {
      $('.phone_vaild').css("display", "block");
    }
  } else {
    $('.phone_vaild').css("display", "none");
  }

});

function validatePaymentMethod() {
  if ($('#cash_check_id').prop("checked") == true ||
    $('#cheque_check_id').prop("checked") == true ||
    $('#bank_transfer_check_id').prop("checked") == true) {
    $('#payment_option_error').addClass('d-none');
    return true;
  } else { // If no option is checked
    $('#payment_option_error').removeClass('d-none');
    return false;
  }
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, currentTabRequiredInputs, i, valid = true;
  if (currentTabIndex >= 4) {
    // If minimum one option is checked
    if (!validatePaymentMethod())
      return false;
  }

  currentTabRequiredInputs = allTabs[currentTabIndex].getElementsByClassName("require");
  let requireMultipleSelect = $(allTabs[currentTabIndex]).find('.required-multiple-select');

  // Handle Supplier financial entity data

  // A loop that checks every input field in the current tab:
  for (i = 0; i < currentTabRequiredInputs.length; i++) {
    // If a field is empty...
    if ($(currentTabRequiredInputs[i]).attr('type') != 'file') // as no trim on file input value for that except file inputs
      currentTabRequiredInputs[i].value = currentTabRequiredInputs[i].value.trim();

    if (currentTabRequiredInputs[i].value == "" && !$(currentTabRequiredInputs[i]).hasClass('not-required')) { // input is empty
      // add an "invalid" class to the field:
      $(currentTabRequiredInputs[i]).addClass("invalid is-invalid");
      // and set the current valid status to false
      valid = false;
    }
    else if ($(currentTabRequiredInputs[i]).hasClass('validate-email')) { // if input is email
      if (!validateEmail($(currentTabRequiredInputs[i])))
        valid = false;
    }
    else if ($(currentTabRequiredInputs[i]).hasClass('validate-url')) { // if input is URL
      if (!validateURL($(currentTabRequiredInputs[i])))
        valid = false;
    }
    else if ($(currentTabRequiredInputs[i]).hasClass('validate-mobile')) { // if input is mobile
      if (!validateMobile($(currentTabRequiredInputs[i])))
        valid = false;
    }
    else if ($(currentTabRequiredInputs[i]).hasClass('validate-Tax-id-number-and-value-add-registeration-number')) { // if input is value_add_registeration_number
      if (!validateTax_id_numberAndValue_add_registeration_number($(currentTabRequiredInputs[i])))
        valid = false;
    }
    else if ($(currentTabRequiredInputs[i]).hasClass('validate_commercial_registeration_number')) { // if input is commercial_registeration_number
      if (!validate_commercial_registeration_number($(currentTabRequiredInputs[i])))
        valid = false;
    }
    else if (currentTabRequiredInputs[i].value != "" && $(currentTabRequiredInputs[i]).hasClass('not-required')) { // input is empty
      // and set the current valid status to false
      valid = !$(currentTabRequiredInputs[i]).trigger('change').hasClass('require');
    }
    else {
      $(currentTabRequiredInputs[i]).removeClass("invalid is-invalid");
    }
  }

  // A loop that checks every multible select field in the current tab which must at least select one item
  for (let i = 0; i < requireMultipleSelect.length; i++) {
    if ($(requireMultipleSelect[i]).find('option:selected').length == 0) {
      $(requireMultipleSelect[i]).addClass("invalid is-invalid");
      valid = false;
    }
  }

  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    $('.step').eq(currentTabIndex).addClass("finish").html("<i class='fa fa-check'> </i>");
    if ($(".checkout  select.invalid")[0]) {
      $('.tab .form-service-invalid').css("display", "none")
    }
  }
  return valid; // return the valid status
}

function fixStepIndicator(stepDirection) {
  // This function removes the "active" class of all steps...
  let allSteps = document.getElementsByClassName("step");
  for (let i = 0; i < allSteps.length; i++) {
    allSteps[i].className = allSteps[i].className.replace("active", "");
  }
  //... and adds the "active" class on the current step:
  allSteps[stepDirection].className += " active";
}

// validate email
$('.validate-email').on('change', function () {
  validateEmail($(this));
});

// validate url
$('.validate-url').on('change', function () {
  validateURL($(this));
});

// validate email
$('.validate-mobile').on('change', function () {
  validateMobile($(this));
});

// validate Tax id number and value add registeration number
$('.validate-Tax-id-number-and-value-add-registeration-number').on('focusout', function (e) {
  validateTax_id_numberAndValue_add_registeration_number($(this))
});

// validate commercial registeration number
$('.validate_commercial_registeration_number').on('focusout', function (e) {
  validate_commercial_registeration_number($(this));
});

function validate(object, regex, className) {
  const element = object.val().trim();
  let havRequire = false; // detect if the input is reuired firstly
  if (object.hasClass('require'))
    havRequire = true;

  if (element != '') { // element has value
    object.addClass('require');

    if (regex.test(element)) { // element match
      object.parent().parent().find(`.validate-${className}-error`).addClass('d-none');
      object.removeClass("invalid is-invalid");
      return true;
    }
    else {
      object.parent().parent().find(`.validate-${className}-error`).removeClass('d-none');
      object.addClass("invalid is-invalid");
      return false;
    }
  }
  else { // is empty
    if (!havRequire) // if the input in the first is not required
      object.removeClass('require');
    object.parent().parent().find(`.validate-${className}-error`).addClass('d-none');
    object.removeClass("invalid is-invalid");
    return true;
  }
}

function validateEmail(that) {
  return validate(that, /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/, 'email');
}

function validateURL(that) {
  return validate(that, /[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/i, 'url');
}

function validateMobile(that) {
  return validate(that, /^[0-9]{4,16}$/, 'mobile');
}

function validateTax_id_numberAndValue_add_registeration_number(that) {
  return validate(that, /^[\d]{3}-[\d]{3}-[\d]{3}$/, 'Tax-id-number-and-value-add-registeration-number');
}

function validate_commercial_registeration_number(that) {
  return validate(that, /^[\d]{4,7}$/, 'commercial-registeration-number');
}

// remove invalid is-invalid for multiple select on change
$(document).on('change', '.required-multiple-select', function () {
  if ($(this).find('option:selected').length == 0)
    $(this).removeClass("invalid is-invalid");
})

// remove invalid is-invalid for multiple select on change
$(document).on('change', '.required-multiple-select', function () {
  if ($(this).find('option:selected').length >= 1)
    $(this).removeClass("invalid is-invalid");
})

// remove invalid is-invalid for require on change
$('.require').on('change', function () {
  if ($(this).val() != '')
    $(this).removeClass("invalid is-invalid");
})

$(document).on('select2:unselecting', '.subGroup', function () {
  getAllUsedSubGroups();
})

function getAllUsedSubGroups() {
  usedSubGroupIds = [];

  // Get used subGroups
  $('.subGroup').each((index, subGroup) => {
    usedSubGroupIds.push(subGroup.value);
  });

  $('.subGroup option[value]').each((index, option) => {
    if (usedSubGroupIds.includes($(option).val()))
      $(option).prop('disabled', true);
    else
      $(option).prop('disabled', false);
  });
}
