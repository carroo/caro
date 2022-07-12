@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pengaturan Data</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Pengaturan</li>
                        <li class="breadcrumb-item active">Data</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <main class="py-4">
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="/murid-data">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                
                                <div class="info-box-content">
                                    <span class="info-box-text">Murid</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="/guru-data">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user"></i></span>
                
                                <div class="info-box-content">
                                    <span class="info-box-text">Guru</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="/rate-data">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-star"></i></span>
                
                                <div class="info-box-content">
                                    <span class="info-box-text">Rate</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="/mapel-data">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-pen"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Mapel</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="/jurusan-data">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-pen"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Jurusan</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

