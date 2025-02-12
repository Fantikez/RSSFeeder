<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    public static function rollback($e, $message = 'Something went wrong!')
    {
        DB::rollBack();
        return self::throw($e, $message);
    }

    /**
     * @param $e
     * @param string $message
     * @return mixed
     */
    public static function throw($e, string $message = 'Something went wrong!'): mixed
    {
        Log::info($message);
        return throw new HttpResponseException(response()->json(['message' => $message], 500));
    }

    public static function sendResponse($result, $message, $status = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
        ];
        if (!empty($message)) {
            $response['message'] = $message;
        }
        return response()->json($response, $status);
    }
}
