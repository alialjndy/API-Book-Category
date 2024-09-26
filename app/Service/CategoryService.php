<?php
namespace App\Service;

use App\Models\category;
use Exception;
use Illuminate\Support\Facades\Log;

class CategoryService{
    public function createCategory(array $data){
        try{
            $category = category::create($data);
            return $category;
        }catch(Exception $e){
            Log::error('Error : error when create category.');
            throw new Exception('There is an error in server');
        }
    }
    public function show(string $id){
        try{
            $category = category::findOrFail($id);
            return $category->books()->get();
        }catch(Exception $e){
            Log::error('Error : error when show category.');
            throw new Exception(message: 'There is an error in server');
        }
    }
    public function updateCategory(array $data , string $id){
        try{
            $category = category::where('id',$id)->first();
            $category->update($data);

        }catch(Exception $e){
            Log::error('Error : error when update category');
            throw new Exception('There is an error in server');
        }
    }
    public function delete(string $id){
        try{
            $category = category::where('id',$id)->first();
            $category->delete();
        }catch(Exception $e){
            Log::error('Error : error when delete category.');
            throw new Exception('There is an error in server.');
        }
    }

}
