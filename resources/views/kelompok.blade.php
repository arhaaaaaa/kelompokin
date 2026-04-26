<nav>
    <a href="/">Dashboard</a> |
    <a href="/siswa">Daftar Siswa</a> |
    <a href="/kelompok">Generate Kelompok</a>
</nav>

<hr>

<h1>Generate Kelompok</h1>

<form action="/kelompok/generate" method="POST">
    @csrf

    <label>Jumlah Kelompok:</label><br>
    <input type="number" name="jumlah_kelompok" min="1" required><br><br>

    <button type="submit">Generate</button>
</form>