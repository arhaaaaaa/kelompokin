<?php

use Illuminate\Support\Facades\Route;
use App\Models\Student;

Route::get('/', function () {
    return view('dashboard');
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

    $students = \App\Models\Student::all()->shuffle();

    $kelompok = [];

    foreach ($students as $index => $siswa) {
        $groupIndex = $index % $jumlah;
        $kelompok[$groupIndex][] = $siswa;
    }

    return view('hasil_kelompok', [
        'kelompok' => $kelompok
    ]);
});