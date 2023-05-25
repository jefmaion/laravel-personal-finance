<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
           return $this->categoryService->listToDatatable();
        }

        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $parents  = $this->categoryService->listCategories();
        return view('category.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->except('_token');

        if(!$category = $this->categoryService->create($data)) {
            return redirect()->route('category.index')->with('error', $this->categoryService->message());
        }

        return redirect()->route('category.show', $category)->with('success', $this->categoryService->message() . ' (<a href="'.route('category.create').'">Adicionar Outro</a>)');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$category = $this->categoryService->find($id)) {
            return redirect()->route('category.index')->with('error', $this->categoryService->message());
        }

        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$category = $this->categoryService->find($id)) {
            return redirect()->route('category.index')->with('error', $this->categoryService->message());
        }

        $parents  = $this->categoryService->listCategories();
        return view('category.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {

        if(!$category = $this->categoryService->find($id)) {
            return redirect()->route('category.index')->with('error', $this->categoryService->message());
        }

        $data = $request->except(['_token', '_method']);
        
        $this->categoryService->update($category, $data);

        return redirect()->route('category.show', $category)->with('success', $this->categoryService->message());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$category = $this->categoryService->find($id)) {
            return redirect()->route('category.index')->with('error', $this->categoryService->message());
        }

        $this->categoryService->delete($category);

        return redirect()->route('category.index')->with('success', $this->categoryService->message());
    }
}
