<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;
use App\Http\Requests\RoleFormRequest;
use App\Models\Role;
use Hamcrest\Core\AllOf;
use PhpParser\Builder\Use_;
use Psy\Readline\Hoa\Ustring;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $query = Role::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function (Builder $q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $roles = $query->paginate(5);
        return view('role.index')->with('roles', $roles);
    }
    public function create()
    {
        return view('role.create');
    }

    public function saveOrUpdate(RoleFormRequest $request, Role $role)
    {
        $fields = [
            'name' => $request->name,
        ];

        $role->fill($fields)->save();

        $message = $role->wasRecentlyCreated ? 'Role created succefully' : 'Role updated successfully';

        return redirect()->route('role.index')->with('success', $message);
    }
    public function edit(Role $role)
    {
        return view('role.edit')->with('role', $role);
    }
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return redirect()->route('role.index')->with('success', 'Role deleted successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('role.index')->with('error', 'Cannot delete role Beacuse User is  attached to this Role!');
        }
    }
}
