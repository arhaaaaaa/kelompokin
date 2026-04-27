@extends('layouts.app')

@section('content')

<h1 class="mb-4">Dashboard</h1>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Jumlah Siswa</h5>
                <p class="card-text fs-4">{{ $jumlahSiswa }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Jumlah Riwayat</h5>
                <p class="card-text fs-4">{{ $jumlahRiwayat }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-dark bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Riwayat Terakhir</h5>

                @if ($riwayatTerakhir)
                    <p class="card-text fs-5">
                        {{ $riwayatTerakhir->nama ?? 'Riwayat #' . $riwayatTerakhir->id }}
                    </p>
                @else
                    <p class="card-text fs-5">Belum ada riwayat</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection