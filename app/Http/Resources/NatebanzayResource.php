<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class NatebanzayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = auth()->user();
        $like = null;
        $isLiked = false;
        $totalLikes = 0;

        if ($user) {
            $like = $user->natebanzayLikes()
                ->where('natebanzay_id', $this->id)
                ->first();
            $isLiked = $like ? true: false;
        }

        // Get total active likes count using the model's relationship
        $totalLikes = $this->resource->likes()
            ->where('like', true)
            ->count();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'address' => $this->address,
            'phone' => $this->phone,
            'note' => $this->note,
            'user' => $this->user,
            'item' => $this->item,
            'photos' => $this->photos,
            'status' => $this->status,
            'comment_count' => $this->comments->count(),
            'like_count' => $this->likes->count(),
            'view_count' => $this->views->count(),
            'like' => $this->likes->pluck('user_id')->toArray(),
            'view' => $this->views->where('natebanzay_id', $this->id)->first(),
            'requested_count' => $this->natebanzayRequests->count(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
