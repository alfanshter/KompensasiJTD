<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Symfony\Component\HttpFoundation\Response;

class FingerCOntroller extends Controller
{

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function request_finger(Request $request)
    {
        //is finger=  0 =>daftar fingerprint
        //is finger=  1 =>ambil fingerprint


        $user = User::where('id',$request->input('id'))->first();
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
        $data = User::where('id',$request->uid)->update([
            'finger' => $request->id_finger
        ]);

        $response = [
            'message' => 'berhasil update',
            'data' => $data,
            'status' => 1,
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    function request_absen(Request $request) {
        
        $user = User::where('id',$request->input('id'))->first();
        $database = Firebase::database();
        $database->getReference('fingerprint/status')->set(2);
        $database->getReference('fingerprint/absen')
            ->set([
                'uid' => (int)auth()->user()->id,
                'nama' => auth()->user()->nama
            ]);

        notify()->success('Silahkan cek alat fingerprint', 'Mahasiswa');
        return redirect('/kompenmahasiswa');
    }

    function request_absen_selesai(Request $request) {
        
        $user = User::where('id',$request->input('id'))->first();
        $database = Firebase::database();
        $database->getReference('fingerprint/status')->set(3);
        $database->getReference('fingerprint/absen')
            ->set([
                'uid' => (int)auth()->user()->id,
                'nama' => auth()->user()->nama
            ]);

        notify()->success('Silahkan cek alat fingerprint', 'Mahasiswa');
        return redirect('/kompenmahasiswa');
    }
}
