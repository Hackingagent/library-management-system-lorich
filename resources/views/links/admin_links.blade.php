@extends("layouts.app")
@section("content")
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2 class="admin-heading">Manage External Links</h2>
                </div>
                <div class="col-md-2">
                    <a class="add-new" href="{{ route("links.add_link") }}">Add Link</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="content-table">
                        <thead>
                            <th>S.No</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach ($links as $link)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$link->title}}</td>
                                    <td><a href="{{ $link->url }}" target="_blank">{{$link->url}}</a></td>
                                    <td>{{ $link->type }}</td>
                                    <td>{{ $link->description }}</td>
                                    <td class="edit"><a href="{{ route('links.edit', $link) }}" class="btn btn-success">Edit</a></td>
                                    <td class="delete">
                                        <form action="{{ route('links.destroy',$link->id ) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this link?');">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <tr>
                                <td>2</td>
                                <td>Sample Journal Article</td>
                                <td><a href="http://journal.example.com/article1"
                                        target="_blank">http://journal.example.com/article1</a></td>
                                <td>Journal</td>
                                <td class="edit"><a href="#" class="btn btn-success">Edit</a></td>
                                <td class="delete">
                                    <form action="#" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this link?');">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection