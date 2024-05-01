<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\SaduditharComment\StoreSaduditharCommentRequest;
use App\Http\Resources\SaduditharCommentResource;
use App\Models\SaduditharComment;
use Illuminate\Http\Request;

class SaduditharCommentController extends Controller
{

    public function index(int $id)
    {
        $comments =  SaduditharComment::where('sadudithar_id', $id)->get();
        return ResponseHelper::success(SaduditharCommentResource::collection($comments));
    }
    public function store(StoreSaduditharCommentRequest $request)
    {
        return $this->handleTransaction(function () use ($request) {
            $comment = $request->all();
            $comment = SaduditharComment::create($comment);
            return $this->responseHelper->success($comment->load('user'), "Commented Successfully");
        });
    }
}
