src="js/jquery-3.7.1.min.js"
src="js/bootstrap.bundle.min.js"

// For Sex
document.querySelectorAll('.sex-checkbox').forEach(cb => {
  cb.addEventListener('change', function () {
    if (this.checked) {
      document.querySelectorAll('.sex-checkbox').forEach(other => {
        if (other !== this) other.checked = false;
      });
    }
  });
});

// For Civil Status
document.querySelectorAll('.civil-status-checkbox').forEach(cb => {
  cb.addEventListener('change', function () {
    if (this.checked) {
      document.querySelectorAll('.civil-status-checkbox').forEach(other => {
        if (other !== this) other.checked = false;
      });
    }
  });
});

// For citizenship
const filipinoCheck = document.getElementById('filipinoCheck');
const dualCheck = document.getElementById('dualCheck');
const dualDetails = document.getElementById('dualDetails');

if (filipinoCheck && dualCheck && dualDetails) {
  filipinoCheck.addEventListener('change', function () {
    if (this.checked) {
      dualCheck.checked = false;
      dualCheck.disabled = true;
      dualDetails.style.display = 'none';
    } else {
      dualCheck.disabled = false;
    }
  });

  dualCheck.addEventListener('change', function () {
    if (this.checked) {
      filipinoCheck.checked = false;
      filipinoCheck.disabled = true;
      dualDetails.style.display = 'block';
    } else {
      filipinoCheck.disabled = false;
      dualDetails.style.display = 'none';
    }
  });
}

async function loadCountries() {
  const select = document.getElementById("countrySelect");
  if (!select) return;
  
  try {
    const res = await fetch('https://restcountries.com/v3.1/all?fields=name');
    const countries = await res.json();

    select.innerHTML = '<option value="">Select Country</option>';

    countries.sort((a, b) => a.name.common.localeCompare(b.name.common));

    countries.forEach(country => {
      const option = document.createElement("option");
      option.value = country.name.common;
      option.textContent = country.name.common;
      select.appendChild(option);
    });
  } catch (err) {
    select.innerHTML = '<option value="">Failed to load countries</option>';
    console.error("Error loading countries:", err);
  }
}

window.addEventListener("DOMContentLoaded", loadCountries);

// For residential/permanent address
const sameAddressCheckbox = document.getElementById('sameAddress');
if (sameAddressCheckbox) {
  sameAddressCheckbox.addEventListener('change', function () {
    const isChecked = this.checked;
    const fields = ['house', 'street', 'subdivision', 'barangay', 'city', 'province', 'zip'];

    fields.forEach(field => {
      const resField = document.getElementById('res_' + field);
      const permField = document.getElementById('perm_' + field);

      if (resField && permField) {
        if (isChecked) {
          permField.value = resField.value;
          permField.readOnly = true; // Lock it
        } else {
          permField.readOnly = false; // Unlock it
        }
      }
    });
  });

  const fields = ['house', 'street', 'subdivision', 'barangay', 'city', 'province', 'zip'];
  fields.forEach(field => {
    const resField = document.getElementById('res_' + field);
    if (resField) {
      resField.addEventListener('input', function () {
        if (sameAddressCheckbox.checked) {
          const permField = document.getElementById('perm_' + field);
          if (permField) permField.value = this.value;
        }
      });
    }
  });
}

// For children's details
document.addEventListener('DOMContentLoaded', function () {
  const childrenContainer = document.getElementById('children-container');
  if (!childrenContainer) return;

  // Toggle children section based on checkbox
  const haveChildrenCheck = document.getElementById('haveChildrenCheck');
  const childrenSection = document.getElementById('children-section');
  
  if (haveChildrenCheck && childrenSection) {
    haveChildrenCheck.addEventListener('change', function() {
      if (this.checked) {
        childrenSection.style.display = 'block';
      } else {
        childrenSection.style.display = 'none';
        // Clear any child validation errors
        const childrenError = document.getElementById('children-error');
        if (childrenError) {
          childrenError.remove();
        }
      }
    });
  }

  childrenContainer.addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('add-child')) {
      const newChild = document.createElement('div');
      newChild.classList.add('child-entry', 'row', 'mb-2');
      newChild.innerHTML = `
        <div class="col-md-7">
          <input type="text" name="children_names[]" class="form-control" placeholder="Full Name">
        </div>
        <div class="col-md-4">
          <input type="date" name="children_dobs[]" class="form-control">
        </div>
        <div class="col-md-1 d-flex align-items-center">
          <button type="button" class="btn btn-danger remove-child">−</button>
        </div>
      `;
      childrenContainer.appendChild(newChild);
    }

    // Remove child entry
    if (e.target && e.target.classList.contains('remove-child')) {
      e.target.closest('.child-entry').remove();
    }
  });
});

// jQuery Validation for Personal Information Section
$(document).ready(function() {
  // Clear error messages when input changes
  $('input, select').on('input change', function() {
    const fieldId = $(this).attr('id');
    if (fieldId) {
      $(`#${fieldId}-error`).text('');
      $(this).removeClass('is-invalid');
    }
  });

  // Function to save personal information
  function savePersonalInfo() {
    console.log("Starting savePersonalInfo function...");

    const surname = $('#surname').val().trim();
    const firstname = $('#firstname').val().trim();
    const middlename = $('#middlename').val().trim();
    const nameext = $('#extension').val().trim();
    const dob = $('#dob').val().trim();
    const pob = $('#pob').val().trim();
    const sex = $('.sex-checkbox:checked').val() || '';
    const civilstatus = $('.civil-status-checkbox:checked').val() || '';
    const height = $('#height').val().trim();
    const weight = $('#weight').val().trim();
    const bloodtype = $('#bloodtype').val().trim();
    const gsis = $('#gsis').val().trim();
    const pagibig = $('#pagibig').val().trim();
    const philhealth = $('#philhealth').val().trim();
    const sss = $('#sss').val().trim();
    const tin = $('#tin').val().trim();
    const agencyempno = $('#agency_no').val().trim();

    // Get citizenship data
    const citizenship = $('input[name="citizenship"]:checked').val() || '';
    let dualType = [];
    let country = '';

    if (citizenship === 'Dual Citizenship') {
      // Get all checked dual citizenship types
      $('input[name="dual_type[]"]:checked').each(function() {
        dualType.push($(this).val());
      });
      country = $('#countrySelect').val() || '';
    }
    
    // Get residential address data
    const res_house = $('#res_house').val().trim();
    const res_street = $('#res_street').val().trim();
    const res_subdivision = $('#res_subdivision').val().trim();
    const res_barangay = $('#res_barangay').val().trim();
    const res_city = $('#res_city').val().trim();
    const res_province = $('#res_province').val().trim();
    const res_zip = $('#res_zip').val().trim();
    
    // Get permanent address data
    const perm_house = $('#perm_house').val().trim();
    const perm_street = $('#perm_street').val().trim();
    const perm_subdivision = $('#perm_subdivision').val().trim();
    const perm_barangay = $('#perm_barangay').val().trim();
    const perm_city = $('#perm_city').val().trim();
    const perm_province = $('#perm_province').val().trim();
    const perm_zip = $('#perm_zip').val().trim();
    const perm_telno = $('#perm_telno').val().trim();
    const perm_mobileno = $('#perm_mobileno').val().trim();
    const perm_email = $('#perm_email').val().trim();

    console.log("Form data extracted:", {
      surname, firstname, middlename, nameext, dob, pob, sex, civilstatus,
      height, weight, bloodtype, gsis, pagibig, philhealth, sss, tin, agencyempno, citizenship, dualType, country,
      res_house, res_street, res_subdivision, res_barangay, res_city, res_province, res_zip,
      perm_house, perm_street, perm_subdivision, perm_barangay, perm_city, perm_province, perm_zip,
      perm_telno, perm_mobileno, perm_email
    });

    const requiredFields = [
      {field: surname, id: 'surname', name: 'Surname'},
      {field: firstname, id: 'firstname', name: 'First Name'},
      {field: dob, id: 'dob', name: 'Date of Birth'},
      {field: pob, id: 'pob', name: 'Place of Birth'},
      {field: sex, id: 'sex', name: 'Sex'},
      {field: civilstatus, id: 'civil_status', name: 'Civil Status'},
      {field: citizenship, id: 'citizenship', name: 'Citizenship'},
      {field: res_house, id: 'res_house', name: 'Residential House No.'},
      {field: res_barangay, id: 'res_barangay', name: 'Residential Barangay'},
      {field: res_city, id: 'res_city', name: 'Residential City'},
      {field: res_province, id: 'res_province', name: 'Residential Province'},
      {field: perm_house, id: 'perm_house', name: 'Permanent House No.'},
      {field: perm_barangay, id: 'perm_barangay', name: 'Permanent Barangay'},
      {field: perm_city, id: 'perm_city', name: 'Permanent City'},
      {field: perm_province, id: 'perm_province', name: 'Permanent Province'}
    ];

    // Dual citizenship validation
    let hasErrors = false;
    if (citizenship === 'Dual Citizenship') {
      if (dualType.length === 0) {
        $('#citizenship-error').text('Please select dual citizenship type');
        hasErrors = true;
      }
      if (!country) {
        $('#citizenship-error').text('Please select a country');
        hasErrors = true;
      }
    }
    
    requiredFields.forEach(({field, id, name}) => {
      if (!field) {
        console.error(`Validation failed: ${name} is required`);
        $(`#${id}-error`).text(`${name} is required`);
        $(`#${id}`).addClass('is-invalid');
        hasErrors = true;
      }
    });

    if (hasErrors) {
      return false;
    }

    console.log("Form validation passed");

    // Clear previous errors
    $('.error').text('');
    $('.is-invalid').removeClass('is-invalid');

    // Show loading state
    $('#saveButton').prop('disabled', true).text('Saving...');
    console.log("Save button disabled, showing loading state");

    // Send data via AJAX
    console.log("Sending AJAX request to save_personalinfo.php");
    
    $.ajax({
      url: 'save_personalinfo.php',
      type: 'POST',
      data: {
        surname: surname,
        firstname: firstname,
        middlename: middlename,
        nameext: nameext,
        dob: dob,
        pob: pob,
        sex: sex,
        civil_status: civilstatus,
        height: height,
        weight: weight,
        bloodtype: bloodtype,
        gsis: gsis,
        pagibig: pagibig,
        philhealth: philhealth,
        sss: sss,
        tin: tin,
        agency_no: agencyempno,
        citizenship: citizenship,
        dual_type: dualType,
        country: country,
        res_house: res_house,
        res_street: res_street,
        res_subdivision: res_subdivision,
        res_barangay: res_barangay,
        res_city: res_city,
        res_province: res_province,
        res_zip: res_zip,
        perm_house: perm_house,
        perm_street: perm_street,
        perm_subdivision: perm_subdivision,
        perm_barangay: perm_barangay,
        perm_city: perm_city,
        perm_province: perm_province,
        perm_zip: perm_zip,
        perm_telno: perm_telno,
        perm_mobileno: perm_mobileno,
        perm_email: perm_email
      },
      dataType: 'json',
      success: function(response) {
        console.log("Personal info AJAX success:", response);
        
        if (response.status === 'success') {
            console.log("✅ Personal information saved successfully");
            // Store CSID for family background
            const csid = response.csid;
            localStorage.setItem('current_csid', csid);
            
            // Now save family background
            saveFamilyBackground();
        } else {
            console.error("❌ Personal info save failed:", response.message);
            alert('Error saving personal information: ' + response.message);
            $('#saveButton').prop('disabled', false).text('Save');
        }
    },
      error: function(xhr, status, error) {
        console.error("❌ Personal info AJAX failed:", error);
        alert('Error saving personal information. Check console for details.');
        $('#saveButton').prop('disabled', false).text('Save');
      }
    });
  }

    // Function to save children information
  function saveChildrenInfo(csid) {
    return new Promise((resolve, reject) => {
      console.log("Starting saveChildrenInfo function with CSID:", csid);
      
      // Check if user has children
      if (!csid) {
        console.error("No CSID provided for children info");
        return Promise.reject(new Error("CSID is required"));
    }
      
      // Get all children data
      const childrenNames = [];
      const childrenDobs = [];
      
      $('input[name="children_names[]"]').each(function() {
        childrenNames.push($(this).val().trim());
      });
      
      $('input[name="children_dobs[]"]').each(function() {
        childrenDobs.push($(this).val().trim());
      });
      
      // Validate children data
      const childrenData = [];
      for (let i = 0; i < childrenNames.length; i++) {
        if (childrenNames[i] && childrenDobs[i]) {
          childrenData.push({
            name: childrenNames[i],
            dob: childrenDobs[i]
          });
        }
      }
      
      if (childrenData.length === 0) {
        console.log("No valid children data to save");
        resolve(true);
        return;
      }
      
      console.log("Children data to save:", childrenData);
      
      // Send data via AJAX
      $.ajax({
        url: 'save_children.php',
        type: 'POST',
        data: {
          csid: csid,
          children: JSON.stringify(childrenData)
        },
        dataType: 'json',
        success: function(response) {
          console.log("Children AJAX success:", response);
          
          if (response.status === 'success') {
            console.log("✅ Children information saved successfully");
            resolve(true);
          } else {
            console.error("❌ Children info save failed:", response.message);
            reject(new Error(response.message));
          }
        },
        error: function(xhr, status, error) {
          console.error("❌ Children AJAX failed:", error);
          reject(new Error(error));
        }
      });
    });
  }

  // Function to save family background
    function saveFamilyBackground() {
    console.log("Starting saveFamilyBackground function...");
    
    // Get CSID from localStorage
    const csid = localStorage.getItem('current_csid');
    if (!csid) {
        console.error("No CSID found for family background");
        alert('Error: No CSID found. Please save personal information first.');
        $('#saveButton').prop('disabled', false).text('Save');
        return false;
    }

    // Helper function to safely get and trim field values
    function getFieldValue(selector) {
    const field = $(selector);
    return field.length ? field.val().trim() : '';
    }

    // Get form data for personal information
    const surname = getFieldValue('#surname');
    const firstname = getFieldValue('#firstname');
    const middlename = getFieldValue('#middlename');
    const nameext = getFieldValue('#extension');
    const dob = getFieldValue('#dob');
    const pob = getFieldValue('#pob');
    const sex = $('.sex-checkbox:checked').val() || '';
    const civilstatus = $('.civil-status-checkbox:checked').val() || '';
    const height = getFieldValue('#height');
    const weight = getFieldValue('#weight');
    const bloodtype = getFieldValue('#bloodtype');
    const gsis = getFieldValue('#gsis');
    const pagibig = getFieldValue('#pagibig');
    const philhealth = getFieldValue('#philhealth');
    const sss = getFieldValue('#sss');
    const tin = getFieldValue('#tin');
    const agencyempno = getFieldValue('#agency_no');

    // Get residential address data
    const res_house = getFieldValue('#res_house');
    const res_street = getFieldValue('#res_street');
    const res_subdivision = getFieldValue('#res_subdivision');
    const res_barangay = getFieldValue('#res_barangay');
    const res_city = getFieldValue('#res_city');
    const res_province = getFieldValue('#res_province');
    const res_zip = getFieldValue('#res_zip');

    // Get permanent address data
    const perm_house = getFieldValue('#perm_house');
    const perm_street = getFieldValue('#perm_street');
    const perm_subdivision = getFieldValue('#perm_subdivision');
    const perm_barangay = getFieldValue('#perm_barangay');
    const perm_city = getFieldValue('#perm_city');
    const perm_province = getFieldValue('#perm_province');
    const perm_zip = getFieldValue('#perm_zip');
    const perm_telno = getFieldValue('#perm_telno');
    const perm_mobileno = getFieldValue('#perm_mobileno');
    const perm_email = getFieldValue('#perm_email');

      // Get spouse information
    const spouse_surname = $('input[name="spouse_surname"]').length ? $('input[name="spouse_surname"]').val().trim() : '';
    const spouse_firstname = $('input[name="spouse_firstname"]').length ? $('input[name="spouse_firstname"]').val().trim() : '';
    const spouse_middlename = $('input[name="spouse_middlename"]').length ? $('input[name="spouse_middlename"]').val().trim() : '';
    const spouse_nameext = $('input[name="spouse_extension"]').length ? $('input[name="spouse_extension"]').val().trim() : '';
    const spouse_occupation = $('input[name="spouse_occupation"]').length ? $('input[name="spouse_occupation"]').val().trim() : '';
    const spouse_employer = $('input[name="spouse_employer"]').length ? $('input[name="spouse_employer"]').val().trim() : '';
    const spouse_businessadd = $('input[name="spouse_business_address"]').length ? $('input[name="spouse_business_address"]').val().trim() : '';
    const spouse_telno = $('input[name="spouse_tel"]').length ? $('input[name="spouse_tel"]').val().trim() : '';

    // Get father information
    const father_surname = $('input[name="father_surname"]').length ? $('input[name="father_surname"]').val().trim() : '';
    const father_firstname = $('input[name="father_firstname"]').length ? $('input[name="father_firstname"]').val().trim() : '';
    const father_middlename = $('input[name="father_middlename"]').length ? $('input[name="father_middlename"]').val().trim() : '';
    const father_nameext = $('input[name="father_extension"]').length ? $('input[name="father_extension"]').val().trim() : '';

    // Get mother information
    const mother_surname = $('input[name="mother_surname"]').length ? $('input[name="mother_surname"]').val().trim() : '';
    const mother_firstname = $('input[name="mother_firstname"]').length ? $('input[name="mother_firstname"]').val().trim() : '';
    const mother_middlename = $('input[name="mother_middlename"]').length ? $('input[name="mother_middlename"]').val().trim() : '';
    const mother_nameext = $('input[name="mother_extension"]').length ? $('input[name="mother_extension"]').val().trim() : '';

    console.log("Family background data extracted:", {
        csid, spouse_surname, spouse_firstname, spouse_middlename, spouse_nameext,
        spouse_occupation, spouse_employer, spouse_businessadd, spouse_telno,
        father_surname, father_firstname, father_middlename, father_nameext,
        mother_surname, mother_firstname, mother_middlename, mother_nameext
    });

    // Validate required fields (parents information)
    if (!father_surname || !father_firstname || !mother_surname || !mother_firstname) {
        alert('Father\'s and Mother\'s basic information (surname and first name) are required');
        return false;
    }

    // Show loading state
    $('#saveFamilyButton').prop('disabled', true).text('Saving...');

    // Send data via AJAX
    $.ajax({
        url: 'save_familybackground.php',
        type: 'POST',
        data: {
        csid: csid,
        spouse_surname: spouse_surname,
        spouse_firstname: spouse_firstname,
        spouse_middlename: spouse_middlename,
        spouse_extension: spouse_nameext,
        spouse_occupation: spouse_occupation,
        spouse_employer: spouse_employer,
        spouse_business_address: spouse_businessadd,
        spouse_tel: spouse_telno,
        father_surname: father_surname,
        father_firstname: father_firstname,
        father_middlename: father_middlename,
        father_extension: father_nameext,
        mother_surname: mother_surname,
        mother_firstname: mother_firstname,
        mother_middlename: mother_middlename,
        mother_extension: mother_nameext
        },
        dataType: 'json',
            success: function(response) {
            console.log("Family background AJAX success:", response);
            
            if (response.status === 'success') {
                console.log("✅ Family background saved successfully");
                
            // In the saveChildrenInfo success callback, add:
            saveChildrenInfo(csid)
            .then(() => {
                console.log("✅ Children information saved successfully");
                
                // Now save educational background
                return saveEducationalBackground(csid);
            })
            .then(() => {
                console.log("✅ All data saved successfully!");
                alert('All data saved successfully!');
                // Redirect or clear form as needed
            })
            .catch(error => {
                console.error("❌ Error saving data:", error);
                alert('Error saving data: ' + error.message);
            })
            .finally(() => {
                // Re-enable button regardless of success/failure
                $('#saveButton').prop('disabled', false).text('Save');
            });
                
            } else {
                console.error("❌ Family background save failed:", response.message);
                alert('Error saving family background: ' + response.message);
                $('#saveButton').prop('disabled', false).text('Save');
            }
            },
            error: function(xhr, status, error) {
            console.error("❌ Family background AJAX failed:", error);
            alert('Error saving family background. Check console for details.');
            $('#saveButton').prop('disabled', false).text('Save');
            }
        });
    }

    // Add this function to your js-function.js file

    // Function to save educational background
    function saveEducationalBackground(csid) {
    return new Promise((resolve, reject) => {
        console.log("Starting saveEducationalBackground function with CSID:", csid);
        
        if (!csid) {
        console.error("No CSID provided for educational background");
        reject(new Error("CSID is required"));
        return;
        }

        // Get educational data
        const educationalData = {
        // Elementary
        elem_name: $('input[name="elem_school"]').val().trim(),
        elem_course: $('input[name="elem_course"]').val().trim(),
        elem_start: $('input[name="elem_from"]').val().trim(),
        elem_end: $('input[name="elem_to"]').val().trim(),
        elem_highestlevel: $('input[name="elem_level"]').val().trim(),
        elem_yrgrad: $('input[name="elem_year_grad"]').val().trim(),
        elem_honor: $('input[name="elem_honors"]').val().trim(),
        
        // Secondary
        secondary_name: $('input[name="sec_school"]').val().trim(),
        secondary_course: $('input[name="sec_course"]').val().trim(),
        secondary_start: $('input[name="sec_from"]').val().trim(),
        secondary_end: $('input[name="sec_to"]').val().trim(),
        secondary_highestlevel: $('input[name="sec_level"]').val().trim(),
        secondary_yrgrad: $('input[name="sec_year_grad"]').val().trim(),
        secondary_honor: $('input[name="sec_honors"]').val().trim(),
        
        // Vocational
        vocational_name: $('input[name="voc_school"]').val().trim(),
        vocational_course: $('input[name="voc_course"]').val().trim(),
        vocational_start: $('input[name="voc_from"]').val().trim(),
        vocational_end: $('input[name="voc_to"]').val().trim(),
        vocational_highestlevel: $('input[name="voc_level"]').val().trim(),
        vocational_yrgrad: $('input[name="voc_year_grad"]').val().trim(),
        vocational_honor: $('input[name="voc_honors"]').val().trim(),
        
        // College
        college_name: $('input[name="college_school"]').val().trim(),
        college_course: $('input[name="college_course"]').val().trim(),
        college_start: $('input[name="college_from"]').val().trim(),
        college_end: $('input[name="college_to"]').val().trim(),
        college_highestlevel: $('input[name="college_level"]').val().trim(),
        college_yrgrad: $('input[name="college_year_grad"]').val().trim(),
        college_honor: $('input[name="college_honors"]').val().trim(),
        
        // Graduate Studies
        grad_name: $('input[name="grad_school"]').val().trim(),
        grad_course: $('input[name="grad_course"]').val().trim(),
        grad_start: $('input[name="grad_from"]').val().trim(),
        grad_end: $('input[name="grad_to"]').val().trim(),
        grad_highestlevel: $('input[name="grad_level"]').val().trim(),
        grad_yrgrad: $('input[name="grad_year_grad"]').val().trim(),
        grad_honor: $('input[name="grad_honors"]').val().trim(),
        
        // Signature and Date
        cs_sig: '', // Will be handled separately for file upload
        cs_date: $('input[name="date"]').val().trim()
        };

        console.log("Educational data to save:", educationalData);

        // Send data via AJAX
        $.ajax({
        url: 'save_educational.php',
        type: 'POST',
        data: {
            csid: csid,
            ...educationalData
        },
        dataType: 'json',
        success: function(response) {
            console.log("Educational background AJAX success:", response);
            
            if (response.status === 'success') {
            console.log("✅ Educational background saved successfully");
            resolve(true);
            } else {
            console.error("❌ Educational background save failed:", response.message);
            reject(new Error(response.message));
            }
        },
        error: function(xhr, status, error) {
            console.error("❌ Educational background AJAX failed:", error);
            reject(new Error(error));
        }
        });
    });
    }

  // Save button click handler
  $('#saveButton').click(function() {
    console.log("Main Save button clicked");
    
    let isValid = true;
    let firstErrorElement = null;

    console.log("Form validation result:", isValid ? "Valid" : "Invalid");

    // Validate required fields in Personal Information section
    const requiredFields = [
      'surname', 'firstname', 'middlename', 'extension', 'dob', 'pob', 'height', 'weight',
      'bloodtype', 'gsis', 'pagibig', 'philhealth', 'sss', 'tin', 'agency_no',
      'res_house', 'res_street', 'res_subdivision', 'res_barangay', 'res_city', 'res_province', 'res_zip',
      'perm_house', 'perm_street', 'perm_subdivision', 'perm_barangay', 'perm_city', 'perm_province', 'perm_zip',
      'perm_telno', 'perm_mobileno', 'perm_email'
    ];

    // Clear previous errors
    $('.error').text('');
    $('.is-invalid').removeClass('is-invalid');

    // Validate text fields
    requiredFields.forEach(field => {
      const $field = $(`#${field}`);
      if ($field.length) { // Check if the field exists
        const value = $field.val().trim();
        if (!value) {
          $(`#${field}-error`).text('This field is required');
          $field.addClass('is-invalid');
          isValid = false;
          
          // Track the first error element for scrolling
          if (!firstErrorElement) firstErrorElement = $field[0];
        }
      }
    });

    // Validate sex selection
    const sexSelected = $('.sex-checkbox:checked').length > 0;
    if (!sexSelected) {
      $('#sex-error').text('Please select your sex');
      isValid = false;
      
      // Track the first error element for scrolling
      if (!firstErrorElement) firstErrorElement = $('#sex-error')[0];
    }

    // Validate civil status selection
    const civilStatusSelected = $('.civil-status-checkbox:checked').length > 0;
    if (!civilStatusSelected) {
      $('#civil_status-error').text('Please select your civil status');
      isValid = false;
      
      // Track the first error element for scrolling
      if (!firstErrorElement) firstErrorElement = $('#civil_status-error')[0];
    }

    // Validate citizenship selection
    const citizenshipSelected = $('#filipinoCheck').is(':checked') || $('#dualCheck').is(':checked');
    if (!citizenshipSelected) {
      $('#citizenship-error').text('Please select your citizenship');
      isValid = false;
      
      // Track the first error element for scrolling
      if (!firstErrorElement) firstErrorElement = $('#citizenship-error')[0];
    }

    // If dual citizenship is selected, validate dual citizenship details
    if ($('#dualCheck').is(':checked')) {
      const dualTypeSelected = $('#byBirth').is(':checked') || $('#byNaturalization').is(':checked');
      const countrySelected = $('#countrySelect').val();
      
      if (!dualTypeSelected) {
        $('#citizenship-error').text('Please select dual citizenship type');
        isValid = false;
        
        // Track the first error element for scrolling
        if (!firstErrorElement) firstErrorElement = $('#citizenship-error')[0];
      }
      
      if (!countrySelected) {
        $('#citizenship-error').text('Please select a country');
        isValid = false;
        
        // Track the first error element for scrolling
        if (!firstErrorElement) firstErrorElement = $('#citizenship-error')[0];
      }
    }

    // ===== II. Family Background Validation =====
    // Validate spouse information if married
    const isMarried = $('#civil_married').is(':checked');
    if (isMarried) {
      const spouseFields = [
        'spouse_surname', 'spouse_firstname', 'spouse_middlename', 'spouse_extension',
        'spouse_occupation', 'spouse_employer', 'spouse_business_address', 'spouse_tel'
      ];
      
      spouseFields.forEach(field => {
        const $field = $(`input[name="${field}"]`);
        if ($field.length) {
          const value = $field.val().trim();
          if (!value) {
            // Create error element if it doesn't exist
            if (!$(`#${field}-error`).length) {
              $field.after(`<div class="error" id="${field}-error"></div>`);
            }
            $(`#${field}-error`).text('This field is required for married applicants');
            $field.addClass('is-invalid');
            isValid = false;
            
            if (!firstErrorElement) firstErrorElement = $field[0];
          }
        }
      });
    }

    // Toggle children section based on checkbox
    $('#haveChildrenCheck').change(function() {
      if ($(this).is(':checked')) {
        $('#children-section').show();
      } else {
        $('#children-section').hide();
        // Clear any child validation errors
        $('#children-error').remove();
      }
    });

    // Update the children validation in your saveButton click handler
    // Replace the existing children validation with this:
    const hasChildrenChecked = $('#haveChildrenCheck').is(':checked');
    if (hasChildrenChecked) {
      let childError = false;
      let emptyChildFields = false;
      
      // Check if at least one child has a name
      const hasChildWithName = $('input[name="children_names[]"]').filter(function() {
        return $(this).val().trim() !== '';
      }).length > 0;
      
      if (!hasChildWithName) {
        isValid = false;
        if (!$('#children-error').length) {
          $('#children-container').append('<div class="error" id="children-error">Please add at least one child</div>');
        }
        if (!firstErrorElement) firstErrorElement = $('#children-error')[0];
      } else {
        // Validate all child entries
        $('input[name="children_names[]"]').each(function() {
          if ($(this).val().trim() === '') {
            childError = true;
            return false; // Break out of the loop
          }
        });
        
        $('input[name="children_dobs[]"]').each(function() {
          if ($(this).val().trim() === '') {
            childError = true;
            return false; // Break out of the loop
          }
        });
        
        if (childError) {
          isValid = false;
          if (!$('#children-error').length) {
            $('#children-container').append('<div class="error" id="children-error">Please complete all child entries</div>');
          }
          if (!firstErrorElement) firstErrorElement = $('#children-error')[0];
        }
      }
    }

    // Validate father's information
    const fatherFields = ['father_surname', 'father_firstname', 'father_middlename', 'father_extension'];
    fatherFields.forEach(field => {
      const $field = $(`input[name="${field}"]`);
      if ($field.length) {
        const value = $field.val().trim();
        if (!value) {
          if (!$(`#${field}-error`).length) {
            $field.after(`<div class="error" id="${field}-error"></div>`);
          }
          $(`#${field}-error`).text('This field is required');
          $field.addClass('is-invalid');
          isValid = false;
          
          if (!firstErrorElement) firstErrorElement = $field[0];
        }
      }
    });

    // Validate mother's information
    const motherFields = ['mother_surname', 'mother_firstname', 'mother_middlename'];
    motherFields.forEach(field => {
      const $field = $(`input[name="${field}"]`);
      if ($field.length) {
        const value = $field.val().trim();
        if (!value) {
          if (!$(`#${field}-error`).length) {
            $field.after(`<div class="error" id="${field}-error"></div>`);
          }
          $(`#${field}-error`).text('This field is required');
          $field.addClass('is-invalid');
          isValid = false;
          
          if (!firstErrorElement) firstErrorElement = $field[0];
        }
      }
    });

    // If form is valid, submit it
    if (isValid) {
      console.log("Saving information...");
      savePersonalInfo();
    } else {
      console.log("Validation failed, not saving data");
      if (firstErrorElement) {
        $('html, body').animate({
          scrollTop: $(firstErrorElement).offset().top - 100
        }, 500);
      }
      return false;
    }
  });
});