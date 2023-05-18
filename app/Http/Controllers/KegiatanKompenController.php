<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanKompenController extends Controller
{
    public function index()
    {
        $data = Kegiatan::where('is_status',0)->orderBy('created_at','DESC')->get();
        return view('kegiatan.kegiatan',[
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {

        $post = [
            'kegiatan' => $request->kegiatan,
            'jam' => $request->jam
        ];
        $data = Kegiatan::create($post);
        notify()->success('Berhasil di input','Kegiatan');
        return redirect('/kegiatan');

        
    }

    public function update(Request $request)
    {
        $data = Kegiatan::where('id',$request->id)->update([
            'kegiatan' => $request->kegiatan,
            'jam' => $request->jam,
        ]);

        notify()->success('Berhasil di update','Kegiatan');
        return redirect('/kegiatan');
    }

    public function delete(Request $request)
    {
        $data = Kegiatan::where('id',$request->id)->delete();

        notify()->success('Berhasil di hapus','Kegiatan');
        return redirect('/kegiatan');
    }
}
