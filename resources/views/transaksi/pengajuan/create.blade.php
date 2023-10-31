<form method="POST" action="{{ route('pengajuan.store') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}" required>
        @error('nama_produk')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="jumlah">Jumlah:</label>
        <input type="text" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" required>
        @error('jumlah')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="dokumen">Dokumen:</label>
        <input type="file" name="dokumen" id="dokumen" required>
        @error('dokumen')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Submit</button>
</form>
