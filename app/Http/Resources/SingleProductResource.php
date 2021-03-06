<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'stock' => $this->stock == 0? 'Out of Stock':$this->stock,
            'discount' =>$this->discount,
            'totalPrice' => round((1 - $this->discount/100) * $this->price,2),
            // 17/100 = 0.17
            // 1-0.17 = ans * 300
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2):'No Rating Yet',
            'href' =>[
                'reviews' =>route('review.index', $this->id)
            ]
        ];
    }
}
