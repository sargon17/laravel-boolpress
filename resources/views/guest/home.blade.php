@extends("layouts.front-app")


@section("content")
NON CONNESSO

<div id="app">


</div>

<form action="{{ route('login') }}" method="GET" >

    <button type="submit" class="btn btn-primary">Login</button>
</form>
@endsection
