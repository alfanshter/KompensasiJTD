@extends('layout.master')


@section('konten')
<div class="page-header">

    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        dosen
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
                <div class="card-description">
                    <button class="btn btn-rounded btn-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="card-title">Tambah Kegiatan Kompensasi</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/dosen" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="text" required name="nama" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Nama">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" required class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" required name="nip" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="NIP">
                                        </div>

                                        <div class="form-group">
                                            <select class="form-control text-dark" aria-label="Default select example" name="jenis_kelamin" id="jenis_kelamin">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Perempuan">Perempuan</option>
                                                <option value="Laki - laki">Laki - laki</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" required name="telegram" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="ID Telegram">
                                        </div>

                                        <div class="form-group">
                                            <label for="message-text">Tanggal Lahir:</label>
                                            <input type="date" required name="tanggal_lahir" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Tanggal Lahir">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" required name="tempat_lahir" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Tempat Lahir">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" required name="alamat" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Alamat">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" required class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="confirm_password" required class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Ulangi Password">
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

                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="table-danger text-center">
                                <th> No</th>
                                <th> Nama </th>
                                <th> Alamat </th>
                                <th> NIP</th>
                                <th> ID Telegram </th>
                                <th> Email </th>
                                <th> Tanggal lahir </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr class="text-center">
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->nama}} </td>
                                <td> {{$item->alamat}} </td>
                                <td> {{$item->nip}} </td>
                                <td> {{$item->telegram}} </td>
                                <td> {{$item->email}} </td>
                                <td> {{$item->tanggal_lahir}} </td>
                                <td class="align-middle text-center">

                                    <div class="d-flex justify-content-sm-center mt-2">
                                        <div class="d-flex justify-content-sm-center mt-2">
                                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editdosen{{$item->id}}">Edit</button>
                                            <a href="/hapusdosen/{{$item->id}}" onclick="return confirm('Apakah anda akan menghapus data ?')" class="btn btn-danger" style="margin-left: 10px">Hapus</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- EDIT Modal -->
                            <div class="modal fade" id="editdosen{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="card-title">Edit Jam Kompensasi</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="/editdosen" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="message-text">Nama:</label>
                                                    <input type="text" required name="nama" value="{{$item->nama}}" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Nama">
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text">Email:</label>
                                                    <input type="email" name="email" value="{{$item->email}}" required class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                                                </div>

                                                <div class="form-group">
                                                    <label for="message-text">NIP:</label>
                                                    <input type="text" required name="nip" value="{{$item->nip}}" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="NIP">
                                                </div>

                                                <div class="form-group">
                                                    <label for="message-text">Telegram:</label>
                                                    <input type="text" required name="telegram" value="{{$item->telegram}}" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="ID Telegram">
                                                </div>

                                                <div class="form-group">
                                                    <label for="message-text">Tanggal Lahir:</label>
                                                    <input type="date" required name="tanggal_lahir" value="{{$item->tanggal_lahir}}" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Tanggal Lahir">
                                                </div>

                                                <div class="form-group">
                                                    <label for="message-text">Tempat Lahir:</label>
                                                    <input type="text" required name="tempat_lahir" value="{{$item->tempat_lahir}}" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Tempat Lahir">
                                                </div>

                                                <div class="form-group">
                                                    <label for="message-text">Alamat :</label>
                                                    <input type="text" required name="alamat" class="form-control form-control-lg" value="{{$item->alamat}}" id="exampleInputUsername1" placeholder="Alamat">
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