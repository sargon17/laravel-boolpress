@extends("layouts.dashboard")
@section("content")
<div class="row justify-content-between">
    <div class="col-auto">
        <h1>Tutti i posts</h1>
    </div>
    {{-- <div class="col-auto">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            Crea nuovo post
        </a>
    </div> --}}
</div>
<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th >ID</th>
            <th >Name</th>
            <th >Registration data</th>
            <th class="col-2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td scope='row'>{{$user->id}}</td>
                <td  scope='row'>{{$user->name}}</td>
                <td  scope='row'>{{$user->created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
