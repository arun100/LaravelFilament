<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatgptController extends Controller
{
    public function collect(){
      //dump(request()->get('prompt_data',''));
      echo $Prompt = request()->get('prompt_data','');



    }
}
