@extends('backend.template_backend.layout')

@section('content')

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">DATA AYAH </h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="text-center">
                        <a href="{{ asset($foto->foto) }}" data-toggle="lightbox" data-title="Foto Profile {{ Auth::user()->name }}" data-gallery="gallery" data-footer=' <form action="{{ Route('data-warga.update', Crypt::encrypt($data_warga->id)) }}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}<input type="file" class="form-control"  name=" foto" id="foto"> <input type="hidden" class="form-control" name=" user" id="user" value=""> <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-file-upload"></i> </button></form>'>
                            <img src="{{ asset( $foto->foto) }}" width="130px" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                        </a>
                    </div>
                    <h3 class="profile-username text-center">{{ $data_warga->nama }}</h3>
                    <!-- <p class="text-muted text-center">{{ Auth::user()->role }}</p> -->
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>No INduk</b> <a class="float-right">{{ $data_warga->id }}</a>
                        </li>
                    </ul>
                    <table id="example1" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{$data_warga->nama}}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelammin</td>
                                <td>:</td>
                                <td>{{$data_warga->jenis_kelamin}}</td>
                            </tr>
                            <tr>
                                <td>Tempat, Tgl Lahir</td>
                                <td>:</td>
                                <td>{{$data_warga->tempat_lahir}}, {{$data_warga->tanggal_lahir}}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{$data_warga->alamat}}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td>{{$data_warga->agama}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{$data_warga->status}}</td>
                            </tr>
                            <tr>
                                <td>Status Pernikahan</td>
                                <td>:</td>
                                <td>{{$data_warga->status_pernikahan}}</td>
                            </tr>

                            @foreach($cek_data_hubungan as $data)
                            <tr>
                                <td>{{$data->hubungan}}</td>
                                <td>:</td>
                                <td>{{$data->data_warga->nama}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- /.table-body -->
                </div>
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h5 class="text-bold card-header bg-light p-2 text-center"> Akun Yang Terkait</h5>
                    </div>
                    <div class="card-body">
                        @if ($data_akun == true)
                        <div class="form-group col-12">
                            <label for="navbar">{{$data_akun->email}}</label>
                        </div>
                        <div class="form-group col-12">
                            <label for="menu">{{$data_akun->role->nama_role}}</label>
                        </div>
                        <div class="form-group col-12">
                            @if($data_akun->is_active == 1)
                            <label for="sider">Aktif</label>
                            @else
                            <label for="sider">Tidak Aktif</label>
                            @endif
                        </div>
                        @else
                        <label for="">Belum ada akun yang terkait, segera daftarkan jika ingin bisa masuk ke aplikasi</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection