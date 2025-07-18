<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Sadudithar;
use App\Models\SaduditharLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class   SaduditharLikeController extends Controller
{
    public function index()
    {
        $saduditharLikes = SaduditharLike::all();
        return response()->json([
            'likes' => $saduditharLikes
        ]);
    }
    public function store(Request $request, string $id)
    {
        $user = auth()->user();

        // Check if user has already liked this sadudithar
        $like = $user->saduditharLikes()
            ->where('sadudithar_id', $id)
            ->first();

        if ($like) {
            $like->delete();
            $message = "Disliked";
        }else {
            // Create new like
            $like = SaduditharLike::create([
                'user_id' => $user->id,
                'sadudithar_id' => $id,
                'like' => true,
            ]);
            $message = "Liked";
        }

        // Get total active likes count
        $totalLikes = SaduditharLike::where('sadudithar_id', $id)
            ->where('like', true)
            ->count();

        return ResponseHelper::success([
            'like' => $like,
            'is_liked' => $like->like,
            'total_likes' => $totalLikes,
            'sadudithar_id' => $id
        ], $message);
    }
}
