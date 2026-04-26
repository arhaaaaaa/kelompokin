<h1>Edit Siswa</h1>

<form action="/siswa/{{ $student->id }}/edit" method="POST">
    @csrf
    @method('PUT')

    <label>Nama:</label><br>
    <input type="text" name="nama" value="{{ $student->nama }}" required><br><br>

    <label>NPM:</label><br>
    <input type="text" name="npm" value="{{ $student->npm }}" required><br><br>

    <label>Kelas:</label><br>
    <select name="kelas" required>
        @foreach(range('A', 'Z') as $huruf)
            <option value="{{ $huruf }}" {{ $student->kelas == $huruf ? 'selected' : '' }}>
                {{ $huruf }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Simpan Perubahan</button>
</form>