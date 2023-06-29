   <center>
       <img src="{{asset($layout_pengeluaran->gambar)}}" alt="" width="50%">
       <h5 class="text-bold card-header bg-light p-0"> FORM PINJAMAN</h5>
   </center>
   <form id="basic-form" action="{{Route('pengajuan.store')}}" method="POST" enctype="multipart/form-data" novalidate>
       {{csrf_field()}}
       <div class="form-group">
           <label for="data_warga_id"><a href="#data_warga" class="" data-toggle="collapse">Data Warga</a></label> <br>
           <span class="text-danger" style="font-size: 13px;">Jika ingin mengajukan keluarga klik aja <b>Data Warga</b> di atas, dan pilih data warganya. </span>
           <div class="collapse" id="data_warga">
               <select id="data_warga_id" name="data_warga_id" class="select2 form-control @error('data_warga_id') is-invalid @enderror">
                   @if (old('data_warga_id') == true)
                   <option value="{{old('data_warga_id')}}">{{old('nama')}}</option>
                   @endif
                   <option value="">-- Pilih Data Warga --</option>
                   @foreach ($data_hubungan as $data)
                   <option value="{{$data->data_warga_id}}"> {{$data->data_warga->nama}}</option>
                   @endforeach
               </select>
               @error('data_warga_id')
               <div class="invalid-feedback">
                   <strong>{{ $message }}</strong>
               </div>
               @enderror
           </div>
       </div>
       <div class="form-group row">
           <label for="jumlah">Nominal</label>
           <input type="hidden" name="kategori" id="kategori" value="4">
           <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="Cont : 50000    jangan pake titik ataupun koma" class="form-control col-12 @error('jumlah') is-invalid @enderror">
           @error('jumlah')
           <div class="invalid-feedback">
               <strong>{{ $message }}</strong>
           </div>
           @enderror
           <span class="text-dark" style="font-size: 10px">Jatah perorang {{$data_anggaran_max_pinjaman->persen}} % tina jumlah sadayana anggaran pinjaman yaeta {{"Rp" . number_format(1000,2,',','.')}}, teu kengeng ngalebihi.</span>
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