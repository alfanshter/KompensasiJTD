<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        return view('landingpage.landingpage');
    }
    public function login_view()
    {
        return view('auth.login');
    }


    public function register_view_pelanggan()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $validatedData = $request->all();
        $validatedData = $request->validate([
            'email' => ['required', 'min:5', 'max:255', 'unique:users'],
            'password' => ['required', 'min:5'],
        ]);

        if ($request->password != $request->confirm_password) {
            notify()->error('Password tidak sama');
            return redirect('/register');
        }

        $post['nama'] = $request->nama;
        $post['nip'] = $request->nip;
        $post['jenis_kelamin'] = $request->jenis_kelamin;
        $post['telegram'] = $request->telegram;
        $post['tanggal_lahir'] = $request->tanggal_lahir;
        $post['tempat_lahir'] = $request->tempat_lahir;
        $post['alamat'] = $request->alamat;
        $post['email'] = $request->email;
        $post['password'] = Hash::make($validatedData['password']);
        $post['role'] = 1;

        //create pada tabel user
        $register = User::create($post);
        //create pada tabel admin


        notify()->success('Pendaftaran berhasil');
        return redirect('/login');
    }


    //Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        notify()->error('Login gagal');
        return back();
    }

    //logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profil()
    {
        return view('profil.profil');
    }

    public function mahasiswa()
    {
        $data = User::where('role',1)->get();
        return view('mahasiswa.mahasiswa',[
            'data' =>$data
        ]);
    }
}
