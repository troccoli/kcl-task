<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubmitController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validData = $request->validate(['text' => 'present|nullable|string']);

        $inputValue = $validData['text'];

        return response()->json(['message' => mb_strlen($inputValue)]);
    }
}
