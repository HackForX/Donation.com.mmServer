<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\SaduditharView;
use Illuminate\Http\Request;

class SaduditharViewController extends Controller
{
    public function index()
    {
        $saduditharViews = SaduditharView::all();
        return response()->json([
            'views' => $saduditharViews
        ]);
    }
    public function store(Request $request, string $id)
    {
        $user = auth()->user();

        // Assuming your Sadudithar model has a 'likes' relationship method
        $view = $user->saduditharViews()->where('sadudithar_id', $id)->first();

        if ($view) {

            $message = "Already Viewed";
        } else {
            $view =  SaduditharView::create([
                'user_id' => $user->id,
                'sadudithar_id' => $id, // Use appropriate foreign key name
                'is_view' => true,
            ]);
            $message = "Viewed";
        }
        return ResponseHelper::success($view, $message);
    }
}
