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
        $user = auth()->user();
        $userLike = null;

        if ($user) {
            // Get the user's like for this sadudithar using the relationship
            $userLike = $this->likes()
                ->where('user_id', $user->id)
                ->where('like', true)  // Only get active likes
                ->first();
        }

        // Check if user has an active like
        $isLiked = $userLike !== null;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category,
            'subcategory' => $this->subcategory,
            'type' => $this->type,
            'city' => $this->city,
            'township' => $this->township,
            'description' => $this->description,
            'user' => $this->user,
            'estimated_amount' => $this->estimated_amount,
            'estimated_time' => $this->estimated_time,
            'estimated_quantity' => $this->estimated_quantity,
            'actual_start_time' => $this->actual_start_time,
            'actual_end_time' => $this->actual_end_time,
            'event_date' => $this->event_date,
            'comment_count' => $this->comments->count(),
            'like_count' => $this->likes()->where('like', true)->count(), // Only count active likes
            'view_count' => $this->views->count(),
                        'like' => $this->likes->pluck('user_id')->toArray(),
            'view' => $this->views->where('sadudithar_id', $this->id)->first(),
            'is_open' => $this->is_open,
            'is_show' => $this->is_show,
            'address' => $this->address,
            'phone' => $this->phone,
            'image' => $this->image,
            'status' => $this->status,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
