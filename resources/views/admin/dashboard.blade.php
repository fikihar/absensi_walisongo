@extends('layouts.app', ['title' => 'Dashboard'])

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>

            <div class="row">
                <!-- Total Admin -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>SISWA</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalSiswa }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-industry"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>DUDI</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalDudi }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>GURU PEMBIMBING</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalGuru }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Online Users -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>TOTAL ABSENSI</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalAbsensi }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
