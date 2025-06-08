@extends('layouts.guest')
@section('content')

    <div id="wrapper-admin">
        <div class="container">
            <div class="row">
                <div class="offset-md-4 col-md-4">
                    <div class="logo border border-danger">
                        <img src="{{ asset('images/library.png') }}" alt="">
                    </div>
                    <form class="yourform" action="{{ route('student.signup.perform') }}" method="post">
                        @csrf
                        <h3 class="heading">Student SignUp</h3>
                        <div class="form-group">
                            <label>Matriculation Number</label>
                            <input type="text" class="form-control" placeholder="Student Matricule" name="matricule"
                                value="{{ old('matricule') }}" required>
                            @error('matricule')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Student Name</label>
                            <input type="text" class="form-control" placeholder="Student Name" name="name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                            </select>
                            @error('gender')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="phone" class="form-control" placeholder="Phone" name="phone"
                                value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="********" class="form-control" value="" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" placeholder="********" name="password_confirmation" class="form-control" value="" required>
                        </div>
                        <input type="submit" name="SignUp" class="btn btn-danger" value="SignUp" />

                        <p>Already Have an Account <a href="{{ route('student.login') }}">login</a></p>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
