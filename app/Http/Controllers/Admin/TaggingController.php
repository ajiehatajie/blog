<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tagging;
use Illuminate\Http\Request;
use Session;

class TaggingController extends Controller
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
            $tagging = Tagging::where('title', 'LIKE', "%$keyword%")
				->orWhere('slug', 'LIKE', "%$keyword%")
				->orWhere('desc', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $tagging = Tagging::paginate($perPage);
        }

        return view('admin.tagging.index', compact('tagging'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.tagging.create');
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
			'desc' => 'required'
		]);
        $requestData = $request->all();

        Tagging::create($requestData);

        Session::flash('flash_message', 'Tagging added!');

        return redirect('admin/tagging');
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
        $tagging = Tagging::findOrFail($id);

        return view('admin.tagging.show', compact('tagging'));
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
        $tagging = Tagging::findOrFail($id);

        return view('admin.tagging.edit', compact('tagging'));
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
			'desc' => 'required'
		]);
        $requestData = $request->all();

        $tagging = Tagging::findOrFail($id);
        $tagging->update($requestData);

        Session::flash('flash_message', 'Tagging updated!');

        return redirect('admin/tagging');
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
        Tagging::destroy($id);

        Session::flash('flash_message', 'Tagging deleted!');

        return redirect('admin/tagging');
    }
}
