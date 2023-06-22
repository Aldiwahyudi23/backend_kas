@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <center>
                    <h5 class="text-bold card-header bg-light p-0"> HALAMAN LAYOUT PEMASUKAN</h5>
                </center>
                <hr>

                <form action="{{ Route('layout-halaman-pemasukan.update',Crypt::encrypt($layout_pemasukan->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="tittle">tittle Menu</label>
                        <input type="text" id="tittle" name="tittle" value="{{ old('tittle',$layout_pemasukan->tittle) }}" placeholder="tittle Pemasukan" class="form-control col-12 @error('tittle') is-invalid @enderror">
                        @error('tittle')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="gambar">Gambar Form Pemasukan</label>
                        <input type="file" id="gambar" name="gambar" placeholder="fas fe-call" class="form-control col-12 @error('gambar') is-invalid @enderror">
                        @error('gambar')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>
                    <img src="{{asset($layout_pemasukan->gambar)}}" alt="">
                    <div class="form-group">
                        <label for="info_proses">info_proses</label>
                        <textarea name="info_proses" class="textarea form-control bg-light @error('info_proses') is-invalid @enderror" id="summernote" rows="6" value="{{ old('info_proses') }}">{{ old('info_proses',$layout_pemasukan->info_proses) }}</textarea>
                        @error('info_proses')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <hr>
                    <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> EDIT</button>
                    <div id="tombol_proses"></div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">AKSES LAYOUT</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Nama User</th>
                            <th>Form Admin</th>
                            <th>Form Anggota</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        use App\Models\Access_Pemasukan;

                        $no = 0; ?>
                        @foreach($user as $data)
                        <?php $no++;
                        $cek_access_form_1 = Access_Pemasukan::where('user_id', $data->id)->where('kategori', 'form_1')->where('role_id', $data->role_id);
                        $cek_access_form = Access_Pemasukan::where('user_id', $data->id)->where('kategori', 'form');
                        ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->data_warga->nama}}</td>
                            <td>
                                @if($cek_access_form_1->count() == 1)
                                ON
                                @else
                                OFF
                                @endif
                            </td>
                            <td>
                                @if($cek_access_form->count() == 1)
                                ON
                                @else
                                OFF
                                @endif
                            </td>
                            <td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- /.table-body -->

            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->
@endsection
@section('script')
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#Dataanggaran").addClass("active");
</script>
@endsection