<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $data = User::where('role',2)->get();
        return view('dosen.dosen',[
            'data' =>$data
        ]);
    }


    public function store(Request $request)
    {

        $validatedData = $request->all();
        $validatedData = $request->validate([
            'email' => ['required', 'min:5', 'max:255', 'unique:users'],
            'password' => ['required', 'min:5'],
        ]);

        if ($request->password != $request->confirm_password) {
            notify()->error('Password tidak sama');
            return redirect('/dosen');
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
        $post['role'] = 2;

        //create pada tabel user
        $register = User::create($post);
        //create pada tabel admin


        notify()->success('Pendaftaran berhasil');
        return redirect('/dosen');
    }

    public function edit(Request $request)
    {

        $validatedData = $request->all();
        $validatedData = $request->validate([
            'email' => ['required', 'min:5', 'max:255']        ]);

        if ($request->password != $request->confirm_password) {
            notify()->error('Password tidak sama');
            return redirect('/dosen');
        }

        $post['nama'] = $request->nama;
        $post['nip'] = $request->nip;
        $post['telegram'] = $request->telegram;
        $post['tanggal_lahir'] = $request->tanggal_lahir;
        $post['tempat_lahir'] = $request->tempat_lahir;
        $post['alamat'] = $request->alamat;
        $post['email'] = $request->email;

        //create pada tabel user
        $register = User::where('id',$request->id)->update($post);
        //create pada tabel admin


        notify()->success('Edit berhasil');
        return redirect('/dosen');
    }

    public function delete(Request $request)
    {
        $data = User::where('id', $request->id)->delete();

        notify()->success('Berhasil di hapus', 'Kegiatan');
        return redirect('/dosen');
    }
}
