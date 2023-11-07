<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Idea $idea){

        //dd($idea->comments); getting related all comments
        return view('ideas.show',compact('idea'));

    }
    public function edit(Idea $idea){
        $editing = true;
        return view('ideas.show',compact('idea','editing'));
    }
    public function update(Idea $idea){
        request()->validate([
            'content' => 'required|min:3|max:240'
        ]);
        $idea->content = request()->get('content','');
        $idea->save();

        return redirect()->route('ideas.show',$idea->id)->with('success','Idea updted successfully');
    }
   public function store(){

    request()->validate([
        'idea' => 'required|min:3|max:240'
    ]);
    //dd(request()->all());
     $idea = Idea::create(
        [
        "content" => request()->get('idea','')
        ]
    );
   return redirect()->route('dashboard')->with('success','Idea created successfully.');

   }

//    public function destroy($id){
//     //where id=id
//     //idea::destroy($id);
//    $idea = Idea::where('id',$id)->firstOrFail();
//    $idea->delete();
//     return redirect()->route('dashboard')->with('success','Deleted successfully');

//    }
public function destroy(Idea $idea){

   $idea->delete();
    return redirect()->route('dashboard')->with('success','Deleted successfully');

   }


}
