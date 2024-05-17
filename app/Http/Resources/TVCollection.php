<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TVCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'poster' => $this->poster,
            'cover' => $this->cover,
            'year' => $this->year,
            'place' => $this->place,
            'gener' => $this->gener,
            'mortabit_id' => $this->mortabit_id,
            'whereistartcomics' => $this->whereistartcomics,
            'age' => $this->age,
            'story' => $this->story,
            'tmdb_id' => $this->tmdb_id,
            'statu' => $this->statu,
        ];
    }
}
