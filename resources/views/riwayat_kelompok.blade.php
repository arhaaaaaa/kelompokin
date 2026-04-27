<h1>Riwayat Kelompok</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama Sesi</th>
        <th>Aksi</th>
    </tr>

    @foreach($sessions as $session)
        <tr>
            <td>{{ $session->nama_sesi }}</td>
            <td>
                <a href="/kelompok/lihat/{{ $session->id }}">Lihat</a> |
                <a href="/kelompok/download/{{ $session->id }}">Download</a>
            </td>
        </tr>
    @endforeach
</table>