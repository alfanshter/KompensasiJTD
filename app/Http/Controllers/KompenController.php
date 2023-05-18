<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kompen;
use App\Models\User;
use Illuminate\Http\Request;

class KompenController extends Controller
{
    public function editkompen(Request $request)
    {
        $data = User::where('id',$request->id)->update([
            'jumlahkompen' => $request->kompen
        ]);

        notify()->success('Edit kompen berhasil');
        return redirect('/mahasiswa');
    }

    public function kompenmahasiswa()
    {
        $kegiatan = Kegiatan::where('is_status',0)->get();
        $data = Kompen::where('id_user',auth()->user()->id)
        ->with('kegiatan')
        ->get();
        return view('kompen.kompenmahasiswa',[
            'data' => $data,
            'kegiatan' => $kegiatan
        ]);
    }

    public function kompenadmin()
    {
        $data = Kompen::orderBy('is_status','ASC')
        ->with('mahasiswa')
        ->get();
        return view('kompen.kompenadmin',[
            'data' => $data
        ]);
    }

    public function ajukankompen(Request $request)
    {
        $post = $request->except(['_token']);
        $post['id_user'] = auth()->user()->id;
        $data = Kompen::create($post);
        $update = Kegiatan::where('id',$post['kegiatan_id'])->update([
            'is_status' =>1
        ]);
        notify()->success('Pengajuan berhasil, Tunggu konfirmasi dari admin');
        return redirect('/kompenmahasiswa');
    }

    public function batalkompen(Request $request)
    {
     
        $data = Kompen::where('id',$request->id)->delete();

        $update = Kegiatan::where('id',$request->kegiatan_id)->update([
            'is_status' =>0
        ]);

        notify()->success('Kompen dibatalkan','Kompen');
        return redirect('/kompenmahasiswa');
    }

    public function terimakompen(Request $request)
    {
        $update = Kompen::where('id',$request->id)->update([
            'is_status' => 1
        ]);

        notify()->success('Kompen diterima','Kompen');
        return redirect('/kompenadmin');


    }

    public function tolakkompen($id)
    {
        $update = Kompen::where('id',$id)->update([
            'is_status' => 2
        ]);

        notify()->success('Kompen ditolak','Kompen');
        return redirect('/kompenadmin');


    }
}
