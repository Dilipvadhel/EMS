<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{


    // public function index()
    // {

    //     $users = User::all();
    //     $users = User::paginate(5);
    //     return view('user.index')->with('users', $users);
    // }
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function (Builder $q) use ($search) {
                $q->where('firstname', 'like', '%' . $search . '%')
                    ->orWhere('lastname', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%')
                    ->orWhereHas('role', function (Builder $query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            });
        }
        $users = $query->paginate(5);
        return view('user.index')->with('users', $users);
    }
    public function getUserCount()
    {
        $userCount = User::count();
        return response()->json(['count' => $userCount]);
    }
    public function create()
    {
        $roles = Role::all();
        return view("user.create", ['roles' => $roles]);
    }
    public function saveOrUpdate(UserFormRequest $request, User $user)
{
    $fields = [
        'role_id' => $request->role_id,
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'username' => $request->username,
        'password' => Hash::make($request->password),
    ];

    if ($request->hasFile('profile_picture')) {
        $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $fields['profile_picture'] = $profilePicturePath;
    } else {
        $fields['profile_picture'] = $user->profile_picture;
    }

    $user->fill($fields)->save();
    $message = $user->wasRecentlyCreated ? 'User created successfully' : 'User updated successfully';
    return redirect()->route('user.index')->with('success', $message);
}
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('deleted', 'User deleted successfully!');
    }
}
