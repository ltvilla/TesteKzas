@extends('admin.layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
                <div class="col-4 p-5">
                    @if(isset($message))
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong class="justify-content-center">{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('admin.login.do') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" name="password" id="password" required min="1" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">
                            Entrar
                        </button>
                    </form>
                </div>
            <span class="border border-primary"></span>
                <div class="col-6 p-5">
                    <div class="container d-flex justify-content-center mt-2">
                        <div class="row ">
                            <div class="col">
                                <h1>Teste KZAS</h1>
                            </div>

                        </div>

                    </div>

                </div>
        </div>
    </div>
@endsection
