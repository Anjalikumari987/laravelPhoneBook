<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\registration;
use DB;
use DataTables;
Use Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller {

    /**
     * User registration view
     *
     * @return  [type]  [return description]
     */
    public function index() {
        return view('registration');
    }

    /**
     * Register User
     *
     * @param   Request  $request  [$request description]
     *
     * @return  [type]             [return description]
     */
    public function userPostRegistration(Request $request) {
        // validate form fields

            $rules = [
               
                'email'            =>  'exists:users',
                'password'         =>  'min:5',
                'confirm_password' =>  'same:password',
                'phone'            =>  'min:10|max:12|unique:registerUser',
               
            ];
        
            $customMessages = [
                'required'   => 'The :attribute field can not be blank.',
                'exists'     => ':attribute field already exists.',
                'unique'     => ':attribute number already exists',
                'min'        => 'Minimum 10 character',
                'max'        => 'Maximum 12 character'
            ];
        
            $this->validate($request, $rules, $customMessages);
           
        $input                  =       $request->all();
        // if validation success then create an input array
         $inputArray            =    array(
            'name'              =>      $request->name,
            'email'             =>      $request->email,
            'password'          =>      Hash::make($request->password),
            'phone'             =>      $request->phone,
            'age'               =>      $request->age,
            'about'             =>      $request->about,
            'status'            =>       0,
         );

        // register user
        $user           =           User::create($inputArray);

        // if registration success then return with success message
        if(!is_null($user)) {
            return view('login');
        }

        // else return with error message
        else {
            return back()->with('error', 'Whoops! some error encountered. Please try again.');
        }
       
  
    }

    /**
     * function for redirect on login view page.
     *
     * @return  [type]  [return description]
     */
    public function userLoginIndex() {
        return view('login');
    }


    /**
     * login User
     *
     * @param   Request  $request  [$request description]
     *
     * @return  [type]             [return description]
     */
    public function userPostLogin(Request $request) {

        $request->validate([
            "email"           =>    "required|email",
            "password"        =>    "required|min:6"
        ]);
        $status = 1; 
        $userCredentials = $request->only('email', 'password');

        // check user using auth function
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if(Auth()->user()->status == 1){
              return redirect()->intended('dashboard');
            }
            else{
              return back()->with('error','disable user!');
            }
        }
       else{
            return back()->with('error', 'Whoops! invalid username or password.');
        }
    }

    /**
     * show list using ajax
     *
     */
   
 

}
