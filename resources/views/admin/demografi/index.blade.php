@extends('layouts.theme.backend.master')
@section('title')
    Demografi Desa
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Data Penduduk</h5>
                        <small class="text-muted">Total {{ number_format($total_penduduk) }} Jiwa</small>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0 mt-4">
                        @foreach ($penduduk as $pdd)
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-user"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{ $pdd->title }}</h6>
                                        <small class="text-muted">Total Seluruh Mencapai</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($pdd->jumlah) }}</small>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Data Pekerjaan</h5>
                        <small class="text-muted">Total {{ number_format($total_pekerjaan) }} Jenis Pekerjaan</small>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0 mt-4">
                        @foreach ($pekerjaan as $pjk)
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-user"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{ $pjk->title }}</h6>
                                        <small class="text-muted">Total Seluruh Mencapai</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($pjk->jumlah) }}</small>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Data Pendidikan</h5>
                        <small class="text-muted">Total {{ number_format($total_pendidikan) }} Status Pendidikan</small>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0 mt-4">
                        @foreach ($pendidikan as $skl)
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-user"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{ $skl->title }}</h6>
                                        <small class="text-muted">Total Seluruh Mencapai</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($skl->jumlah) }}</small>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Data Agama</h5>
                        <small class="text-muted">Total {{ number_format($total_agama) }} Jenis Agama</small>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0 mt-4">
                        @foreach ($agama as $agm)
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-user"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{ $agm->title }}</h6>
                                        <small class="text-muted">Total Seluruh Mencapai</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($agm->jumlah) }}</small>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
