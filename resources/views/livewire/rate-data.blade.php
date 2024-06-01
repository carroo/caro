<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" id="title-page">Pengaturan data rate</h1>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rate Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="form-group">
                            <label>Penilai</label>
                            <select id="penilai" class="form-control"  wire:model="penilai">
                                <option value="">--Pilih--</option>
                                @foreach ($duser as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('penilai') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Dinilai</label>
                            <select id="dinilai" class="form-control" wire:model="dinilai">
                                <option value="">--Pilih--</option>
                                @foreach ($duser as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('dinilai') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Nilai:{{ $nilai }}</label>
                            <input type="range" class="form-control-range " min="1" max="5" @isset($nilai) @if ($nilai) value="{{ $nilai }}" @endif
                        @endisset wire:model="nilai">
                        @error('nilai') <span class="error text-danger">{{ $message }}</span> @enderror
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
                            <h3 class="card-title">Rate</h3>
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
                                    <th>Penilai</th>
                                    <th>Dinilai</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dnilai as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $dpenilai[$key]->name }}</td>
                                        <td>{{ $ddinilai[$key]->name }}</td>
                                        <td>{{ $value->nilai }}</td>
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
        $('select').select2();
        $('#penilai').on('change', function(e) {
            var data = $('#penilai').select2("val");
            @this.set('penilai', data);
        });
        $('#dinilai').on('change', function(e) {
            var data = $('#dinilai').select2("val");
            @this.set('dinilai', data);
        });
    });
</script>
