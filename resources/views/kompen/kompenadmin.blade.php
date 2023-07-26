@extends('layout.master')


@section('konten')
<div class="page-header">

    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        Pengajuan Kompensasi
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
                                <td> {{$item->jam}} </td>
                                @if($item->is_status == 0)
                                <td>Menunggu Konfirmasi</td>
                                @endif
                                @if($item->is_status == 1)
                                <td>di ACC</td>
                                @endif
                                @if($item->is_status == 2)
                                <td>di Tolak </td>
                                @endif
                                @if($item->is_status == 3)
                                <td>Sudah absen</td>
                                @endif
                                @if($item->is_status == 4)
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
                                                <input type="hidden" name="nama" value="{{$item->mahasiswa->nama}}">
                                                <input type="hidden" name="telepon" value="{{$item->mahasiswa->telegram}}">
                                                <input type="hidden" name="nip" value="{{$item->mahasiswa->nip}}">
                                                <input type="hidden" name="pekerjaan" value="{{$item->kegiatan->kegiatan}}">
                                                <input type="hidden" name="jam" value="{{$item->kegiatan->jam}}">
                                                <button type="submit" onclick="return confirm('Apakah anda akan menerima kompen ?')" class="btn btn-primary" style="margin-left: 10px">Terima</button>
                                            </form>
                                            <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-danger" style="margin-left: 10px">Tolak</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="/tolakkompen" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="nama" value="{{$item->mahasiswa->nama}}">
                                                            <input type="hidden" name="telepon" value="{{$item->mahasiswa->telegram}}">
                                                            <input type="hidden" name="nip" value="{{$item->mahasiswa->nip}}">
                                                            <input type="hidden" name="pekerjaan" value="{{$item->kegiatan->kegiatan}}">
                                                            <input type="hidden" name="kegiatan_id" value="{{$item->kegiatan_id}}">
                                                            <input type="hidden" name="kegiatan_jam" value="{{$item->kegiatan->jam}}">
                                                            <input type="hidden" name="jam" value="{{$item->jam}}">
                                                            <input type="hidden" name="id" value="{{$item->id}}">

                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleTextarea1">Kenapa anda membatalkan Kompensasi ? </label>
                                                                        <input class="form-control" name="alasan" />
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

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