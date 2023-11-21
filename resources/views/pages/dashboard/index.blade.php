@extends('template')

<style>
    #main {
        height: 100vh;
    }
    #main .main-content {
        overflow: auto;
    }
    #absen {
        transition: 0.3s;
        background-color: rgb(183, 210, 210);
        color: black;
        text-decoration: none;
    }
    #absen:hover {
        background-color: rgb(103, 114, 197);
        opacity: 0.6;
        color: white !important;
    }
</style>
@section('content')
    <style>
        th {
            width: 40%;
            white-space: nowrap;
        }
    </style>
    <div class="contnainer px-3 py-3" id="main">
        <div class="row" style="gap: 17px; height: 100%;">
            <div class="col-md-2 shadow rounded sidebar" style="height: 100%">
                @include('components.sidebar')
            </div>
            <div class="col-md main-content">
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <h1>Selamat Datang <span class="text-uppercase">{{ Auth::user()->name }}</span></h1>
                    </div>
                </div>
                
                @if ( Auth::user()->is_karyawan !== null )
                    @if ( $checkAbsen['belum_absen'] )
                        <a href="{{ route("absenNow") }}" id="absen" class="card shadow border-0" style=" width: 40%;">
                            <div class="card-body align-items-center d-flex" style="gap: 12px;">
                                <div class="btn d-inline-block rounded shadow-md rounded-circle btn-primary" style="width: max-content;">
                                    <h1>
                                        <i class="bi bi-power"></i>
                                    </h1>
                                </div>
                                <div>
                                    <h3>Attend Now</h3>
                                </div>
                            </div>
                        </a>
                        @else
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card border-0 mt-3 shadow">
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Absen Sekarang</th>
                                                <td>: {{ $checkAbsen['absen']['waktu'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Terlambat Absen</th>
                                                <td>: {{ $checkAbsen['absen']['terlambat'] }} Jam</td>
                                            </tr>
                                            <tr>
                                                <th>Absen yang akan datang</th>
                                                <td>: {{ $checkAbsen['akan_data'] }} Jam</td>
                                            </tr>
                                            <tr>
                                                <th>Jabatan</th>
                                                <td>: {{ $jabatan['nama'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Shift</th>
                                                <td>: {{ $shift['nama'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Lokasi/Gedung</th>
                                                <td>: {{ $lokasi['nama'] }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection