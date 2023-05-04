@extends('layouts.mainlayout')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary btn-sm mb-4" href="/datauser"><i class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">Detail User</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Detail Pengingat</th>
                                    </tr>
                                </tbody>
                            </table>

                            <table id="example" class="table table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Pengingat</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($detailpengingat as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->user->name }}</td>
                                            <td>{{ $data->pengingat->name }}</td>
                                            <td>{{ $data->pengingat->time }}</td>
                                            <td>
                                                @if ($data->status == 'sudah')
                                                    <span class="badge badge-success px-2">Sudah</span>
                                                @else
                                                    <span class="badge badge-danger px-2">Belum</span>
                                                @endif
                                            </td>
                                            <td>{{ $data->tanggal }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br><br>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Detail Poli</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table id="exampleaja" class="table table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Pemeriksa</th>
                                        <th>Bukti Pemeriksaan</th>
                                        <th>Lokasi</th>
                                        <th>Tempat</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($detailpoli as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->nama_pemeriksa }}</td>
                                            <td class="align-middle text-center">
                                                <span>
                                                    <button data-toggle="modal"
                                                        data-target="#buktiModal{{ $item->id }}" type="button"
                                                        class="btn mb-1 btn-rounded btn-outline-warning btn-sm">Detail</button>
                                            </td>

                                            <td class="align-middle text-center">
                                                <span>
                                                    <button data-toggle="modal"
                                                        data-target="#lokasiModal{{ $item->id }}" type="button"
                                                        class="btn mb-1 btn-rounded btn-outline-warning btn-sm">Detail</button>
                                            </td>
                                            <td>{{ $item->tempat }}</td>
                                            <td>{{ $item->tanggal }}</td>


                                        </tr>
                                        {{-- Modal Bukti --}}
                                        <div class="modal fade" id="buktiModal{{ $item->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Bukti Modal</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <label>Foto Pemeriksaan</label>
                                                        <img class="d-block w-100"
                                                            src="{{ asset('foto/bukti/' . $item['bukti_pemeriksaan']) }}"
                                                            alt="First slide">

                                                        <br>
                                                        <label>TTD Pemeriksa</label>
                                                        <img class="d-block w-100"
                                                            src="{{ asset('foto/ttd/' . $item['ttd_pemeriksa']) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- Lokasi TTD --}}
                                        <div class="modal fade" id="lokasiModal{{ $item->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Lokasi Modal</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <iframe
                                                            src="https://www.google.com/maps?q={{ $item->lat }}, {{ $item->long }}&hl=es;z=14&output=embed"
                                                            width="460" height="460" style="border:0;"
                                                            allowfullscreen="" loading="lazy"
                                                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">CLose</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',


                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],

                buttons: [{
                        extend: 'colvis',
                        className: 'btn btn-primary btn-sm',
                        text: 'Column Visibility',
                        // columns: ':gt(0)'


                    },

                    {

                        extend: 'pageLength',
                        className: 'btn btn-primary btn-sm',
                        text: 'Page Length',
                        // columns: ':gt(0)'
                    },


                    // 'colvis', 'pageLength',

                    {
                        extend: 'excel',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    // {
                    //     extend: 'csv',
                    //     className: 'btn btn-primary btn-sm',
                    //     exportOptions: {
                    //         columns: [0, ':visible']
                    //     }
                    // },
                    {
                        extend: 'pdf',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    {
                        extend: 'print',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    // 'pageLength', 'colvis',
                    // 'copy', 'csv', 'excel', 'print'

                ],

            });
        });
        $(document).ready(function() {
            $('#exampleaja').DataTable({
                dom: 'Bfrtip',


                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],

                buttons: [{
                        extend: 'colvis',
                        className: 'btn btn-primary btn-sm',
                        text: 'Column Visibility',
                        // columns: ':gt(0)'


                    },

                    {

                        extend: 'pageLength',
                        className: 'btn btn-primary btn-sm',
                        text: 'Page Length',
                        // columns: ':gt(0)'
                    },


                    // 'colvis', 'pageLength',

                    {
                        extend: 'excel',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    // {
                    //     extend: 'csv',
                    //     className: 'btn btn-primary btn-sm',
                    //     exportOptions: {
                    //         columns: [0, ':visible']
                    //     }
                    // },
                    {
                        extend: 'pdf',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    {
                        extend: 'print',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    // 'pageLength', 'colvis',
                    // 'copy', 'csv', 'excel', 'print'

                ],

            });
        });
    </script>
@endsection
