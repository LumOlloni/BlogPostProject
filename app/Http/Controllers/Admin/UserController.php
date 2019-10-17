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

}
