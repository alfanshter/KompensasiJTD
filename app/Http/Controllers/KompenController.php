<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kompen;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KompenController extends Controller
{
    public function editkompen(Request $request)
    {
        $data = User::where('id', $request->id)->update([
            'jumlahkompen' => $request->kompen
        ]);

        notify()->success('Edit kompen berhasil');
        return redirect('/mahasiswa');
    }

    public function kompenmahasiswa()
    {
        $kegiatan = Kegiatan::where('is_status', 0)->get();
        $data = Kompen::where('id_user', auth()->user()->id)
            ->with('kegiatan')
            ->get();

        return view('kompen.kompenmahasiswa', [
            'data' => $data,
            'kegiatan' => $kegiatan
        ]);
    }

    public function kompenadmin()
    {
        $data = Kompen::orderBy('is_status', 'ASC')
            ->with('mahasiswa')
            ->get();
        return view('kompen.kompenadmin', [
            'data' => $data
        ]);
    }

    public function ajukankompen(Request $request)
    {

        //cek nomor telegram
        $telegram = auth()->user()->telegram;
        $first_telegram = substr($telegram, 0, 2);
        $second_telegram = substr($telegram, 0, 3);
        if ($first_telegram == '08') {
            $new_telegram = substr($telegram, 2);
            $telegram = '%2B628' . $new_telegram;
        } else if ($second_telegram == '+62') {
            $telegram = $telegram;
        } else {
            notify()->error('Pengajuan gagal, Nomor telegram tidak sesuai');
            return redirect('/kompenmahasiswa');
        }


        $post = $request->except(['_token']);
        $post['id_user'] = auth()->user()->id;
        $data = Kompen::create($post);
        $update = Kegiatan::where('id', $post['kegiatan_id'])->update([
            'is_status' => 1
        ]);


        // $str1 = substr($str, 2);
        //cek kegiatan 
        $kegiatan = Kegiatan::where('id', $request->kegiatan_id)->first();
        //kirim ke bot telegram 
        $text = auth()->user()->nama . ' telah mengajukan kompen ' . $kegiatan->kegiatan . ' jumlah ' . $kegiatan->jam . ' jam';
        $linktelegram = urlencode('\n t.me/' . $telegram);
        $sendmessage = Http::get('https://api.telegram.org/bot5926746981:AAGZ23-t-M5deho8u6camRWnEETzKXUBgXQ/sendMessage?chat_id=1026793676&text=' . $text . 'Silahkan konfirmasi ke nomor ' . $linktelegram);
        notify()->success('Pengajuan berhasil, Tunggu konfirmasi dari admin');
        return redirect('/kompenmahasiswa');
    }

    public function batalkompen(Request $request)
    {

        $data = Kompen::where('id', $request->id)->delete();

        $update = Kegiatan::where('id', $request->kegiatan_id)->update([
            'is_status' => 0
        ]);

        notify()->success('Kompen dibatalkan', 'Kompen');
        return redirect('/kompenmahasiswa');
    }

    public function terimakompen(Request $request)
    {

        $update = Kompen::where('id', $request->id)->update([
            'is_status' => 1
        ]);
        //kirim notifikasi ke telegram
        //kirim ke bot telegram .
        $nama = $request->nama;
        $nim = $request->nip;
        $pekerjaan = $request->pekerjaan;
        $jam = $request->jam;
        $linktelegram = "Admin+telah+menyetujui+kompen+mahasiswa 
Nama : $nama
NIM : $nim 
Pekerjaan : $pekerjaan 
Jumlah Jam : $jam";
        $sendmessage = Http::get('https://api.telegram.org/bot5842590995:AAElX8rcw1b357sqHQO6M6U121gZc69vGlw/sendMessage?chat_id=1026793676&text=' . $linktelegram);

        notify()->success('Kompen diterima', 'Kompen');
        return redirect('/kompenadmin');
    }

    public function tolakkompen($id)
    {
        $update = Kompen::where('id', $id)->update([
            'is_status' => 2
        ]);

        notify()->success('Kompen ditolak', 'Kompen');
        return redirect('/kompenadmin');
    }

    function printpdf(Request $request)
    {

        $kompen = Kompen::where('id', $request->id)
            ->with('kegiatan')
            ->with('mahasiswa')
            ->first();

        $pdf = Pdf::loadView('pdf.pdf', [
            'kompen' => $kompen
        ])
            ->setPaper('a4', 'potrait');

        return $pdf->stream();
    }
}
