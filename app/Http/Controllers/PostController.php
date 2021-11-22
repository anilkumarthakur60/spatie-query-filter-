<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $brands = Brand::all();

        $posts = QueryBuilder::for(Post::class)
            ->allowedFilters([
                AllowedFilter::exact('brand', 'brand_id'),
                AllowedFilter::exact('category', 'category_id'),
                AllowedFilter::exact('tag', 'tag_id')
            ])
            ->get();
        $tags = Tag::all();

        return view('filter.index', compact('posts', 'categories', 'tags', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        $brands = Brand::all();
        $tags = Tag::all();

        $posts = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact('brand', 'brand_id'),
                AllowedFilter::exact('category', 'category_id'),
                AllowedFilter::exact('tag', 'tag_id'),
            ])
            ->get();

        // return $posts;
        return view('filter.index', compact('posts', 'categories', 'tags', 'brands'));
        //
    }
    public function filter()
    {
        $categories = Category::all();

        $brands = Brand::all();
        $tags = Tag::all();

        $posts = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact('brand', 'brand_id'),
                AllowedFilter::exact('category', 'category_id'),
                AllowedFilter::exact('tag', 'tag_id'),
            ])
            ->get();


        return view('filter.index', compact('posts', 'categories', 'tags', 'brands'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}