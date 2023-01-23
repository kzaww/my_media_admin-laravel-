<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class adminController extends Controller
{
    //direct profile page
    public function dashboard()
    {
        if(auth()->user()->role == 'admin'){
            return view('admin.profile');
        }elseif(auth()->user()->role == 'user'){
            return redirect()->route('admin#notfound');
        }
    }

    //direct 404 page
    public function notfound()
    {
        return view('404page');
    }

    //change profile
    public function changeProfile(Request $request)
    {
        $validator = $this->profileValidation($request->all());

        if($validator->fails()){
            return back()->with('fail','Fail to Update,Try Again!')
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = $this->userupdateInfo($request->all());
        User::where('id',auth()->user()->id)->update($data);
        return back()->with('success','Successfully Updated');
    }

    //change password
    public function changepassword(Request $request)
    {
        $validator = $this->passwordValidation($request->all());

        if($validator->fails()){
            return back()->with('changeFail','Fail to Change,Try Again!')
                        ->withErrors($validator)
                        ->withInput();
        }

        $oldPassword = $request->oldpassword;
        $newPassword = $request->newpassword;
        $hashPassword = Hash::make($newPassword);
        $dbPass = User::where('id',auth()->user()->id)->first();
        $dbPass = $dbPass->password;
        if(Hash::check($oldPassword, $dbPass)){
            User::where('id',auth()->user()->id)->update(['password'=>$hashPassword]);
            return back()->with('changeSuccess','Password Change Success!');
        }else{
            return back()->with('notMatch','old Password must match with Db password!!');
        }
    }

    //change profile validation
    private function profileValidation($data)
    {
        $id = auth()->user()->id;
        return Validator::make($data,[
            'name' => 'required',
            'email'=> "required|email|unique:users,email,$id,id",
            'phone' => 'required|max:11',
            'address' => 'required',
            'gender' => 'required',
        ]);
    }

    //change password validation
    private function passwordValidation($data)
    {
        return Validator::make($data,[
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8',
            'confirmpassword' => 'required|min:8|same:newpassword'
        ]);
    }

    //change format for update
    private function userupdateInfo($data)
    {
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'gender' => $data['gender']
        ];
    }
}
