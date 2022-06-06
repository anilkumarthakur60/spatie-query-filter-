<?php

namespace App\Http\Controllers;

use App\Filters\FiltersBlogs;
use App\Filters\FiltersCategories;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
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

        $posts = QueryBuilder::for(Post::class)->whereHas('user')
            ->allowedFilters([
                AllowedFilter::exact('brand', 'brand.slug'),
                AllowedFilter::exact('category', 'subcategory.category.slug'),
                AllowedFilter::exact('tag', 'tag.slug')
            ])
            ->allowedSorts('name')
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
    public function filter(Request $request)
    {
        $categories = Category::all();

        $brands = Brand::all();
        $tags = Tag::all();

        // $posts=Product


        $posts = QueryBuilder::for(Post::class)
            ->allowedFilters([
                // AllowedFilter::exact('brand', 'brand_id'),
                // AllowedFilter::exact('category', 'category_id'),
                AllowedFilter::exact('tag', 'tag_id'),
                AllowedFilter::custom('category', new FiltersCategories),
                AllowedFilter::custom('brand', new FiltersBlogs()),
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

    public function uploadFile()
    {
        return view('post.upload_file');
    }
    public function uploadVideo(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive();
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

            $disk = Storage::disk(config('filesystems.public'));
            $path = $disk->putFileAs('public', $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());
            return [
                'path' => asset('storage/' . $path),
                'filename' => $fileName
            ];
        }
    }
}
