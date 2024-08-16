<?php

namespace App\Http\Controllers;

use App\Http\Actions\CalculateAverageStringLength;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AverageController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        throw_if(Auth::guest(), 'Unauthorized', 403);

        return response()->json([
            'averageLength' => CalculateAverageStringLength::run(Auth::user()),
        ]);
    }
}
