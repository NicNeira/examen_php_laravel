@extends('layouts.temp')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <!-- Statistics -->
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Estadísticas</h5>
                <small class="text-muted">Actualizado {{ now()->diffForHumans() }}</small>
            </div>
            <div class="card-body d-flex align-items-end">
                <div class="w-100">
                    <div class="row gy-3">
                        <!-- Usuarios -->
                        <div class="col-md-4 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded bg-label-primary me-4 p-2">
                                    <i class="ti ti-users ti-lg"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $totalUsers }}</h5>
                                    <small>Usuarios</small>
                                </div>
                            </div>
                        </div>
                        <!-- Productos -->
                        <div class="col-md-4 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded bg-label-danger me-4 p-2">
                                    <i class="ti ti-package ti-lg"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $totalProducts }}</h5>
                                    <small>Productos</small>
                                </div>
                            </div>
                        </div>
                        <!-- Clientes -->
                        <div class="col-md-4 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded bg-label-success me-4 p-2">
                                    <i class="ti ti-address-book ti-lg"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $totalClients }}</h5>
                                    <small>Clientes</small>
                                </div>
                            </div>
                        </div>
                        <!-- Puedes agregar más métricas si lo deseas -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection