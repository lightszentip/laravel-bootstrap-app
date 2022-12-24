<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    function __construct()
    {
        //Check permission for this controller all functions
        $this->middleware('can:role list', ['only' => ['index','show']]);
        $this->middleware('can:role create', ['only' => ['create','store']]);
        $this->middleware('can:role edit', ['only' => ['edit','update']]);
        $this->middleware('can:role delete', ['only' => ['destroy']]);
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $roles = (new Role)->newQuery();
        if (request()->has('search')) {
            $roles->where('name', 'Like', '%' . request()->input('search') . '%');
        }
        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $roles->orderBy($attribute, $sort_order);
        } else {
            $roles->latest();
        }
        $roles = $roles->paginate(5);
        return view('admin.role.index',compact('roles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:'.config('permission.table_names.roles', 'roles').',name',
        ]);

        $role = Role::create($request->all());

        if(! empty($request->permissions)) {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('role.index')
            ->with('message','Role created successfully.');
    }

    /**
     * @param Role $role
     * @return Application|Factory|View
     */
    public function show(Role $role): View|Factory|Application
    {
        $permissions = Permission::all();
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');
        return view('admin.role.show', compact('role', 'permissions', 'roleHasPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return Application|Factory|View
     */
    public function edit(Role $role): Application|Factory|View
    {
        $permissions = Permission::all();
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');

        return view('admin.role.edit', compact('role', 'permissions', 'roleHasPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:'.config('permission.table_names.roles', 'roles').',name,'.$role->id,
        ]);

        $role->update($request->all());
        $permissions = $request->permissions ?? [];
        $role->syncPermissions($permissions);

        return redirect()->route('role.index')
            ->with('message','Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role): \Illuminate\Http\RedirectResponse
    {
        $role->delete();

        return redirect()->route('role.index')
            ->with('message','Role deleted successfully');
    }
}
