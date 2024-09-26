<?php
namespace App\Service;

use App\Models\Book;
use App\Models\category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class BookService{
    public function filter(Request $request){
        $query = Book::query();
        if($request->has('active')){
            $query->where('is_active', 1);
        }
        if($request->has('published_at')){
            $query->orderBy('published_at','DESC');
        }
        if($request->has('category')){
            $category = category::where('name',$request->input('category'))->first;
            $request->where('category_id',$category->id);
        }
        $books = $query->get();

        // Format the `published_at` field
        $formattedBooks = $books->map(function ($book) {
            $book->published_at = Response::formatDate($book->published_at);
            return $book;
        });

        return $formattedBooks;
    }
    public function createBook(array $data){
        try{
            $book = Book::create($data);
            return $book ;
        }catch(Exception $e){
            Log::error('Error : Failed when create a book ' .$e->getMessage());
            throw new Exception($e->getMessage());
        }

    }
    public function updateBook(array $data , string $id){
        try{
            $book = Book::where('id', $id)->first();
            $updatedBook = $book->update($data);
            return $updatedBook ;
        }catch(Exception $e){
            Log::error('Error : Failed When Updated Book '.$e->getMessage());
            throw new Exception('Failed Updated Book '.$e->getMessage());
        }
    }
    public function showBookById(string $id){
        try{
            $book = Book::where('id',$id)->first();
            return $book ;
        }catch(Exception $e){
            Log::error('Error : Failed When show Book '.$e->getMessage());
            throw new Exception('Failed show Book '.$e->getMessage());
        }
    }
    public function delete(string $id){
        try{
            $book = Book::where('id',$id)->first();
            $book->delete();
        }catch(Exception $e){
            Log::error('Error : Failed When delete Book '.$e->getMessage());
            throw new Exception('Failed delete Book '.$e->getMessage());
        }
    }
}
?>
