@extends('admin.master.adminMaster')

@section('main-content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <h2 class="mb-4">Create Blog</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Create Blog</li>
            </ol>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Create Blog</h3>
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
                            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="content" name="content" rows="6" placeholder="Content" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="featured_image" class="form-label">Featured Image</label>
                                    <input type="file" class="form-control" id="featured_image" name="featured_image">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
