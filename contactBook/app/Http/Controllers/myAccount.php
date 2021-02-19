<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\registration;
use DB;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class myAccount extends Controller
{

    /**
     * after validation redirect to dashboard
     */
    public function dashboard() 
    {

        // check if user logged in
        if(Auth::check()) {
            $userid  =      Auth()->user()->id;
     
            $contactUsers = registration::where(['userid'=>$userid,'status'=>1 ])->limit(5)->latest()->get();
         
            return view('dashboard',compact('contactUsers'));
        }
        return redirect::to("user-login")->withSuccess('Oopps! You do not have access');
    }

    /**
     * logout User
     *
     * @param   Request  $request  [$request description]
     *
     * @return  [type]             [return description]
     */
    public function logout(Request $request ) 
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('user-login');
    }

    /**
     * view form of add Contact details
     *
     */
    public function create() 
    {
        return view('addContactDetails');
    }

    /**
     * Add contact Details of user
     *
     * @param   Request  $request  [$request description]
     *
     * @return  [type]             [return description]
     */
    public function addContactDetails(Request $request)
    {
        $rules = [
            'username'             =>      'required',
            'useremail'            =>      'required|unique:contact_details',
            'usermobile'           =>      'required|min:10|unique:contact_details',
            'userimage'            =>      'required|image|mimes:jpeg,png,jpg,gif,svg',
            'aboutuser'            =>      'required|max:300',
           
        ];
    
        $customMessages = [
            'required'   => 'The :attribute field can not be blank.',
            'unique'    => 'The :attribute already exists.',
            'max'        => 'Maximum 300 character'
        ];
    
        $this->validate($request, $rules, $customMessages);
        $input          =           $request->all();
        $imageName = time().'.'.$request->userimage->extension();  
        $request->userimage->move(public_path('uploads'), $imageName);

        // if validation success then create an input array
        $inputArray = array(
            'userid'               =>      Auth()->user()->id,
            'username'             =>      $request->username,
            'useremail'            =>      $request->useremail,
            'usermobile'           =>      $request->usermobile,
            "userimage"            =>      $imageName,
            'aboutuser'            =>      $request->aboutuser,
            'status'               =>      1
        );

        // register user
        $contactUser = registration::create($inputArray);
        // if registration success then return with success message
        if(!is_null($contactUser)) {
            return redirect('/dashboard');
        }
        // else return with error message
        else {
            return back()->with('error', 'Whoops! some error encountered. Please try again.');
        }
    }

    /**
     *  get data of contact details
     */
    public function editindex()
    {
        $users =DB::table('contact_details')->get();
        return back()->withInput();
    }

    /**
     * get data of contact_details table and send data to edit form
     *
     */
    public function show($id)
    {
        $user = registration::where('id',$id)->first();
        return view('edit', compact('user'));
    }

    /**
     * Update contact details table 
     *
     */
    public function update(Request $request,$id) 
    {
       
        $this->validate($request, $rules, $customMessages);
        $imageName = time().'.'.$request->userimage->extension();  
        $request->userimage->move(public_path('uploads'), $imageName);
        $username = $request->get('username');
        $useremail = $request->get('useremail');
        $usermobile = $request->get('usermobile');
        $userimage = $request->file('userimage');
        $aboutuser = $request->get('aboutuser');
        $users= registration::where('id',$id)->update([
                'username'=>$username,
                'useremail'=>$useremail,
                'usermobile'=>$usermobile,
                'userimage'=>$imageName,
                'aboutuser'=>$aboutuser
        ]);
        if($users){
            return redirect('/dashboard');
        }
    }

    /**
     * Search Contact User
     *
     */
    public function search(Request $request){
        $search = $request->get('search');
        $id = Auth()->user()->id;
        $status =1;
        // Get the search value from the request
        $contactUsers = registration::where('username', 'LIKE', "%$search%" )->where('status', $status)->where('userid', $id)->latest()->get();
        // Return the search view with the resluts compacted
        return view('dashboard', compact('contactUsers'));
    }
    /**
     * delete contact details record
     *
     * @param   [integer]  $id 
     *
     */
    public function destroy($id) 
    {
        $users = DB::table('contact_details')->where('id', $id)->delete();
        return back()->withInput();
    }
    
    /**
     * Disable contact details
     *
     * @param   [integer]  $id 
     *
     */
    public function disable($id)
    {
        $users = registration::where('id',$id)->update(['status'=>0]);
        return back()->withInput();
    }

    /**
     * Show data Tables 
     *
     */
    public function index1(Request $request)
    {
        $userid =  Auth()->user()->id;
        if ($request->ajax()) {
            $data = registration::where(['userid'=>$userid,'status'=>1 ])->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name',function($row){
                        return $row->username;
                    })
                    ->editColumn('email',function($row){
                        return $row->useremail;
                    })
                    ->editColumn('mobile',function($row){
                        return $row->usermobile;
                    })
                    ->addColumn('image', function ($row) { 
                        $url= asset('uploads/'.$row->userimage);
                        return '<img src="'.$url.'" border="0" width="100"  align="center" />';
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="/update/'. $row->id.'" class="btn btn-primary">Edit</a>';
                    })
                    ->editColumn('delete', function ($row) {
                        return '<a href="/delete/'. $row->id.'">delete</a>';
                    })
                    ->rawColumns(['image','action','delete' => 'delete','action' => 'action'])
                    ->make(true);
        }
      
        return view('users');
    }  


  
}

