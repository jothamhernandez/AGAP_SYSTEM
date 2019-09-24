<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserInfo as UserInfoModel;
use App\Repositories\Repository;

class UserInfo extends Controller
{

    public function __construct(UserInfoModel $model, Request $request)
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
        return $this->model->with('department')->get();
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
        return $this->model->getModel()->with('agency')->where('user_id',$id)->first();
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
        
        $data = $request->only($this->model->getModel()->getFillable());

        $data['first_name'] = ucfirst(strtolower(@$data['first_name']));
        $data['last_name'] = ucfirst(strtolower(@$data['last_name']));
        $data['middle_name'] = ucfirst(strtolower(@$data['middle_name']));
        $userInfo = $this->model->update($data, $id);
        

        return $this->show($id);
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
