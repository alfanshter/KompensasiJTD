<?php

namespace App\Http\Controllers;

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
}
