@extends('layouts.mainlayout')

@section('title')
    Data Poli
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Poli</h4>
                        <div class="align-right text-right">
                            <button data-toggle="modal" data-target="#addModal" type="button"
                                class="btn mb-1 btn-rounded btn-outline-primary btn-sm ms-auto">Add</button>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span>
                                </button>

                                <?php
                                
                                $nomer = 1;
                                
                                ?>

                                @foreach ($errors->all() as $error)
                                    <li>{{ $nomer++ }}. {{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Pemeriksa</th>
                                        <th>Bukti Pemeriksaan</th>
                                        <th>Lokasi</th>
                                        <th>Tempat</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php
                                    
                                    $no = 1;
                                    
                                    ?>
                                    @foreach ($dataPoli as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->nama_pemeriksa }}</td>
                                            <td class="align-middle text-center">
                                                <span>
                                                    <button data-toggle="modal" data-target="#buktiModal{{ $item->id }}"
                                                        type="button"
                                                        class="btn mb-1 btn-rounded btn-outline-warning btn-sm">Detail</button>
                                                </span>
                                            </td>

                                            <td class="align-middle text-center">
                                                <span>
                                                    <button data-toggle="modal"
                                                        data-target="#lokasiModal{{ $item->id }}" type="button"
                                                        class="btn mb-1 btn-rounded btn-outline-warning btn-sm">Detail</button>
                                                </span>
                                            </td>
                                            <td>{{ $item->tempat }}</td>
                                            <td>{{ $item->tanggal }}</td>

                                            <td class="align-middle text-center">
                                                <span>
                                                    <button data-toggle="modal" data-target="#editModal{{ $item->id }}"
                                                        type="button"
                                                        class="btn mb-1 btn-rounded btn-outline-warning btn-sm">Edit</button>
                                                    <button data-toggle="modal"
                                                        data-target="#hapusModal{{ $item->id }}" type="button"
                                                        class="btn mb-1 btn-rounded btn-outline-danger btn-sm">Delete</button>

                                                </span>
                                            </td>
                                        </tr>

                                        {{-- Modal Edit --}}
                                        <div class="modal fade" id="editModal{{ $item->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Modal</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/datapoli-update/{{ $item->id }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">



                                                            <div class="form-group">
                                                                <label>Nama</label>
                                                                <select name="id_user" class="form-control input-rounded"
                                                                    id="sel1">
                                                                    <option selected value="{{ $item->id_user }}">
                                                                        {{ $item->user->name }}</option>

                                                                    @foreach ($dataUser as $data)
                                                                        <option value="{{ $data->id }}">
                                                                            {{ $data->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Nama Pemeriksa</label>
                                                                <input name="nama_pemeriksa" type="text"
                                                                    value="{{ $item->nama_pemeriksa }}"
                                                                    class="form-control input-rounded"
                                                                    placeholder="Input Nama Pemeriksa" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="formFile" class="form-label">Upload TTD
                                                                    Pemeriksa</label>

                                                                <div class="mb-3">
                                                                    <div id="sigedit{{ $item->id }}"></div>
                                                                    <br /><br />
                                                                    <span onclick="deletesignature{{ $item->id }}()"
                                                                        class="btn btn-danger btn-sm">Clear</span>

                                                                    {{-- <canvas id="signatureedit{{ $item->id }}"
                                                                        name="ttd_pemeriksa" style="display: none"></canvas> --}}

                                                                    <textarea id="signatureedit{{ $item->id }}" name="ttd_pemeriksa" style="display: none"></textarea>
                                                                </div>



                                                            </div>




                                                            <div class="form-group">

                                                                <div class="mb-3">

                                                                    <label for="formFile" class="form-label">Upload Bukti
                                                                        Pemeriksaan</label>
                                                                    <input name="bukti_pemeriksaan"
                                                                        class="form-control input-rounded" id="formFileSm"
                                                                        type="file">
                                                                </div>

                                                            </div>



                                                            <div class="form-group">
                                                                <label for="">Dapatkan Lokasi Anda</label>
                                                                <br>
                                                                <div class="text-center">
                                                                    <span onclick="getlocationedit{{ $item->id }}()"
                                                                        class="btn btn-primary btn-sm mb-4"> <a><i
                                                                                class="fa fa-paper-plane"></i></a>
                                                                        Dapatkan</span>

                                                                </div>


                                                            </div>
                                                            <div hidden class="form-group">
                                                                <label for="">Lat</label>
                                                                <input name="lat" value="{{ $item->lat }}"
                                                                    id="latedit{{ $item->id }}" type="text"
                                                                    class="form-control input-rounded"
                                                                    placeholder="Input Place">
                                                            </div>

                                                            <div hidden class="form-group">
                                                                <label for="">Long</label>
                                                                <input name="long" value="{{ $item->long }}"
                                                                    id="longedit{{ $item->id }}" type="text"
                                                                    class="form-control input-rounded"
                                                                    placeholder="Input Place">
                                                            </div>

                                                            <script text="text/javascript">
                                                                function getlocationedit{{ $item->id }}() {
                                                                    if (navigator.geolocation) {
                                                                        navigator.geolocation.getCurrentPosition(showPositionedit{{ $item->id }});
                                                                    } else {
                                                                        swal("Wrong!", "Browser Anda Tidak Support", "error");
                                                                    }
                                                                }

                                                                function showPositionedit{{ $item->id }}(position) {

                                                                    $('#latedit{{ $item->id }}').val(position.coords.latitude);
                                                                    $('#longedit{{ $item->id }}').val(position.coords.longitude);

                                                                    swal("Done", "Lokasi Berhasil Didapatkan", "success");
                                                                }
                                                            </script>

                                                            <div class="form-group">
                                                                <label for="">Tempat</label>
                                                                <input name="tempat" type="text"
                                                                    value="{{ $item->tempat }}"
                                                                    class="form-control input-rounded"
                                                                    placeholder="Input Place" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Tanggal</label>
                                                                <input name="tanggal" type="date"
                                                                    value="{{ $item->tanggal }}"
                                                                    class="form-control input-rounded" placeholder=""
                                                                    required>
                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-danger" type="submit">Save</button>
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>




                                        </div>

                                        {{-- Modal Hapus --}}
                                        <div class="modal fade" id="hapusModal{{ $item->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Modal</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/datapoli-delete/{{ $item->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">Anda Yakin Akan Menghapus Data
                                                            {{ $item->user->name }}?</div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">No</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

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

                                        {{-- Modal Lokasi --}}
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

                        {{-- Modal Add --}}
                        <div class="modal fade" id="addModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Modal</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <form action="/datapoli" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <select name="id_user" class="form-control input-rounded"
                                                        id="sel1" required>
                                                        <option value="">Pilih Nama</option>
                                                        @foreach ($dataUser as $data)
                                                            <option value="{{ $data->id }}">
                                                                {{ $data->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Nama Pemeriksa</label>
                                                    <input name="nama_pemeriksa" type="text"
                                                        class="form-control input-rounded"
                                                        placeholder="Input Nama Pemeriksa" required>
                                                </div>


                                                <div class="form-group">

                                                    <div class="mb-3">

                                                        <label for="formFile" class="form-label">Upload TTD
                                                            Pemeriksa</label>
                                                        {{-- <input name="ttd_pemeriksa" class="form-control input-rounded"
                                                            id="formFileSm" type="file"> --}}
                                                        <div id="sig"></div>
                                                        <br /><br />
                                                        <button id="clear"
                                                            class="btn btn-danger btn-sm">Clear</button>
                                                        <textarea id="signature" name="ttd_pemeriksa" style="display: none"></textarea>
                                                    </div>



                                                </div>

                                                <div class="form-group">

                                                    <div class="mb-3">

                                                        <label for="formFile" class="form-label">Upload Bukti
                                                            Pemeriksaan</label>
                                                        <input name="bukti_pemeriksaan" class="form-control input-rounded"
                                                            id="formFileSm" type="file">
                                                    </div>

                                                </div>



                                                <div class="form-group">
                                                    <label for="">Dapatkan Lokasi Anda</label>
                                                    <br>
                                                    <div class="text-center">
                                                        <span onclick="getlocation()" class="btn btn-primary btn-sm mb-4">
                                                            <a><i class="fa fa-paper-plane"></i></a>
                                                            Dapatkan</span>
                                                        {{-- <button onclick="getlocation()"
                                                            class="btn btn-primary btn-sm mb-4">
                                                            <a><i class="fa fa-paper-plane"></i></a> Dapatkan</button> --}}
                                                    </div>
                                                </div>

                                                <div hidden class="form-group">
                                                    <label for="">Lat</label>
                                                    <input name="lat" id="lat" type="text"
                                                        class="form-control input-rounded" placeholder="Input Place">
                                                </div>

                                                <div hidden class="form-group">
                                                    <label for="">Long</label>
                                                    <input name="long" id="long" type="text"
                                                        class="form-control input-rounded" placeholder="Input Place">
                                                </div>



                                                <div class="form-group">
                                                    <label for="">Tempat</label>
                                                    <input name="tempat" type="text"
                                                        class="form-control input-rounded" placeholder="Input Place">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Tanggal</label>
                                                    <input name="tanggal" type="date"
                                                        class="form-control input-rounded" placeholder="" required>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" type="submit">Save</button>
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('sc/getlocation.js') }}"></script>
    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature',
            syncFormat: 'PNG',
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature").val('');
        });
    </script>

    @foreach ($dataPoli as $data)
        <script type="text/javascript">
            var sigedit{{ $data->id }} = $('#sigedit{{ $data->id }}').signature({
                syncField: '#signatureedit{{ $data->id }}',
                syncFormat: 'PNG',
            });

            function deletesignature{{ $data->id }}() {
                sigedit{{ $data->id }}.signature('clear');
                $("#signatureedit{{ $data->id }}").val('');
            }
        </script>
    @endforeach

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
    </script>
@endsection

@section('sweetalert')
    @if (Session::get('update'))
        <script>
            swal("Done", "Data Berhasil Diupdate", "success");
        </script>
    @endif
    @if (Session::get('delete'))
        <script>
            swal("Done", "Data Berhasil Dihapus", "success");
        </script>
    @endif
    @if (Session::get('create'))
        <script>
            swal("Done", "Data Berhasil Ditambahkan", "success");
        </script>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
