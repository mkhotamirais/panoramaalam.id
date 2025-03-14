<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blogcat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // new Middleware('auth', only: ['store']),
            new Middleware('auth', except: ['show']),
            // new Middleware('auth'),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(6);
        return view('dashboard.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blogCategories = Blogcat::all();
        return view('dashboard.blog.create', compact('blogCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $fields = $request->validate([
            'title' => 'required|max:255|unique:blogs',
            'content' => 'required',
            'blogcat_id' => 'nullable|integer|exists:blogcats,id',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $slug = Str::slug($fields['title']);

        // Upload image if file exist
        $path = null;
        if ($request->hasFile('banner')) {
            $path = Storage::disk('public')->put('blogs-images', $request->banner);
        }

        Auth::user()->blogs()->create([...$fields, 'slug' => $slug, 'banner' => $path]);

        return redirect('/blogs')->with('success', 'Blog created successfully');
    }

    public function show(Blog $blog)
    {
        $latestThreeBlogs = Blog::latest()->where('id', '!=', $blog->id)->take(4)->get();
        return view('pages.blog.show', compact('blog', 'latestThreeBlogs'));
    }

    public function edit(Blog $blog)
    {
        $blogcats = Blogcat::all();
        return view('dashboard.blog.edit', compact('blog', 'blogcats'));
    }

    public function update(Request $request, blog $blog)
    {
        $fields = $request->validate([
            // 'title' => ['required', 'max:255', Rule::unique('blogs')->ignore($blog->id)],
            'title' => "required|max:255|unique:blogs,title,$blog->id",
            'content' => 'required',
            'blogcat_id' => 'nullable|integer|exists:blogcats,id',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $slug = Str::slug($fields['title']);

        $path = $blog->banner ?? null;
        if ($request->hasFile('banner')) {
            if ($blog->banner) {
                Storage::disk('public')->delete($blog->banner);
            }
            $path = Storage::disk('public')->put('blogs-images', $request->banner);
        }
        $blog->update([...$fields, 'slug' => $slug, 'banner' => $path]);

        return redirect('/blogs')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->banner) {
            Storage::disk('public')->delete($blog->banner);
        }

        $blog->delete();

        return back()->with('delete', 'Blog deleted successfully');
    }
}
