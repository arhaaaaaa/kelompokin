<nav>
    <a href="/">Dashboard</a> |
    <a href="/siswa">Daftar Siswa</a> |
    <a href="/kelompok">Generate Kelompok</a>
    <a href="/kelompok/download/{{ $session_id }}">
    <button>Download CSV</button>
</a>
</nav>

<hr>

<h1>Hasil Kelompok</h1>

@foreach($kelompok as $index => $group)
    <h3>Kelompok {{ $index + 1 }}</h3>
    <ul>
        @foreach($group as $siswa)
            <li>{{ $siswa->nama }} ({{ $siswa->kelas }})</li>
        @endforeach
    </ul>
@endforeach