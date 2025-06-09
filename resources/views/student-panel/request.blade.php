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


<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="admin-heading">All Request</h2>
            </div>
            <div class="offset-md-6 col-md-2">
                {{-- <a class="add-new" href="{{ route('student.create') }}">Add Student</a> --}}
            </div>
        </div>
    <div class="row">
        <div class="col-md-12">
            <div class="message"></div>
            <table class="content-table">
                <thead>
                    <th>S.N</th>
                    <th>Student Matricule</th>
                    <th>Student Name</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    {{-- <th>phone</th>
                    <th>Payment</th> --}}
                    <th>Delete</th>
                    {{-- <th>Delete</th> --}}
                </thead>
                <tbody>
                    @forelse (Auth::guard('student')->user()->request as $request)
                        <tr>
                            <td class="id">{{ $loop->index + 1 }}</td>
                            <td>{{ $request->student->matricule }}</td>
                            <td>{{ $request->student->name }}</td>
                            <td class="text-capitalize">{{ $request->book->name }}</td>
                            <td>{{ $request->book->auther->name }}</td>
                            {{-- <td>{{ $student->phone }}</td> --}}

                            {{-- <td class="view">
                                <button data-sid='{{ $student->id }}>'
                                    class="btn btn-primary view-btn">View</button>
                            </td> --}}
                            {{-- <td class="edit">
                                <a href="{{ route('student.edit', $student) }}>" class="btn btn-success">Edit</a>
                            </td> --}}
                            <td class="delete">
                                <form action="{{ route('admin.request.delete', $request->id) }}" method="post"
                                    class="form-hidden">
                                    @method('DELETE')
                                    <button class="btn btn-danger delete-student">Delete</button>
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No Request Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- {{ $requests->links('vendor/pagination/bootstrap-4') }} --}}
            <div id="modal">
                <div id="modal-form">
                    <table cellpadding="10px" width="100%">

                    </table>
                    <div id="close-btn">X</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
