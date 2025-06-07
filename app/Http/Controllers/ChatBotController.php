<?php

namespace App\Http\Controllers;

use App\Servies\GeneralServices;
use Illuminate\Http\Request;
use Exception;

class ChatBotController extends Controller
{
    public function index()
    {
        return view('chatbot.chat');
    }

    public function getResponse(Request $request)
    {
        try {
            $text = (new GeneralServices())->generateText($request->data['prompt']);
            return response()->json([
                'message' => $text
            ]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()]);
        }
    }
}
