<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\TagRequest as Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(auth()->user()->cannot('create', Tag::class), 403);

        $tags = Tag::withCount('articles')->latest()->paginate(10);
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(auth()->user()->cannot('create', Tag::class), 403);

        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tag::class);

        try {
            Tag::create($request->all());

            return redirect()->route('tags.index')->withSuccess(
                __('common.created', ['title' => $request->name])
            );
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withError(
                $e->getMessage()
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        abort_unless(auth()->user()->can('update', $tag), 403);

        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TagRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $this->authorize('update', $tag);

        try {
            $tag->update($request->all());

            return redirect()->route('tags.index')->withSuccess(
                __('common.updated', ['title' => $tag->title])
            );
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withError(
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);

        try {
            $title = $tag->name;

            $tag->delete();
            return redirect()->back()->withSuccess(__('common.created', ['title' => $title]));
        } catch (\Exception $exception) {
            return redirect()->back()->withError(
                $exception->getMessage()
            );
        }
    }
}
