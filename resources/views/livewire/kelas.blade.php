<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kalas</h1>
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
            <div class="col justify-content-center">
                <div class="card card-solid">
                    <div class="card-header">
                        <div class="row">
                            @if(Auth::user()->level == 0 )
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Cari Kelas</label>
                                    </div>
                                    <input type="text" class="form-control" placeholder="cari kelas"  wire:model='cari_kelas'>
                                    <button class="btn btn-info"  wire:click='cari_kelas'>Cari</button>
                                </div>
                            </div>
                            @elseif(Auth::user()->level == 1 )
                            <div class="col-6">
                                <button data-toggle="modal" data-target="#modal"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> <span>Buat Kelas</span>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Buat Kelas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form">
                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type='text' wire:model='form.nama' class='form-control' placeholder="example : Matematika 12 RPL 1">
                                            @error('form.nama') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Desc</label>
                                            <textarea rows="3" wire:model='form.desc' class='form-control' placeholder='example : setiap selasa jam 8-10'></textarea>
                                            @error('form.desc') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-block btn-primary" wire:click.privent='simpan'>Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self class="modal fade" id="modalloading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border text-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                @isset($kelas)
                                    @foreach ($kelas as $key => $value)
                                        <div class="col-md-3">
                                            <div class="card bg-light m1">
                                                <div class="card-header text-muted border-bottom-0">
                                                    {{ strtoupper($value->nama) }}
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="lead"><b>{{$value->name}}</b></h2>
                                                            <p class="text-sm"><b>{{$value->kode}}</b></p>
                                                            <p class="ml-4 mb-0 fa-ul text-muted">
                                                                <p class="text-muted text-sm">{!! nl2br($value->desc) !!}</p>
                                                            </p>
                                                        </div>
                                                        <div class="col-5 text-center">
                                                            <img  
                                                            @if($value->photo)
                                                                src="{{ "storage/photo/".$vallue->photo }}"
                                                            @else
                                                                src="{{ "https://ui-avatars.com/api/?name=".$value->name }}"
                                                            @endif 
                                                            alt="" class="img-circle img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="col">
                                                        <a href="kelas-info?id={{ $value->id }}" class="btn btn-block btn-primary">
                                                            <i class="fas fa-user"></i> Lihat Kelas
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
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

