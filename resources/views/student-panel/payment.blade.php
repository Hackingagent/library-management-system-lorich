@extends("layouts.student")
@section("content")

<div id="wrapper-admin">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="container">
        <div class="row">
            @if (session('message'))
                <div class="badge badge-info" style="height: 40px">
                    <p style="font-size: 30px">{{session('message')}}</p>
                </div>

            @endif


            <div class="offset-md-4 col-md-4">
                <div class="logo border border-danger">
                    <img src="{{ asset('images/library.png') }}" alt="">
                </div>
                <form class="yourform" action="{{ route('student.payment.perform') }}" method="post">
                    @csrf
                    <h3 class="heading">Library Payment</h3>
                    <div class="form-group">
                        <label>Matricule</label>
                        <input type="text" name="username" class="form-control" value="{{ Auth::guard('student')->user()->matricule }}" readonly
                            required>
                    </div>
                    <div class="form-group">
                        <label>Momo Number</label>
                        <input type="number" name="number" class="form-control" value="" required>
                    </div>
                    <br>
                    <input type="submit" name="Pay" class="btn btn-danger" value="Pay" />
                </form>
                @error('number')
                    <div class='alert alert-danger'>{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

@endsection