<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest as Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = auth()->user()->articles()->latest()->paginate(5);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $fileName = uniqid() . '.' . $request->image->extension();
                $imagePath = $request->image->storeAs('public/images/articles', $fileName);
            }

            auth()->user()->articles()->create(
                $request->only(['title', 'details', 'is_published']) + [
                    'image' => $imagePath
                ]
            );

            return redirect()->route('articles.index')->withSuccess(
                __('common.created', ['title' => $request->title])
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
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        try {
            $imagePath = $article->image;
            if ($request->hasFile('image')) {

                if ($article->image && Storage::exists($article->image)) {
                    Storage::delete($article->image);
                }

                $fileName = uniqid() . '.' . $request->image->extension();
                $imagePath = $request->image->storeAs('public/images/articles', $fileName);
            }

            $article->update(
                $request->only(['title', 'details', 'is_published']) + [
                    'image' => $imagePath
                ]
            );

            return redirect()->route('articles.index')->withSuccess(
                __('common.updated', ['title' => $article->title])
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
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        try {
            $title = $article->title;

            if ($article->image && Storage::exists($article->image)) {
                Storage::delete($article->image);
            }

            $article->delete();
            return redirect()->back()->withSuccess(__('common.created', ['title' => $title]));
        } catch (\Exception $exception) {
            return redirect()->back()->withError(
                $exception->getMessage()
            );
        }
    }
}