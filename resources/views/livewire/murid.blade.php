<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" id="title-page">Rating</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Murid</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            @if(Auth::user()->level == 1)
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rate Aspek murid</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="form-group">
                            <label>Tanggung Jawab:{{ $formaspek['tanggung_jawab'] ?? '?' }}</label>
                            <input type="range" class="form-control-range" min="1" max="10" wire:model='formaspek.tanggung_jawab'>
                        </div>
                        @error('formaspek.tanggung_jawab') <span class="error text-danger">{{ $message }}</span> @enderror
                        <div class="form-group">
                            <label>Kedisiplinan:{{ $formaspek['kedisiplinan'] ?? '?' }}</label>
                            <input type="range" class="form-control-range" min="1" max="10" wire:model='formaspek.kedisiplinan'>
                        </div>
                        @error('formaspek.kedisiplinan') <span class="error text-danger">{{ $message }}</span> @enderror
                        <div class="form-group">
                            <label>Sosialisasi:{{ $formaspek['sosialisasi'] ?? '?' }}</label>
                            <input type="range" class="form-control-range" min="1" max="10" wire:model='formaspek.sosialisasi'>
                        </div>
                        @error('formaspek.sosialisasi') <span class="error text-danger">{{ $message }}</span> @enderror
                        <div class="form-group">
                            <label>Perilaaku:{{ $formaspek['perilaku'] ?? '?' }}</label>
                            <input type="range" class="form-control-range" min="1" max="10" wire:model='formaspek.perilaku'>
                        </div>
                        @error('formaspek.perilaku') <span class="error text-danger">{{ $message }}</span> @enderror
                        <div class="form-group">
                            <label>Keaktifan:{{ $formaspek['keaktifan'] ?? '?' }}</label>
                            <input type="range" class="form-control-range" min="1" max="10" wire:model='formaspek.keaktifan'>
                        </div>
                        @error('formaspek.keaktifan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-block btn-primary" wire:click.privent='simpan_aspek'>Simpan</button>
                </div>
            @elseif(Auth::user()->level == 0)
                <div class="modal-body">
                    <form class="form">
                        <div class="form-group">
                            <label>Nilai:{{ $frate }}</label>
                            <input type="range" class="form-control-range" min="1" max="5" wire:change='save_rate' wire:model='frate' value="{{ $frate ?? '' }}">
                        </div>
                    </form>
                </div>
            @else
            @endif
          </div>
        </div>
    </div>
    <main>
        <div class="container-fluid">
            <div class="col justify-content-center">
                <div class="card card-solid">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4">
                                <div wire:ignore class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Kelas</label>
                                    </div>
                                    <select id="dkelas" class="custom-select s2ga" wire:change='ckelas' wire:model='dkelas'>
                                        <option value="" @isset($ckelas)@if(!$ckelas) selected @endif @endisset>--- Semua ---</option>
                                        <option value="10">--- 10 ---</option>
                                        <option value="11">--- 11 ---</option>
                                        <option value="12">--- 12 ---</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div wire:ignore class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Jurusan</label>
                                    </div>
                                    <select id="djurusan" class="custom-select s2ga" wire:change='cjurusan' wire:model='djurusan'>
                                        <option value="" @isset($cjurusan)@if(!$cjurusan) selected @endif @endisset>--- Semua ---</option>
                                        @foreach ($jurusan as $key => $value)
                                            <option value="{{$value->id}}">---{{$value->jurusan}}---</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Cari</label>
                                    </div>
                                    <input type="text" class="form-control" placeholder="cari nisn atau nama" wire:keydown='carinisn' wire:model='dnisn'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                @isset($murid)
                                    @foreach ($murid as $key => $value)
                                        <div class="col-md-3">
                                            <div class="card bg-light m1">
                                                <div class="card-header text-muted border-bottom-0">
                                                    Murid
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="lead"><b>{{strtoupper($value->name)}}</b></h2>
                                                            <p class="text-muted text-sm"><b>{{$value->kelas.'-'.$value->njurusan}}</b></p>
                                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-heart text-pink"></i></span>{{ $likedcount[$key] }}.</li>
                                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-star text-warning"></i></span>{{number_format($drate[$key], 1, '.', ',') }}({{ $ratedcount[$key] }}).</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-5 text-center">
                                                            <img  
                                                            @if($value->photo)
                                                                src="{{ "storage/photo/".$value->photo }}"
                                                            @else
                                                                src="{{ "https://ui-avatars.com/api/?name=".$value->name }}"
                                                            @endif 
                                                            alt="" class="img-circle img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row text-right">
                                                        <div class="col-2 mx-0">
                                                            @if(Auth::user()->level == 1)
                                                            <button class="btn btn-sm @if($ratedaspek[$key]) btn-success @else btn-warning @endif" data-toggle="modal" data-target="#modal" wire:click="rating_aspek({{ $value->id }})">
                                                                <i class="fas fa-star  text-white"></i>
                                                            </button>
                                                            @elseif(Auth::user()->level == 0)
                                                            <button class="btn btn-sm @if($rated[$key]) btn-success @else btn-warning @endif" data-toggle="modal" data-target="#modal" wire:click="rating({{ $value->id }})">
                                                                <i class="fas fa-star  text-white"></i>
                                                            </button>
                                                            @else
                                                            @endif
                                                        </div>
                                                        <div class="col-2 mx-0">
                                                            <button class="btn btn-sm @if($liked[$key]) btn-success @else btn-warning @endif" wire:click="liking({{ $value->id }})">
                                                                <i class="fas fa-heart  text-white"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-8 mx-0">
                                                            <form action="profile"class="form" method ="post">
                                                                @csrf
                                                                <input type="hidden" value="{{ $value->id }}" name="id_profile">
                                                                <button type="submit" class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-user"></i> Lihat Profile
                                                                </button>
                                                            </form>
                                                        </div>
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
        $('select').select2();
        $('#dkelas').on('change', function(e) {
            var data = $('#dkelas').select2("val");
            @this.set('dkelas', data);
        });
        $('#djurusan').on('change', function(e) {
            var data = $('#djurusan').select2("val");
            @this.set('djurusan', data);
        });
    });
</script>

