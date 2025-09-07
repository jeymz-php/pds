<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Personal Data Sheet</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    .form-section {
      border: 1px solid #ccc;
      padding: 20px;
      margin-bottom: 30px;
      border-radius: 10px;
    }
    .form-section h4 {
      margin-bottom: 20px;
    }
    .error {
      color: red;
      font-size: 0.875em;
      margin-top: 5px;
    }
  </style>
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="text-center mb-4">Personal Data Sheet (PDS)</h2>
  <p>WARNING: Any misrepresentation made in the Personal Data Sheet and the Work Experience Sheet shall cause the filing of administrative/criminal case/s against the person concerned.</p>
  <p>READ THE ATTACHED GUIDE TO FILLING OUT THE PERSONAL DATA SHEET (PDS) BEFORE ACCOMPLISHING THE PDS FORM.</p>
  <p>Print legibly. Tick appropriate boxes and use separate sheet if necessary. Indicate N/A if not applicable.  DO NOT ABBREVIATE.</p>
  <form method="post" action="submit.php" enctype="multipart/form-data" id="pdsForm">
    
    <!-- I. Personal Information -->
    <div class="form-section">
      <h4>I. Personal Information</h4>
      <div class="row g-3">
        <div class="col-md-3">
          <label>Surname</label>
          <input type="text" class="form-control" name="surname" id="surname">
          <div class="error" id="surname-error"></div>
        </div>
        <div class="col-md-3">
          <label>First Name</label>
          <input type="text" class="form-control" name="firstname" id="firstname">
          <div class="error" id="firstname-error"></div>
        </div>
        <div class="col-md-3">
          <label>Middle Name</label>
          <input type="text" class="form-control" name="middlename" id="middlename">
          <div class="error" id="middlename-error"></div>
        </div>
        <div class="col-md-3">
          <label>Name Extension</label>
          <input type="text" class="form-control" name="extension" id="extension">
          <div class="error" id="extension-error"></div>
        </div>

        <div class="col-md-3">
          <label>Date of Birth</label>
          <input type="date" class="form-control" name="dob" id="dob">
          <div class="error" id="dob-error"></div>
        </div>
        <div class="col-md-3">
          <label>Place of Birth</label>
          <input type="text" class="form-control" name="pob" id="pob">
          <div class="error" id="pob-error"></div>
        </div>
        <div class="col-md-3">
          <label>Sex</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input sex-checkbox" type="checkbox" name="sex[]" value="Male" id="sex-male">
            <label class="form-check-label" for="sex-male">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input sex-checkbox" type="checkbox" name="sex[]" value="Female" id="sex-female">
            <label class="form-check-label" for="sex-female">Female</label>
          </div>
          <div class="error" id="sex-error"></div>
        </div>
        <div class="col-md-3">
        <label><strong>Civil Status</strong></label>
          <div class="form-check">
              <input class="form-check-input civil-status-checkbox" type="checkbox" name="civil_status" value="Single" id="civil_single">
              <label class="form-check-label" for="civil_single">Single</label>
            </div>
            <div class="form-check">
              <input class="form-check-input civil-status-checkbox" type="checkbox" name="civil_status" value="Married" id="civil_married">
              <label class="form-check-label" for="civil_married">Married</label>
            </div>
            <div class="form-check">
              <input class="form-check-input civil-status-checkbox" type="checkbox" name="civil_status" value="Widowed" id="civil_widowed">
              <label class="form-check-label" for="civil_widowed">Widowed</label>
            </div>
            <div class="form-check">
              <input class="form-check-input civil-status-checkbox" type="checkbox" name="civil_status" value="Separated" id="civil_separated">
              <label class="form-check-label" for="civil_separated">Separated</label>
            </div>
            <div class="form-check">
              <input class="form-check-input civil-status-checkbox" type="checkbox" name="civil_status" value="Other" id="civil_other">
              <label class="form-check-label" for="civil_other">Other/s</label>
            </div>
            <div class="error" id="civil_status-error"></div>
        </div>

        <div class="col-md-2">
          <label>Height (m)</label>
          <input type="text" class="form-control" name="height" id="height">
          <div class="error" id="height-error"></div>
        </div>
        <div class="col-md-2">
          <label>Weight (kg)</label>
          <input type="text" class="form-control" name="weight" id="weight">
          <div class="error" id="weight-error"></div>
        </div>
        <div class="col-md-2">
          <label>Blood Type</label>
          <input type="text" class="form-control" name="bloodtype" id="bloodtype">
          <div class="error" id="bloodtype-error"></div>
        </div>
        <div class="col-md-3">
          <label>GSIS ID No.</label>
          <input type="text" class="form-control" name="gsis" id="gsis">
          <div class="error" id="gsis-error"></div>
        </div>
        <div class="col-md-3">
          <label>PAG-IBIG No.</label>
          <input type="text" class="form-control" name="pagibig" id="pagibig">
          <div class="error" id="pagibig-error"></div>
        </div>
        <div class="col-md-3">
          <label>PhilHealth No.</label>
          <input type="text" class="form-control" name="philhealth" id="philhealth">
          <div class="error" id="philhealth-error"></div>
        </div>
        <div class="col-md-3">
          <label>SSS No.</label>
          <input type="text" class="form-control" name="sss" id="sss">
          <div class="error" id="sss-error"></div>
        </div>
        <div class="col-md-3">
          <label>TIN No.</label>
          <input type="text" class="form-control" name="tin" id="tin">
          <div class="error" id="tin-error"></div>
        </div>
        <div class="col-md-3">
          <label>Agency Employee No.</label>
          <input type="text" class="form-control" name="agency_no" id="agency_no">
          <div class="error" id="agency_no-error"></div>
        </div>

        <div class="col-md-12">
          <label>Citizenship</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="filipinoCheck" name="citizenship" value="Filipino">
            <label class="form-check-label" for="filipinoCheck">Filipino</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="dualCheck" name="citizenship" value="Dual Citizenship">
            <label class="form-check-label" for="dualCheck">Dual Citizenship</label>
          </div>
          <div class="error" id="citizenship-error"></div>

          <!-- Hidden section for dual citizenship details -->
          <div id="dualDetails" class="mt-3" style="display: none; margin-left: 30px;">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="dual_type[]" id="byBirth" value="By Birth">
              <label class="form-check-label" for="byBirth">By Birth</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="dual_type[]" id="byNaturalization" value="By Naturalization">
              <label class="form-check-label" for="byNaturalization">By Naturalization</label>
            </div>
            <div class="mt-2">
              <select class="form-select" name="country" id="countrySelect">
                <option value="">Loading countries...</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Residential Address -->
        <h4>17. Residential Address</h4>
        <div class="row">
          <div class="col-md-4">
            <label>House/Block/Lot No.</label>
            <input type="text" class="form-control" name="res_house" id="res_house">
            <div class="error" id="res_house-error"></div>
          </div>
          <div class="col-md-4">
            <label>Street</label>
            <input type="text" class="form-control" name="res_street" id="res_street">
            <div class="error" id="res_street-error"></div>
          </div>
          <div class="col-md-4">
            <label>Subdivision/Village</label>
            <input type="text" class="form-control" name="res_subdivision" id="res_subdivision">
            <div class="error" id="res_subdivision-error"></div>
          </div>
          <div class="col-md-4">
            <label>Barangay</label>
            <input type="text" class="form-control" name="res_barangay" id="res_barangay">
            <div class="error" id="res_barangay-error"></div>
          </div>
          <div class="col-md-4">
            <label>City/Municipality</label>
            <input type="text" class="form-control" name="res_city" id="res_city">
            <div class="error" id="res_city-error"></div>
          </div>
          <div class="col-md-4">
            <label>Province</label>
            <input type="text" class="form-control" name="res_province" id="res_province">
            <div class="error" id="res_province-error"></div>
          </div>
          <div class="col-md-4">
            <label>ZIP Code</label>
            <input type="text" class="form-control" name="res_zip" id="res_zip">
            <div class="error" id="res_zip-error"></div>
          </div>
        </div>

        <hr>

        <!-- Permanent Address -->
        <h4>18. Permanent Address</h4>
        <div class="form-check mb-2">
          <input type="checkbox" class="form-check-input" id="sameAddress">
          <label class="form-check-label" for="sameAddress">Same as Residential Address</label>
        </div>

        <div class="row">
          <div class="col-md-4">
            <label>House/Block/Lot No.</label>
            <input type="text" class="form-control" name="perm_house" id="perm_house">
            <div class="error" id="perm_house-error"></div>
          </div>
          <div class="col-md-4">
            <label>Street</label>
            <input type="text" class="form-control" name="perm_street" id="perm_street">
            <div class="error" id="perm_street-error"></div>
          </div>
          <div class="col-md-4">
            <label>Subdivision/Village</label>
            <input type="text" class="form-control" name="perm_subdivision" id="perm_subdivision">
            <div class="error" id="perm_subdivision-error"></div>
          </div>
          <div class="col-md-4">
            <label>Barangay</label>
            <input type="text" class="form-control" name="perm_barangay" id="perm_barangay">
            <div class="error" id="perm_barangay-error"></div>
          </div>
          <div class="col-md-4">
            <label>City/Municipality</label>
            <input type="text" class="form-control" name="perm_city" id="perm_city">
            <div class="error" id="perm_city-error"></div>
          </div>
          <div class="col-md-4">
            <label>Province</label>
            <input type="text" class="form-control" name="perm_province" id="perm_province">
            <div class="error" id="perm_province-error"></div>
          </div>
          <div class="col-md-4">
            <label>ZIP Code</label>
            <input type="text" class="form-control" name="perm_zip" id="perm_zip">
            <div class="error" id="perm_zip-error"></div>
          </div>
          <div class="col-md-4">
            <label>Telephone No.</label>
            <input type="text" class="form-control" name="perm_telno" id="perm_telno">
            <div class="error" id="perm_telno-error"></div>
          </div>
          <div class="col-md-4">
            <label>Mobile No.</label>
            <input type="text" class="form-control" name="perm_mobileno" id="perm_mobileno">
            <div class="error" id="perm_mobileno-error"></div>
          </div>
          <div class="col-md-4">
            <label>Email Address</label>
            <input type="text" class="form-control" name="perm_email" id="perm_email">
            <div class="error" id="perm_email-error"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- II. Family Background -->
    <div class="form-section">
      <h4>II. Family Background</h4>
      <div class="row g-3">
        <div class="col-md-3"><input class="form-control" name="spouse_surname" placeholder="Spouse Surname"></div>
        <div class="col-md-3"><input class="form-control" name="spouse_firstname" placeholder="Spouse First Name"></div>
        <div class="col-md-3"><input class="form-control" name="spouse_middlename" placeholder="Spouse Middle Name"></div>
        <div class="col-md-3"><input class="form-control" name="spouse_extension" placeholder="Spouse Name Extension (Jr./Sr.)"></div>
        <div class="col-md-4"><input class="form-control" name="spouse_occupation" placeholder="Spouse Occupation"></div>
        <div class="col-md-4"><input class="form-control" name="spouse_employer" placeholder="Spouse Employer/Business Name"></div>
        <div class="col-md-4"><input class="form-control" name="spouse_business_address" placeholder="Spouse Business Address"></div>
        <div class="col-md-4"><input class="form-control" name="spouse_tel" placeholder="Spouse Telephone No."></div>

        <!-- Have Children Checkbox -->
        <div class="col-md-12">
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="haveChildrenCheck">
            <label class="form-check-label" for="haveChildrenCheck">I have children</label>
          </div>
        </div>

        <div class="form-group" id="children-section" style="display: none;">
          <label><strong>23. Name of Children and Date of Birth</strong></label>
          <div id="children-container">
            <div class="child-entry row mb-2">
              <div class="col-md-7">
                <input type="text" name="children_names[]" class="form-control" placeholder="Full Name">
              </div>
              <div class="col-md-4">
                <input type="date" name="children_dobs[]" class="form-control">
              </div>
              <div class="col-md-1 d-flex align-items-center">
                <button type="button" class="btn btn-success add-child">+</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3"><input class="form-control" name="father_surname" placeholder="Father's Surname"></div>
        <div class="col-md-3"><input class="form-control" name="father_firstname" placeholder="First Name"></div>
        <div class="col-md-3"><input class="form-control" name="father_middlename" placeholder="Middle Name"></div>
        <div class="col-md-3"><input class="form-control" name="father_extension" placeholder="Extension (Jr./Sr.)"></div>

        <div class="col-md-3"><input class="form-control" name="mother_surname" placeholder="Mother's Maiden Surname"></div>
        <div class="col-md-3"><input class="form-control" name="mother_firstname" placeholder="First Name"></div>
        <div class="col-md-3"><input class="form-control" name="mother_middlename" placeholder="Middle Name"></div>
      </div>
    </div>

    <!-- III. Educational Background -->
    <div class="form-group">
      <label><strong>III. Educational Background</strong></label>
    </div>

    <!-- Elementary -->
    <div class="education-group mb-4">
      <h6><strong>Elementary</strong></h6>
      <div class="row">
        <div class="col-md-6 mb-2">
          <input type="text" name="elem_school" class="form-control" placeholder="Name of School">
          <div class="error" id="elem_school-error"></div>
        </div>
        <div class="col-md-6 mb-2">
          <input type="text" name="elem_course" class="form-control" placeholder="Basic Education/Degree/Course">
          <div class="error" id="elem_course-error"></div>
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="elem_from" class="form-control" placeholder="From (yyyy)">
          <div class="error" id="elem_from-error"></div>
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="elem_to" class="form-control" placeholder="To (yyyy)">
          <div class="error" id="elem_to-error"></div>
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="elem_level" class="form-control" placeholder="Highest Level/Units Earned">
          <div class="error" id="elem_level-error"></div>
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="elem_year_grad" class="form-control" placeholder="Year Graduated">
          <div class="error" id="elem_year_grad-error"></div>
        </div>
        <div class="col-md-12 mb-2">
          <input type="text" name="elem_honors" class="form-control" placeholder="Scholarship/Academic Honors Received">
          <div class="error" id="elem_honors-error"></div>
        </div>
      </div>
    </div>

    <!-- Secondary -->
    <div class="education-group mb-4">
      <h6><strong>Secondary</strong></h6>
      <div class="row">
        <div class="col-md-6 mb-2">
          <input type="text" name="sec_school" class="form-control" placeholder="Name of School">
          <div class="error" id="sec_school-error"></div>
        </div>
        <div class="col-md-6 mb-2">
          <input type="text" name="sec_course" class="form-control" placeholder="Basic Education/Degree/Course">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="sec_from" class="form-control" placeholder="From (yyyy)">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="sec_to" class="form-control" placeholder="To (yyyy)">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="sec_level" class="form-control" placeholder="Highest Level/Units Earned">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="sec_year_grad" class="form-control" placeholder="Year Graduated">
        </div>
        <div class="col-md-12 mb-2">
          <input type="text" name="sec_honors" class="form-control" placeholder="Scholarship/Academic Honors Received">
        </div>
      </div>
    </div>

    <!-- Vocational/Trade -->
    <div class="education-group mb-4">
      <h6><strong>Vocational/Trade Course</strong></h6>
      <div class="row">
        <div class="col-md-6 mb-2">
          <input type="text" name="voc_school" class="form-control" placeholder="Name of School">
        </div>
        <div class="col-md-6 mb-2">
          <input type="text" name="voc_course" class="form-control" placeholder="Basic Education/Degree/Course">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="voc_from" class="form-control" placeholder="From (yyyy)">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="voc_to" class="form-control" placeholder="To (yyyy)">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="voc_level" class="form-control" placeholder="Highest Level/Units Earned">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="voc_year_grad" class="form-control" placeholder="Year Graduated">
        </div>
        <div class="col-md-12 mb-2">
          <input type="text" name="voc_honors" class="form-control" placeholder="Scholarship/Academic Honors Received">
        </div>
      </div>
    </div>

    <!-- College -->
    <div class="education-group mb-4">
      <h6><strong>College</strong></h6>
      <div class="row">
        <div class="col-md-6 mb-2">
          <input type="text" name="college_school" class="form-control" placeholder="Name of School">
        </div>
        <div class="col-md-6 mb-2">
          <input type="text" name="college_course" class="form-control" placeholder="Basic Education/Degree/Course">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="college_from" class="form-control" placeholder="From (yyyy)">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="college_to" class="form-control" placeholder="To (yyyy)">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="college_level" class="form-control" placeholder="Highest Level/Units Earned">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="college_year_grad" class="form-control" placeholder="Year Graduated">
        </div>
        <div class="col-md-12 mb-2">
          <input type="text" name="college_honors" class="form-control" placeholder="Scholarship/Academic Honors Received">
        </div>
      </div>
    </div>

    <!-- Graduate Studies -->
    <div class="education-group mb-4">
      <h6><strong>Graduate Studies</strong></h6>
      <div class="row">
        <div class="col-md-6 mb-2">
          <input type="text" name="grad_school" class="form-control" placeholder="Name of School">
        </div>
        <div class="col-md-6 mb-2">
          <input type="text" name="grad_course" class="form-control" placeholder="Basic Education/Degree/Course">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="grad_from" class="form-control" placeholder="From (yyyy)">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="grad_to" class="form-control" placeholder="To (yyyy)">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="grad_level" class="form-control" placeholder="Highest Level/Units Earned">
        </div>
        <div class="col-md-3 mb-2">
          <input type="text" name="grad_year_grad" class="form-control" placeholder="Year Graduated">
        </div>
        <div class="col-md-12 mb-2">
          <input type="text" name="grad_honors" class="form-control" placeholder="Scholarship/Academic Honors Received">
        </div>
      </div>
    </div>

    <!-- Signature and Date -->
    <div class="form-section">
      <h4>Signature and Date</h4>
      <div class="row">
        <div class="col-md-6">
          <label for="signature">Upload Signature (Image)</label>
          <input type="file" class="form-control" name="signature" id="signature" accept="image/*">
          <div class="error" id="signature-error"></div>
        </div>
        <div class="col-md-6">
          <label>Date</label>
          <input type="date" class="form-control" name="date" id="date">
          <div class="error" id="date-error"></div>
        </div>
      </div>
    </div>

    <!-- Save Button -->
    <div class="text-center my-4">
      <button type="button" id="saveButton" class="btn btn-primary btn-lg">Save</button>
    </div>
    
  </form>
</div>

<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js-function.js"></script>

</body>
</html>
