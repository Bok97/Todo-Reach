<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $returnCollections = [];
        if (count($this->collection) > 0) {
            $returnCollections = $this->collection->map(function ($todos) {
                return [
                    'todoId' => $todos->id,
                    'text' => $todos->text,
                    'completed' => $todos->completed ? true : false,
                    'active' => $todos->active ? true : false,
                ];
            });
        }
        return $returnCollections;
    }
}
