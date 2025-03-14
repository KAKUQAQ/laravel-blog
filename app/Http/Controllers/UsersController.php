<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show','create','store']]);
        $this->middleware('guest', ['only' => ['create']]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create(): Factory|View|Application
    {
        return view('users.create');
    }

    public function show(User $user): Factory|View|Application
    {
        $statuses = $user->statuses()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('users.show', compact('user', 'statuses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
        $activationToken = User::generateActivationToken();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_token' => $activationToken,
            'activated' => false
        ]);

        //链接到日志
        $activationLink = route('user.activate', ['token' => $activationToken]);
        Log::info("用户注册：{$user->email},激活链接：{$activationLink}");
        return redirect()->route('users.show', $user->id)->with('success', 'Signup was successful! Welcome!');
    }
    public function activateUser($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return redirect('/')->withErrors('activation token is invalid');
        }
        $user->update([
            'activation_token' => null,
            'is_active' => true
        ]);

        Auth::login($user);
        return redirect()->route('users.show', $user->id)->with('success', 'Your account has been activated!');
    }

    public function edit(User $user): Factory|View|Application
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|unique:users|max:255',
            'password' => 'nullable|min:6|confirmed'
        ]);
        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success', 'Information update successful!');
        return redirect()->route('users.show', $user->id);
    }

    public function toggleAdmin($id)
    {
        $authUser = auth()->user();

        // 只有 ID = 1 的用户可以操作
        if (!$authUser || $authUser->id !== 1) {
            return redirect()->route('users.index')->with('error', '权限不足');
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', '用户不存在');
        }

        // 不能修改 ID = 1 的超级管理员
        if ($user->id === 1) {
            return redirect()->route('users.index')->with('error', '无法修改超级管理员权限');
        }

        // 切换管理员状态
        $user->is_admin = !$user->is_admin;
        $user->save();

        $message = $user->is_admin ? '用户已成为管理员' : '用户的管理员权限已撤销';
        return redirect()->route('users.index')->with('success', $message);
    }


    public function deleteUser($id)
    {
        $authUser = auth()->user();

        if (!$authUser || !$authUser->isAdmin()) {
            return redirect()->route('users.index')->with('error', '权限不足');
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', '用户不存在');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', '用户已删除');
    }
    /** 激活邮件 */

    public function followings(User $user): Factory|View|Application
    {
        $users = $user->followings()->paginate(10);
        $title = $user->name . '正在关注';
        return view('users.show_follow', compact('users', 'title'));
    }

    public function followers(User $user): Factory|View|Application
    {
        $users = $user->followers()->paginate(10);
        $title = $user->name . '的粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }

}
