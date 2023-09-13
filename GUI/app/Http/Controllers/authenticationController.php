<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class authenticationController extends Controller
{
    //
    
    public function register(Request $request)
    {
        
    $validated=$request->validate([
        'username'=>['required','min:8','string'],
    'email'=>['required','min:8','string'],
    'password'=>['required','confirmed','min:8','string'],
    ]);  
    if(!empty($request->picture)){
        $picture="owamaDiary"."-".date("d-m-y-h-i-s").".".strtolower($request->picture->extension());
        $request->picture->move(public_path("img"),$picture);
        }
    user::create([
        'name'=>$request->username,
        'picture'=>"feather.svg",
        'email'=>$request->email,
       'password'=>Hash::make($request->password)]);
        $credentials=$request->only(['email','password']);
        $remember=($request->remember_me=="on")?true:false;
       if( auth()->attempt($credentials,$remember))
       {
       $request->session()->regenerate();
        return redirect()->route('diary.index');
    }
   //  return redirect()->back()->with('error','An error occurred please try again');
    
    
    }




    public function login(Request $request){
 $validated=$request->validate([
   'email'=>['required','min:8','string'],
   'password'=>['required','min:8','string']
]);    
$credentials=$request->only(['email','password']);
$remember=($request->remember_me=="on")?true:false;
    if( auth()->attempt($credentials,$remember))
    {
        $request->session()->regenerate();
         return redirect()->route('diary.index');
     }
return redirect()->back()->with('error',"Sorry you entered an invalid credentials. Please try again");
    }



    public function logout(Request $request){
auth()->logout();
$request->session()->invalidate();
$request->session()->regenerateToken();
return redirect('/');

    }
    public function create(){
        if(auth()->user()){
            return redirect('/');
        }
        return view("diary.register");
        }

public function signin(){
    if(auth()->user()){
        return redirect('/');
    }
    return view('diary.login');
}
//end of class
}
