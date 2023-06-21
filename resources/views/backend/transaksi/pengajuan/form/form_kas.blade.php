<center>
    <h5 class="text-bold card-header bg-light p-0"> FORM BAYAR KAS</h5>
</center>
<hr>
<form action="{{Route('pengajuan.store')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
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
    <div class="form-group" id="noId"></div>
    <div class="form-group">
        <label for="jumlah">Nominal</label>
        <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="Maukan Nominal Tanpa titik dan koma" class="form-control col-12 @error('jumlah') is-invalid @enderror">
        @error('jumlah')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <textarea name="keterangan" class="textarea form-control bg-light @error('keterangan') is-invalid @enderror" id="summernote" rows="6" value="{{ old('keterangan') }}">{{ old('keterangan') }}</textarea>
        @error('keterangan')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
    </div>
    <hr>
    <input type="hidden" name="data_warga" id="data_warga" value="{{Auth::user()->data_warga_id}}">
    <input type="hidden" name="pengaju_id" id="pengaju_id" value="{{Auth::user()->data_warga_id}}">
    <input type="hidden" name="kategori_id" id="kategori_id" value="1">

    <button onclick="tombol_kas()" id="myBtn_kas" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Yuuu Bayar</button>
    <div id="tombol_proses"></div>
</form>

@section('script')
<!-- SCrip Untuk tanda bukti pembayaran -->
<script>
    $(document).ready(function() {
        $('#pembayaran').change(function() {
            var kel = $('#pembayaran option:selected').val();
            if (kel == "Transfer") {
                $("#noId").html('<label for="account-company">Bukti Transfer</label><input type="file" class="form-control col-12" name="foto" id="foto" required /><span class="text-danger" style="font-size: 13px">Harap kirim tanda bukti transferan.</span>');
            } else {
                $("#noId").html('');
            }
        });
    });
</script>

<script>
    function tombol_kas() {
        if (document.getElementById("myBtn_kas").hidden = true) {
            // membuat objek elemen
            // alert("Nuju di proses...");
            var hasil = document.getElementById("tombol_proses");
            hasil.innerHTML = "Nuju di proses ...";
        }
    }
</script>

<script>
    let jumlah_kas = document.getElementById("jumlah");
    let button_kas = document.getElementById("myBtn_kas");
    button_kas.disabled = true;
    jumlah_kas.addEventListener("change", stateHandle);

    function stateHandle() {
        if (document.getElementById("jumlah").value <= 49999) {
            button_kas.disabled = true;
        } else {
            button_kas.disabled = false;
        }
    }
</script>
@endsection