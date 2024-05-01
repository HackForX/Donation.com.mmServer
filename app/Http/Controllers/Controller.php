<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Throwable;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $responseHelper;

    public function __construct(ResponseHelper $responseHelper)
    {
        $this->responseHelper = $responseHelper;
    }
    protected function handleTransaction(callable $callback): JsonResponse
    {
        try {
            DB::beginTransaction();

            $response = $callback();

            DB::commit();

            return $response;
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            // Extract specific error messages with context
            $errors = [];
            foreach ($e->validator->errors()->messages() as $field => $message) {
                $errors[$field] = $message[0]; // Get the first message for each field
            }

            return $this->responseHelper->error(
                $e->getCode(),
                $errors,
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->responseHelper->error($e->getCode(), $e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
