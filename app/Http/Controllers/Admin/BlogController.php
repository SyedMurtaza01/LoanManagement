<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('admin.blogs.index');
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:1,2',
        ]);

        if ($request->type == '1') {
            $request->validate([
                'youtube_link' => 'required|url',
            ]);
        }
        if ($request->type == '2') {
            $request->validate([
                'description' => 'required|string|max:1000',
            ]);
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->type = $request->type;
        $blog->description = $request->description;
        $blog->link = $request->youtube_link;
        // $blog->latest = ($request->latest ? '1' : '0');
        if($request->file('image'))
        {
            $img = $request->file(key: 'image');
            $ext = rand().".".$img->getClientOriginalName();
            $img->move("blog/image/",$ext);
            $blog->image = $ext;
        }
        $blog->save();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:1,2',
        ]);

        if ($request->type == '1') {
            $request->validate([
                'youtube_link' => 'required|url',
            ]);
        }

        if ($request->type == '2') {
            $request->validate([
                'description' => 'required|string|max:1000',
            ]);
        }

        $blog->title = $request->title;

        if (!empty($request->input('slug'))) {
            $blog->slug = Str::slug($request->input('slug'));
        } else {
            $blog->slug = Str::slug($request->input('title'));
        }

        $blog->type = $request->type;

        if ($request->type == '2') {
            $blog->description = $request->description;
            $blog->link = null;
        } else {
            $blog->link = $request->youtube_link;
            $blog->description = null;
        }

        if ($request->file('image')) {
            if ($blog->image) {
                unlink(public_path("blog/image/" . $blog->image));
            }

            $img = $request->file('image');
            $ext = rand() . "." . $img->getClientOriginalName();
            $img->move("blog/image/", $ext);
            $blog->image = $ext;
        }

        $blog->save();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }


    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        $image = public_path('blog/image/').$blog->image;
        if(file_exists($image)){
            unlink($image);
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');

    }
}
