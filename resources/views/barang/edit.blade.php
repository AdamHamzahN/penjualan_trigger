<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <input type="hidden" name="id_barang" id="id_barang" value="{{$barangDetil->id_barang}}">
            <label for="kode_barang">Kode Barang</label>
            <input class="form-control"type="text" name="kode_barang" id="kode_barang" value="{{$barangDetil->kode_barang}}">
        </div>
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input class="form-control"type="text" name="nama_barang" id="nama_barang" value="{{$barangDetil->nama_barang}}">
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input class="form-control"type="number" name="harga" id="harga" value="{{$barangDetil->harga}}">
        </div>
    </div>

</div>