@extends('template')

<style>
    #main {
        height: 100vh;
    }
    #main .main-content {
        overflow: auto;
    }
    th {
        text-transform: uppercase;
        white-space: nowrap;
    }
</style>
@section('content')
    <div class="contnainer px-3 py-3" id="main">
        <div class="row" style="gap: 12px; height: 100%;">
            <div class="col-md-2 shadow rounded sidebar" style="height: 100%">
                @include('components.sidebar')
            </div>
            <div class="col-md main-content">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <div class="crud-button mb-3">
                            <button data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-sm btn-success">
                                <i class="bi bi-plus-lg"></i>
                                Tambah Data
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Shift Kerja</th>
                                    <th>Lokasi Kerja</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($karyawan as $key => $item)
                                    <tr>
                                        <td class="text-center" style="width: 40px;">{{ $key +1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jabatan->nama }}</td>
                                        <td>{{ $item->shift->nama }}</td>
                                        <td>{{ $item->lokasi->nama }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td style="width: 80px;">
                                            <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 100%; gap: 3px;">
                                                <a href="{{ route("removeKaryawan", $item->id) }}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                                <a href="{{ route("updateKaryawanView", $item->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel">Tambah Karyawan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route("addKaryawan") }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <h5>Informasi Login</h5>
                            <div class="mb-3">
                                <input type="text" name="name" placeholder="Username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" placeholder="Email" class="form-control">
                            </div>
                        </div>

                        
                        <div class="mb-4">
                            <h5>Informasi Karyawan</h5>
                            <div class="mb-3">
                                <input type="text" name="nama" placeholder="Nama" class="form-control">
                            </div>
                            <div class="mb-3">
                                <textarea name="alamat" placeholder="Alamat" class="form-control" ></textarea>
                            </div>
                            <div class="mb-3">
                                <select name="shift_id" class="form-select">
                                    <option selected>-- Waktu Kerja --</option>
                                    @foreach ($shift as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="jabatan_id" class="form-select">
                                    <option selected>-- Jabatan --</option>
                                    @foreach ($jabatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="lokasi_id" class="form-select">
                                    <option selected>-- Lokasi/Gedung --</option>
                                    @foreach ($gedung as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection