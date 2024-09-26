<?php
namespace App\Service;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

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
            return $user ;
        }catch(Exception $e){
            Log::error($e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     *
     * @param array $data
     * @throws \Exception
     * @return mixed
     */
    public function login(array $data){
        try{
            $credentials = [
                'email'=>$data['email'],
                'password'=>$data['password']
            ];
            if(!$token = JWTAuth::attempt($credentials)){
                throw new Exception('Invalid Credentials');
            }
            else{
                return $token;
            }
        }catch(Exception $e){
            Log::error('Error : Failed Get data '.$e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
    /**
     * Summary of me
     * @throws \Exception
     * @return mixed
     */
    public function me(){
        try{
            $user = JWTAuth::parseToken()->authenticate();
            return $user ;
        }catch(Exception $e){
            Log::error('Error : Failed Get User '.$e->getMessage());
            throw new Exception('There is an error in server');
        }

    }
    public function logout(){
        try{
            JWTAuth::invalidate(JWTAuth::getToken());
        }catch(Exception $e){
            Log::error('Error : Failed Log Out '.$e->getMessage());
            throw new Exception('There is an error in server ');
        }
    }
}
?>
