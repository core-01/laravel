<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogAdminController extends Controller
{
    /**
     * Show list of blogs
     */
    public function index()
    {
        \Log::info('BlogAdminController@index called');
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store blog
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $imagePath = null;

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('front/images/blogstorage'), $filename);
            $imagePath = 'front/images/blogstorage/' . $filename;
        }

        Blog::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')) . '-' . uniqid(),
            'content' => $request->input('content'),
            'featured_image' => $imagePath,
            'status' => $request->input('status'),
            'published_at' => $request->input('status') === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Edit blog
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update blog
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $imagePath = $blog->featured_image;

        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blog->featured_image && file_exists(public_path($blog->featured_image))) {
                unlink(public_path($blog->featured_image));
            }

            $image = $request->file('featured_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('front/images/blogstorage'), $filename);
            $imagePath = 'front/images/blogstorage/' . $filename;
        }

        $blog->update([
            'title' => $request->input('title'),
            'slug' => ($blog->title !== $request->input('title'))
                ? Str::slug($request->input('title')) . '-' . uniqid()
                : $blog->slug,
            'content' => $request->input('content'),
            'featured_image' => $imagePath,
            'status' => $request->input('status'),
            'published_at' => $request->input('status') === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Delete blog
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->featured_image && file_exists(public_path($blog->featured_image))) {
            unlink(public_path($blog->featured_image));
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
