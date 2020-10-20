<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Repository;
use App\User as UserModel;

class User extends Controller
{
    protected $model;
    protected $request;

    public function __construct(UserModel $model, Request $request)
    {
        $this->model = new Repository($model);
        $this->request = $request;   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->model->with(['info'])->findOrFail($this->request->user()->id);
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $this->model->with(['info','agency'])->show($id);
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

    public function sendEmailVerification(){
        
        try {
            $status = $this->request->user()->sendEmailVerificationNotification();
            return response()->json(['message'=>'sending success'], 200);
        } catch(\Exception $e) {
            return response()->json(['message'=>'sending failed'], 412);
        }
    }
}
