@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Daftar Lokasi Latihan Renang</h5>
        <p>Menu "Location" memungkinkan admin untuk mengelola, memantau, dan memperbarui informasi daftar lokasi renang secara efisien</p>

        <a href="{{route('location.create')}}" class="btn btn-success btn-sm mb-4">
            <i class="fas fa-plus"></i> Tambah
        </a>
        <table id="zero-conf" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>alamat</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($locations as $location)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$location -> name}}</td>
                        <td>{{$location -> address}}</td>
                        <td class="d-flex">
                            <a href="{{route('location.edit', $location->id)}}" class="btn btn-warning btn-sm ">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{route('location.show', $location->id)}}" class="btn btn-info btn-sm mx-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{route('location.destroy', $location -> id)}}" method="POST" style="display:inline;">

                                <button type="submit" class="btn btn-danger btn-sm" >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Alamat</th>
                    <th>aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@push('custom-style')
<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/perfectscroll/perfect-scrollbar.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/DataTables/datatables.min.css')}}" rel="stylesheet">

<!-- Theme Styles -->
<link href="{{asset('assets/css/main.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
@endpush

@push('custom-script')
<!-- Javascripts -->
<script src="{{asset('assets/plugins/jquery/jquery-3.4.1.min.js')}}"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="{{asset('assets/plugins/perfectscroll/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/main.min.js')}}"></script>
<script src="{{asset('assets/js/pages/datatables.js')}}"></script>

<script>
    // Inisialisasi DataTables
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#zero-conf')) {
            $('#zero-conf').DataTable().clear().destroy();
        }
        $('#zero-conf').DataTable();
    });
</script>
@endpush
