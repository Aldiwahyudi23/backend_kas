@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="true">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-data-diri-tab" data-toggle="pill" href="#custom-tabs-one-data-diri" role="tab" aria-controls="custom-tabs-one-data-diri" aria-selected="false">Data Diri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-data-ayah-tab" data-toggle="pill" href="#custom-tabs-one-data-ayah" role="tab" aria-controls="custom-tabs-one-data-ayah" aria-selected="false">Data Ayah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-data-ibu-tab" data-toggle="pill" href="#custom-tabs-one-data-ibu" role="tab" aria-controls="custom-tabs-one-data-ibu" aria-selected="false">Data Ibu</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DATA DIRI</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="text-center">
                                    <a href="{{ asset($data_pribadi->foto) }}" data-toggle="lightbox" data-title="Foto Profile {{ Auth::user()->name }}" data-gallery="gallery" data-footer=' <form action="{{ Route('data-warga.update', Crypt::encrypt($data_pribadi->id)) }}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}<input type="file" class="form-control"  name=" foto" id="foto"> <input type="hidden" class="form-control" name=" user" id="user" value=""> <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-file-upload"></i> </button></form>'>
                                        <img src="{{ asset( $data_pribadi->foto) }}" width="130px" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                                    </a>
                                </div>
                                <h3 class="profile-username text-center">{{ $data_pribadi->nama }}</h3>
                                <h5 class="profile-username text-center">( {{ Auth::user()->name }} )</h5>
                                <!-- <p class="text-muted text-center">{{ Auth::user()->role }}</p> -->
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>No INduk</b> <a class="float-right">{{ $data_pribadi->id }}</a>
                                    </li>
                                </ul>
                                <table id="example1" class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{$data_pribadi->nama}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelammin</td>
                                            <td>:</td>
                                            <td>{{$data_pribadi->jenis_kelamin}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tempat, Tgl Lahir</td>
                                            <td>:</td>
                                            <td>{{$data_pribadi->tempat_lahir}}, {{$data_pribadi->tanggal_lahir}}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>{{$data_pribadi->alamat}}</td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>:</td>
                                            <td>{{$data_pribadi->agama}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:</td>
                                            <td>{{$data_pribadi->status}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status Pernikahan</td>
                                            <td>:</td>
                                            <td>{{$data_pribadi->status_pernikahan}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- /.table-body -->

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-data-diri" role="tabpanel" aria-labelledby="custom-tabs-one-data-diri-tab">
                        @include('profile.form_profile.form_pribadi')
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-data-ayah" role="tabpanel" aria-labelledby="custom-tabs-one-data-ayah-tab">
                        @if($cek_data_ayah->count() == false)
                        <div class="card card-light card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-cek-data-tab" data-toggle="pill" href="#custom-tabs-one-cek-data" role="tab" aria-controls="custom-tabs-one-cek-data" aria-selected="true">Cek Data Ayah Yang Sudah Ada</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-input-tab" data-toggle="pill" href="#custom-tabs-one-input" role="tab" aria-controls="custom-tabs-one-input" aria-selected="true">Input Data Ayah</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-cek-data" role="tabpanel" aria-labelledby="custom-tabs-one-cek-data-tab">
                                        <form action="{{Route('data-hubungan-warga.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-body">
                                                    <center>
                                                        <h5 class="text-bold card-header bg-light p-0"> INPUT DATA AAYAH</h5>
                                                    </center>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="hubungan_id">Jenis Kelamin</label>
                                                        <select id="hubungan_id" name="hubungan_id" class="select3bs4 form-control col-12 @error('hubungan_id') is-invalid @enderror">
                                                            @if(old('hubungan_id') == true)
                                                            <option value="{{old('hubungan_id')}}">{{old('hubungan_id')}}</option>
                                                            @endif
                                                            <option value="">-- Pilih Keluarga --</option>
                                                            @foreach($data_warga_ayah as $data)
                                                            <option value="{{$data->id}}">{{$data->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('hubungan_id')
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                        @enderror
                                                        <input type="hidden" name="warga_id" id="warga_id" value="{{$data_pribadi->id}}">
                                                        <input type="hidden" name="hubungan" id="hubungan" value="Ayah">
                                                        <hr>
                                                        <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambahkan Ayah</button>
                                                        <div id="tombol_proses"></div>
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade show" id="custom-tabs-one-input" role="tabpanel" aria-labelledby="custom-tabs-one-input-tab">
                                        @include('profile.form_profile.form_input_data')
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        @include('profile.form_profile.form_ayah')
                        @endif
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-data-ibu" role="tabpanel" aria-labelledby="custom-tabs-one-data-ibu-tab">
                        @if($cek_data_ibu->count() == false)
                        <div class="card card-light card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-cek-ibu-tab" data-toggle="pill" href="#custom-tabs-one-cek-ibu" role="tab" aria-controls="custom-tabs-one-cek-ibu" aria-selected="true">Cek Data Ibu Yang Sudah Ada</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-input-ibu-tab" data-toggle="pill" href="#custom-tabs-one-input-ibu" role="tab" aria-controls="custom-tabs-one-input-ibu" aria-selected="true">Input Data Ibu</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-cek-ibu" role="tabpanel" aria-labelledby="custom-tabs-one-cek-ibu-tab">
                                        <form action="{{Route('data-hubungan-warga.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-body">
                                                    <center>
                                                        <h5 class="text-bold card-header bg-light p-0"> INPUT DATA IBU</h5>
                                                    </center>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="hubungan_id">Jenis Kelamin</label>
                                                        <select id="hubungan_id" name="hubungan_id" class="select3bs4 form-control col-12 @error('hubungan_id') is-invalid @enderror">
                                                            @if(old('hubungan_id') == true)
                                                            <option value="{{old('hubungan_id')}}">{{old('hubungan_id')}}</option>
                                                            @endif
                                                            <option value="">-- Pilih Keluarga --</option>
                                                            @foreach($data_warga_ibu as $data)
                                                            <option value="{{$data->id}}">{{$data->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('hubungan_id')
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                        @enderror
                                                        <input type="hidden" name="warga_id" id="warga_id" value="{{$data_pribadi->id}}">
                                                        <input type="hidden" name="hubungan" id="hubungan" value="Ibu">
                                                        <hr>
                                                        <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambahkan Ibu</button>
                                                        <div id="tombol_proses"></div>
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade show" id="custom-tabs-one-input-ibu" role="tabpanel" aria-labelledby="custom-tabs-one-input-ibu-tab">
                                        @include('profile.form_profile.form_input_data')
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        @include('profile.form_profile.form_ibu')
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- /.row -->
@endsection

@section('script')
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataKeluarga").addClass("active");
</script>

@endsection