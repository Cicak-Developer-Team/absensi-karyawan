<style>
    #sidebar {
        width: 100%;
        height: 100%;
        overflow: auto;
    }
</style>
<div id="siebar" class="p-2">
    {{-- web name/ icon --}}
    <div class="icon text-center py-3 bg-secondary text-white rounded">
        <h3>{{ env("APP_NAME") }}</h3>
    </div>
    <div class="menu py-2 mt-4">
        <h5>Master</h5>
        <div class="list-group list-group-flush">
            <a href="/dashboard" class="list-group-item list-group-item-action"><i class="bi bi-chevron-right"></i> Dashboard</a>
            @if ( !Auth::user()->is_karyawan )
                <a href="/dashboard/karyawan" class="list-group-item list-group-item-action"><i class="bi bi-chevron-right"></i> Karyawan</a>
                <a href="/dashboard/shift" class="list-group-item list-group-item-action"><i class="bi bi-chevron-right"></i> Shift</a>
                <a href="/dashboard/jabatan" class="list-group-item list-group-item-action"><i class="bi bi-chevron-right"></i> Jabatan</a>
                <a href="/dashboard/gedung" class="list-group-item list-group-item-action"><i class="bi bi-chevron-right"></i> Gedung/Lokasi</a>
            @endif
        </div>
    </div>
    <div class="menu py-2">
        <h5>Application</h5>
        <div class="list-group list-group-flush">
            <a href="/dashboard/riwayat" class="list-group-item list-group-item-action"><i class="bi bi-chevron-right"></i> Riwayat Absensi</a>
        </div>
    </div>
    <div class="logout">
        <a class="btn btn-danger rounded rounded-fill" href="{{ route("logout") }}" style="width: 100%;">LOGOUT</a>
    </div>
</div>