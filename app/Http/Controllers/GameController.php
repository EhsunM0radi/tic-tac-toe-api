<?php

namespace App\Http\Controllers;

use App\Models\GameTokens;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function generateToken(Request $request)
    {
        $token = Str::uuid()->toString();
        
        GameTokens::create([
            "token" => $token,
        ]);

        return response()->json(['message' => 'Game saved successfully'], 200);
    }
}
