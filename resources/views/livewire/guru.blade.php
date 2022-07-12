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
                        <li class="breadcrumb-item active">Guru</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <form class="form">
                  <div class="form-group">
                      <label>Nilai:{{ $frate }}</label>
                      <input type="range" class="form-control-range" min="1" max="5" wire:change='save_rate' wire:model='frate' value="{{ $frate ?? '' }}">
                  </div>
              </form>
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
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Cari</label>
                                    </div>
                                    <input type="text" class="form-control" placeholder="cari id atau nama" wire:keydown='cari' wire:model='cari'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                @isset($guru)
                                    @foreach ($guru as $key => $value)
                                        <div class="col-md-3">
                                            <div class="card bg-light m1">
                                                <div class="card-header text-muted border-bottom-0">
                                                    Guru
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="lead"><b>{{strtoupper($value->name)}}</b></h2>
                                                            <p class="text-muted text-sm"><b>{{$value->nmapel}}</b></p>
                                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-heart text-pink"></i></span>{{ $likedcount[$key] }}.</li>
                                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-star text-warning"></i></span>{{number_format($rate[$key], 1, '.', ',') }}({{ $ratedcount[$key] }}).</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-5 text-center">
                                                            <img src="vendor/adminlte/dist/img/user2-160x160.jpg" alt="" class="img-circle img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row text-right">
                                                        <div class="col-2 mx-0">
                                                            <button class="btn btn-sm @if($rated[$key]) btn-success @else btn-warning @endif" data-toggle="modal" data-target="#modal" wire:click="modal_rate({{ $value->id }})">
                                                                <i class="fas fa-star  text-white"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-2 mx-0">
                                                            <button class="btn btn-sm @if($liked[$key]) btn-success @else btn-warning @endif" wire:click="save_like({{ $value->id }})">
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
    });
</script>

