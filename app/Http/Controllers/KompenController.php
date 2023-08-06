<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kompen;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class KompenController extends Controller
{
    public function editkompen(Request $request)
    {
        $data = User::where('id', $request->id)->update([
            'jumlahkompen' => $request->kompen * 2
        ]);

        notify()->success('Edit kompen berhasil');
        return redirect('/mahasiswa');
    }

    public function kompenmahasiswa()
    {
        $kegiatan = Kegiatan::where('is_status', 0)
        ->with('dosen')
        ->get();
        $data = Kompen::where('id_user', auth()->user()->id)
            ->with('kegiatan')
            ->orderBy('is_status', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('kompen.kompenmahasiswa', [
            'data' => $data,
            'kegiatan' => $kegiatan
        ]);
    }

    public function kompenmahasiswa_api(Request $request)
    {

        $user = User::where('nip', $request->input('nim'))->first();
        $data = Kompen::where('is_status', 4)->where('id_user', $user->id)
            ->with('kegiatan')
            ->get();

        $response = [
            'data' => $data,
            'status' => 1
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function kompenadmin()
    {
        if (auth()->user()->role ==0) {
            $data = Kompen::orderBy('is_status', 'ASC')
            ->with('mahasiswa')
            ->with('kegiatan')
            ->get();
        }else{
            $search = auth()->user()->id;
            $data = Kompen::whereHas('kegiatan', function ($query) use ($search) {
                $query->where('id_user', 'like', '%' . $search . '%');
            })->get();
    
        }

        return view('kompen.kompenadmin', [
            'data' => $data
        ]);
    }

    public function ajukankompen(Request $request)
    {

        //cek jam kompen
        $cekjam = Kegiatan::where('id', $request->kegiatan_id)->first();
        if ((int)$request->jam <= 0 || $request->jam > $cekjam->jam) {
            notify()->error('Pengajuan gagal, Jam harus range 0 sampai jam yang ditentukan admin');
            return redirect('/kompenmahasiswa');
        }
        //cek nomor telegram
        $telegram = auth()->user()->telegram;



        $post = $request->except(['_token']);
        $post['id_user'] = auth()->user()->id;
        $data = Kompen::create($post);

        if ($request->jam == $cekjam->jam) {
            $update = Kegiatan::where('id', $post['kegiatan_id'])->update([
                'is_status' => 1,
                'jam' => $cekjam->jam - $request->jam
            ]);
        } else {
            $update = Kegiatan::where('id', $post['kegiatan_id'])->update([
                'jam' => $cekjam->jam - $request->jam
            ]);
        }


        // $str1 = substr($str, 2);
        //cek kegiatan 
        $kegiatan = Kegiatan::where('id', $request->kegiatan_id)->first();
        //kirim ke bot telegram 
        $text = auth()->user()->nama . ' telah mengajukan kompen ' . $kegiatan->kegiatan . ' jumlah ' . $kegiatan->jam . ' jam';
        $linktelegram = urlencode('\n t.me/' . $telegram);
        $sendmessage = Http::get('https://api.telegram.org/bot5926746981:AAGZ23-t-M5deho8u6camRWnEETzKXUBgXQ/sendMessage?chat_id=962901101&text=' . $text . 'Silahkan konfirmasi ke nomor ' . $linktelegram);
        notify()->success('Pengajuan berhasil, Tunggu konfirmasi dari admin');
        return redirect('/kompenmahasiswa');
    }

    public function batalkompen(Request $request)
    {

        $data = Kompen::where('id', $request->id)->delete();

        $update = Kegiatan::where('id', $request->kegiatan_id)->update([
            'is_status' => 0,
            'jam' => (int)$request->kegiatan_jam + (int)$request->jam
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
        $telegram = $request->telepon;
        $pekerjaan = $request->pekerjaan;
        $jam = $request->jam;
        $linktelegram = "Admin+telah+menyetujui+kompen+mahasiswa 
Nama : $nama
NIM : $nim 
Pekerjaan : $pekerjaan 
Jumlah Jam : $jam";
        $sendmessage = Http::get('https://api.telegram.org/bot5842590995:AAElX8rcw1b357sqHQO6M6U121gZc69vGlw/sendMessage?chat_id=' . $telegram . '&text=' . $linktelegram);

        notify()->success('Kompen diterima', 'Kompen');
        return redirect('/kompenadmin');
    }

    public function tolakkompen(Request $request)
    {
        $update = Kompen::where('id', $request->id)->update([
            'is_status' => 2,
            'alasan' =>$request->alasan
        ]);

        $update = Kegiatan::where('id', $request->kegiatan_id)->update([
            'is_status' => 0,
            'jam' => (int)$request->kegiatan_jam + (int)$request->jam
        ]);

        //kirim ke bot telegram .
        $nama = $request->nama;
        $nim = $request->nip;
        $telegram = $request->telepon;
        $pekerjaan = $request->pekerjaan;
        $jam = $request->jam;
        $alasan = $request->alasan;
        $linktelegram = "Admin+telah+menolak+kompen+mahasiswa 
        Nama : $nama
        NIM : $nim 
        Pekerjaan : $pekerjaan 
        Jumlah Jam : $jam
        Alasan : $alasan";
        $sendmessage = Http::get('https://api.telegram.org/bot5842590995:AAElX8rcw1b357sqHQO6M6U121gZc69vGlw/sendMessage?chat_id=' . $telegram . '&text=' . $linktelegram);



        notify()->success('Kompen ditolak', 'Kompen');
        return redirect('/kompenadmin');
    }

    function printpdf(Request $request)
    {

        $kompen = Kompen::where('id', $request->id)
            ->with('kegiatan')
            ->with('mahasiswa')
            ->first();

        $sisakompensasi = (int)$kompen->mahasiswa->jumlahkompen - (int)$kompen->kegiatan->jam;
        if ($sisakompensasi <=0) {
            $sisakompensasi = 0;
        }
        $pdf = Pdf::loadView('pdf.pdf', [
            'kompen' => $kompen,
            'sisakompensasi' => $sisakompensasi
        ])
            ->setPaper('a4', 'potrait');

        return $pdf->stream();
    }
}
