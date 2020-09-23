@extends('admin.layouts.layout')

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{$navItems['sel1']}}" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Listar Empresas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{$navItems['sel2']}}" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Listar Funcionários</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade {{$navItems['data1']}}" id="home" role="tabpanel" aria-labelledby="home-tab">
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
            <section>
                <header class="p-2">
                    <h3 class="icon-tachometer">Últimos cadastrados realizados de empresas</h3>
                </header>
                <div class="dash_content_app_box">
                    <div class="dash_content_app_box_stage">
                        <table id="dataTable" class="table nowrap hover stripe" width="100" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Razao Social</th>
                                <th>Email</th>
                                <th>website</th>
                                <th>Criado em</th>
                                <th>Ultima atualização</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($companies as $company)
                                <tr>
                                    <td><a href="{{ route('admin.companies.edit', ['company' => $company->id ]) }}"> {{ $company->id }}</a></td>
                                    <td>{{ $company->name }}</td>
                                    <td><a href="mailto:teste@kzas.com?body=Esse é um teste para se tornar um programador no Kzas " class="alert-primary">{{ $company->email }}</a></td>
                                    <td><a href="{{$company->website}}" target="_blank">{{ $company->website }}</a></td>
                                    <td>{{ $company->created_at }}</td>
                                    <td>{{ $company->updated_at }}</td>
                                    <td>
                                    <form method="post" action="{{ route('admin.companies.destroy', ['company' => $company->id])  }}"
                                          onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($company->name) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-center d-flex">
                        {{ $companies->links() }}
                    </div>
                </div>
            </section>

        </div>


        <div class="tab-pane fade {{$navItems['data2']}}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <section>
                <header class="p-2">
                    <h3 class="icon-tachometer">Últimos cadastrados realizados de funcionários</h3>
                </header>
                <div class="dash_content_app_box">
                    <div class="dash_content_app_box_stage">
                        <table id="dataTable" class="table nowrap hover stripe" width="100" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>email</th>
                                <th>CPF</th>
                                <th>Empresa</th>
                                <th>Cidade</th>
                                <th>Criado em</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($employees as $employee)
                                <tr >
                                    <td><a href="{{ route('admin.employees.edit', ['employee' => $employee->id ]) }}"> {{ $employee->id }}</a></td>
                                    <td>{{ $employee->name }}</td>
                                    <td><a href="mailto:teste@kzas.com?body=Esse é um teste para se tornar um programador no Kzas " class="alert-primary">{{ $employee->email }}</a></td>
                                    <td>{{ $employee->CPF }}</td>
                                    <td>{{ ($employee->company->name) ?? '' }}</td>
                                    <td>{{ $employee->addresse->city }}</td>
                                    <td>{{ $employee->created_at }}</td>
                                    <td>
                                        <form method="post" action="{{ route('admin.employees.destroy', ['employee' => $employee->id])  }}"
                                              onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($employee->name) }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
