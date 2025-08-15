@extends('front.master.master')

@section('main-content')
    <!-- Blog Banner Section -->
    <section class="page-banner">
        <div class="anim-icons">
            <span class="icon shape-2 wow fadeInRight animated" data-wow-delay="800ms">
                <img src="{{ asset('front/images/banner-shape-1.png') }}" alt="">
            </span>
        </div>
        <div class="image-layer lazy-image">
            <div class="bottom-rotten-curve alternate"></div>
            <div class="auto-container">
                <h1>Industry Insights & Updates</h1>
                <h5 class="tagline" data-aos="fade-up" data-aos-delay="100">
                    Stay informed with the latest trends, tips, and expert opinions in the B2B marketplace.
                </h5>
            </div>
        </div>
    </section>

    <!-- Blog Intro Section -->
    <section class="about-bg-2 pt-4 pb-4">
        <div class="container">
            <div class="row m-text-c">
                <div class="col-md-6 col-lg-4 v-center">
                    <img src="{{ asset('front/images/common/featured-blog.png') }}" alt="Blogs Feature Image"
                        class="img-fluid">
                </div>
                <div class="col-md-6 col-lg-8 v-center">
                    <div class="about-company">
                        <h2 class="mb20" data-aos="fade-up" data-aos-delay="100">
                            Explore <em>Latest Blogs </em><br />
                            <span class="fw3">Insights that help you grow</span>
                        </h2>
                        <p data-aos="fade-up" data-aos-delay="300">
                            Get weekly blogs covering finance, B2B industry updates, tips, and market insights
                            to help you make better business decisions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog List Section -->
    <section class="step-bg pt50 pb80">
        <div class="container">
            <div class="row">
                @if($blogs->count())
                    @foreach($blogs as $blog)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 shadow-sm border-0">
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


                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $blog->title }}</h5>
                                    <p class="text-muted small mb-2">
                                        <i class="far fa-calendar-alt"></i>
                                        {{ $blog->published_at ? $blog->published_at->format('M d, Y') : '' }}
                                    </p>
                                    <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-primary mt-auto">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">No blog posts available at the moment. Please check back later.</p>
                @endif
            </div>
        </div>
    </section>

    <div class="back-to-top" title="Go to top">
        <img src="{{ asset('front/images/gototop-btn.png') }}" alt="Go to top btn">
    </div>
@endsection