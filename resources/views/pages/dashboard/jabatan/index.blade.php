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
                                    <th class="text-center">no</th>
                                    <th>Nama</th>
                                    <th></th>
                                </tr>
                                @foreach ($jabatan as $key => $item)
                                    <tr>
                                        <td class="text-center" style="width: 40px;">{{ $key +1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td style="width: 80px">
                                            <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 100%; gap: 3px;">
                                                <a href="{{ route("removeJabatan", $item->id) }}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
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
                    <h1 class="modal-title fs-5" id="modalLabel">Tambah Jabatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route("addJabatan") }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" name="nama" placeholder="Nama Jabatan/Departement" class="form-control">
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