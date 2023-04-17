@extends('layouts.mainlayout')

@section('title')
    Data Pengingat
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Pengingat</h4>

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
                                        <th>Nama Pengingat</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $no = 1;
                                    
                                    ?>
                                    @foreach ($dataDetailPengingat as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->pengingat->name }}</td>
                                            <td>{{ $item->pengingat->time }}</td>
                                            <td>
                                                @if ($item->status == 'sudah')
                                                    <span class="badge badge-success px-2">Sudah</span>
                                                @else
                                                    <span class="badge badge-danger px-2">Belum</span>
                                                @endif
                                            </td>

                                            <td>{{ $item->tanggal }}</td>

                                            <td class="align-middle text-center">
                                                <span>
                                                    <button data-toggle="modal" data-target="#editModal{{ $item->id }}"
                                                        type="button"
                                                        class="btn mb-1 btn-rounded btn-outline-warning btn-sm">Edit</button>
                                                    <button data-toggle="modal" data-target="#hapusModal{{ $item->id }}"
                                                        type="button"
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
                                                    <form action="/datapengingat-update/{{ $item->id }}"
                                                        method="post">
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
                                                                <label>Pengingat</label>
                                                                <select name="id_pengingat"
                                                                    class="form-control input-rounded" id="sel1">
                                                                    <option selected value="{{ $item->id_pengingat }}">
                                                                        {{ $item->pengingat->name }}</option>

                                                                    @foreach ($dataPengingat as $data)
                                                                        <option value="{{ $data->id }}">
                                                                            {{ $data->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select name="status" class="form-control input-rounded"
                                                                    id="sel1">


                                                                    @if ($item->status == 'sudah')
                                                                        <option selected value="sudah">
                                                                            Sudah</option>
                                                                        <option value="belum">
                                                                            Belum</option>
                                                                    @else
                                                                        <option value="sudah">
                                                                            Sudah</option>
                                                                        <option selected value="belum">
                                                                            Belum</option>
                                                                    @endif



                                                                </select>
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
                                                    <form action="/datapengingat-delete/{{ $item->id }}"
                                                        method="POST">
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
                                    <form action="/datapengingat" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <select name="id_user" class="form-control input-rounded"
                                                        id="sel1">
                                                        <option value="">Pilih Nama</option>

                                                        @foreach ($dataUser as $data)
                                                            <option value="{{ $data->id }}">
                                                                {{ $data->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Pengingat</label>
                                                    <select name="id_pengingat" class="form-control input-rounded"
                                                        id="sel1">
                                                        <option>Pilih Pengingat</option>

                                                        @foreach ($dataPengingat as $data)
                                                            <option value="{{ $data->id }}">
                                                                {{ $data->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control input-rounded"
                                                        id="sel1">
                                                        <option selected>Pilih Status</option>
                                                        <option value="sudah">
                                                            Sudah</option>
                                                        <option value="belum">
                                                            Belum</option>
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label for="">Tanggal</label>
                                                    <input name="tanggal" type="date"
                                                        class="form-control input-rounded" placeholder="" required>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" type="submit">Save</button>
                                                <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
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
    @if (Session::get('sudahada'))
        <script>
            swal("Whats Wrong!", "Data Sudah Ada", "error");
        </script>
    @endif
@endsection
