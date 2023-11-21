@extends('template')

@section('content')
    <div class="container d-flex align-items-center justify-content-center m-auto" style="height: 100vh;">
        <div class="card" style="width: 50%;">
            <div class="card-header">
                <h1>Login Page</h1>
            </div>
            <div class="card-body">
                <form action="{{ route("auth") }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="email/username">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="password">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection