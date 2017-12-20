<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function index()
    {
		return new UserCollection(User::isMember()->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules =[
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6'
        ];

        if ($request->phone){
          array_push($rules,['phone' => 'unique:users']);
        }

        if($request->idCardNum){
          array_push($rules,['idCardNum' => 'unique:users']);
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $validator->errors();
        }

        $user =User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password) ,
            'checkPass'=>$request->checkPass ,
            'gender'  =>$request->gender,
            'idCardNum' =>$request->idCardNum,
            'idCardFront' =>$request->idCardFront,
            'idCardBack' =>$request->idCardBack,
            'status' => $request->status
        ]);
        if($user){
            return response()->json([
                'message' => '添加成功！',
                'data' => $user
            ],200);
        }else{
            return response()->json([
                'message' => '添加失败！',
            ],401);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserCollection
     */
    public function show($id)
    {
		return new UserCollection(User::find($id));
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
