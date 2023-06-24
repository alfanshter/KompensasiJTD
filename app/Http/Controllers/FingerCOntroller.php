<?php

namespace App\Http\Controllers;

use App\Models\Kompen;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Contract\Database;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Symfony\Component\HttpFoundation\Response;

class FingerCOntroller extends Controller
{

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function daftar_finger(Request $request)
    {
        $database = Firebase::database();
        $data = $database->getReference('fingerprint/daftar')->getSnapshot()->getValue();

        $user = User::where('id', $data['uid'])->update([
            'finger' => $request->finger
        ]);

        $database->getReference('fingerprint/status')->set(1);


        $response = [
            'message' => 'Pendaftaran Berhasil',
            'data' => $user,
            'status' => 1,
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }
    public function request_finger(Request $request)
    {
        //is finger=  0 =>daftar fingerprint
        //is finger=  1 =>ambil fingerprint


        $user = User::where('id', $request->input('id'))->first();
        $database = Firebase::database();
        $database->getReference('fingerprint/status')->set(0);
        $database->getReference('fingerprint/daftar')
            ->set([
                'uid' => (int)$request->input('id'),
                'nama' => $user->nama
            ]);

        notify()->success('Silahkan cek alat fingerprint', 'Mahasiswa');
        return redirect('/mahasiswa');
    }

    public function post_fingerprint(Request $request)
    {
        $data = User::where('id', $request->uid)->update([
            'finger' => $request->id_finger
        ]);

        $response = [
            'message' => 'berhasil update',
            'data' => $data,
            'status' => 1,
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    function request_absen(Request $request)
    {

        $user = User::where('id', $request->input('id'))->first();
        $database = Firebase::database();
        $database->getReference('fingerprint/status')->set(2);
        $database->getReference('fingerprint/absen')
            ->set([
                'uid' => (int)auth()->user()->id,
                'nama' => auth()->user()->nama,
                'finger' => (int)auth()->user()->finger,
                'id_kompen' => (int)$request->input('id'),
                'pekerjaan' => $request->pekerjaan,
                'jam' => $request->jam
            ]);

        notify()->success('Silahkan cek alat fingerprint', 'Mahasiswa');
        return redirect('/kompenmahasiswa');
    }

    function absen(Request $request)
    {
        $database = Firebase::database();
        $data = $database->getReference('fingerprint/absen')->getSnapshot()->getValue();

        if ($request->finger == $data['finger']) {
            //cek user
            $user = User::where('finger', $data['finger'])->first();

            if ($user != null) {
                //cek nomor telegram
                $telegram = $user->telegram;
                $first_telegram = substr($telegram, 0, 2);
                $second_telegram = substr($telegram, 0, 3);
                if ($first_telegram == '08') {
                    $new_telegram = substr($telegram, 2);
                    $telegram = '%2B628' . $new_telegram;
                } else if ($second_telegram == '+62') {
                    $telegram = $telegram;
                } else {
                    $response = [
                        'message' => 'Nomor telegram salah',
                        'status' => 0,
                        'data' => $user
                    ];
                    return response()->json($response, Response::HTTP_OK);
                }

                $kompen = Kompen::where('id', $data['id_kompen'])->update([
                    'is_status' => 3,
                    'tanggal_absen' => Carbon::now()
                ]);

                //kirim telegram
                $nama = $data['nama'];
                $pekerjaan = $data['pekerjaan'];
                $jam = $data['jam'];
                $linktelegram = "$nama telah melakukan absen kompen dengan pekerjaan $pekerjaan jumlah $jam Jam";
                $sendmessage = Http::get('https://api.telegram.org/bot5926746981:AAGZ23-t-M5deho8u6camRWnEETzKXUBgXQ/sendMessage?chat_id=1026793676&text=' . $linktelegram);
              
                $database->getReference('fingerprint/status')->set(1);

                $response = [
                    'message' => 'Berhasil absen',
                    'status' => 1
                ];
                return response()->json($response, Response::HTTP_OK);

            } else {
                $response = [
                    'message' => 'User tidak ada',
                    'status' => 0,
                    'data' => $user
                ];
                return response()->json($response, Response::HTTP_OK);
            }
        } else {
            $response = [
                'message' => 'ID Finger tidak sama',
                'status' => 0
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

    function request_absen_selesai(Request $request)
    {

        $user = User::where('id', $request->input('id'))->first();
        $database = Firebase::database();
        $database->getReference('fingerprint/status')->set(3);
        $database->getReference('fingerprint/absen')
            ->set([
                'uid' => (int)auth()->user()->id,
                'nama' => auth()->user()->nama,
                'finger' => (int)auth()->user()->finger,
                'id_kompen' => (int)$request->input('id'),
                'pekerjaan' => $request->pekerjaan,
                'jam' => $request->jam
            ]);

        notify()->success('Silahkan cek alat fingerprint', 'Mahasiswa');
        return redirect('/kompenmahasiswa');
    }

    function absen_selesai(Request $request)
    {
        $database = Firebase::database();
        $data = $database->getReference('fingerprint/absen')->getSnapshot()->getValue();

        if ($request->finger == $data['finger']) {
            //cek user
            $user = User::where('finger', $data['finger'])->first();

            if ($user != null) {
                //cek nomor telegram
                $telegram = $user->telegram;
                $first_telegram = substr($telegram, 0, 2);
                $second_telegram = substr($telegram, 0, 3);
                if ($first_telegram == '08') {
                    $new_telegram = substr($telegram, 2);
                    $telegram = '%2B628' . $new_telegram;
                } else if ($second_telegram == '+62') {
                    $telegram = $telegram;
                } else {
                    $response = [
                        'message' => 'Nomor telegram salah',
                        'status' => 0,
                        'data' => $user
                    ];
                    return response()->json($response, Response::HTTP_OK);
                }

                $kompen = Kompen::where('id', $data['id_kompen'])->update([
                    'is_status' => 4,
                    'tanggal_selesai' => Carbon::now()
                ]);

                //kirim telegram
                $nama = $data['nama'];
                $pekerjaan = $data['pekerjaan'];
                $jam = $data['jam'];
                $linktelegram = "$nama telah menyelesaikan pekerjaan $pekerjaan jumlah $jam Jam";
                $sendmessage = Http::get('https://api.telegram.org/bot5926746981:AAGZ23-t-M5deho8u6camRWnEETzKXUBgXQ/sendMessage?chat_id=1026793676&text=' . $linktelegram);
              
                $database->getReference('fingerprint/status')->set(1);

                $response = [
                    'message' => 'Berhasil absen',
                    'status' => 1
                ];
                return response()->json($response, Response::HTTP_OK);

            } else {
                $response = [
                    'message' => 'User tidak ada',
                    'status' => 0,
                    'data' => $user
                ];
                return response()->json($response, Response::HTTP_OK);
            }
        } else {
            $response = [
                'message' => 'ID Finger tidak sama',
                'status' => 0
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

}
