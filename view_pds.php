<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Saved PDS</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .pds-table {
            width: 100%;
            border-collapse: collapse;
        }
        .pds-table th, .pds-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .pds-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .pds-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .pds-table tr:hover {
            background-color: #f1f1f1;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .details-row {
            display: none;
        }
        .details-content {
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container my-5">
        <h2 class="text-center mb-4">Saved Personal Data Sheets</h2>
        <div class="text-end mb-3">
            <a href="PDS_PAGE1_Gregorio.php" class="btn btn-primary">Create New PDS</a>
        </div>
        <div id="loading" class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p>Loading PDS data...</p>
        </div>
        <div id="pds-container" style="display: none;">
            <table class="pds-table table table-striped">
                <thead>
                    <tr>
                        <th>CSID</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Civil Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="pds-table-body">
                    <!-- Data will be populated by JavaScript -->
                </tbody>
            </table>
        </div>
        <div id="error-message" class="alert alert-danger" style="display: none;"></div>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        // Fetch all PDS data
        $.ajax({
            url: 'fetch_pds.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#loading').hide();
                
                if (response.status === 'success') {
                    $('#pds-container').show();
                    populatePdsTable(response.data);
                } else {
                    $('#error-message').text(response.message).show();
                }
            },
            error: function(xhr, status, error) {
                $('#loading').hide();
                $('#error-message').text('Error fetching data: ' + error).show();
            }
        });

        function populatePdsTable(data) {
            const tableBody = $('#pds-table-body');
            tableBody.empty();

            if (data.length === 0) {
                tableBody.append('<tr><td colspan="5" class="text-center">No PDS records found</td></tr>');
                return;
            }

            data.forEach(pds => {
                const personal = pds.personal;
                const name = `${personal.cs_surname}, ${personal.cs_firstname} ${personal.cs_middlename}`;
                
                const row = `
                    <tr>
                        <td>${pds.csid}</td>
                        <td>${name}</td>
                        <td>${personal.cs_dateofbirth}</td>
                        <td>${personal.cs_civilstatus}</td>
                        <td class="action-buttons">
                            <button class="btn btn-info btn-sm view-btn" data-csid="${pds.csid}">View</button>
                            <button class="btn btn-warning btn-sm edit-btn" data-csid="${pds.csid}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-csid="${pds.csid}">Delete</button>
                        </td>
                    </tr>
                    <tr class="details-row" id="details-${pds.csid}">
                        <td colspan="5">
                            <div class="details-content">
                                <h5>Personal Information</h5>
                                <p><strong>Full Name:</strong> ${name}</p>
                                <p><strong>Date of Birth:</strong> ${personal.cs_dateofbirth}</p>
                                <p><strong>Place of Birth:</strong> ${personal.cs_placeofbirth}</p>
                                <p><strong>Sex:</strong> ${personal.cs_sex}</p>
                                <p><strong>Civil Status:</strong> ${personal.cs_civilstatus}</p>
                                
                                <h5 class="mt-3">Family Background</h5>
                                ${pds.family ? `
                                    <p><strong>Father:</strong> ${pds.family.father_surname}, ${pds.family.father_firstname} ${pds.family.father_middlename}</p>
                                    <p><strong>Mother:</strong> ${pds.family.mother_surname}, ${pds.family.mother_firstname} ${pds.family.mother_middlename}</p>
                                    ${pds.family.spouse_surname ? `<p><strong>Spouse:</strong> ${pds.family.spouse_surname}, ${pds.family.spouse_firstname} ${pds.family.spouse_middlename}</p>` : ''}
                                ` : '<p>No family background data</p>'}
                                
                                <h5 class="mt-3">Children</h5>
                                ${pds.children && pds.children.length > 0 ? 
                                    pds.children.map(child => `<p>${child.children_name} - ${child.childrendateofbirth}</p>`).join('') : 
                                    '<p>No children data</p>'}
                                
                                <h5 class="mt-3">Educational Background</h5>
                                ${pds.education ? `
                                    ${pds.education.elem_name ? `<p><strong>Elementary:</strong> ${pds.education.elem_name} (${pds.education.elem_yrgrad})</p>` : ''}
                                    ${pds.education.secondary_name ? `<p><strong>Secondary:</strong> ${pds.education.secondary_name} (${pds.education.secondary_yrgrad})</p>` : ''}
                                    ${pds.education.college_name ? `<p><strong>College:</strong> ${pds.education.college_name} - ${pds.education.college_course} (${pds.education.college_yrgrad})</p>` : ''}
                                ` : '<p>No educational background data</p>'}
                            </div>
                        </td>
                    </tr>
                `;
                
                tableBody.append(row);
            });

            // Add event listeners
            $('.view-btn').click(function() {
                const csid = $(this).data('csid');
                $(`#details-${csid}`).toggle();
            });

            $('.edit-btn').click(function() {
                const csid = $(this).data('csid');
                if (confirm('Are you sure you want to edit this PDS?')) {
                    window.location.href = `PDS_PAGE1_Gregorio.php?csid=${csid}`;
                }
            });

            $('.delete-btn').click(function() {
                const csid = $(this).data('csid');
                if (confirm('Are you sure you want to delete this PDS? This action cannot be undone.')) {
                    deletePds(csid);
                }
            });
        }

        function deletePds(csid) {
            $.ajax({
                url: 'delete_pds.php',
                type: 'POST',
                data: { csid: csid },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('PDS deleted successfully');
                        location.reload();
                    } else {
                        alert('Error deleting PDS: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error deleting PDS: ' + error);
                }
            });
        }
    });
    </script>
</body>
</html>