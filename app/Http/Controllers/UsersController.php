<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{

    public function index()
    {
        $this->data['title'] = "System Users";
        $this->data['subtitle'] = "Manage System users";
        return view('pages.users.index',$this->data);
    }

    public function userData(Request $request)
    {
        $request->merge(
            [
                'phone' => standardizephone($request->columns[3]['search']['value'])
            ]);

        $users = User::all();
        return Datatables::of(collect($users))
            ->addColumn('action',function($user){
                return '<a href="'.route('user.edit',['id' => $user->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('phone', function($user){
                return localphone($user->phone);
            })
            ->make(true);

    }

    public function importForm()
    {
        $this->data['title'] = 'Import Users';
        $this->data['subtitle'] = 'Import multiple users into the system';
        return view('pages.users.import',$this->data);
    }

    public function import(Request $request)
    {
        $this->validate($request,[
            'template' => 'required|mimes:xls,xlsx'
        ],
            [
                'template.mimes' => 'The template must be an Excel sheet'
            ]);
        $file = $request->file('template');

        $filename = str_random(20).'.'.$file->getClientOriginalExtension();

        //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath,$filename);

        $users = Excel::load(public_path('uploads'.DIRECTORY_SEPARATOR.$filename),function ($reader){
            try
            {
                return $reader->select(array('first_name', 'last_name','phone','email'))->get();
            }catch (Exception $e)
            {
                return 0;
            }
        });

        $i = 0;
        $emails = [];
        $user_data = $users->toArray();
        $count = count($user_data);
        if($count == 0)
        {
            return back()->with('error','Ooops! Something went wrong.');
        }

        $now = date('Y-m-d H:i:s');
        $pass = bcrypt('@KPMG');
        foreach($user_data as $user)
        {
            $u = User::where('email',$user['email'])->first();
            if($u)
            {
                array_push($emails,$user['email']);
            }
            $user_data[$i]['password'] = $pass;
            $user_data[$i]['phone'] = standardizephone('0'.$user_data[$i]['phone']);
            $user_data[$i]['created_at'] = $now;
            $user_data[$i]['updated_at'] = $now;
            $user_data[$i]['api_token'] = str_random('64');
            $user_data[$i]['activated'] = false;
            $i++;
        }

        if(count($emails) > 0)
        {
            $message = "The following email(s) are already registered. Remove them and try again:
                     <ul>";
            foreach ($emails as $email)
            {
                $message.= "<li>$email</li>";
            }

            $message.= "</ul>";
            return back()->with('error',$message);
        }

        // delete the file
        unlink(public_path('uploads'.DIRECTORY_SEPARATOR.$filename));

        if(User::insert($user_data))
        {
            return back()->with('success','User accounts created successfully.');
        }

        return back()->with('error','Ooops! Something went wrong.');

    }

    public function edit($id)
    {
        $user = User::find($id);
        if(!$user)
        {
            return back()->with('error','Oops! Something went wrong.');
        }
        $this->data['title'] = 'Edit User';
        $this->data['subtitle'] = $user->fullname();
        $this->data['is_edit'] = true;
        $this->data['user'] = $user;

        return view('pages.users.form',$this->data);

    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        $user = User::find($id);

        if(!$user)
        {
            return back()->with('error','Oops! Something went wrong.');
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = standardizephone($request->phone);
        $user->email = $request->email;

        if($user->save())
        {
            return back()->with('success','User Successfully Updated');
        }
        return back()->with('error','Oops! Something went wrong');
    }

    public function getTemplate()
    {
        $template = storage_path('templates'.DIRECTORY_SEPARATOR.'user-template.xlsx');
        return response()->download($template);
    }

    public function deactivate($id)
    {
        $user = User::find($id);

        if(!$user)
        {
            return back()->with('error','Ooops! Something went wrong');
        }

        $user->is_active = !$user->is_active;

        if(!$user->save())
        {
            return back()->with('error','Ooops! Something went wrong');
        }
        return back()->with('success','User status changed successfully');
    }

    public function activate($id)
    {
        return $this->deactivate($id);
    }

}
