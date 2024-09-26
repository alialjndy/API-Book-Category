<?php

namespace App\Http\Controllers;


use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Models\User;
use App\Service\Admin\UserService;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    protected $userService ;
    public function __construct(UserService $userService){
        $this->userService = $userService ;
    }
    /**
     * Summary of index
     * @return mixed
     */
    public function index()
    {
        $allUsers = User::select('id','name','email')->get();
        return Response::api('success','All Users',$allUsers,200);
    }

    /**
     * Summary of store
     * @param \App\Http\Requests\Auth\CreateUserRequest $request
     * @return mixed
     */
    public function store(CreateUserRequest $request)
    {
        $validatedData = $request->validated();
        $user = $this->userService->createUser($validatedData);
        return Response::api('success','User Created Successfully',$user,201);
    }

    /**
     * Summary of show
     * @param string $id
     * @return mixed
     */
    public function show(string $id)
    {
        $user = $this->userService->showUserByID($id);
        return Response::api('success','User Info ',$user,200);
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\Auth\UpdateUserRequest $request
     * @param string $id
     * @return mixed
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $valdiatedData = $request->validated();
        $this->userService->updateUser($valdiatedData , $id);
        return Response::api('success','user updated successfully',[true],200);
    }

    /**
     * Summary of destroy
     * @param string $id
     * @return mixed
     */
    public function destroy(string $id)
    {
        $this->userService->delete($id);
        return Response::api('success','user deleted successfully',[null],200);
    }

}
