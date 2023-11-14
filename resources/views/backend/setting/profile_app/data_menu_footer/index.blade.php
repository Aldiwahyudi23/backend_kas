@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <center>
                    <h5 class="text-bold card-header bg-light p-0"> TAMBAH DATA MENU FOOTER</h5>
                </center>
                <hr>
                <form action="{{Route('menu-footer.store')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="program_id">Program</label>
                        <select id="program_id" name="program_id" class="select2bs4 form-control @error('program_id') is-invalid @enderror">
                            <option value="">-- Pilih Url --</option>
                            <option value="0">-- Tidak Ada Program --</option>
                            @foreach ($data_program as $data)
                            <option value="{{$data->id}}"> {{$data->nama_program}}</option>
                            @endforeach
                        </select>
                        @error('program_id')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="nama">Menu Footer</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama Menu Footer" class="form-control col-12 @error('nama') is-invalid @enderror">
                        @error('nama')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pilih">Icon / Foto</label>
                        <select id="pilih" name="pilih" class="select2bs4 form-control " require>
                            <option value="">--Pilih--</option>
                            <option value="icon">Icon</option>
                            <option value="foto">Foto</option>
                        </select>
                    </div>
                    <div class="form-group row" id="noId"></div>

                    <div class="form-group">
                        <label for="route_url_id">Url</label>
                        <select id="route_url_id" name="route_url_id" class="select2bs4 form-control @error('route_url_id') is-invalid @enderror">
                            <option value="">-- Pilih Url --</option>
                            @foreach ($data_route_url as $data)
                            <option value="{{$data->id}}"> {{$data->nama}}</option>
                            @endforeach
                        </select>
                        @error('route_url_id')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">kategori</label>
                        <select id="kategori" name="kategori" class="select2bs4 form-control @error('kategori') is-invalid @enderror">
                            <option value="1">Keluarga</option>
                            <option value="0">Teriket Keluarga</option>
                        </select>
                        @error('kategori')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="textarea form-control bg-light @error('deskripsi') is-invalid @enderror" id="summernote" rows="6" value="{{ old('deskripsi') }}">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <hr>
                    <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambihkeun</button>
                    <div id="tombol_proses"></div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DATA SUB MENU</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Nama Role</th>
                            <th>Is-Active</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data_menu_footer as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td><i class="{{$data->icon}}"></i> {{$data->nama}}</td>
                            <td>
                                <form action="{{ Route('menu-footer.update',Crypt::encrypt($data->id)) }}" method="post" enctype="multipart/form-data">
                                    @method('PATCH')
                                    {{csrf_field()}}
                                    <input type="hidden" name="nama" id="nama" value="{{$data->nama}}">
                                    <input type="hidden" name="program_id" id="program_id" value="{{$data->program_id}}">
                                    <input type="hidden" name="kategori" id="kategori" value="{{$data->kategori}}">
                                    <input type="hidden" name="route_url_id" id="route_url_id" value="{{$data->route_url_id}}">
                                    <input type="hidden" name="deskripsi" id="deskripsi" value="{{$data->deskripsi}}">
                                    <input type="hidden" name="icon" id="icon" value="{{$data->icon}}">
                                    <input type="hidden" name="foto" id="foto" value="{{$data->foto}}">
                                    @if($data->is_active == 1 )
                                    <input type="hidden" name="is_active" id="is_active" value="0">
                                    <button type="submit" class="btn btn-success"> ON</button>
                                    @else
                                    <input type="hidden" name="is_active" id="is_active" value="1">
                                    <button type="submit" class="btn btn-danger"> OFF</button>
                                    @endif
                                </form>
                            </td>
                            <td>
                                <form action="{{route('menu-footer.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('menu-footer.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-book"></i></a>
                                    <a href="{{route('menu-footer.edit',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                    @if (auth()->user()->role->nama_role == 'Admin')
                                    <button class="btn btn-link btn-sm mt-2"><i class="nav-icon fas fa-trash-alt" onclick="return confirm('Leres bade ngahapus data anu namina {{$data->nama}}  ?')"></i> Hapus</button>
                                    @endif
                                </form>
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