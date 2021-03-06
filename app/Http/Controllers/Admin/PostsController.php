<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use App\Tagging as Tag;
use Illuminate\Http\Request;
use Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $posts = Post::where('title', 'LIKE', "%$keyword%")
				->orWhere('slug', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->orWhere('content', 'LIKE', "%$keyword%")
				->orWhere('published_at', 'LIKE', "%$keyword%")
				->orWhere('publish', 'LIKE', "%$keyword%")
				->orWhere('thumbnails', 'LIKE', "%$keyword%")
				->orWhere('views', 'LIKE', "%$keyword%")
        ->paginate($perPage);
        } else {
            $posts = Post::paginate($perPage);
        }

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tag=Tag::pluck('title','id');
        return view('admin.posts.create',compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
  			'title' => 'required',
  			'description' => 'required',
  			'content' => 'required',
  			'published_at' => 'required',
  			'publish' => 'required'
  		]);
        $requestData = $request->all();

        $post = New Post($requestData);
        $post->save();
        //Post::create($requestData);
        $post->CreateInputTag()->attach($request->input('tag'));

        Session::flash('flash_message', 'Post added!');

        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->addclick();

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $tag=Tag::pluck('title','id');
        return view('admin.posts.edit', compact('post','tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
			'title' => 'required',
			'description' => 'required',
			'content' => 'required',
			'published_at' => 'required',
			'publish' => 'required'
		]);
        $requestData = $request->all();

        $post = Post::findOrFail($id);
        $post->update($requestData);
        $post->CreateInputTag()->sync($request->input('tag'));
        Session::flash('flash_message', 'Post updated!');

        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Post::destroy($id);

        Session::flash('flash_message', 'Post deleted!');

        return redirect('admin/posts');
    }
}
