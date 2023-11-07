<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;


class OpenAIController extends Controller
{
    public function index23(): JsonResponse
    {
      $search = 'Who is google';
      $data= Http::withHeader([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer '.env('OPEN_API_KEY'),
      ])
      ->post('https://api.openai.com/v1/completions',[
        'model' =>'gpt-3.5-turbo-instruct',
        'messages' => [
            [
            "role"=>'user',
            'content'=>$search
            ]
            ],
            'temperature' => 0.5,
            'max_tokens' => 200,
            'top_p' => 1.0,
            'frequency_penalty' => 0.52,
            'presence_penalty' => 0.5,
            'stop' => ["11."],
      ])->json();
      return response()->json($data['choice'][0]['message'],200,array(),JSON_PRETTY_PRINT);
    }
}
