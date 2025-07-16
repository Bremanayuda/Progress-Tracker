@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-body">
                    <div class="mb-4">
                        <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="card-title mb-2">{{ Auth::user()->name }}</h4>
                    <p class="card-text mb-1"><strong>Email:</strong> <span class="fs-5">{{ Auth::user()->email }}</span></p>
                    <p class="card-text mb-1"><strong>Role:</strong> <span class="fs-5">{{ Auth::user()->role }}</span></p>
                    <p class="card-text mb-4"><strong>Bergabung:</strong> <span class="fs-5">{{ Auth::user()->created_at->format('d M Y') }}</span></p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-danger btn-lg w-100">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 