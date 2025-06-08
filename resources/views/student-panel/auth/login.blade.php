@extends('layouts.guest')
@section('content')

    <div id="wrapper-admin">
        <div class="container">
            <div class="row">
                <div class="offset-md-4 col-md-4">
                    <div class="logo border border-danger">
                        <img src="{{ asset('images/library.png') }}" alt="">
                    </div>
                    <form class="yourform" action="{{ route('student.login.perform') }}" method="post">
                        @csrf
                        <h3 class="heading">Student Login</h3>
                        <div class="form-group">
                            <label>Matriculation Number</label>
                            <input type="text" name="matricule" class="form-control" value="{{ old('matricule') }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-danger" value="login" />

                        <p>Don't Have an Account <a href="{{ route('student.signup') }}">Signup</a></p>
                    </form>
                    @error('matricule')
                        <div class='alert alert-danger'>{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
@endsection
