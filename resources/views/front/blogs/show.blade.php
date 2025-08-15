@extends('front.master.master-nolayout')


@section('title', $blog->title)

@section('main-content')
    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <!-- Blog Card -->
                    <div class="card border-0 shadow-sm">
                        <!-- Blog Image -->
                        @if(!empty($blog->featured_image))
                            @if(file_exists(public_path($blog->featured_image)))
                                <img src="{{ asset($blog->featured_image) }}" class="card-img-top img-fluid"
                                    style="height: 350px; object-fit: cover;" alt="{{ $blog->title }}">
                            @else
                                <img src="{{ asset('front/images/wideimg.jpeg') }}" class="card-img-top img-fluid"
                                    style="height: 350px; object-fit: cover;" alt="Default Blog Image">
                            @endif
                        @else
                            <img src="{{ asset('front/images/wideimg.jpeg') }}" class="card-img-top img-fluid"
                                style="height: 350px; object-fit: cover;" alt="Default Blog Image">
                        @endif


                        <div class="card-body">
                            <!-- Title -->
                            <h2 class="card-title">{{ $blog->title }}</h2>
                            <!-- Date -->
                            <p class="text-muted small mb-3">
                                <i class="far fa-calendar-alt"></i>
                                {{ $blog->published_at->format('F d, Y') }}
                            </p>
                            <!-- Blog Content -->
                            <div class="card-text">
                                {!! $blog->content !!}
                            </div>
                            <!-- Back Button -->
                            <div class="mt-4">
                                <a href="{{ route('blogs.index') }}" class="btn btn-secondary">
                                    ← Back to Blogs
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Blog Card -->
                </div>
            </div>
        </div>
    </section>
@endsection