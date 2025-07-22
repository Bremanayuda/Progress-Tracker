@extends('layouts.dashboard')

@section('title', 'Edit Profil')

@section('content')
 <div class="edit-profile-wrapper">
    <div class="card edit-profile-card animate__animated animate__fadeIn" style="width: 100%; max-width: 480px;">
                <div class="card-header">Edit Profile</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3" style="text-align:center;">
                            @if(Auth::user()->foto)
                                <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil" style="width:64px; height:64px; border-radius:50%; object-fit:cover; margin-bottom:10px;">
                            @else
                                <span class="profile-avatar" style="width:64px; height:64px; font-size:32px; display:inline-flex; align-items:center; justify-content:center; margin-bottom:10px;">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="foto">Foto Profil</label>
                            <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" accept="image/*">
                            @error('foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <div class="form-control" style="background: #f8f9fa; cursor: default;">{{ Auth::user()->role }}</div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="created_at">Bergabung</label>
                            <div class="form-control" style="background: #f8f9fa; cursor: default;">{{ Auth::user()->created_at->format('d M Y') }}</div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="save-profile-btn">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 