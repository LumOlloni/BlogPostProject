<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Response;
use App\DataTables\UserDataTable;
use App\DataTables\UsersDataTablesEditor;

use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    
    // public function index(UserDataTable $dataTable)
    // {
    //     return $dataTable->render('admin.template.users');
    // }

    // public function store(UsersDataTablesEditor $editor)
    // {
    //     return $editor->process(request());
    // }
    /**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    if(request()->ajax()) {
        return datatables()->of(User::select('*'))
        ->addColumn('action', 'admin.datatabledesign.button')
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }
    return view('admin.template.users');
}
 
 
/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{  
    $userId = $request->user_id;
    $user   =   User::updateOrCreate(['id' => $userId],
                ['name' => $request->name, 'email' => $request->email]);        
    return Response::json($user);
}
 
 
// /**
//  * Show the form for editing the specified resource.
//  *
//  * @param  \App\Product  $product
//  * @return \Illuminate\Http\Response
//  */
// public function edit($id)
// {   
//     $where = array('id' => $id);
//     $user  = User::where($where)->first();
 
//     return Response::json($user);
// }

 
    public function show($id)
    {
        $user_id = array('id' => $id);
        $user  = User::where($user_id)->first();
        return view('admin.template.show')->with('user' , $user);
    }


 
 
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Product  $product
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    $user = User::where('id',$id)->delete();
 
    return Response::json($user);
}

    // public function anyData()
    // {
    //     return Datatables::of(User::query())
       
    //     ->setRowId(function ($user) {
    //         return $user->id;
    //     })
    //     ->editColumn('created_at' , function(User $user){
    //       return  $user->created_at->diffForHumans();
    //     })
        
    //     ->setRowAttr(['align' => 'center'])
    //     ->addColumn('show' , 'admin.datatabledesign.show-btn')
    //     ->addColumn('delete' , 'admin.datatabledesign.delete-btn')
    //     ->rawColumns(['show' , 'delete'])
    //     ->toJson();
    //     // ->make(true);
    // }
}
