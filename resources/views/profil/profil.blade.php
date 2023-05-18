@extends('layout.master')


@section('konten')
<div class="page-header">

  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-home"></i>
    </span>
    Profil
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
        @if(auth()->user()->role == 1)
        <h4 class="card-title">Profil Mahasiswa</h4>
        @endif
        @if(auth()->user()->role == 0)
        <h4 class="card-title">Profil Admin</h4>
        @endif
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
        <br>
        <form class="forms-sample" method="POST" action="/update_profil_admin">
          <input type="hidden" name="id" value="{{auth()->user()->id}}">
          @csrf
          <div class="form-group">
            <label for="exampleInputName1">Nama </label>
            <input type="text" class="form-control" required value="{{auth()->user()->nama}}" disabled>
          </div>
          <div class="form-group">
            @if(auth()->user()->role ==1)
            <label for="exampleInputName1">NIM </label>
            @endif
            @if(auth()->user()->role ==0)
            <label for="exampleInputName1">NIP </label>
            @endif
            <input type="text" class="form-control" required value="{{auth()->user()->nip}}" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputName1">Jenis Kelamin </label>
            <input type="text" class="form-control" required value="{{auth()->user()->jenis_kelamin}}" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputName1">Nomor Telegram </label>
            <input type="text" class="form-control" required value="{{auth()->user()->telegram}}" disabled>
          </div>
          @if(auth()->user()->role ==1)
          <div class="form-group">
            <label for="exampleInputName1">Jumlah Kompen </label>
            <input type="text" class="form-control" required value="{{auth()->user()->kompen}}" disabled>
          </div>

          @endif

          <div class="form-group">
            <label for="exampleInputEmail3">Email address</label>
            <input type="email" name="email" class="form-control" value="{{old('email',auth()->user()->email)}}" required id="exampleInputEmail3" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword4">Ubah Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

@endsection