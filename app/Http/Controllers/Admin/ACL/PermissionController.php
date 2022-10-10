<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermission;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->repository = $permission;

        $this->middleware(['can:permisssão']);
    }
    
    public function index()
    {
        $permissions = $this->repository->paginate();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(StoreUpdatePermission $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('permissions.index');
    }

    public function edit($id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(StoreUpdatePermission $request, $id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back();
        }

        $permission->update($request->all());

        return redirect()->route('permissions.index');
    }

    public function show($id)
    {
        $permission = $this->repository->find($id);

        if (!$permission) {
            return redirect()->back();
        }

        return view('admin.permissions.show', compact('permission'));
    }

    public function destroy($id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back();
        }
        $permission->delete();

    return redirect()->route('permissions.index');
    }

    public function search(Request $request)
   {
       $filters = $request->except('_token');

       $permissions = $this->repository->search($request->filter);

       return view('admin.pages.permissions.index', [
        'permissions' => $permissions,
        'filters' => $filters,
    ]);
   }

}
