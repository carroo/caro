<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" id="title-page">Pengaturan data murid</h1>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Murid Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" wire:model='form.name' placeholder="Nama">
                            @error('form.name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" wire:model='form.fullname' placeholder="Nama Lengkap">
                            @error('form.fullname') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" wire:model='form.email' placeholder="Email">
                            @error('form.email') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select id="kelas" class="form-control" wire:model="form.kelas">
                                <option value="">--Pilih--</option>
                                <option value="10">--10--</option>
                                <option value="11">--11--</option>
                                <option value="12">--12--</option>
                            </select>
                            @error('form.kelas') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <select id="jurusan" class="form-control" wire:model="form.jurusan">
                                <option value="">--Pilih--</option>
                                @foreach ($jurusan as $item)
                                    <option value="{{ $item->id }}">--{{ $item->jurusan }}--</option>
                                @endforeach
                            </select>
                            @error('form.jurusan') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>NISN</label>
                            <input type="number" class="form-control" wire:model='form.nisn' placeholder="NISN">
                            @error('form.nisn') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>tanggal Lahir</label>
                            <input type="date" class="form-control" wire:model='form.tgl_lahir' placeholder="Tanggal Lahir">
                            @error('form.tgl_lahir') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>No Hp</label>
                            <input type="number" class="form-control" wire:model='form.phone' placeholder="No Hp">
                            @error('form.phone') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <select id="agama" class="form-control" wire:model="form.agama">
                                <option value="">--Pilih--</option>
                                @foreach ($agama as $item)
                                    <option value="{{ $item->id }}">--{{ $item->agama }}--</option>
                                @endforeach
                            </select>
                            @error('form.agama') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Kelamin</label>
                            <select id="kelamin" class="form-control" wire:model="form.kelamin">
                                <option value="">--Pilih--</option>
                                <option value="1">--Laki Laki--</option>
                                <option value="2">--Perempuan--</option>
                            </select>
                            @error('form.kelamin') <span class="error text-danger">{{ $message }}</span> @enderror
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
                            <h3 class="card-title">Murid</h3>
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
                                    <th>Nama</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>NISN</th>
                                    <th>Tgl Lahir</th>
                                    <th>HP</th>
                                    <th>Agama</th>
                                    <th>Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($murid as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->fullname }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->kelas }}</td>
                                        <td>{{ $value->njurusan }}</td>
                                        <td>{{ $value->nisn }}</td>
                                        <td>{{ $value->tgl_lahir }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->nagama }}</td>
                                        <td>@if($value->kelamin==1)Laki-laki @elseif($value->kelamin==2) Perempuan @else lainnya @endif</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#modal" wire:click="edit({{ $value->id }})"><i
                                                    class="fa fa-pen"></i> <span>Edit</span></button>
                                            <button class="btn btn-sm btn-danger"
                                                wire:click="hapus({{ $value->id }})"><i class="fa fa-trash"></i>
                                                <span>Hapus</span></button>
                                            <form action="profile"class="form" method ="post">
                                                @csrf
                                                <input type="hidden" value="{{ $value->id }}" name="id_profile">
                                                <button type="submit" class="btn btn-sm btn-info">
                                                    <i class="fas fa-user"></i> Lihat Profile
                                                </button>
                                            </form>
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
        $('select').select2({
            width: '100%'
        });
        $('#kelas').on('change', function(e) {
            var data = $('#kelas').select2("val");
            @this.set('form.kelas', data);
        });
        $('#jurusan').on('change', function(e) {
            var data = $('#jurusan').select2("val");
            @this.set('form.jurusan', data);
        });
        $('#kelamin').on('change', function(e) {
            var data = $('#kelamin').select2("val");
            @this.set('form.kelamin', data);
        });
        $('#agama').on('change', function(e) {
            var data = $('#agama').select2("val");
            @this.set('form.agama', data);
        });
    });
</script>
