@extends('layouts.main')

@section('content')
    <div data-aos="fade-down" data-aos-duration="1500">
        <div class="row d-flex align-items-center">
            <div class="col">
                <div class="page-title mb-4 pt-5">
                    <h1 class="fw-bold">Data PPKS</h1>
                </div>
            </div>
            <div class="col pt-4">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb float-end">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data PPKS</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div data-aos="fade-down" data-aos-duration="1500">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
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
    </div>

    @if (Auth::user()->role != 3)
        <button class="btn btn-primary mb-3 p-10" type="button" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="fas fa-plus fs-6 me-2"></i>Tambah
        </button>
    @endif

    <!-- Page Title -->
    <div data-aos="fade-down" data-aos-duration="1500">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Table Data PPKS</h5>
                    <div class="row">
                        <table id="myTable2" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>KRITERIA</th>
                                    <th>TERMINASI</th>
                                    <th>NAMA</th>
                                    <th>NIK</th>
                                    <th>TEMPAT LAHIR</th>
                                    <th>TANGGAL LAHIR</th>
                                    <th>UMUR</th>
                                    <th>JENIS KELAMIN</th>
                                    <th>ALAMAT</th>
                                    <th>KECAMATAM</th>
                                    <th>FOTO</th>
                                    @if (auth()->user()->role == 1)
                                        <th>ACTION</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ppkss as $index => $ppks)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $ppks->jenis->jenis }}</td>
                                        <td>{{ $ppks->terminasi->nama ?? '-' }}</td>
                                        <td>{{ $ppks->nama }}</td>
                                        <td>{{ $ppks->nik }}</td>
                                        <td>{{ $ppks->tempatlahir }}</td>
                                        <td>{{ $ppks->tanggallahir }}</td>
                                        <td>{{ $ppks->umur }}</td>
                                        <td>{{ $ppks->jeniskelamin }}</td>
                                        <td>{{ $ppks->alamat }}</td>
                                        <td>{{ $ppks->kecamatan }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#seeImage{{ $loop->iteration }}">
                                                Foto
                                            </button>
                                        </td>
                                        @if (auth()->user()->role == 1)
                                            <td class="d-flex">
                                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $loop->iteration }}">
                                                    <i class="fas fa-pen-square text-white"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapus{{ $loop->iteration }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>

                                    <div class="modal fade" id="seeImage{{ $loop->iteration }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Lihat Foto</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d">
                                                    <div class="row">
                                                        <div class="col text-center">
                                                            <img class="rounded-3" style="object-fit: cover"
                                                                src="{{ asset('storage/' . $ppks->foto) }}"
                                                                alt="Foto {{ $ppks->nama }}" height="250"
                                                                width="350">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  MODAL SEE IMAGE  --}}

                                    <!-- Modal Edit -->
                                    <div class="modal fade editModal" id="editModal{{ $loop->iteration }}" tabindex="-1"
                                        aria-hidden="true" enctype="multipart/form-data">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Edit Data PPKS</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('datappks.update', $ppks->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="id_kriteria" class="form-label">Kriteria</label>
                                                            <select
                                                                class="form-select @error('id_kriteria') is-invalid @enderror"
                                                                id="id_kriteria" name="id_kriteria" required>
                                                                @foreach ($kriterias as $kriteria)
                                                                    <option value="{{ $kriteria->id }}"
                                                                        {{ $kriteria->id == old('id_kriteria', $ppks->id_kriteria) ? 'selected' : '' }}>
                                                                        {{ $kriteria->jenis }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('id_kriteria')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="id_terminasi" class="form-label">Terminasi</label>
                                                            <select
                                                                class="form-select @error('id_terminasi') is-invalid @enderror"
                                                                id="id_terminasi" name="id_terminasi">
                                                                <option value="">Pilih Terminasi (Optional)</option>
                                                                <!-- Opsi default kosong -->
                                                                @foreach ($terminasis as $terminasi)
                                                                    <option value="{{ $terminasi->id }}"
                                                                        {{ $terminasi->id == old('id_terminasi', $ppks->id_terminasi) ? 'selected' : '' }}>
                                                                        {{ $terminasi->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('id_terminasi')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="nama" class="form-label">Nama</label>
                                                            <input type="text"
                                                                class="form-control @error('nama') is-invalid @enderror"
                                                                name="nama" id="nama"
                                                                value="{{ old('nama', $ppks->nama) }}" autofocus required>
                                                            @error('nama')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="nik" class="form-label">NIK</label>
                                                            <input type="number"
                                                                class="form-control @error('nik') is-invalid @enderror"
                                                                name="nik" id="nik"
                                                                value="{{ old('nik', $ppks->nik) }}" autofocus>
                                                            @error('nik')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tempatlahir" class="form-label">Tempat
                                                                Lahir</label>
                                                            <input type="text"
                                                                class="form-control @error('tempatlahir') is-invalid @enderror"
                                                                name="tempatlahir" id="tempatlahir"
                                                                value="{{ old('tempatlahir', $ppks->tempatlahir) }}"
                                                                autofocus>
                                                            @error('tempatlahir')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tanggallahir" class="form-label">Tanggal
                                                                Lahir</label>
                                                            <input type="date"
                                                                class="form-control @error('tanggallahir') is-invalid @enderror"
                                                                name="tanggallahir" id="tanggallahir"
                                                                value="{{ old('tanggallahir', $ppks->tanggallahir) }}"
                                                                autofocus>
                                                            @error('tanggallahir')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="umur" class="form-label">Umur</label>
                                                            <input type="number"
                                                                class="form-control @error('umur') is-invalid @enderror"
                                                                name="umur" id="umur"
                                                                value="{{ old('umur', $ppks->umur) }}" autofocus>
                                                            @error('umur')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="jeniskelamin" class="form-label">Jenis
                                                                Kelamin</label>
                                                            <select
                                                                class="form-select @error('jeniskelamin') is-invalid @enderror"
                                                                id="jeniskelamin" name="jeniskelamin" required>
                                                                <option value="Laki-Laki"
                                                                    {{ old('jeniskelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                                                    laki-Laki
                                                                </option>
                                                                <option value="Perempuan"
                                                                    {{ old('jeniskelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                                    Perempuan
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="alamat" class="form-label">Alamat</label>
                                                            <input type="text"
                                                                class="form-control @error('alamat') is-invalid @enderror"
                                                                name="alamat" id="alamat"
                                                                value="{{ old('alamat', $ppks->alamat) }}" autofocus>
                                                            @error('alamat')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kecamatan" class="form-label">Kecamatan</label>
                                                            <input type="text"
                                                                class="form-control @error('kecamatan') is-invalid @enderror"
                                                                name="kecamatan" id="kecamatan"
                                                                value="{{ old('kecamatan', $ppks->kecamatan) }}" autofocus
                                                                required>
                                                            @error('kecamatan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="foto" class="form-label">Upload
                                                                Foto</label>
                                                            <img src="{{ asset('storage/' . $ppks->foto) }}"
                                                                class="img-previewnew1 img-fluid mb-3 col-sm-5 d-block">
                                                            <img class="img-previewnew1 img-fluid mb-3 col-sm-5">
                                                            <input
                                                                class="form-control @error('foto') is-invalid @enderror"
                                                                type="file" name="foto" id="fotonew1"
                                                                onchange="previewImagenew1()">
                                                            @error('foto')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="langitude" class="form-label">Latitute</label>
                                                            <input type="text"
                                                                class="form-control @error('langitude') is-invalid @enderror"
                                                                name="langitude" id="langitude"
                                                                value="{{ old('langitude', $ppks->langitude) }}" autofocus
                                                                required>
                                                            @error('langitude')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="longatitude" class="form-label">Longitute</label>
                                                            <input type="text"
                                                                class="form-control @error('longatitude') is-invalid @enderror"
                                                                name="longatitude" id="longatitude"
                                                                value="{{ old('longatitude', $ppks->longatitude) }}"
                                                                autofocus required>
                                                            @error('longatitude')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Modal Hapus -->
                                    <div class="modal fade modalHapus" id="modalHapus{{ $loop->iteration }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Hapus Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('datappks.destroy', $ppks->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus data {{ $ppks->nama }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- add Modal Tambah --}}
            <!-- Add User Modal -->
            <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Tambah Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('datappks.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="id_kriteria" class="form-label">Kriteria</label>
                                <select class="form-select @error('id_kriteria') is-invalid @enderror" id="id_kriteria"
                                    name="id_kriteria" required>
                                    @foreach ($kriterias as $kriteria)
                                        <option value="{{ $kriteria->id }}">{{ $kriteria->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_terminasi" class="form-label">Terminasi</label>
                                <select class="form-select @error('id_terminasi') is-invalid @enderror" id="id_terminasi"
                                    name="id_terminasi">
                                    <option value="">Pilih Terminasi (Optional)</option> <!-- Opsi default kosong -->
                                    @foreach ($terminasis as $terminasi)
                                        <option value="{{ $terminasi->id }}">{{ $terminasi->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" value="{{ old('nama') }}" autofocus required>
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                    name="nik" id="nik" value="{{ old('nik') }}" autofocus>
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tempatlahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempatlahir') is-invalid @enderror"
                                    name="tempatlahir" id="tempatlahir" value="{{ old('tempatlahir') }}" autofocus>
                                @error('tempatlahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggallahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tanggallahir') is-invalid @enderror"
                                    name="tanggallahir" id="tanggallahir" value="{{ old('tanggallahir') }}" autofocus>
                                @error('tanggallahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="umur" class="form-label">Umur</label>
                                <input type="number" class="form-control @error('umur') is-invalid @enderror"
                                    name="umur" id="umur" value="{{ old('umur') }}" autofocus>
                                @error('umur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jeniskelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select @error('jeniskelamin') is-invalid @enderror" id="jeniskelamin"
                                    name="jeniskelamin" required>
                                    <option value="Laki-Laki" {{ old('jeniskelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                        laki-Laki
                                    </option>
                                    <option value="Perempuan" {{ old('jeniskelamin') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" id="alamat" value="{{ old('alamat') }}" autofocus>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                    name="kecamatan" id="kecamatan" value="{{ old('kecamatan') }}" autofocus required>
                                @error('kecamatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Upload Foto <i>(png, jpeg, jpg)</i></label>
                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                <input class="form-control @error('foto') is-invalid @enderror" type="file"
                                    name="foto" id="foto" onchange="previewImage()" required>
                                @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="langitude" class="form-label">Lantitute</label>
                                <input type="text" class="form-control @error('langitude') is-invalid @enderror"
                                    name="langitude" id="langitude" value="{{ old('langitude') }}" autofocus required>
                                @error('langitude')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="longatitude" class="form-label">Longitute</label>
                                <input type="text" class="form-control @error('longatitude') is-invalid @enderror"
                                    name="longatitude" id="longatitude" value="{{ old('longatitude') }}" autofocus
                                    required>
                                @error('longatitude')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable({
                "scrollX": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Search...",
                    "decimal": ",",
                    "thousands": ".",
                },
                @if (Auth::user()->role == 3)
                    dom: 'Bfrtip',
                    buttons: [
                        'print'
                    ]
                @endif
            });

            $('.dataTables_filter input[type="search"]').css({
                "marginBottom": "10px"
            });
        });
    </script>

    <script>
        function previewImage() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(OFREvent) {
                imgPreview.src = OFREvent.target.result;
            }
        }

        function previewImagenew1() {

            const image1 = document.querySelector('#fotonew1');
            const imgPreview1 = document.querySelector('.img-previewnew1');

            imgPreview1.style.display = 'block';

            const oFReader1 = new FileReader();
            oFReader1.readAsDataURL(image1.files[0]);

            oFReader1.onload = function(OFREvent) {
                imgPreview1.src = OFREvent.target.result;
            }
        }
    </script>
@endsection
