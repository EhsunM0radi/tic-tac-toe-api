<?php

namespace App\Http\Controllers;

use App\Models\GameTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GameController extends Controller
{
    private function generateBoardString(array $data)
    {
        // استخراج آخرین وضعیت صفحه
        $finalSquares = $data['moves'][count($data['moves']) - 1]['squares'];

        // ایجاد رشته نهایی
        $boardString = implode('', array_map(function($cell) {
            return $cell ?? 'O'; // خانه‌های خالی را به 'O' تبدیل می‌کنیم
        }, $finalSquares));

        return $boardString;
    }

    public function generateToken(Request $request)
    {
        $gameData = $request->all();
        $boardString = $this->generateBoardString($gameData);
        $token = Str::uuid()->toString();

        GameTokens::create([
            "token" => $token,
            "final_map" => $boardString
        ]);

        return response()->json(['message' => 'Game saved successfully'], 200);
    }

    public function gameTokens(Request $request)
    {
        $tokens = GameTokens::select('id','token')->get();
        return response()->json($tokens,200);
    }
}
