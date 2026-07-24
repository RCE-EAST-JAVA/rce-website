@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12 col-lg-9 col-md-12">
        <div class="row">
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon purple mb-2">
                                    <i class="iconly-boldShow"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Programs</h6>
                                <h6 class="font-extrabold mb-0">{{ \App\Models\Project::count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon blue mb-2">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total People</h6>
                                <h6 class="font-extrabold mb-0">{{ \App\Models\Staff::count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon green mb-2">
                                    <i class="iconly-boldAdd-User"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Users</h6>
                                <h6 class="font-extrabold mb-0">{{ \App\Models\User::count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Welcome to RCE East Java Admin Panel</h4>
                    </div>
                    <div class="card-body">
                        <p>From this dashboard, you have full control over the public website content, including:</p>
                        <ul>
                            <li>Adding, editing, or deleting <strong>Program Portfolio</strong>.</li>
                            <li>Managing profiles of academics, researchers, and practitioners in the <strong>People Directory</strong>.</li>
                            <li>Monitoring registered users in the portal.</li>
                        </ul>
                        <p class="text-muted mt-4 mb-3">Use the left menu to navigate to content management features or access official mail directly:</p>
                        <a href="{{ route('webmail.sso') }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary d-inline-flex align-items-center gap-2">
                            <i class="bi bi-envelope-fill"></i>
                            <span>Access Mail RCE East Java</span>
                            <i class="bi bi-box-arrow-up-right font-size-xs opacity-75" style="font-size: 0.8rem;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-3">
        <div class="card">
            <div class="card-body py-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl">
                        <img src="{{ asset('assets/compiled/jpg/1.jpg') }}" alt="Face 1">
                    </div>
                    <div class="ms-3 name">
                        <h5 class="font-bold">{{ auth()->user()->name }}</h5>
                        <h6 class="text-muted mb-0">{{ auth()->user()->email }}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body py-4 px-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="stats-icon red me-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(220, 53, 69, 0.15); border-radius: 0.75rem;">
                        <i class="bi bi-envelope-paper-fill text-danger fs-5"></i>
                    </div>
                    <div>
                        <h6 class="font-bold mb-0" style="font-size: 0.95rem;">Webmail Access</h6>
                        <small class="text-muted" style="font-size: 0.75rem;">mail.rce-eastjava.org</small>
                    </div>
                </div>
                <p class="text-muted" style="font-size: 0.825rem; line-height: 1.4;">Akses cepat layanan email resmi RCE East Java.</p>
                <a href="{{ route('webmail.sso') }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary font-bold w-100 d-flex align-items-center justify-content-between px-3 py-2">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill"></i>
                        <span>Buka Webmail</span>
                    </div>
                    <i class="bi bi-box-arrow-up-right opacity-75" style="font-size: 0.85rem;"></i>
                </a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body py-4 px-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="stats-icon yellow me-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(255, 193, 7, 0.18); border-radius: 0.75rem;">
                        <i class="bi bi-mortarboard-fill text-warning fs-5"></i>
                    </div>
                    <div>
                        <h6 class="font-bold mb-0" style="font-size: 0.95rem;">Sistem Bimbingan</h6>
                        <small class="text-muted" style="font-size: 0.75rem;">bimbingan.rce-eastjava.org</small>
                    </div>
                </div>
                <p class="text-muted" style="font-size: 0.825rem; line-height: 1.4;">Portal bimbingan dosen, admin, dan konfirmasi mahasiswa.</p>
                <a href="{{ route('bimbingan.sso') }}" target="_blank" rel="noopener noreferrer" class="btn btn-warning text-dark font-bold w-100 d-flex align-items-center justify-content-between px-3 py-2">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-mortarboard-fill"></i>
                        <span>Portal Bimbingan</span>
                    </div>
                    <i class="bi bi-box-arrow-up-right opacity-75" style="font-size: 0.85rem;"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
