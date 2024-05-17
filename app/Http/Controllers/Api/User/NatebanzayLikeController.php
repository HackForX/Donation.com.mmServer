<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\NatebanzayLike;
use Illuminate\Http\Request;

class NatebanzayLikeController extends Controller
{
    public function index()
    {
        $saduditharLikes = NatebanzayLike::all();
        return response()->json([
            'lieks' => $saduditharLikes
        ]);
    }
    public function store(Request $request, string $id)
    {
        $user = auth()->user();

        // Assuming your Sadudithar model has a 'likes' relationship method
        $like = $user->natebanzayLikes()->where('natebanzay_id', $id)->first();

        if ($like) {
            $like->delete();
            $message = "Disliked";
        } else {
            $like =  NatebanzayLike::create([
                'user_id' => $user->id,
                'natebanzay_id' => $id,
                'like' => true,
            ]);
            $message = "Liked";
        }
        return ResponseHelper::success($like, $message);
    }
}
