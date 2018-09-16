<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Validator;

class ChangePassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users =User::where('type','=','agent')->get();
        return view('admin.change_password',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $ids = $req->option;
      foreach ($ids as $i)
      {
        $user_change_pass = User::find($i);
        $user_change_pass->flag ='1';
        $user_change_pass->save();
    }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store_pass(Request $request ,$id)
    {

        if (!\Hash::check($request->get('new_password'),Auth::user()->password)) {
                $rules = [
                    'new_password' => 'required',
                    'confirm_password' => 'required|same:new_password'

                ];
                $validator = Validator::make($request->all(), $rules);
                  if ($validator->fails()) {
                      return response()->json([
                          'status' => 'error',
                           "errors" => $validator->errors()->toArray()
                      ]);
                      // return $validator->errors();
                  } else {
                          $user = Auth::user();
                          $user->password = bcrypt($request->get('new_password'));
                          $user->flag = '0';
                          $user->save();
                          return response()->json([
                              'status' => 'success'
                          ]);
            }

       }
          else {
         return response()->json([
             'error' => 'New Password cannot be same as your current password. Please choose a different password.'
         ]);

       }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
