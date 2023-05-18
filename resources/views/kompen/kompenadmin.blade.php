@extends('layout.master')


@section('konten')
<div class="page-header">

    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        Pengajuan Kompen
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview
                <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-danger text-center">
                                <th> No</th>
                                <th> Nama</th>
                                <th> NIM</th>
                                <th> Kegiatan </th>
                                <th> Jumlah Jam </th>
                                <th> Status </th>
                                <th> Telegram </th>
                                <th> Tanggal </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr class="text-center">
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->mahasiswa->nama}} </td>
                                <td> {{$item->mahasiswa->nip}} </td>
                                <td> {{$item->kegiatan->kegiatan}} </td>
                                <td> {{$item->kegiatan->jam}} </td>
                                @if($item->is_status == 0)
                                <td>Menunggu Konfirmasi</td>
                                @endif
                                @if($item->is_status == 1)
                                <td>di ACC</td>
                                @endif
                                @if($item->is_status == 2)
                                <td>Ditolak</td>
                                @endif
                                @if($item->is_status == 3)
                                <td>Selesai</td>
                                @endif
                                <td>{{$item->mahasiswa->telegram}}</td>

                                <td>{{$item->tanggal}}|{{$item->waktu}}</td>
                                
                                @if($item->is_status == 0)
                                <td class="align-middle text-center">

                                    <div class="d-flex justify-content-sm-center mt-2">
                                        <div class="d-flex justify-content-sm-center mt-2">
                                            <form action="/terimakompen" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <button type="submit" onclick="return confirm('Apakah anda akan menerima kompen ?')" class="btn btn-primary" style="margin-left: 10px">Terima</button>
                                            </form>
                                            <a href="/tolakkompen/{{$item->id}}" onclick="return confirm('Apakah anda akan menolak kompen ?')" class="btn btn-danger" style="margin-left: 10px">Tolak</a>
                                        </div>
                                    </div>
                                </td>
                                @endif

                            </tr>
                            @endforeach



                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection