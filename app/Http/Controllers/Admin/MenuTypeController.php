<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MenuType;
use Auth;
use Session;

class MenuTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Manager']);
    }
    
    public function index()
    {
        $types = MenuType::orderby('id', 'desc')->get();
        return view('admin.menutypes.index', compact('types'));
    }

    public function store(Request $request)
    {
        $type = new MenuType;
        $type->name = $request->input('name');
        $type->save();
        Session::flash('success', 'New Menu Type Saved Successfully.');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $type = MenuType::find($id);
        $type = MenuType::where('id',$id)->first();
        $type->name = $request->input('name');
        $type->save();
        Session::flash('success', 'Menu Type Updated Successfully.');
        return redirect()->route('menutypes.index');
    }

    public function destroy($id)
    {
        $type = MenuType::findOrFail($id);
        $type->delete();
        return response()->json('data deleted successfully.');
    }

    public function updatenamesajax(Request $request, $id)
    {
        $type = MenuType::where('id',$id)->first();
        $type->name = $request->value;
        $type->save();
    }
}
