<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Carbon\Carbon;
use Session;
use DB;

class RoleController extends Controller
{
	public function __construct() {
      $this->middleware(['role:Manager','permission:Administer roles & permissions']);
    }
    
    public function index()
    {
      $roles = Role::orderby('id', 'desc')->get();
      return view('admin.roles.index')->with('roles', $roles);
    }

    public function create()
    {
      $permissions = Permission::all();
      return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
      $this->validate($request, [
          'name'=>'required|unique:roles|max:20',
          'permissions' =>'required',
          ]
      );
      $name = $request['name'];
      $role = new Role();
      $role->name = $name;
      $permissions = $request['permissions'];
      $role->save();
      foreach ($permissions as $permission) {
          $p = Permission::where('id', '=', $permission)->firstOrFail();
          $role = Role::where('name', '=', $name)->first();
          $role->givePermissionTo($p);
      }

      return redirect()->route('roles.index')->with('success', 'Role'. $role->name.' added!');
    }

    public function show($id)
    {
        return redirect('admin.roles.index');
    }

    public function edit($id)
    {
      $role = Role::findOrFail($id);
      $permissions = Permission::all();
      return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
      $role = Role::findOrFail($id);
      $this->validate($request, [
          'name'=>'required|max:10|unique:roles,name,'.$id,
          'permissions' =>'nullable',
      ]);
      $input = $request->except(['permissions']);
      $permissions = $request['permissions'];
      $role->fill($input)->save();
      $p_all = Permission::all();
      foreach ($p_all as $p) {
          $role->revokePermissionTo($p);
      }
      foreach ($permissions as $permission) {
          $p = Permission::where('id', '=', $permission)->firstOrFail();
          $role->givePermissionTo($p);
      }
      return redirect()->route('roles.index')->with('success', 'Role'. $role->name.' updated!');
    }

    public function destroy($id)
    {
      $role = Role::findOrFail($id);
      $role->delete();
      return redirect()->route('roles.index')->with('success', 'Role deleted!');
    }

    public function addPermissionsToRole(Request $request){
    	$this->validate($request, [
	        'name'=>'required|max:40',
	    ]);

	    $names = $request->input('name');
	    
	    $results = collect($names)->map(function ($item, $key) {
            return ['name' => $item];
        })->toArray();

	    $roles = $request->input('roles');
       	$r = Role::where('id', '=', $roles)->firstOrFail();

  		foreach($results as $result) {
  			Permission::create([
                  'name' => $result['name'],
              ]);

              $permission = Permission::where('name', '=', $result['name'])->get();
              $r->givePermissionTo($permission);
  		}

      	return redirect()->route('roles.index')->with('success', 'Permission added!');
    }
}
