@extends('layouts.mainlayout')

@section('title')
    Data User
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data User</h4>
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
                            <table class="table table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $no = 1;
                                    
                                    ?>
                                    @foreach ($userList as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->email }}</td>

                                            <td class="align-middle text-center">
                                                <span>
                                                    <a class="btn mb-1 btn-rounded btn-outline-success btn-sm"
                                                        href="/datauser-detail/{{ $item->id }}">Detail</a>
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
                                                    <form action="/datauser-update/{{ $item->id }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="">Name</label>
                                                                <input name="name" type="text"
                                                                    value="{{ $item->name }}"
                                                                    class="form-control input-rounded"
                                                                    placeholder="Input Name" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Username</label>
                                                                <input name="username" type="text"
                                                                    value="{{ $item->username }}"
                                                                    class="form-control input-rounded"
                                                                    placeholder="Input Username" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Email</label>
                                                                <input name="email" type="email"
                                                                    value="{{ $item->email }}"
                                                                    class="form-control input-rounded"
                                                                    placeholder="Input Email" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Password</label>
                                                                <input name="password" type="password"
                                                                    class="form-control input-rounded"
                                                                    placeholder="Input Password" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Re-Password</label>
                                                                <input name="repassword" type="password"
                                                                    class="form-control input-rounded"
                                                                    placeholder="Input Password" required>
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
                                                    <form action="/datauser-delete/{{ $item->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">Anda Yakin Akan Menghapus Data
                                                            {{ $item->name }}?</div>
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
                                    <form action="/datauser" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input name="name" type="text" class="form-control input-rounded"
                                                    placeholder="Input Name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Username</label>
                                                <input name="username" type="text" class="form-control input-rounded"
                                                    placeholder="Input Username" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input name="email" type="email" class="form-control input-rounded"
                                                    placeholder="Input Email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input name="password" type="password" class="form-control input-rounded"
                                                    placeholder="Input Password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Re-Password</label>
                                                <input name="repassword" type="password"
                                                    class="form-control input-rounded" placeholder="Input Password"
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
