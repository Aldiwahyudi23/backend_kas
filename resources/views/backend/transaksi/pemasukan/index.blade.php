@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DATA SEMUA PEMASUKAN</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>ID transaksi</th>
                            <th>Nama Anggota</th>
                            <th>Tanggal Input</th>
                            <th>Nominal</th>
                            <th>Pembayaran</th>
                            <th>Di Input Oleh</th>
                            <th>Di Setujui Oleh</th>
                            <th>Kategori</th>
                            <th>Katerangan</th>
                            <th>created at</th>
                            <th>updated at</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data_pemasukan as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->kode}}</td>
                            <td>{{$data->data_warga->nama}}</td>
                            <td>{{$data->tanggal}}</td>
                            <td>{{$data->jumlah}}</td>
                            <td>{{$data->pembayaran}}</td>
                            <td>{{$data->pengaju->nama}}</td>
                            <td>{{$data->pengurus->nama}}</td>
                            <td>{{$data->kategori->nama_kategori}}</td>
                            <td>{!!$data->keterangan!!}</td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->updated_at}}</td>
                            <td>
                                <form action="{{route('pemasukan.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('pemasukan.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-book"></i></a>
                                    <a href="{{route('pemasukan.edit',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                    @if (auth()->user()->role->nama_role == 'Admin')
                                    <button class="btn btn-link btn-sm mt-2"><i class="nav-icon fas fa-trash-alt" onclick="return confirm('Leres bade ngahapus data anu namina {{$data->nama}}  ?')"></i> </button>
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