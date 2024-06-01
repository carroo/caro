<div class="content-wrapper">
    <div wire:ignore.self class="modal fade" id="edit_kelas" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type='text' wire:model='form_edit_kelas.nama' class='form-control'
                                placeholder="example : Matematika 12 RPL 1">
                            @error('form_edit_kelas.nama')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Desc</label>
                            <textarea rows="3" wire:model='form_edit_kelas.desc' class='form-control'
                                placeholder='example : setiap selasa jam 8-10'></textarea>
                            @error('form_edit_kelas.desc')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-block btn-primary" wire:click.privent='simpan_edit_kelas'>Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modaltugas" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type='text' wire:model='form_tugas.nama_tugas' class='form-control'
                                placeholder="example : Matematika 12 RPL 1">
                            @error('form_tugas.nama_tugas')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" rows="5" wire:model='form_tugas.deskripsi_tugas'></textarea>
                            @error('form_tugas.deskripsi_tugas')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-block btn-primary" wire:click.privent='simpan_tugas'>Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="pesertaKelas" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Peserta Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($murid as $key => $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->kelas . $value->jurusan }}</td>
                                        <td>
                                            <div class="row">
                                                <form action="profile"class="form" method ="post">
                                                    @csrf
                                                    <input type="hidden" value="{{ $value->murid_id }}"
                                                        name="id_profile">
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </form>
                                                @if (Auth::user()->id == $kelasinfo->guru_id)
                                                    <button
                                                        onclick="confirm('Yakin mengeluarkan?') || event.stopImmediatePropagation()"
                                                        wire:click='keluarkan_murid({{ $value->murid_id }})'
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" id="title-page">Kelas {{ strtoupper($kelasinfo->nama) }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">kelas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-circle" width="100" height="100"
                                    @if ($kelasinfo->photo) src="{{ 'storage/photo/' . $kelasinfo->photo }}"
                          @else
                           src="{{ 'https://ui-avatars.com/api/?name=' . $kelasinfo->name }}" @endif
                                    alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ strtoupper($kelasinfo->nama) }}</h3>
                            <p class="text-muted text-center">({{ $kelasinfo->name }})-({{ $kelasinfo->kode }})</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <p>{!! nl2br($kelasinfo->desc) !!}</p>
                            </ul>
                            @if (Auth::user()->level == 0)
                                <div class="col">
                                    <form action="profile"class="form" method ="post">
                                        @csrf
                                        <input type="hidden" value="{{ $kelasinfo->guru_id }}" name="id_profile">
                                        <button type="submit" class="btn btn-block btn-primary">
                                            <i class="fas fa-user"></i> Lihat Profile
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="col">
                                @if (Auth::user()->level == 0)
                                    <button class="btn btn-block btn-danger"
                                        onclick="confirm('Yakin keluar?') || event.stopImmediatePropagation()"
                                        wire:click="keluar_kelas">
                                        <i class="fas fa-sign-out-alt text-white"></i>Keluar Kelas
                                    </button>
                                @elseif(Auth::user()->id == $kelas_info->guru_id)
                                    <button class="btn btn-block btn-warning" data-toggle="modal"
                                        data-target="#edit_kelas">
                                        <i class="fas fa-pen text-white">Edit Kelas</i>
                                    </button>
                                @endif
                                <button class="btn btn-block btn-primary" data-toggle="modal"
                                    data-target="#pesertaKelas">
                                    <i class="fas fa-pen text-white">Peserta Kelas</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <span>Tugas</span>
                        </div><!-- /.card-header -->
                        <div wire:ignore.self class="card-body">
                            <div class="tab-content">
                                <div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="float-sm-lift">
                                                <span>Daftar Tugas</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            @if (Auth::user()->id == $kelasinfo->guru_id)
                                                <div class="float-sm-right">
                                                    <button data-toggle="modal" data-target="#modaltugas"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa fa-plus"></i> <span>Tambah</span>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="table-responsive">
                                                <table id="ga" class="table table-hover table-sm">
                                                    <thead class="bg-primary">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($kelas_tugas as $key => $value)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $value->nama_tugas }}</td>
                                                                <td>
                                                                    <div class="row">
                                                                        <button
                                                                            onclick="$('#tugas_info')[0].scrollIntoView()"
                                                                            wire:click="tugas_info({{ $value->id }})"
                                                                            class="btn btn-sm btn-primary">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button>
                                                                        @if (Auth::user()->id == $kelasinfo->guru_id)
                                                                            <button
                                                                                wire:click='edit_tugas({{ $value->id }})'
                                                                                data-toggle="modal"
                                                                                data-target="#modaltugas"
                                                                                class="btn btn-sm btn-warning text-white">
                                                                                <i class="fas fa-pen"></i>
                                                                            </button>
                                                                            <button
                                                                                onclick="confirm('Yakin menghapus?') || event.stopImmediatePropagation()"
                                                                                wire:click='hapus_tugas({{ $value->id }})'
                                                                                class="btn btn-sm btn-danger">
                                                                                <i class="fas fa-ban"></i>
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tugas_info" class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <span>Informasi Tugas </span>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            @if ($tugas_info)
                                <div class="row">
                                    <div class="container p-3 my-3 border">
                                        <h3 class="m-0 text-dark">Nama tugas :
                                            {{ strtoupper($tugas_info->nama_tugas) }}</h3>
                                        <p>{!! nl2br($tugas_info->deskripsi_tugas) !!}</p>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    $(document).ready(function() {});
</script>
