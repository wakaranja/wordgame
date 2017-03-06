<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $entries = Entry::orderBy('name','asc')->paginate(50);
        return view('entries.entries',['entries'=>$entries]);
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
          'name'=>'required|max:50|unique:entries,name,NULL,id,category_id,'.$request['category_id']
        ]);
        $entry = new Entry();
        $entry->name = $request['name'];
        $entry->category_id = $request['category_id'];

        if($request->user()->entries()->save($entry)){
            $message='Entry sucessfully added!';
        };

        return back();
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
        //
        $entry = Entry::find($id);
        return view('entries.editentry',['entry'=>$entry]);
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
          'name'=>'required|max:50|unique:entries,name,NULL,id,category_id,'.$request['category_id']
        ]);
        $entry = Entry::find($id);
        $entry->name = $request['name'];        

        if( $entry->update() ){
            $message='Entry sucessfully updated!';
        };

        return redirect()->route('entries');
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
        $category = Entry::find($id)->delete();
        return back();
    }
}
