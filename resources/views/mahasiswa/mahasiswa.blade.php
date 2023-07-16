@extends('layout.master')


@section('konten')
<div class="page-header">

    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        Mahasiswa
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
                <h4 class="card-title">Daftar Mahasiswa</h4>
                @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                </div>
                @endif
                @error('username')
                <div class="alert alert-danger mt-2" role="alert">
                    {{$message}}
                </div>
                @enderror

                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-danger text-center">
                                <th> No</th>
                                <th> Nama </th>
                                <th> Alamat </th>
                                <th> Jumlah Kompensasi </th>
                                <th> ID Fingerprint </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr class="text-center">
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->nama}} </td>
                                <td> {{$item->alamat}} </td>
                                @if($item->jumlahkompen == null)
                                <td>-</td>
                                @endif
                                @if($item->jumlahkompen != null)
                                <td>{{$item->jumlahkompen}}</td>
                                @endif

                                <td>
                                    @if($item->finger == null)
                                    <div class="d-flex justify-content-sm-center mt-2">
                                        <a href="/request_finger?id={{$item->id}}" class="btn btn-info" onclick="return confirm('Apakah anda setuju ?')" >Daftar Fingerprint</a>
                                    </div>
                                    @else
                                    <p>Terdaftar Fingerprint</p>
                                    @endif
                                    
                                </td>
                                <td class="align-middle text-center">

                                    <div class="d-flex justify-content-sm-center mt-2">
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editMahasiswa{{$item->id}}">Edit Kompensasi</button>
                                    </div>
                                </td>
                            </tr>
                            <!-- EDIT Modal -->
                            <div class="modal fade" id="editMahasiswa{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="card-title">Edit Jam Kompensasi</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="/editkompen" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="exampleTextarea1">Jumlah Kompensasi</label>
                                                    <input class="form-control" name="kompen" type="number" value="{{$item->kompen}}" id="exampleTextarea1">
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
        </div>
    </div>

</div>

@endsection