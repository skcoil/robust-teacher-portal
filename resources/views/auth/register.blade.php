@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container" style="min-height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div class="row justify-content-center" style="width: 100%;">
        <div class="col-md-6">
            <div class="card shadow" style="border-radius: 8px;">
                <div class="card-header text-center" style="background-color: #e9ecef; border-bottom: none; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                    <i class="fas fa-user-plus"></i> Register
                </div>
                <div class="card-body p-4">
                    <form id="registration-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                            <span id="name-check"></span>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                </div>
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autocomplete="username">
                            </div>
                            <span id="username-check"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                            <span id="email-check"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                            <div id="password-guidelines" class="mt-2">
                                <p>Password must contain:</p>
                                <ul style="list-style: none; padding: 0;">
                                    <li id="min-characters" class="text-danger">At least 8 characters</li>
                                    <li id="uppercase" class="text-danger">At least one uppercase letter</li>
                                    <li id="lowercase" class="text-danger">At least one lowercase letter</li>
                                    <li id="number" class="text-danger">At least one number</li>
                                    <li id="special-char" class="text-danger">At least one special character</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <span id="password-check"></span>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.footer')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registration-form');

    function validateForm() {
        let isValid = true;

        // Name Validation
        const name = document.getElementById('name').value.trim();
        if (name === '') {
            document.getElementById('name-check').textContent = 'Name is required';
            document.getElementById('name-check').style.color = 'red';
            isValid = false;
        } else {
            document.getElementById('name-check').textContent = '';
        }

        // Username Validation
        const username = document.getElementById('username').value.trim();
        if (username === '') {
            document.getElementById('username-check').textContent = 'Username is required';
            document.getElementById('username-check').style.color = 'red';
            isValid = false;
        }

        // Email Validation
        const email = document.getElementById('email').value.trim();
        if (email === '') {
            document.getElementById('email-check').textContent = 'Email is required';
            document.getElementById('email-check').style.color = 'red';
            isValid = false;
        } else if (!validateEmail(email)) {
            document.getElementById('email-check').textContent = 'Invalid email format';
            document.getElementById('email-check').style.color = 'red';
            isValid = false;
        } else {
            document.getElementById('email-check').textContent = '';
        }

        // Password Validation
        const password = document.getElementById('password').value;
        if (password.length < 8) {
            document.getElementById('min-characters').classList.add('text-danger');
            document.getElementById('min-characters').classList.remove('text-success');
            isValid = false;
        } else {
            document.getElementById('min-characters').classList.add('text-success');
            document.getElementById('min-characters').classList.remove('text-danger');
        }

        // Confirm Password Validation
        const confirmPassword = document.getElementById('password-confirm').value;
        if (password !== confirmPassword) {
            document.getElementById('password-check').textContent = 'Passwords do not match';
            document.getElementById('password-check').style.color = 'red';
            isValid = false;
        } else {
            document.getElementById('password-check').textContent = 'Passwords match';
            document.getElementById('password-check').style.color = 'green';
        }

        return isValid;
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }

    function checkPasswordCriteria() {
        const password = document.getElementById('password').value;
        const minCharacters = document.getElementById('min-characters');
        const uppercase = document.getElementById('uppercase');
        const lowercase = document.getElementById('lowercase');
        const number = document.getElementById('number');
        const specialChar = document.getElementById('special-char');
        
        // Check minimum length
        if (password.length >= 8) {
            minCharacters.classList.remove('text-danger');
            minCharacters.classList.add('text-success');
        } else {
            minCharacters.classList.remove('text-success');
            minCharacters.classList.add('text-danger');
        }

        // Check for uppercase letter
        if (/[A-Z]/.test(password)) {
            uppercase.classList.remove('text-danger');
            uppercase.classList.add('text-success');
        } else {
            uppercase.classList.remove('text-success');
            uppercase.classList.add('text-danger');
        }

        // Check for lowercase letter
        if (/[a-z]/.test(password)) {
            lowercase.classList.remove('text-danger');
            lowercase.classList.add('text-success');
        } else {
            lowercase.classList.remove('text-success');
            lowercase.classList.add('text-danger');
        }

        // Check for number
        if (/\d/.test(password)) {
            number.classList.remove('text-danger');
            number.classList.add('text-success');
        } else {
            number.classList.remove('text-success');
            number.classList.add('text-danger');
        }

        // Check for special character
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            specialChar.classList.remove('text-danger');
            specialChar.classList.add('text-success');
        } else {
            specialChar.classList.remove('text-success');
            specialChar.classList.add('text-danger');
        }
        
        checkPasswordMatch(); // Call this to check if passwords match as well
    }

    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password-confirm').value;
        const passwordCheck = document.getElementById('password-check');
        
        if (password === confirmPassword) {
            passwordCheck.textContent = 'Passwords match';
            passwordCheck.style.color = 'green';
        } else {
            passwordCheck.textContent = 'Passwords do not match';
            passwordCheck.style.color = 'red';
        }
    }

    document.getElementById('username').addEventListener('blur', function() {
        var username = this.value;
        fetch('{{ url('/check-username') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ username: username })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                document.getElementById('username-check').textContent = 'Username already exists';
                document.getElementById('username-check').style.color = 'red';
            } else {
                document.getElementById('username-check').textContent = 'Username is available';
                document.getElementById('username-check').style.color = 'green';
            }
        });
    });

    document.getElementById('email').addEventListener('blur', function() {
        var email = this.value;
        fetch('{{ url('/check-email') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                document.getElementById('email-check').textContent = 'Email already exists';
                document.getElementById('email-check').style.color = 'red';
            } else {
                document.getElementById('email-check').textContent = 'Email is available';
                document.getElementById('email-check').style.color = 'green';
            }
        });
    });

    document.getElementById('password').addEventListener('keyup', checkPasswordCriteria);
    document.getElementById('password-confirm').addEventListener('keyup', checkPasswordMatch);

    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});
</script>
@endsection
