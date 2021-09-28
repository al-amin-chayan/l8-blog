<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest as Request;
use App\Models\Tag;
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
        $tags = Tag::pluck('name', 'id');

        return view('articles.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $fileName = uniqid() . '.' . $request->image->extension();
                $imagePath = $request->image->storeAs('public/images/articles', $fileName);
            }

            $article = auth()->user()->articles()->create(
                $request->only(['title', 'details', 'is_published']) + [
                    'image' => $imagePath
                ]
            );

            $article->tags()->attach($request->tag_id);
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
        $tags = Tag::pluck('name', 'id');

        $tag_ids = $article->tags()->pluck('id')->toArray();
        return view('articles.edit', compact('tags', 'tag_ids', 'article'));
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

            $article->tags()->sync($request->tag_id);

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

            /*if ($article->image && Storage::exists($article->image)) {
                Storage::delete($article->image);
            }*/

            $article->delete();
            return redirect()->back()->withSuccess(__('common.created', ['title' => $title]));
        } catch (\Exception $exception) {
            return redirect()->back()->withError(
                $exception->getMessage()
            );
        }
    }

    /**
     * Display a listing of the deleted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $this->authorize('trashed-articles');
        $articles = Article::with('user')->onlyTrashed()->latest()->paginate(10);
        return view('articles.trashed', compact('articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function restore(\Illuminate\Http\Request $request, $articleId)
    {
        $article = Article::withTrashed()->findOrFail($articleId);
        $this->authorize('restore', $article);

        try {
            $article->restore();

            return redirect()->back()->withSuccess(
                __('common.restored', ['title' => $article->title])
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
    public function erase($articleId)
    {
        $article = Article::withTrashed()->findOrFail($articleId);
        $this->authorize('forceDelete', $article);

        try {
            $title = $article->title;

            if ($article->image && Storage::exists($article->image)) {
                Storage::delete($article->image);
            }

            $article->forceDelete();
            return redirect()->back()->withSuccess(__('common.erased', ['title' => $title]));
        } catch (\Exception $exception) {
            return redirect()->back()->withError(
                $exception->getMessage()
            );
        }
    }
}
