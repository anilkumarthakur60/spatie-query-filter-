<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\SubcategoryResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\UserResource;
use App\Models\Brand;
use App\Models\Post;
use App\Models\Subcategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function posts()
    {
        $products = Post::withFilters(
            request()->input('subcategories', []),
            request()->input('tags', []),
            request()->input('users', []),
            request()->input('brands', []),
        )->with(['user', 'tag', 'subcategory', 'brand'])->get();

        return PostResource::collection($products);
    }


    public function subCategories()
    {
        $categories = Subcategory::withCount(['posts' => function ($query) {
            $query->withFilters(
                request()->input('subcategories', []),
                request()->input('tags', []),
                request()->input('users', []),
                request()->input('brands', [])
            );
        }])
            ->get();
        return SubcategoryResource::collection($categories);
    }


    public function  users()
    {




        $manufacturers = User::withCount(['posts' => function ($query) {
            $query->withFilters(
                request()->input('subcategories', []),
                request()->input('tags', []),
                request()->input('users', []),
                request()->input('brands', [])
            );
        }])
            ->get();


        return UserResource::collection($manufacturers);
    }
    public function  brands()
    {
        $manufacturers = Brand::withCount(['posts' => function ($query) {
            $query->withFilters(
                request()->input('subcategories', []),
                request()->input('tags', []),
                request()->input('users', []),
                request()->input('brands', [])
            );
        }])
            ->get();
        return UserResource::collection($manufacturers);
    }
    public function  tags()
    {
        $manufacturers = Tag::withCount(['posts' => function ($query) {
            $query->withFilters(
                request()->input('subcategories', []),
                request()->input('tags', []),
                request()->input('users', []),
                request()->input('brands', [])
            );
        }])
            ->get();
        return TagResource::collection($manufacturers);
    }
}
