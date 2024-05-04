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
            'lieks' => $saduditharLikes
        ]);
    }
    public function store(Request $request, string $id)
    {
        $user = auth()->user();

        // Assuming your Sadudithar model has a 'likes' relationship method
        $like = $user->saduditharLikes()->where('sadudithar_id', $id)->first();

        if ($like) {
            $like->delete();
            $message = "Disliked";
        } else {
            $like =  SaduditharLike::create([
                'user_id' => $user->id,
                'sadudithar_id' => $id,
                'like' => true,
            ]);
            $message = "Liked";
        }
        return ResponseHelper::success($like, $message);
    }
}
