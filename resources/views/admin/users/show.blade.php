@extends("layouts.dashboard")
@section("content")
<div class="container">
     <div class="row my-2">
        <div class="col">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="hero">
                <div class="background">
                    <img src="{{ asset('storage/'. $user->cover) }}" alt="">
                </div>
                <div class="content">
                    <div class="avatar">
                        <img src="{{ asset('storage/'. $user->avatar) }}" alt="">
                    </div>
                    <div class="info">
                        <h1 class="username">{{ $user->name }}</h1>
                        <h2 class="email">{{ $user->email }}</h2>
                        <h3 class="created">Created {{ $user->created_at->diffForHumans() }}</h3>
                        <a class="btn btn-outline-primary" href="{{ route('admin.users.edit', $user->id) }}">Edit profile</a>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
