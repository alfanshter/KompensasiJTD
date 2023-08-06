<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Contract\Database;

class KegiatanKompenController extends Controller
{

    public function index()
    {
        if (auth()->user()->role == 0) {
            $data = Kegiatan::where('is_status', 0)->orderBy('created_at', 'DESC')->get();
            return view('kegiatan.kegiatan', [
                'data' => $data
            ]);
    
        }else{
            $data = Kegiatan::where('is_status', 0)->where('id_user',auth()->user()->id)->orderBy('created_at', 'DESC')->get();
            return view('kegiatan.kegiatan', [
                'data' => $data
            ]);
    
        }
    }


    public function store(Request $request)
    {
        if (auth()->user()->role ==0) {
            $post = [
                'kegiatan' => $request->kegiatan,
                'jam' => $request->jam
            ];
            $jam = $request->jam;
            $kegiatan = $request->kegiatan;
            $data = Kegiatan::create($post);
            //kirim telegram
            $linktelegram = "admin telah menambahkan kegiatan kompensasi dengan pekerjaan $kegiatan jumlah $jam Jam";
            $sendmessage = Http::get('https://api.telegram.org/bot5926746981:AAGZ23-t-M5deho8u6camRWnEETzKXUBgXQ/sendMessage?chat_id=-1001944722125&text=' . $linktelegram);
    
            notify()->success('Berhasil di input', 'Kegiatan');
            return redirect('/kegiatan');
        }else{
            $post = [
                'kegiatan' => $request->kegiatan,
                'jam' => $request->jam,
                'id_user' => auth()->user()->id
            ];
            $jam = $request->jam;
            $kegiatan = $request->kegiatan;
            $data = Kegiatan::create($post);
            //kirim telegram
            $linktelegram = "admin telah menambahkan kegiatan kompensasi dengan pekerjaan $kegiatan jumlah $jam Jam";
            $sendmessage = Http::get('https://api.telegram.org/bot5926746981:AAGZ23-t-M5deho8u6camRWnEETzKXUBgXQ/sendMessage?chat_id=-1001944722125&text=' . $linktelegram);
    
            notify()->success('Berhasil di input', 'Kegiatan');
            return redirect('/kegiatan');
        }

    }

    public function update(Request $request)
    {
        $data = Kegiatan::where('id', $request->id)->update([
            'kegiatan' => $request->kegiatan,
            'jam' => $request->jam,
        ]);

        notify()->success('Berhasil di update', 'Kegiatan');
        return redirect('/kegiatan');
    }

    public function delete(Request $request)
    {
        $data = Kegiatan::where('id', $request->id)->delete();

        notify()->success('Berhasil di hapus', 'Kegiatan');
        return redirect('/kegiatan');
    }
}
