<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('roles.view_role',compact('roles'));
    }

    public function create()
    {
        return view('roles.create_role');
    }

    public function afterInsertion($color, $notification)
    {
        return redirect('view_roles')->with('notification',$notification)->with('color',$color);
    }

    public function store(Request $request)
    {
        //Validation should always be kept outside
        $this->validate($request,[
            'role_name'=>'required'
        ]);


        try {
            $role_create = Role::insert(
                [
                   'role_name'=>$request->role_name
                ]
            );

            if ($role_create == true) {
                $notification="Role has been added successfully!";
                $color="success";
            } else {
                $notification="Oops something went wrong!";
                $color="danger";
            }

            return $this->afterInsertion($color,$notification);

        }catch (\Exception $notification)
        {
            $color="danger";

            return $this->afterInsertion($color,$notification);
        }


    }

    public function edit($id)
    {
        $role = Role::where('id',$id)->get()[0];


        return view('roles.edit_role',compact('role'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'role_name'=>'required'
        ]);

        try {
            $role_update = Role::where('id', $id)
                ->update(
                    [
                       'role_name'=>$request->role_name
                    ]
                );

            if ($role_update == true) {
                $notification="Role has been edited successfully!";
                $color="success";
            } else {
                $notification="Oops something went wrong!";
                $color="danger";
            }

            return redirect('view_roles')->with('notification',$notification)->with('color',$color);


        }catch (\Exception $notification)
        {
            $color="danger";
            return redirect('view_roles')->with('notification',"Oop looks we have an error")->with('color',$color);
        }

    }

    public function destroy($id)
    {
        try{

            $role = Role::where('id',$id)->delete();

            if ($role == true) {
                $notification="Role has been deleted successfully!";
                $color="success";
            } else {
                $notification="Oops something went wrong!";
                $color="danger";
            }

            return redirect('view_roles')->with('notification',$notification)->with('color',$color);

        }catch (\Exception $notification)
        {
            $color = 'danger';

            return redirect('view_roles')->with('notification',$notification)->with('color',$color);
        }
    }
}
