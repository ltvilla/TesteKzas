@extends('admin.layouts.layout')

@section('content')
    @if($errors->all())
        @foreach($errors->all() as $error)
            <div class="container">
                <div class="row justify-content-center">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong class="justify-content-center">{{ $error }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="container col-6">
        <div class="row">
            <h1 class="mb-4">Dados Empresa</h1>
        </div>
    </div>
    <div class="container col-6">
        <div class="row justify-content-center ">
            <form action="{{ route('admin.companies.update', ['company' => $company->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $company->id }}">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Razao Social:</label>
                        <input type="text" name="name" required class="form-control" value="{{ $company->name }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" required class="form-control" value="{{ $company->email }}">
                    </div>
                    <div class="form-group col-12">
                    @if(!empty($company->logo))
                        <div>
                            <img src="{{ url(asset('/storage/' . $company->logo)) }}" class="img-thumbnail" height="200px" width="200px">
                        </div>
                    @else
                        <label for="logo">Logo</label>
                        <input type="file" name="logo" class="form-control" value="{{ $company->logo }}">
                    @endif
                    </div>

                    <div class="form-group col-12">
                        <label for="website">WebSite</label>
                        <input type="text" name="website" required class="form-control" value="{{ $company->website }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4">
                    Cadastrar
                </button>
            </form>
        </div>
    </div>
@endsection
