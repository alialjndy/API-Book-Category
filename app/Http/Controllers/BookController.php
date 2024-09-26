<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\updatedBookRequest;
use App\Models\category;
use App\Service\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BookController extends Controller
{
    protected $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allBook = $this->bookService->filter($request);
        return Response::api('success', 'All Book', $allBook, 200);
    }
    /**
     * Summary of indexByCategoryID
     * index all books related to this category
     * @param mixed $category_ID
     * @return mixed
     */
    public function indexByCategoryID($category_ID){
        $category = category::where('id',$category_ID)->first();
        $books = $category->books()->select('books.id','books.category_id','books.title','books.author','books.published_at','books.is_active')->get();
        return Response::api('success', 'All Book by Category ID', $books, 200);
    }

    /**
     * Store a newly created resource in storage.
     * @return mixed
     */
    public function store(CreateBookRequest $request)
    {
        $validatedData = $request->validated();
        $book = $this->bookService->createBook($validatedData);
        return Response::api('success','Book Created Successfully',$book ,201);
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return mixed
     */
    public function show(string $id)
    {
        $book = $this->bookService->showBookById($id);
        return Response::api('success','book by id',$book,200);
    }

    /**
     * Update the specified resource in storage.
     * @param string $id
     * @return mixed
     */
    public function update(updatedBookRequest $updateBookRequest, string $id)
    {
        $validatedData = $updateBookRequest->validated();
        $updatedBook = $this->bookService->updateBook($validatedData , $id);
        return Response::api('success','Book Updated Successfully',$updatedBook,200);
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return mixed
     */
    public function destroy(string $id)
    {
        $this->bookService->delete($id);
        return Response::api('success','Book Deleted Successfully',null,200);
    }
}
