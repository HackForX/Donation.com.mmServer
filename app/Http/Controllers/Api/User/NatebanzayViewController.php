<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\NatebanzayView;
use Illuminate\Http\Request;

class NatebanzayViewController extends Controller
{

    public function index()
    {
        $natebanzayViews = NatebanzayView::all();
        return response()->json([
            'views' => $natebanzayViews
        ]);
    }
    public function store(Request $request, string $id)
    {
        $user = auth()->user();

        // Assuming your Sadudithar model has a 'likes' relationship method
        $view = $user->natebanzayViews()->where('natebanzay_id', $id)->first();

        if ($view) {

            $message = "Already Viewed";
        } else {
            $view =  NatebanzayView::create([
                'user_id' => $user->id,
                'natebanzay_id' => $id, // Use appropriate foreign key name
                'is_view' => true,
            ]);
            $message = "Viewed";
        }
        return ResponseHelper::success($view, $message);
    }
}
