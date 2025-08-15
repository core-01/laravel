@extends('admin.master.adminMaster')

@section('main-content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <h2 class="mb-4">Edit Blog</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Blog</li>
            </ol>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Edit Blog</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $blog->title) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                                    <textarea name="content" class="form-control" id="content" rows="6" required>{{ old('content', $blog->content) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="featured_image" class="form-label">Featured Image</label>
                                    @if($blog->featured_image)
                                        <div class="mb-2">
                                            <img src="{{ asset($blog->featured_image) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                                        </div>
                                    @endif
                                    <input type="file" name="featured_image" class="form-control" id="featured_image">
                                    <small class="text-muted">Leave empty to keep current image.</small>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="draft" {{ $blog->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ $blog->status === 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-primary">Update Blog</button>
                                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Manual footer --}}
            <footer class="py-4 bg-light mt-4">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div>Copyright &copy; LetsFin Admin. All Rights Reserved</div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
</div>
@endsection
