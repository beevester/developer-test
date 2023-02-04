<?php

namespace App\Http\Controllers;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserListing extends Controller
{

    // Index Page for Users
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    public function __construct(
        UserRepository       $userRepository,
        RoleRepository       $roleRepository,
        PermissionRepository $permissionRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $users = $this->userRepository->usersIndex();

        $params = [
            'title' => 'Users Listing',
            'users' => $users,
        ];

        return view('users.users_list')->with($params);
    }

    public function create()
    {
        $roles = $this->roleRepository->all();

        $params = [
            'title' => 'Create UserSeeder',
            'roles' => $roles,
        ];

        return view('users.users_create')->with($params);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = $this->userRepository->createUser(
            $request->input('first_name'),
            $request->input('last_name'),
            $request->input('email'),
            bcrypt($request->input('password'))
        );

        $role = $this->roleRepository->findById($request->input('role_id'));

        $user->attachRole($role);

        return redirect()->route('users.index')->with('success', "The user <strong>$user->name</strong> has successfully been created.");
    }

    public function show($id)
    {
        try {
            $user = $this->userRepository->findById($id);
            $roles = $this->roleRepository->findById($id);
            $params = [
                'title' => 'UserSeeder Details',
                'user' => $user,
                'roles' => $roles,
            ];

            return view('users.user_view')->with($params);
        } catch (ModelNotFoundException $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function edit($id)
    {
        try {
            $user = $this->userRepository->findById($id);
            $roles = $this->roleRepository->all();
            $permissions = $this->permissionRepository->all();
            $params = [
                'title' => 'Edit UserSeeder',
                'user' => $user,
                'roles' => $roles,
                'permissions' => $permissions,
            ];

            return view('users.users_edit')->with($params);
        } catch (ModelNotFoundException $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = $this->userRepository->findById($id);

            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
            ]);

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');

            // Update permission of the user

            return redirect()->route('users.index')->with('success', "The user <strong>$user->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Remove UserSeeder from DB with detaching Role
    public function destroy($id)
    {
        try {
            $this->userRepository->delete($id);

        } catch (ModelNotFoundException $e) {

            if ($e instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        } catch (\Exception $e) {
            dump($e);
        }
    }
}
