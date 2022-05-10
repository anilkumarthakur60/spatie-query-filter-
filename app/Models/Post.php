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
}