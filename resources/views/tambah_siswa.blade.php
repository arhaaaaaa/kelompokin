<h1>Tambah Siswa</h1>

<form action="/siswa/tambah" method="POST">
    @csrf

    <label for="nama">Nama:</label><br>
    <input type="text" id="nama" name="nama" required><br><br>

    <label for="npm">NPM:</label><br>
    <input type="text" id="npm" name="npm" required><br><br>

    <label>Kelas:</label><br>
    <select name="kelas" required>
        <option value="">Pilih Kelas</option>
        
        @foreach(range('A', 'Z') as $huruf)
            <option value="{{ $huruf }}">{{ $huruf }}</option>
        @endforeach

    </select><br><br>

    <button type="submit">Tambah Siswa</button>
</form>