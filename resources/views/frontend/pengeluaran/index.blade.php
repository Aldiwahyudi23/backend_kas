@extends('backend.template_backend.layout')

@section('content')
<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">PINJAM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Deskripsi</a>
                    </li>
                    @if(Auth::user()->role == "Admin" || Auth::user()->role == "Sekertaris")
                    <li class="nav-item">
                        <a href="{{Route('pengeluaran.create')}}" class="nav-link" id="custom-tabs-four-messages-tab">PENGELUARAN</a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <!-- Form Admin -->
                        @if (Auth::user()->role->nama_role == "Admin")
                        <center>
                            <img src="{{asset($layout_pengeluaran->gambar)}}" alt="" width="50%">
                            <h5 class="text-bold card-header bg-light p-0"> FORM PINJAMAN</h5>
                        </center>
                        <form id="basic-form" action="{{Route('pengajuan.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="data_warga_id">Nama data_warga</label>
                                <select id="data_warga_id" name="data_warga_id" class="select2 form-control @error('data_warga_id') is-invalid @enderror">
                                    @if (old('data_warga_id') == true)
                                    <option value="{{old('data_warga_id')}}">{{old('nama')}}</option>
                                    @endif
                                    <option value="">-- Pilih Data Warga --</option>
                                    @foreach ($data_warga as $data)
                                    <option value="{{$data->id}}"> {{$data->nama}}</option>
                                    @endforeach
                                </select>
                                @error('data_warga_id')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="jumlah">Nominal</label>
                                <input type="hidden" name="anggota_id" id="anggota_id" value="{{Auth::id()}}">
                                <input type="hidden" name="kategori" id="kategori" value="Pinjaman">
                                <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="Cont : 50000    jangan pake titik ataupun koma" class="form-control col-12 @error('jumlah') is-invalid @enderror">
                                @error('jumlah')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                                <span class="text-dark" style="font-size: 10px">Jatah perorang {{$data_anggaran_max_pinjaman->persen}} % tina jumlah sadayana anggaran pinjaman yaeta {{"Rp" . number_format(1000,2,',','.')}}, teu kengeng ngalebihi.</span>
                            </div>
                            <div class="form-group row">
                                <label for="pembayaran">Metode Pembayaran</label>
                                <select name="pembayaran" id="pembayaran" class="form-control select2bs4 @error('pembayaran') is-invalid @enderror">

                                    <option value="">--Pilih Pembayaran--</option>
                                    <option value="Cash">Uang Tunai</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                                @error('pembayaran')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" class="textarea form-control bg-light @error('keterangan') is-invalid @enderror" id="summernote" rows="6" value="{{ old('keterangan') }}">{{ old('keterangan') }}
                                <p id="keterangann"></p>
                                </textarea>
                                @error('keterangan')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <p id="keterangan"></p>
                            <hr>
                            <button onclick="tombol_pinjam()" id="myBtn_pinjam" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> PINJAM</button>
                            <div id="tombol_proses"></div>
                            <span class="text-dark" style="font-size: 10px">Pinjaman di batasi Jatah {{$data_anggaran_max_pinjaman->max_orang}} Orang sesuai anggaran nu aya. <br> Ayeuna nembe aya nu Nambut {{$cek_pengeluaran_pinjaman}} Orang, Masih aya sisa jatah {{$data_anggaran_max_pinjaman->max_orang - $cek_pengeluaran_pinjaman }} Orang deui</span>
                        </form>
                        @else
                        <!-- Form Anggota -->
                        @if($cek_pengajuan >= 1)

                        <body class="justify-content-center">
                            {!!$layout_pengeluaran->info_proses!!}
                        </body>
                        @elseif($cek_pengeluaran_pinjaman_user >= 1)

                        <body class="justify-content-center">
                            {!!$layout_pengeluaran->info_nunggak!!}
                        </body>
                        @elseif($cek_pengeluaran_pinjaman >= $data_anggaran_max_pinjaman->max_orang)

                        <body class="justify-content-center">
                            {!!$layout_pengeluaran->info_full!!}
                        </body>
                        @elseif($cek_total_pinjaman <= $data_anggaran_max_pinjaman->nominal_max_anggaran)

                            <body class="justify-content-center">
                                {!!$layout_pengeluaran->info_saldo!!}
                            </body>
                            @else
                            @include('backend.transaksi.pengajuan.form.form_pinjaman')
                            @endif

                            @endif

                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        {!!$data_anggaran_max_pinjaman->deskripsi!!}
                    </div>

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-pinjaman-tab" data-toggle="pill" href="#custom-tabs-one-pinjaman" role="tab" aria-controls="custom-tabs-one-pinjaman" aria-selected="true">pinjaman"</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="custom-tabs-one-pengajuan-tab" data-toggle="pill" href="#custom-tabs-one-pengajuan" role="tab" aria-controls="custom-tabs-one-pengajuan" aria-selected="false">pengajuan</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

                    <div class="tab-pane fade show active" id="custom-tabs-one-pinjaman" role="tabpanel" aria-labelledby="custom-tabs-one-pinjaman-tab">
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr class="bg-light">
                                    <th>No.</th>
                                    <th>Ket.</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                use Illuminate\Support\Facades\DB;

                                $no = 0;
                                ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($data_pengeluaran_pinjaman->get() as $data)
                                <?php $no++;
                                $status2 = DB::table('pengeluarans')->find($data->id);
                                ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>
                                        <a href="{{Route('pengeluaran.show',Crypt::encrypt($data->id))}}" class="">
                                            @if ( $status2->status == 'Lunas')
                                            <i class="btn btn-success "> LUNAS </i>
                                            @elseif ( $status2->status == 'Nunggak')
                                            <i class=" btn btn-warning "> Bayar </i>
                                            @endif
                                            </i></a>
                                    </td>
                                    <td>{{$data->tanggal}}</td>
                                    <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>

                                </tr>

                                @php
                                $total += $data->jumlah;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-body -->
                    </div>
                    <div class="tab-pane fade show" id="custom-tabs-one-pengajuan" role="tabpanel" aria-labelledby="custom-tabs-one-pengajuan-tab">
                        <table id="example" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr class="bg-light">
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Proses</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($cek_pengajuan_proses as $data)
                                <?php $no++;
                                $status2 = DB::table('pengeluarans')->find($data->id);
                                ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->kategori}}</td>
                                    <td>
                                        <a href="{{Route('pengajuan.show',Crypt::encrypt($data->id))}} " class="">
                                            @if ( $data->status == 'Proses')
                                            <i class="btn btn-success "> {{ $data->status}} </i>
                                            @else
                                            <i class=" btn btn-warning "> {{ $data->status}} Sementara </i>
                                            @endif
                                            </i></a>
                                    </td>
                                    <td>{{$data->tanggal}}</td>
                                    <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
                                    <td>
                                        <form action="{{route('pengajuan.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-link btn-sm mt-2"><i class="nav-icon fas fa-trash-alt" onclick="return confirm('Leres bade ngahapus data anu namina   ?')"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-body -->
                    </div>

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection