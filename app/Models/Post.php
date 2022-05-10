<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['name', 'slug', 'subcategory_id', 'tag_id', 'brand_id'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithFilters(
        $query,
        $subcategories,
        $tags,
        $users,
        $brands,
    ) {
        return $query->when(count($subcategories), function ($query) use ($subcategories) {
            $query->whereIn('subcategory_id', $subcategories);
        })
            ->when(count($tags), function ($query) use ($tags) {
                $query->whereIn('tag_id', $tags);
            })
            ->when(count($brands), function ($query) use ($brands) {
                $query->whereIn('brand_id', $brands);
            })
            ->when(count($users), function ($query) use ($users) {
                $query->whereIn('brand_id', $users);
            });
    }
}
