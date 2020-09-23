<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {

        if(Auth::check() === true) {
            return redirect()->route('admin.home');
        }
        return view('admin.index');
    }

    public function home()
    {
        if(session()->get('valid')){
            $navItems = array();
            $navItems['sel1'] = '';
            $navItems['sel2'] = 'active';
            $navItems['data1'] = '';
            $navItems['data2'] = 'show active';
        } else {
            $navItems = array();
            $navItems['sel1'] = 'active';
            $navItems['sel2'] = '';
            $navItems['data1'] = 'show active';
            $navItems['data2'] = '';
        }

        session()->forget('valid');

        $companies = Company::paginate(10);
        $companies->onEachSide(5)->links();
        $employees = Employee::all();
        return view('admin.home', [
            'companies' => $companies,
            'employees' => $employees,
            'navItems' => $navItems
        ]);
    }

    public function login(Request $request)
    {
        if(in_array('', $request->only('email', 'password'))) {
            $json['message'] = 'Informe todos os dados para efetuar o login';
            return  redirect()->route('admin.login');
        }

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $json['message'] = 'Informe um e-mail valido';
            return  redirect()->route('admin.login');
        }

        $cretentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(!Auth::attempt($cretentials)){
            return  view('admin.index', [
                'message' => 'Senha ou e-mail não conferem'
            ]);
        }

        $this->authenticated();
        return  redirect()->route('admin.login');
    }

    private function authenticated()
    {
        $user = User::where('id', Auth::user()->id);
        $user->update([
            'last_login_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }


}
