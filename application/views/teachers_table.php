<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Teacher Table</title>
</head>

<body>

    <div class="container">
        <?php include "components/navbar.php"; ?>
        <table class="table table-hover">
            <h2>Teachers Table</h2>
            <a class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add</a>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="teachersTableBody">
                <!-- JavaScript will populate this -->
            </tbody>
        </table>
    </div>

    <!-- Add Teacher Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="addTeacherForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Teacher's Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="gender">Gender</label>
                            <select class="form-select" id="gender" required>
                                <option value="" disabled selected>-- Select --</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" id="dob" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" id="phone_number" class="form-control" placeholder="Phone Number"
                                required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Teacher Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="editTeacherForm">
                        <input type="hidden" id="edit_id"> <!-- Hidden ID Field -->
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Teacher's Name</label>
                            <input type="text" id="edit_name" class="form-control" required>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="edit_gender">Gender</label>
                            <select class="form-select" id="edit_gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_dob" class="form-label">Date of Birth</label>
                            <input type="date" id="edit_dob" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_phone_number" class="form-label">Phone Number</label>
                            <input type="text" id="edit_phone_number" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const url = "http://localhost/ci_school_management/teachers/";


        function getData() {
            $.ajax({
                url: url + 'get_all_teachers',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    renderTeachersTable(data.teachers);
                },
                error: function (xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        }


        function renderTeachersTable(teachers) {
            const tableBody = $('#teachersTableBody');
            tableBody.empty();

            teachers.forEach(teacher => {
                const row = `
                <tr id="row-${teacher.id}">
                    <th scope="row">${teacher.id}</th>
                    <td>${teacher.name}</td>
                    <td>${teacher.gender}</td>
                    <td>${teacher.dob}</td>
                    <td>${teacher.phone_number}</td>
                    <td>
                        <button class="btn btn-primary btn-sm editBtn" data-id="${teacher.id}"
                                data-name="${teacher.name}" data-gender="${teacher.gender}"
                                data-dob="${teacher.dob}" data-phone_number="${teacher.phone_number}"
                                data-bs-toggle="modal" data-bs-target="#editModal">
                            Edit
                        </button>
                        <a href="#" class="btn btn-danger btn-sm delete-btn" data-id="${teacher.id}">Delete</a>
                    </td>
                </tr>
            `;
                tableBody.append(row);
            });
        }

        $(document).ready(function () {

            getData();


            $(document).on('click', '.delete-btn', function (e) {
                e.preventDefault();
                var teacherId = $(this).data('id');

                if (confirm("Are you sure you want to delete this teacher?")) {
                    $.ajax({
                        url: url + 'delete/' + teacherId,
                        type: 'POST',  // Use POST instead of DELETE
    data: { id: teacherId }, // Send the ID in the request body
                        success: function (response) {
                            var res = JSON.parse(response);
                            if (res.status === 'success') {
                                alert(res.message);
                                $('#row-' + teacherId).remove();
                            } else {
                                alert('Error: ' + res.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            alert('Error: ' + error);
                        }
                    });
                }
            });


            $(document).on('click', '.editBtn', function () {

                $('#edit_id').val($(this).data('id'));
                $('#edit_name').val($(this).data('name'));
                $('#edit_gender').val($(this).data('gender'));
                $('#edit_dob').val($(this).data('dob'));
                $('#edit_phone_number').val($(this).data('phone_number'));
            });


            $('#editTeacherForm').on('submit', function (e) {
                e.preventDefault();
                var teacherId = $('#edit_id').val();
                var teacherData = {
                    name: $('#edit_name').val(),
                    gender: $('#edit_gender').val(),
                    dob: $('#edit_dob').val(),
                    phone_number: $('#edit_phone_number').val()
                };

                $.ajax({
                    url: url + 'update/' + teacherId, // Add ID to the URL
                    type: 'POST', // Change to POST instead of PUT
                    data: teacherData,
                    success: function (response) {
                        var res = JSON.parse(response);
                        if (res.status === 'success') {
                            alert(res.message);
                            $('#editModal').modal('hide');
                            getData();
                        } else {
                            alert('Error: ' + res.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('Error: ' + error);
                    }
                });
            });




            $('#addTeacherForm').on('submit', function (e) {
                e.preventDefault();
                var teacherData = {
                    name: $('#name').val(),
                    gender: $('#gender').val(),
                    dob: $('#dob').val(),
                    phone_number: $('#phone_number').val()
                };

                $.ajax({
                    url: url + 'create',
                    type: 'POST',
                    data: teacherData,
                    success: function (response) {
                        var res = JSON.parse(response);
                        if (res.status === 'success') {
                            alert(res.message);
                            $('#addTeacherForm')[0].reset();
                            $('#staticBackdrop').modal('hide');
                            getData();
                        } else {
                            alert('Error: ' + res.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('Error: ' + error);
                    }
                });
            });
        });
    </script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>