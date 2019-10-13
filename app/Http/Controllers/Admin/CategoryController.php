<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryValidation;
use Spatie\Activitylog\Contracts\Activity;
use Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
       return view('admin.template.category')->with('category', $category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.template.createcategory");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryValidation $request)
    {
        $category = new Category;
        $category->name = $request->input('category');
      
        $category->save();
        
        activity()
        ->performedOn( $category)
     ->causedBy(Auth::user()->id)
        ->withProperties(['id' => $category->id , 'name' => $category->name])
        ->log('Category  created succefully !!');

        toastr()->success('Category has succefully created');
         
        return redirect()->route("category.create");
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.template.editcategory')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryValidation $request, $id)
    {
       $category = Category::find($id);
       $category->name = $request->category;

       $category->update();
       activity()
        ->performedOn( $category)
     ->causedBy(Auth::user()->id)
        ->withProperties(['id' => $category->id , 'name' => $category->name])
        ->log('Category  updated succefully !!');
       
       toastr()->success('Category has succefully updated');
       return view('admin.template.editcategory')->with('category' , $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $category = Category::find($id);
       $category->delete();
       activity()
        ->performedOn( $category)
     ->causedBy(Auth::user()->id)
        ->withProperties(['category' => 'delete'])
        ->log('Category deleted succefully !!');
       \toastWarning("Category Deleted");
       return redirect('admin/category');

    }
}
