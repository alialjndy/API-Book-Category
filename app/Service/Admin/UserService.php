<?php
namespace App\Service\Admin;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class UserService{
    /**
     * Summary of createUser
     * @param array $data
     * @throws \Exception
     * @return
     */
    public function createUser(array $data){
        try{
            $user = User::create($data);
            return $user;
        }catch(Exception $e){
            Log::error('Error : Error when creating user '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
    /**
     * Summary of showUserByID
     * @param string $id
     * @throws \Exception
     * @return User|\Illuminate\Database\Eloquent\Collection
     */
    public function showUserByID(string $id){
        try{
            $user = User::select('id','name','email')->findOrFail($id);
            return $user;
        }catch(Exception $e){
            Log::error('Error : Error when show user '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
    /**
     * Summary of updateUser
     * @param array $data
     * @param string $id
     * @throws \Exception
     * @return void
     */
    public function updateUser(array $data ,string $id){
        try{
            $user = User::findOrFail($id);
            $user->update($data);
        }catch(Exception $e){
            Log::error('Error : Error when update user '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
    /**
     * Summary of delete
     * @param string $id
     * @throws \Exception
     * @return void
     */
    public function delete(string $id){
        try{
            $user = User::findOrFail($id);
            $user->delete();
        }catch(Exception $e){
            Log::error('Error : Error when delete user '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
    /**
     * Summary of assignRoleToUser
     * @param array $data
     * @param string $id
     * @throws \Exception
     * @return void
     */

}
