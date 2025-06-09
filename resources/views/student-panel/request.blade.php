@extends('layouts.student')
@section('content')
    <div id="admin-content" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="admin-heading">Request Book</h2>
                </div>
                <div class="offset-md-7 col-md-2">
                    <a class="add-new" href="{{ route('student.books') }}">Books</a>
                </div>
            </div>
            @if (session('message'))
                <div class="badge badge-info" style="height: 40px">
                    <p style="font-size: 30px">{{session('message')}}</p>
                </div>

            @endif
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <form class="yourform" action="{{ route('student.request.perform', $book->id) }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label>Book Name</label>
                            <input type="text" class="form-control" name="book"
                                value="{{ $book->name}}" readonly required>
                        </div>

                        <div class="form-group">
                            <label>Return days (return before the number of days below)</label>
                            <input type="text" class="form-control" name="book"
                                value="{{ $setting->return_days}} days" readonly required>
                        </div>

                        <div class="form-group">
                            <label>Fine (fine for return after the set number of days)</label>
                            <input type="text" class="form-control" name="book"
                                value="{{ $setting->fine}}" readonly required>
                        </div>
                        <div class="form-group">
                            <label>Collection Day</label>
                            <input type="date" class="form-control" placeholder="Collection Day" name="day"
                                value="{{ old('day') }}" required>
                            @error('day')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="submit" name="Submit" class="btn btn-danger" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
