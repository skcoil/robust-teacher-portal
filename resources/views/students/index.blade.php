<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <title>Students</title>
    <style>
        .modal-dialog {
            max-width: 500px;
        }
        .modal-content {
            border-radius: 8px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 10px;
            border-top: 1px solid #dee2e6;
        }
        .error-message {
            color: red;
            font-size: 0.875rem;
        }
        .profile-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('title', 'Students List')

    @section('content')
    <div class="container mt-5">
     

        <div class="card shadow" style="border-radius: 8px;">
            <div class="card-header text-center" style="background-color: #e9ecef; border-bottom: none; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h2><i class="fas fa-users"></i> Students List</h2>
            </div>
            <div class="card-body p-4">
                <button type="button" class="btn btn-primary mb-3" id="openAddStudentModal"><i class="fas fa-user-plus"></i> Add Student</button>

                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Marks</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="profile-circle">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
                            </td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->subject }}</td>
                            <td>{{ $student->marks }}</td>
                            <td>{{ $student->updated_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <button class="btn btn-info edit-btn" data-id="{{ $student->id }}" data-name="{{ $student->name }}" data-subject="{{ $student->subject }}" data-marks="{{ $student->marks }}"><i class="fas fa-edit"></i> Edit</button>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Student Modal -->
        <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel"><i class="fas fa-plus"></i> Add Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeAddStudentModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addStudentForm" method="POST" action="{{ route('students.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i> Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="subject"><i class="fas fa-book"></i> Subject</label>
                                <input type="text" class="form-control" name="subject" required>
                            </div>
                            <div class="form-group">
                                <label for="marks"><i class="fas fa-percentage"></i> Marks</label>
                                <input type="number" class="form-control" name="marks" id="addMarks" required max="100">
                                <div id="addMarksError" class="error-message"></div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Student Modal -->
        <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStudentModalLabel"><i class="fas fa-edit"></i> Edit Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeEditStudentModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editStudentForm" method="POST" action="{{ route('students.update', 0) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="editStudentId">
                            <div class="form-group">
                                <label for="editName"><i class="fas fa-user-edit"></i> Name</label>
                                <input type="text" class="form-control" name="name" id="editName" required>
                            </div>
                            <div class="form-group">
                                <label for="editSubject"><i class="fas fa-book-open"></i> Subject</label>
                                <input type="text" class="form-control" name="subject" id="editSubject" required>
                            </div>
                            <div class="form-group">
                                <label for="editMarks"><i class="fas fa-percent"></i> Marks</label>
                                <input type="number" class="form-control" name="marks" id="editMarks" required max="100">
                                <div id="editMarksError" class="error-message"></div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addStudentModal = document.getElementById('addStudentModal');
            var editStudentModal = document.getElementById('editStudentModal');

            // Open Add Student Modal
            document.getElementById('openAddStudentModal').addEventListener('click', function() {
                addStudentModal.classList.add('show');
                addStudentModal.style.display = 'block';
                addStudentModal.setAttribute('aria-hidden', 'false');
                addStudentModal.setAttribute('aria-modal', 'true');
                document.body.classList.add('modal-open');
            });

            // Close Add Student Modal
            document.getElementById('closeAddStudentModal').addEventListener('click', function() {
                addStudentModal.classList.remove('show');
                addStudentModal.style.display = 'none';
                addStudentModal.setAttribute('aria-hidden', 'true');
                addStudentModal.removeAttribute('aria-modal');
                document.body.classList.remove('modal-open');
            });

            // Open Edit Student Modal
            document.querySelectorAll('.edit-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    var name = this.getAttribute('data-name');
                    var subject = this.getAttribute('data-subject');
                    var marks = this.getAttribute('data-marks');

                    document.getElementById('editStudentId').value = id;
                    document.getElementById('editName').value = name;
                    document.getElementById('editSubject').value = subject;
                    document.getElementById('editMarks').value = marks;

                    document.getElementById('editStudentForm').action = '/students/' + id;

                    editStudentModal.classList.add('show');
                    editStudentModal.style.display = 'block';
                    editStudentModal.setAttribute('aria-hidden', 'false');
                    editStudentModal.setAttribute('aria-modal', 'true');
                    document.body.classList.add('modal-open');
                });
            });

            // Close Edit Student Modal
            document.getElementById('closeEditStudentModal').addEventListener('click', function() {
                editStudentModal.classList.remove('show');
                editStudentModal.style.display = 'none';
                editStudentModal.setAttribute('aria-hidden', 'true');
                editStudentModal.removeAttribute('aria-modal');
                document.body.classList.remove('modal-open');
            });

            // Add Student Form validation
            document.getElementById('addMarks').addEventListener('input', function() {
                var addMarksError = document.getElementById('addMarksError');
                if (this.value < 0 || this.value > 100) {
                    addMarksError.textContent = 'Marks should be between 0 and 100.';
                    this.classList.add('is-invalid');
                } else {
                    addMarksError.textContent = '';
                    this.classList.remove('is-invalid');
                }
            });

            // Edit Student Form validation
            document.getElementById('editMarks').addEventListener('input', function() {
                var editMarksError = document.getElementById('editMarksError');
                if (this.value < 0 || this.value > 100) {
                    editMarksError.textContent = 'Marks should be between 0 and 100.';
                    this.classList.add('is-invalid');
                } else {
                    editMarksError.textContent = '';
                    this.classList.remove('is-invalid');
                }
            });
        });
    </script>
    @endsection
</body>
</html>
