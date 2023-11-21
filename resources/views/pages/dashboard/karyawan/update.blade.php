@extends('template')

<style>
    #main {
        height: 100vh;
    }
    #main .main-content {
        overflow: auto;
    }
</style>
@section('content')
    <div class="contnainer px-3 py-3" id="main">
        <div class="row" style="gap: 17px; height: 100%;">
            <div class="col-md-2 shadow rounded sidebar" style="height: 100%">
                @include('components.sidebar')
            </div>
            <div class="col-md main-content">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <a href="/dashboard/karyawan" class="btn btn-sm btn-primary">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>
                        <h3 class="mb-3">Update Karyawan</h3>
                        <form action="{{ route("updateKaryawan") }}" method="post">
                            @csrf        
                            <input hidden type="text" name="id" value="{{ $karyawan->id }}">
                            <div class="row mb-3">
                                <div class="col-md-12 mb-3">
                                    <label>Nama Karyawan</label>
                                    <input type="text" placeholder="Nama" name="nama" class="form-control" value="{{ $karyawan->nama }}">
                                </div>
    
                                <div class="col-md-6 mb-3">
                                    <label>Nama Alamat</label>
                                    <textarea placeholder="Nama" name="alamat" class="form-control">{{ $karyawan->alamat }}</textarea>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label>Jabatan Karyawan</label>
                                    <select name="jabatan_id" class="form-select">
                                        <option selected value="{{ $karyawan->jabatan_id }}">{{ $karyawan->jabatan->nama }}</option>
                                        @foreach ($jabatan as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="col-md-6 mb-3">
                                    <select name="shift_id" class="form-select">
                                        <option selected value="{{ $karyawan->shift_id }}">{{ $karyawan->shift->nama }}</option>
                                        @foreach ($shift as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="col-md-6 mb-3">
                                    <div class="mb-3">
                                        <select name="lokasi_id" class="form-select">
                                            <option selected value="{{ $karyawan->lokasi_id }}">{{ $karyawan->lokasi->nama }}</option>
                                            @foreach ($gedung as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-success">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection