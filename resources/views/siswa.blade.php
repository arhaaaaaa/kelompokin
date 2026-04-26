<nav>
    <a href="/">Dashboard</a> |
    <a href="/siswa">Daftar Siswa</a> |
    <a href="/kelompok">Generate Kelompok</a>
</nav>

<hr>

<h1>Daftar Siswa</h1>

<a href="/siswa/tambah">Tambah Siswa</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>NPM</th>
        <th>Kelas</th>
        <th>Aksi</th>
    </tr>

    @foreach($students as $siswa)
        <tr>
            <td>{{ $siswa->nama }}</td>
            <td>{{ $siswa->npm }}</td>
            <td>{{ $siswa->kelas }}</td>
            <td>
                <a href="/siswa/{{ $siswa->id }}/edit">Edit</a>

                <form action="/siswa/{{ $siswa->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>