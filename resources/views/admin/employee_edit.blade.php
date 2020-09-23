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
            <h1 class="mb-4">Dados Pessoais</h1>
        </div>
    </div>
    <div class="container col-6">
        <div class="row justify-content-center">
            <form action="{{ route('admin.employees.update', ['employee'=> $employee->id]  ) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $employee->id }}">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nome:</label>
                        <input type="text" name="name" required class="form-control" placeholder="Nome Completo" value="{{ $employee->name  }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" required class="form-control" placeholder="email@example.com" value="{{ $employee->email  }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="phone">Telefone:</label>
                        <input type="tel" name="phone" id="phone" class="form-control" required placeholder="00000-0000" value="{{ $employee->phone  }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="CPF">CPF:</label>
                        <input type="text" name="CPF" id="CPF" required class="form-control" placeholder="000.000.000-00" value="{{ $employee->CPF  }}">
                    </div>
                    <label for="">Empresa Contratante:</label>
                    <select name="company_id" class="form-group col-12">
                        <option value="" selected disabled="true">Selecione uma empresa</option>
                        @foreach($companies as $company)
                            @if(!empty($employee->company_id))
                                <option value="{{ $company->id  }}" {{ ($employee->company->id === $company->id) ? 'selected' : ''}}>{{ $company->name }}</option>
                            @else
                                <option value="{{ $company->id  }}">{{ $company->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if(!empty($employee->company->logo))
                    <div>
                        <img src="{{ url(asset('/storage/' . $employee->company->logo)) }}" class="img-thumbnail" height="100px" width="100px">
                    </div>
                    @endif
                    <div class="container col-12">
                        <div class="row">
                            <h2 class="mb-4">Endereço</h2>
                        </div>
                    </div>
                    <div class="form-group col-3">
                        <label for="zipcode">CEP:</label>
                        <input type="text" name="zipcode" id="zipcode" required class="form-control" autocomplete="off" placeholder="00000-000" value="{{ $employee->addresse->zipcode  }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="street">Rua:</label>
                        <input type="text" name="street" id="street" class="form-control" value="{{ $employee->addresse->street  }}">
                    </div>
                    <div class="form-group col-3">
                        <label for="number">Numero:</label>
                        <input type="text" name="number" id="number" class="form-control" placeholder="Nº" value="{{ $employee->addresse->number  }}">
                    </div>
                    <div class="form-group col-5">
                        <label for="neighborhood">Bairro:</label>
                        <input type="text" name="neighborhood"  id="neighborhood" class="form-control" value="{{ $employee->addresse->neighborhood  }}">
                    </div>
                    <div class="form-group col-5">
                        <label for="city">Cidade:</label>
                        <input type="text" name="city"  id="city" class="form-control" value="{{ $employee->addresse->city  }}">
                    </div>
                    <div class="form-group col-2">
                        <label for="state">Estado:</label>
                        <input type="text" name="state" id="state"  class="form-control" value="{{ $employee->addresse->state  }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4">
                    Atualizar
                </button>
            </form>
        </div>
    </div>
    <script>
        $("#zipcode").mask('00000-000', {reverse: true});
        $("#CPF").mask('000.000.000-00', {reverse: true});
        $("#phone").mask('00000-0000', {reverse: true});
        $(document).ready( function () {
            $('#zipcode').blur(function () {
                function emptyForm() {
                    $("#street").val("");
                    $("#neighborhood").val("");
                    $("#city").val("");
                    $("#state").val("");
                }

                var zip_code = $(this).val().replace(/\D/g, '');
                var validate_zip_code = /^[0-9]{8}$/;

                if (zip_code != "" && validate_zip_code.test(zip_code)) {

                    $("#street").val("");
                    $("#neighborhood").val("");
                    $("#city").val("");
                    $("#state").val("");

                    $.getJSON("https://viacep.com.br/ws/" + zip_code + "/json/?callback=?", function (data) {

                        if (!("erro" in data)) {
                            $("#street").val(data.logradouro);
                            $("#neighborhood").val(data.bairro);
                            $("#city").val(data.localidade);
                            $("#state").val(data.uf);
                        } else {
                            emptyForm();
                            alert("CEP não encontrado.");
                        }
                    });
                } else {
                    emptyForm();
                    alert("Formato de CEP inválido.");
                }
            });
        })

    </script>
@endsection


