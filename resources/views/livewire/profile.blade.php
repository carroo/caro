<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" id="title-page">Profile {{ strtoupper($profile->name) }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">@if($isguru)Guru @else Murid @endif</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-circle"
                          width="100" height="100"
                          @if($profile->photo)
                           src="{{ "storage/photo/".$profile->photo }}"
                          @else
                           src="{{ "https://ui-avatars.com/api/?name=".$profile->name }}"
                          @endif
                           alt="User profile picture"
                      >
                    </div>
                    <h3 class="profile-username text-center">{{ strtoupper($profile->fullname) }}</h3>
                    <p class="text-muted text-center">({{ $profile->name }})</p>
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Rate</b> <a class="float-right">{{number_format($rate, 1, '.', ',') }}({{ $ratecount }})<i class="fas fa-sm fa-star text-warning"></i></a>
                      </li>
                      <li class="list-group-item">
                        <b>like</b> <a class="float-right">{{ $like }}<i class="fas fa-sm fa-heart text-pink"></i></a>
                      </li>
                      <li class="list-group-item">
                        <b>Rating/Liking</b> <a class="float-right">{{ $ratingcount.'/'.$likingcount }}</a>
                      </li>
                    </ul>
                    @if($profile->id != Auth::user()->id)
                        <div class="col">
                            <input type="range" class="form-control-range" wire:model='rated' wire:change='save_rate' min="1" max="5">
                        </div>
                        <div class="col">
                            <button class="btn btn-block  @if($liked) btn-info @else btn-warning @endif" wire:click="save_like">
                                <i class="fas fa-heart text-white"></i>
                            </button>
                        </div>
                    @endif
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
    
                <!-- About Me Box -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">About</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <strong><i class="fas fas fa-address-card mr-1"></i>@if($isguru) Nip @else Nisn @endif</strong>
                    <p class="text-muted">@if($isguru) {{ $profile->nip }} @else {{ $profile->nisn }} @endif</p>
                    <hr>
                    <strong><i class="fas fa-book mr-1"></i>@if($isguru) Mapel @else Kelas @endif</strong>
                    <p class="text-muted"> @if($isguru) {{ $profile->nmapel }} @else {{ $profile->kelas.'-'.$profile->fulljurusan }} @endif</p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i>Alamat</strong>
                    <p class="text-muted">{{ $profile->alamat }}</p>
                    <hr>
                    <strong><i class="fas fa-plus mr-1"></i>Info lengkap</strong>
                    <p class="text-muted">
                    <ul>
                        <li><i class="fas fa-sm fa-mail-bulk mr-1"></i>{{ $profile->email }}</li>
                        <li><i class="fas fa-sm fa-phone mr-1"></i>{{ $profile->phone }}</li>
                        <li><i class="fas fa-sm fa-birthday-cake mr-1"></i>{{ $profile->tgl_lahir }}</li>
                        <li><i class="fas fa-sm fa-venus-mars mr-1"></i>@if($profile->kelamin==1)Laki-laki @else Perempuan @endif</li>
                        <li><i class="fas fa-sm fa-star-and-crescent mr-1"></i>{{ $profile->nagama }}</li>
                    </ul>
                    </p>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li wire:ignore class="nav-item"><a class="nav-link active" href="#feedback" data-toggle="tab">Feedback</a></li>
                      <li wire:ignore class="nav-item"><a class="nav-link" href="#grafik" data-toggle="tab">Grafik</a></li>
                      @if($profile->id == Auth::user()->id)
                        <li wire:ignore class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                      @endif
                    </ul>
                  </div><!-- /.card-header -->
                  <div wire:ignore class="card-body">
                    <div class="tab-content">
                      <div wire:ignore class="active tab-pane" id="feedback">
                        <div class="col">
                          <div clas="row">
                          @if($profile->id == Auth::user()->id)
                             @foreach ($data_feedback as $item)
                              <strong><i class="fas fas fa-user mr-1"></i>Seorang siswa</strong>
                              <p class="text-muted">{{ $item->feed }}</p>
                              <hr>
                             @endforeach
                          @endif
                          @if($profile->id != Auth::user()->id)
                            <form class="form">
                              <label>Feedback</label>
                              <div class="input-group input-group-sm mb-0">
                                <input class="form-control form-control-sm" wire:model='feedback'>
                                <div class="input-group-append">
                                  <a wire:click='save_feedback' class="btn btn-info">Simpan</a>
                                </div>
                              </div>
                            </form>
                          @endif
                          </div>
                        </div>
                      </div>
                      <div wire:ignore class="tab-pane" id="grafik">
                        <div class="row">
                          <div class="col">
                            <canvas id="radar"></canvas>
                          </div>
                        </div>
                      </div>
                      @if($profile->id == Auth::user()->id)
                      <div wire:ignore class="tab-pane" id="settings">
                        <form class="form-horizontal">
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" wire:model='form.name'>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Nama lengkap</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" wire:model='form.fullname' >
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control"  wire:model='form.email'>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" wire:model='form.alamat'>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">NO Hp</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" wire:model='form.phone'>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Agama</label>
                            <div class="col-sm-10">
                              <select class="form-control" wire:model.prevent='form.agama'>
                                  <option value="">--Pilih--</option>
                                  @foreach ($agama as $item)
                                        <option value="{{ $item->id }}" @if($item->id==$profile->agama) selected @endif>{{ $item->agama }}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                              <input type="date" class="form-control" wire:model='form.tgl_lahir'>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tambah Foto</label>
                            <div class="col-sm-10">
                              <input type="file"  wire:model='photo'>
                            </div>
                            @error('photo') <span class="error">{{ $message }}</span> @enderror
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <a wire:click='updateprofile' class="btn btn-info">Simpan</a>
                            </div>
                          </div>
                        </form>
                      </div>
                      @endif
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
    $('select').select2({ width: '100%' });
    $('select').on('change', function(e) {
        var data = $('select').select2("val");
        @this.set('form.agama', data);
    });
    var marksCanvas =$("#radar");

    var radarChart = new Chart(marksCanvas, {
      type: 'radar',
      data: {
          labels: ['Tanggung jawab', 'Kedisiplinan', 'Sosialisasi', 'Perilaku','Keaktifan'],
          datasets: [{
              label: "nilai aspek",
              data: {{ json_encode($chart) }},
              borderColor: 'rgb(54, 162, 235)',
              fill: true,
              backgroundColor: 'rgba(54, 162, 235, 0.2)'
          }]
      },
      options: {
        scale: {
          ticks: {
            suggestedMax: 10,
            suggestedMin: 0
          }
        }
      }
    });
  });
</script>
