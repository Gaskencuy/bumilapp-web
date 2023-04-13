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
                            <table class="table table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Pemeriksa</th>
                                        <th>TTD Pemeriksa</th>
                                        <th>Bukti Pemeriksaan</th>
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
                                                    <button data-toggle="modal" data-target="#ttdModal{{ $item->id }}"
                                                        type="button"
                                                        class="btn mb-1 btn-rounded btn-outline-warning btn-sm">Detail</button>
                                            </td>

                                            <td class="align-middle text-center">
                                                <span>
                                                    <button data-toggle="modal" data-target="#buktiModal{{ $item->id }}"
                                                        type="button"
                                                        class="btn mb-1 btn-rounded btn-outline-warning btn-sm">Detail</button>
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
                                                                <label for="">Upload TTD Pemeriksa</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend"><span
                                                                            class="input-group-text">Upload</span>
                                                                    </div>
                                                                    <div class="custom-file">
                                                                        <input name="ttd_pemeriksa" type="file"
                                                                            class="custom-file-input">
                                                                        <label class="custom-file-label">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Upload Bukti Pemeriksaan</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend"><span
                                                                            class="input-group-text">Upload</span>
                                                                    </div>
                                                                    <div class="custom-file">
                                                                        <input name="bukti_pemeriksaan" type="file"
                                                                            class="custom-file-input">
                                                                        <label class="custom-file-label">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>

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


                                                        <img class="d-block w-100"
                                                            src="{{ asset('foto/bukti/' . $item['bukti_pemeriksaan']) }}"
                                                            alt="First slide">


                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- Modal TTD --}}
                                        <div class="modal fade" id="ttdModal{{ $item->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">TTD Modal</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <img class="d-block w-100"
                                                            src="{{ asset('foto/ttd/' . $item['ttd_pemeriksa']) }}"
                                                            alt="">

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

                                                {{-- @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif --}}

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
                                                    <label for="">Upload TTD Pemeriksa</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span
                                                                class="input-group-text">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input name="ttd_pemeriksa" type="file"
                                                                class="custom-file-input" required>
                                                            <label class="custom-file-label">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Upload Bukti Pemeriksaan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span
                                                                class="input-group-text">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input name="bukti_pemeriksaan" type="file"
                                                                class="custom-file-input" required>
                                                            <label class="custom-file-label">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Tempat</label>
                                                    <input name="tempat" type="text"
                                                        class="form-control input-rounded" placeholder="Input Place"
                                                        required>
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
