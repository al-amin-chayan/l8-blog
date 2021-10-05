<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\FeaturedArticle;
use App\Http\Requests\FeaturedArticleRequest as Request;

class FeaturedArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featured_articles = FeaturedArticle::latest()->paginate(10);
        return view('featured-articles.index', compact('featured_articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::pluck('title', 'id');

        return view('featured-articles.create', compact('articles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FeaturedArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            FeaturedArticle::create($request->all());

            return redirect()->route('featured-articles.index')->withSuccess(
                __('common.created', ['title' => $request->title])
            );
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withError(
                $e->getMessage()
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeaturedArticle  $featuredArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(FeaturedArticle $featuredArticle)
    {
        $articles = Article::pluck('title', 'id');
        return view('featured-articles.edit', compact('articles', 'featuredArticle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeaturedArticle  $featuredArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeaturedArticle $featuredArticle)
    {
        try {
            $featuredArticle->update($request->all());

            return redirect()->route('featured-articles.index')->withSuccess(
                __('common.updated', ['title' => $featuredArticle->title])
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
     * @param  \App\Models\FeaturedArticle  $featuredArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeaturedArticle $featuredArticle)
    {
        try {
            $title = $featuredArticle->title;

            $featuredArticle->delete();
            return redirect()->back()->withSuccess(__('common.created', ['title' => $title]));
        } catch (\Exception $exception) {
            return redirect()->back()->withError(
                $exception->getMessage()
            );
        }
    }
}
