<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'content' => $this->content,
            'slug' => $this->slug,
            'username' => $this->user->name,
            'tagname' => $this->tag->name,
            'brandname' => $this->brand->name,
            'subcategorydname' => $this->subcategory->name,
        ];
    }
}
