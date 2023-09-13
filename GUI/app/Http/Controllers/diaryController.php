<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\contactMailer;
use App\Models\thermometer;
use App\Models\User;


class diaryController extends Controller
{
    //
    public function __construct(){
        return $this->middleWare("auth");
    }
    public function index(Request $request){
        $index= thermometer::where("user_id",auth()->user()->id)->orderBy("created_at","asc")->cursorpaginate(10);
        return  view("diary.index",compact('index'));
    }


public function create(Request $request){
    return view("diary/form");
}


public function store(Request $request){
  
        date_default_timezone_set("Africa/Lagos");
        thermometer::create([
         'user_id'=>auth()->user()->id,
        'readings'=>$request->reading,
        'picture'=>"thermometer.svg"
        ]);
        return response()->json("Temperature saved.");
 

}
 public function send(Request $request){
      
     if( Mail::to(auth()->user()->email)
      ->send(new contactMailer($request))){
        return response()->json("Thank you for reaching out, your message has been successfully delivered.");
 
      }
      else{
      return response()->json("<div class='alert alert-danger alert-styled-left alert-dismissible'>".
      "<button type='button' class='close' data-dismiss='alert'><span>&times;</span></button>"."Oops an error occured! Try again.".
    "</div>");
    }
 }

public function view(Request $request){
        $read=thermometer::where("id",$request->view)
        ->where("user_id",auth()->user()->id)
        ->first();    
return view('diary.view',compact('read'));
}


public function delete(Request $request){
    $title=$request->title;
    $delete=thermometer::where("id",$request->view)
    ->where("user_id",auth()->user()->id)
    ->delete();    
return redirect()->action([diaryController::class,"index"])->with('delete',"$title sucessfully deleted");
}


public function trash(Request $request){
    $index= thermometer::where("user_id",auth()->user()->id)->onlyTrashed()->orderBy("created_at","asc")->cursorpaginate(10);
 return  view("diary.trash",compact('index'));
}


public function restoreTrash(Request $request){
    $index= thermometer::where("user_id",auth()->user()->id)
    ->onlyTrashed()->find($request->restoreId)->restore();
    $restore='"'.$request->title.'"'."successfully restored";
     return redirect()->back()->with('restore',$restore);

}


public function deleteTrash(Request $request){
    $title=$request->title;
    $delete=thermometer::where("id",$request->view)
    ->where("user_id",auth()->user()->id)
    ->forceDelete();    
return redirect()->back()->with('delete',"$title sucessfully deleted");
}
   

  public function search (Request $request){
        $validate=$request->validate(['search'=>'required|min:1']);
        if($request->search){   
          //receive search keyword  
         $searchs=$request->search; 
         //explode search term for looping
         $searchwords=explode(" ",$searchs);
 
    //return dd($searchs);
     
         $searchs=thermometer::where(function ($query) use ($searchs)
         {
             //search for exact keyword(s)
             $query->where("user_id",auth()->user()->id)
             ->where('readings',"like","%".$searchs."%")
             ->orWhere('created_at',"like","%".$searchs."%");
          })->orderBy('created_at','asc')
   ->cursorPaginate(10);    
   return view('diary.search',compact('searchs'));}
//end of function    
     }
     public function profile(Request $request){
        $index= user::where("id",auth()->user()->id)->first();
        $entry= thermometer::where("user_id",auth()->user()->id)->count();
        return  view("diary.profile",compact(['index','entry']));
    }
  
//end of class
}