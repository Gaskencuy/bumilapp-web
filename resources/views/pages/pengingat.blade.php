@extends('layouts.mainlayout')

@section('title')
    Pengingat
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pengingat</h4>
                        <div class="align-right text-right">
                            <button data-toggle="modal" data-target="#addModal" type="button"
                                class="btn mb-1 btn-rounded btn-outline-warning btn-sm ms-auto">Add</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $no = 1;
                                    
                                    ?>
                                    @foreach ($itemList as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <th>{{ $item->time }}</th>

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
                                                    <form action="/pengingat-update/{{ $item->id }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="">Name</label>
                                                                <input name="nama" type="text"
                                                                    value="{{ $item->nama }}"
                                                                    class="form-control input-rounded"
                                                                    placeholder="Input Rounded" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Time</label>
                                                                <div class="input-group clockpicker">

                                                                    <input type="text" name="time"
                                                                        class="form-control input-rounded"
                                                                        value="{{ $item->time }}" placeholder="Input Time"
                                                                        required>
                                                                    <span class="input-group-append"><span
                                                                            class="input-group-text"><i
                                                                                class="fa fa-clock-o"></i></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-success" type="submit">Save</button>
                                                            <button type="button" class="btn btn-danger"
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
                                                        <h5 class="modal-title">Logout Modal</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/pengingat-delete/{{ $item->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">Anda Yakin Akan Menghapus Data
                                                            {{ $item->nama }}?</div>
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
                                    <form action="/pengingat" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input name="nama" type="text" class="form-control input-rounded"
                                                    placeholder="Input Name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Time</label>
                                                <div class="input-group clockpicker">

                                                    <input type="text" name="time"
                                                        class="form-control input-rounded" placeholder="Input Time"
                                                        required>
                                                    <span class="input-group-append"><span class="input-group-text"><i
                                                                class="fa fa-clock-o"></i></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success" type="submit">Save</button>
                                            <button type="button" class="btn btn-danger"
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
@endsection
