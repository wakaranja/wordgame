<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show all categories
        $categories = Category::orderBy('name','asc')->paginate(50);
        return view('categories.categories',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $this->validate($request,[
          'name'=>'required|max:50|unique:categories'
        ]);
        $category = new Category();
        $category->name = $request['name'];
        $category->description = $request['description'];
        $category->private = 0;
        if($request['private']){
          $category->private=1;
        }
        if($request->user()->categories()->save($category)){
            $message='Category sucessfully created!';
        };

        return redirect()->route('categories');
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
        $category = Category::find($id);
        return view('categories.category',['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::find($id);
        return view('categories.editcategory',['category'=>$category]);
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
        //
        $this->validate($request,[
          'name'=>'required|max:50'
        ]);
        $category = Category::find($id);
        $category->name = $request['name'];
        $category->description = $request['description'];
        if($request['private'])
        {
          $category->private = 1;
        }
        else
        {
            $category->private = 0;
        }

        if( $category->update() ){
            $message='Category sucessfully updated!';
        };

        return redirect()->route('categories');
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
        $category = Category::find($id)->delete();
        return back();
    }
}
