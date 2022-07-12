<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" id="title-page">Pengaturan data jurusan</h1>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Jurusan Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="form-group">
                            <label>kode</label>
                            <input type="text" class="form-control" wire:model='form.jurusan' placeholder="kode">
                            @error('form.jurusan') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" wire:model='form.lengkap' placeholder="Nama">
                            @error('form.lengkap') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-block btn-primary" wire:click.privent='simpan'>Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="card-title">jurusan</h3>
                        </div>
                        <div class="col-4">
                            <div class="float-sm-right">
                                <button data-toggle="modal" wire:click="reset_form" data-target="#modal"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> <span>Tambah</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover datatable">
                            <thead class="bg-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Jurusan</th>
                                    <th>kode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jurusan as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->lengkap }}</td>
                                        <td>{{ $value->jurusan }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#modal" wire:click="edit({{ $value->id }})"><i
                                                    class="fa fa-pen"></i> <span>Edit</span></button>
                                            <button class="btn btn-sm btn-danger"
                                                wire:click="hapus({{ $value->id }})"><i class="fa fa-trash"></i>
                                                <span>Hapus</span></button>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    $(document).ready(function() {
    });
</script>
