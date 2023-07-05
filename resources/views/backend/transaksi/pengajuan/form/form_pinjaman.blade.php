   <center>
       <img src="{{asset($layout_pengeluaran->gambar)}}" alt="" width="50%">
       <h5 class="text-bold card-header bg-light p-0"> FORM PINJAMAN</h5>
   </center>
   <form id="basic-form" action="{{Route('pengajuan.store')}}" method="POST" enctype="multipart/form-data" novalidate>
       {{csrf_field()}}
       <div class="form-group">
           <label for="data_warga"><a href="#data_warga" class="" data-toggle="collapse">Data Warga</a></label> <br>
           <span class="text-danger" style="font-size: 13px;">Jika ingin mengajukan keluarga klik aja <b>Data Warga</b> di atas, dan pilih data warganya. </span>
           <div class="collapse" id="data_warga">
               <select id="data_warga" name="data_warga" class="select2 form-control @error('data_warga') is-invalid @enderror">
                   @if (old('data_warga') == true)
                   <option value="{{old('data_warga')}}">{{old('nama')}}</option>
                   @endif
                   <option value="{{Auth::user()->data_warga_id}}">-- Pilih Data Warga --</option>
                   @foreach ($data_hubungan as $data)
                   <option value="{{$data->data_warga_id}}"> {{$data->data_warga->nama}}</option>
                   @endforeach
               </select>
               @error('data_warga')
               <div class="invalid-feedback">
                   <strong>{{ $message }}</strong>
               </div>
               @enderror
           </div>
       </div>
       <div class="form-group row">
           <label for="jumlah">Nominal</label>
           <input type="hidden" name="kategori_id" id="kategori_id" value="4">
           <input type="hidden" name="pengaju_id" id="pengaju_id" value="{{Auth::user()->data_warga_id}}">
           <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="Cont : 50000    jangan pake titik ataupun koma" class="form-control col-12 @error('jumlah') is-invalid @enderror">
           @error('jumlah')
           <div class="invalid-feedback">
               <strong>{{ $message }}</strong>
           </div>
           @enderror
           <span class="text-dark" style="font-size: 10px">Jatah perorang {{$data_anggaran_max_pinjaman->persen}} % tina jumlah sadayana anggaran pinjaman yaeta {{"Rp" . number_format(1000,2,',','.')}}, teu kengeng ngalebihi.</span>
       </div>
       <div class="form-group">
           <label for="pembayaran">Metode Pembayaran</label>
           <select name="pembayaran" id="pembayaran" class="select2bs4 form-control col-12 @error('pembayaran') is-invalid @enderror">
               <option value="">--Pilih Metode Pembayaran--</option>
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

   @section('script')
   <script>
       $("#bayar").addClass("active");
   </script>

   <!-- scrip Untuk elemen Button -->
   <script>
       function tombol_pinjam() {
           if (document.getElementById("myBtn_pinjam").hidden = true) {
               // membuat objek elemen
               // alert("Nuju di proses...");
               var hasil = document.getElementById("tombol_proses");
               hasil.innerHTML = "Nuju di proses ...";
           }
       }
       <?php

        use App\Models\Anggaran;
        use App\Models\BayarPinjaman;
        use App\Models\Pemasukan;

        $total_pembayaran_cash = Pemasukan::where('pembayaran', 'Cash')->sum('jumlah');
        // menghitung jumlah setor tunai
        $total_setor_tunai = Pemasukan::where('kategori_id', 3)->sum('jumlah');
        // Uang nu teu acan di transfer
        $total_bayar_pinjaman_cash = BayarPinjaman::where('pembayaran', 'Cash')->sum('jumlah');
        $uang_blum_diTF = $total_pembayaran_cash - $total_setor_tunai + $total_bayar_pinjaman_cash;
        // Data Anggaran
        $data_anggaran = Anggaran::all();
        $data_anggaran_max_pinjaman = Anggaran::find(3);
        $cek_semua_pemasukan = Pemasukan::where('kategori_id', 1)->sum('jumlah');
        $cek_pemasukan_2 = $cek_semua_pemasukan / 2; // Membagi jumlah semua pemasukan
        $tahap_1 = $cek_pemasukan_2 * 90 / 100; // Menghitung Jumlah anggaran pinjaman dari hasil pembagian 2,
        $cek_total_pinjaman = $tahap_1 / 2; // Menghitung total Anggaran
        $jatah = $cek_total_pinjaman * $data_anggaran_max_pinjaman->persen / 100; //Jath Persenan di ambil dari data anggaran
        ?>
       let jumlah_pinjam = document.getElementById("jumlah");
       let button_pinjam = document.getElementById("myBtn_pinjam");
       button_pinjam.disabled = true;
       jumlah_pinjam.addEventListener("change", stateHandle);

       function stateHandle() {
           if (document.getElementById("jumlah").value <= 49999) {
               button_pinjam.disabled = true;
               document.getElementById("keterangann").innerHTML = "";
           } else if (document.getElementById("jumlah").value >= <?php echo $jatah ?>) {
               button_pinjam.disabled = true;
               document.getElementById("keterangann").innerHTML = "";
           } else {
               button_pinjam.disabled = false;
               document.getElementById("keterangann").innerHTML = "<b> Alasan</b>    : <br> <br> <b> Pami Transfer Esian Data Bank </b> <br> Nama Bank  : <br> No Req    : <br> A/N  : <br> <br><b> Pami bade cash mangga input prosesna pengambilanna : </b> <br> <br><b> Tanggal Di kembalikeun </b> : <br> <hr> <center> Pami Atos di Setujui Bukti di Cantumkeun di Handap </center>";
           }

       }
   </script>
   @endsection