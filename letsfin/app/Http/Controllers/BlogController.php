<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    /**
     * Show list of blogs
     */
    public function index()
    {
        // Fetch all blogs
        $blogs = DB::table('blogs')
            ->select('id', 'title', 'slug', 'content', 'featured_image', 'published_at')
            ->orderBy('published_at', 'desc')
            ->get()
            ->map(function ($blog) {
                $blog->published_at = $blog->published_at
                    ? Carbon::parse($blog->published_at)
                    : now();
                return $blog;
            });

        return view('front.blogs.index', compact('blogs'));
    }

    /**
     * Show single blog by slug
     */
    public function show($slug)
    {
        // Fetch single blog
        $blog = DB::table('blogs')
            ->where('slug', $slug)
            ->select('id', 'title', 'slug', 'content', 'featured_image', 'published_at')
            ->first();

        if ($blog) {
            $blog->published_at = $blog->published_at
                ? Carbon::parse($blog->published_at)
                : now();

            return view('front.blogs.show', compact('blog'));
        }

        abort(404, 'Blog not found');
    }
}
