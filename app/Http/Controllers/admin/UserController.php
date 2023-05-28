<?php

namespace App\Http\Controllers\admin;

use App\Http\constants\CacheConstant;
use App\Http\constants\Constants;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page=$request->page?? 0;
        $users = Cache::remember('adminShowUsers_'.$page,CacheConstant::ONE_DAY,function (){
            return User::latest()->paginate(Constants::PAGINATION_DEFAULT);
        });
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'sometimes|required|string|max:100|unique:users',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|max:255|unique:users',
            'password' => "sometimes|required|min:8|string",
            'address' => "nullable|string|max:2000",
            'phone' => 'required|string|regex:/^09([0-9])[0-9]{8}/'
        ]);

        User::create([
            'name' => $request->name ?? $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roll' => $request->role,
            'status' => $request->status,
            'address' => $request->address,
            'phone' => $request->phone
        ]);
        // remove cache
        forGetCache('adminShowUsers_');
        return redirect()->route('admin.user.index')->with('message', [
            'type' => 'success',
            'body' => 'کاربر با موفقیت ایجاد گردید.'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:users,name,' . $user->id,
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|max:255|unique:users,email,' . $user->id,
            'password' => "required|min:8|string",
            'address' => "nullable|string|max:2000",
            'phone' => 'required|string|regex:/^09([0-9])[0-9]{8}/'
        ]);


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->Password),
            'roll' => $request->role,
            'status' => $request->status,
            'address' => $request->address,
            'phone' => $request->phone
        ]);
        // remove cache
        forGetCache('adminShowUsers_');
        return redirect()->route('admin.user.index')->with('message', [
            'type' => 'success',
            'body' => 'کاربر با موفقیت ویرایش گردید.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        // remove cache
        forGetCache('adminShowUsers_');
        return redirect()->route('admin.user.index')->with('message', [
            'type' => 'success',
            'body' => 'کاربر با موفقیت حذف گردید.'
        ]);
    }
}
