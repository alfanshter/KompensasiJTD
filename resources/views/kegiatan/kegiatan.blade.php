@extends('layout.master')


@section('konten')
<div class="page-header">

    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        Kegiatan Kompensasi
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
                        Tambah
                    </button>

                </div>

                <table class="table table-bordered ">
                    <thead>
                        <tr class="table-danger text-center">
                            <th> No</th>
                            <th> Kegiatan </th>
                            <th> Jumlah Jam </th>
                            <th> Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr class="text-center">
                            <td> {{$loop->iteration}} </td>
                            <td> {{$item->kegiatan}} </td>
                            <td> {{$item->jam}} </td>

                            <td class="align-middle text-center">

                                <div class="d-flex justify-content-sm-center mt-2">
                                    <div class="d-flex justify-content-sm-center mt-2">
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editkegiatan{{$item->id}}">Edit</button>
                                        <a href="/hapuskegiatan/{{$item->id}}" onclick="return confirm('Apakah anda akan menghapus data ?')" class="btn btn-danger" style="margin-left: 10px">Hapus</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- EDIT Modal -->
                        <div class="modal fade" id="editkegiatan{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="card-title">Edit Jam Kompen</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/editkegiatan" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <div class="modal-body">
                                        <div class="form-group">
                                                <label for="exampleTextarea1">Kegiatan</label>
                                                <input class="form-control" name="kegiatan" value="{{$item->kegiatan}}" >
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleTextarea1">Jumlah Kompen</label>
                                                <input class="form-control" name="jam" type="number" value="{{$item->jam}}" >
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                            </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="card-title">Tambah Kegiatan Kompensasi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/kegiatan" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleTextarea1">Kegiatan</label>
                                    <input class="form-control" name="kegiatan" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Jumlah Jam</label>
                                    <input class="form-control" type="number" name="jam" />
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

@endsection