@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card shadow" style="border-radius: 8px;">
                <div class="card-header text-center" style="background-color: #e9ecef; border-bottom: none; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                    <h2><i class="fas fa-sign-in-alt"></i> Login</h2>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-link">Forgot Your Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
@endsection
