<?php

namespace App\Http\Controllers;

use App\Models\InputString;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $numberOfCharacters = mb_strlen($inputValue);

        if (Auth::user()) {
            InputString::factory()
                ->for(Auth::user())
                ->withString($inputValue)
                ->create();
        }
        return response()->json(['message' => $numberOfCharacters]);
    }
}
