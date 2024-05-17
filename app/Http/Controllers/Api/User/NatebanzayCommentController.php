<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\NatebanzayComment\StoreNatebanzayCommentRequest;
use App\Http\Resources\NatebanzayCommentResource;
use App\Models\NatebanzayComment;
use Illuminate\Http\Request;

class NatebanzayCommentController extends Controller
{
    
    public function index(int $id)
    {
        $comments =  NatebanzayComment::where('natebanzay_id', $id)->get();
        return ResponseHelper::success(NatebanzayCommentResource::collection($comments));
    }
    public function store(StoreNatebanzayCommentRequest $request)
    {
        return $this->handleTransaction(function () use ($request) {
            $comment = $request->all();
            $comment = NatebanzayComment::create($comment);
            return $this->responseHelper->success($comment->load('user'), "Commented Successfully");
        });
    }
}
