@extends("layouts.dashboard")
@section("content")
<div class="container">
    <div class="row my-2">
        <div class="col">
            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 card">
            <div class="card-body">
                <h1 class="card-title">Edit Profile</h1>
                <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <label for="name">Name</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{$user->name}}" value=" {{ $user->name}} ">
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        <label for="email">Email</label>
                        <input type="text" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{$user->email}}" value=" {{ $user->email}} ">
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
         <div class="form-group">
             <h3>Images</h3>
             <label for="avatar">Your Avatar</label>
             <input type="file" class="form-control-file @error('avatar') is-invalid @enderror" id="avatar" name="avatar">
             <div class="invalid-feedback">{{ $errors->first('avatar') }}</div>
             <label for="cover">Cover</label>
             <input type="file" class="form-control-file @error('cover') is-invalid @enderror" id="cover" name="cover">
             <div class="invalid-feedback">{{ $errors->first('cover') }}</div>
            </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
