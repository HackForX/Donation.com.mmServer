<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaduditharResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category,
            'sub_category' => $this->category->subCategories->where('category_id', $this->category->id)->first(),
            'city' => $this->city,
            'township' => $this->township,
            'user' => $this->user,
            'estimated_amount' => $this->estimated_amount,
            'estimated_time' => $this->estimated_time,
            'estimated_quantity' => $this->estimated_quantity,
            'actual_start_time' => $this->actual_start_time,
            'actual_end_time' => $this->actual_end_time,
            'event_date' => $this->event_date,
            'comment_count' => $this->comments->count(),
            'like_count' => $this->likes->count(),
            'view_count' => $this->views->count(),
            'like' => $this->likes->where('sadudithar_id', $this->id)->first(),
            'view' => $this->views->where('sadudithar_id', $this->id)->first(),
            'is_open' => $this->is_open,
            'is_show' => $this->is_show,
            'address' => $this->address,
            'phone' => $this->phone,
            'image' => $this->image,
            'status' => $this->status,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'), // Formatted created_at date
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'), // Formatted updated_at date
        ];
    }
}
