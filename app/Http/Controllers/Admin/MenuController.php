<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Menu;
use App\MenuType;
use Image;
use Auth;
use Session;
use Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Manager']);
    }

    public function index()
    {
        $items = Menu::orderby('id', 'desc')->get();
        $types = MenuType::all();
        return view('admin.menus.index', compact('items', 'types'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, array(
			'name' => 'required',
			'price' => 'required|integer',
			'type_id' => 'required|numeric',
			'photo' => 'required|image',
		));
        $item = new Menu;
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->type_id = $request->input('type_id');
        if ($request->hasFile('photo')) {
          $photo = $request->file('photo');
          $filename = 'MenuItem' . '-' . time() . '.' . $photo->getClientOriginalExtension();
          $location = public_path('images/'. $filename);
          $photo->move('images/', $location);
          $item->photo = $filename;
        }
        $item->save();
        Session::flash('success', 'Menu Item Saved Successfully.');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
		$this->validate($request, array(
			'name' => 'required',
			'price' => 'required|integer',
			'type_id' => 'required|numeric',
			'photo' => 'required',
		));
        $item = Menu::find($id);
        $item = Menu::where('id',$id)->first();
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->type_id = $request->input('type_id');
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = 'MenuItem' . '-' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($photo)->resize(500, 500)->save($location);

            $oldFilename = $item->photo;
            $item->photo = $filename;
            if(!empty($item->photo)){
                Storage::delete($oldFilename);
            }
        }
        $item->save();
        Session::flash('success', 'Menu Item Updated Successfully.');
        return redirect()->route('menus.index');
    }

    public function destroy($id)
    {
        $item = Menu::findOrFail($id);
        if(!empty($item->photo)){
            Storage::delete($item->photo);
        }
        $item->delete();
        return response()->json('data deleted successfully.');
    }

    public function updateitemnames(Request $request, $id)
    {
        $item = Menu::where('id',$id)->first();
        $item->name = $request->value;
        $item->save();
    }

    public function updatepricesajax(Request $request, $id)
    {
        $item = Menu::where('id',$id)->first();
        $item->price = $request->value;
        $item->save();
    }

}
