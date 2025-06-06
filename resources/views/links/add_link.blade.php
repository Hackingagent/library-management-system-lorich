@extends("layouts.app")
@section("content")
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="admin-heading">Add External Link</h2>
                </div>
                <div class="offset-md-7 col-md-2">
                    <a class="add-new" href="{{ route("links.admin_links") }}">All Links</a>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <form class="yourform" action="{{ route("admin.links.store") }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label>Link Title</label>
                            <input type="text" class="form-control @error("title") isinvalid @enderror"
                                placeholder="Enter link title" name="title" value="{{ old("title") }}" required>
                            @error("title")
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Link URL</label>
                            <input type="url" class="form-control @error("url") isinvalid @enderror"
                                placeholder="Enter full URL (e.g., https://example.com)" name="url" value="{{ old("url") }}"
                                required>
                            @error("url")
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Link Type</label>
                            <select name="type" class="form-control @error("type") isinvalid @enderror" required>
                                <option value="">Select Type</option>
                                <option value="site" {{ old("type") == "site" ? "selected" : "" }}>Site</option>
                                <option value="journal" {{ old("type") == "journal" ? "selected" : "" }}>Journal</option>
                                <option value="article" {{ old("type") == "article" ? "selected" : "" }}>Article</option>
                            </select>
                            @error("type")
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="submit" name="save" class="btn btn-danger" value="Save Link" required>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection