<?php

namespace App\Http\Controllers;


use App\Http\Requests\Category\createCategoryRequest;
use App\Http\Requests\Category\updateCategoryRequest;
use App\Models\category;
use App\Service\CategoryService;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }
    /**
     * Summary of index
     * @return mixed
     */
    public function index()
    {
        $allCategories = category::all();
        return Response::api('success','All Categories',$allCategories , 200);
    }

    /**
     * Summary of store
     * @param \App\Http\Requests\Category\createCategoryRequest $request
     * @return mixed
     */
    public function store(createCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $category = $this->categoryService->createCategory($validatedData);
        return Response::api('success','Category created successfully',$category , 201);
    }

    /**
     * Summary of show
     * @param string $id
     * @return mixed
     */
    public function show(string $id)
    {
        $category = $this->categoryService->show($id);
        return Response::api('success','Category',$category , 200);
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\Category\updateCategoryRequest $request
     * @param string $id
     * @return mixed
     */
    public function update(updateCategoryRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $this->categoryService->updateCategory($validatedData, $id);
        return Response::api('success','Category updated successfully',[] , 200);
    }

    /**
     * Summary of destroy
     * @param mixed $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return Response::api('success','Category deleted successfully',[] , 200);

    }
}
