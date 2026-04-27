<?php

use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Models\GroupSession;
use App\Models\GroupMember;
use App\Exports\GroupResultExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\RiwayatKelompok;

Route::get('/', function () {
    $jumlahSiswa = Student::count();
    $jumlahRiwayat = GroupSession::count();

    $riwayatTerakhir = GroupSession::latest()->first();

    return view('dashboard', compact(
        'jumlahSiswa',
        'jumlahRiwayat',
        'riwayatTerakhir'
    ));
});

Route::get('/siswa', function () {
    $students = Student::all();

    return view('siswa', [
        'students' => $students
    ]);
});

Route::get ('/siswa/tambah', function (){
    return view('tambah_siswa');
});

Route::post('/siswa/tambah', function () {

Student::create([
    'nama' => request('nama'),
    'npm' => request('npm'),
    'kelas' => request('kelas'),
]);

    return redirect('/siswa');
});

Route::delete('/siswa/{id}', function ($id) {
    $student = Student::find($id)->delete();

    return redirect ('/siswa');
});

Route::get('/siswa/{id}/edit', function ($id) {
    $student = Student::find($id);

    return view('edit_siswa', [
        'student' => $student
    ]);
});

Route::put('/siswa/{id}/edit', function ($id) {
    $student = Student::find($id);

    $student->update([
        'nama' => request('nama'),
        'npm' => request('npm'),
        'kelas' => request('kelas'),
    ]);

    return redirect('/siswa');
});

Route::get('/kelompok', function () {
    return view('kelompok');
});

Route::post('/kelompok/generate', function () {

    $jumlah = request('jumlah_kelompok');

    // 1. buat sesi baru
    $session = GroupSession::create([
        'nama_sesi' => 'Generate ' . now()
    ]);

    // 2. ambil & acak siswa
    $students = Student::all()->shuffle();

    $kelompok = [];

    foreach ($students as $index => $siswa) {

        $groupIndex = $index % $jumlah;

        // simpan ke array (buat tampil)
        $kelompok[$groupIndex][] = $siswa;

        // simpan ke database
        GroupMember::create([
            'group_session_id' => $session->id,
            'student_id' => $siswa->id,
            'nomor_kelompok' => $groupIndex + 1
        ]);
    }

    return view('hasil_kelompok', [
        'kelompok' => $kelompok,
        'session_id' => $session->id
    ]);
});

Route::get('/kelompok/download/{id}', function ($id) {
    return Excel::download(new GroupResultExport($id), 'hasil_kelompok.xlsx');
});

Route::get('/kelompok/riwayat', function () {
    $sessions = \App\Models\GroupSession::latest()->get();

    return view('riwayat_kelompok', [
        'sessions' => $sessions
    ]);
});

Route::get('/kelompok/lihat/{id}', function ($id) {

    $members = \App\Models\GroupMember::where('group_session_id', $id)
        ->orderBy('nomor_kelompok')
        ->get();

    $kelompok = [];

    foreach ($members as $member) {
        $siswa = \App\Models\Student::find($member->student_id);

        $kelompok[$member->nomor_kelompok][] = $siswa;
    }

    return view('hasil_kelompok', [
        'kelompok' => $kelompok,
        'session_id' => $id
    ]);
});