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
    <div class="contnainer px-3 py-3" id="main">
        <div class="row" style="gap: 17px; height: 100%;">
            <div class="col-md-2 shadow rounded sidebar" style="height: 100%">
                @include('components.sidebar')
            </div>
            <div class="col-md main-content">
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center" style="width: 40px">No</th>
                                    <th>Shift</th>
                                    <th>Tanggal</th>
                                    <th>Terlambat</th>
                                    <th>Absen Jam</th>
                                </tr>
                                @foreach ($absen as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $item['shift']['nama'] }} - {{ $item['shift']['waktu_mulai'] }}s/d{{ $item['shift']['waktu_selesai'] }}</td>
                                        <td>{{ $item['waktu'] }}</td>
                                        <td>{{ $item['terlambat'] }} Jam</td>
                                        <td>{{ $item['absen'] }} Jam</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection