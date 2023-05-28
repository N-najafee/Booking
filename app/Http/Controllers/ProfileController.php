<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $orders = Order::with(['orderDetails', 'orderDetails.room'])->where('user_id', auth()->id())->get();
        return view('home.profile.order', compact('orders'));
    }

    public function edit(User $user)
    {
        return view('home.profile.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:users,name,' . $user->id,
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|max:255|unique:users,email,' . $user->id,
            'address' => "nullable|string|max:2000",
            'phone' => 'required|regex:/^09([0-9])[0-9*]{8}/'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return redirect()->back()->with('message', [
            'type' => 'success',
            'body' => 'پروفایل با موفقیت ویرایش گردید.'
        ]);
    }
}
