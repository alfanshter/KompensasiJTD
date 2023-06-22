@extends('layout.master')


@section('konten')
<div class="page-header">

    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        Kompen
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

                <div class="card-description">
                    <button class="btn btn-rounded btn-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Ajukan
                    </button>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-danger text-center">
                                <th> No</th>
                                <th> Kegiatan </th>
                                <th> Jumlah Jam </th>
                                <th> Status </th>
                                <th> Tanggal </th>
                                <th> Tanggal Absen </th>
                                <th> Tanggal  Selesai</th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr class="text-center">
                                <td> {{$loop->iteration}} </td>
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
                                <td>Sudah Absen Masuk</td>
                                @endif
                                @if($item->is_status == 4)
                                <td>Selesai</td>
                                @endif
                                <td>{{$item->tanggal}}|{{$item->waktu}}</td>
                                <td>{{$item->tanggal_absen}}</td>
                                <td>{{$item->tanggal_selesai}}</td>
                                <td class="align-middle text-center">

                                    <div class="d-flex justify-content-sm-center mt-2">
                                        <div class="d-flex justify-content-sm-center mt-2">
                                            @if($item->is_status == 1)
                                            <form action="/request_absen" method="POST">
                                                @csrf
                                                <input type="hidden" name="kegiatan_id" value="{{$item->kegiatan_id}}">
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <button type="submit" onclick="return confirm('Apakah anda akan melakukan absen kompen ?')" class="btn btn-primary" style="margin-left: 10px">Absen Masuk</button>
                                            </form>
                                            @endif
                                            @if($item->is_status == 3)
                                            <form action="/request_absen_selesai" method="POST">
                                                @csrf
                                                <input type="hidden" name="kegiatan_id" value="{{$item->kegiatan_id}}">
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <button type="submit" onclick="return confirm('Apakah anda akan menyelesaikan kompen ?')" class="btn btn-primary" style="margin-left: 10px">Absen Selesai</button>
                                            </form>
                                            @endif
                                            @if($item->is_status ==0 || $item->is_status ==1 || $item->is_status ==2 || $item->is_status ==3)
                                            <form action="/batalkompen" method="POST">
                                                @csrf
                                                <input type="hidden" name="kegiatan_id" value="{{$item->kegiatan_id}}">
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <button type="submit" onclick="return confirm('Apakah anda akan membatalkan kompen ?')" class="btn btn-danger" style="margin-left: 10px">Batal</button>
                                            </form>
                                            @endif
                                            @if($item->is_status == 4)
                                            <form action="/printpdf" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <button type="submit" onclick="return confirm('Apakah anda akan menyelesaikan kompen ?')" class="btn btn-primary" style="margin-left: 10px">Cetak Bukti</button>
                                            </form>
                                            @endif

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="card-title">Ajukan Kompen</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/kompenmahasiswa" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleTextarea1">Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal" required />
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Waktu</label>
                                    <input class="form-control" type="time" name="waktu" required />
                                </div>

                                <div class="form-group">
                                    <label for="exampleTextarea1">Kegiatan</label>
                                    <select name="kegiatan_id" id="kegiatan_id" class="form-control" required>
                                        <option value="">Pilih Kegiatan...</option>
                                        @foreach ($kegiatan as $kegiatans)
                                        <option value="{{ $kegiatans->id }}">{{ $kegiatans->kegiatan }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="exampleTextarea1">Dosen (Opsional)</label>
                                    <input class="form-control" type="text" placeholder="Masukkan nama dosen" name="dosen" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Ajukan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection