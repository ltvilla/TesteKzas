<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\Company;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee as EmployeeRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('admin.employee', [
            'companies' => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('admin.employees.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $createEmployee = Employee::create($request->all());
        $addresse = new Address([
            'street' => $request->street,
            'number' => $request->number,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode
        ]);
        $createEmployee->addresse()->save($addresse);

        session()->put('valid', true);

        return  redirect()->route('admin.home', [
            'message' => 'Cadastro Realizado com Sucesso'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $employee = Employee::where('id', $id)->with(['addresse', 'company'])->first();

        return view('admin.employee_edit', [
            'companies' => $companies,
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::where('id', $id)->first();
        $employee->fill($request->all());
        $employee->save();

        $add = Address::where('employee_id', $id)->first();
        $add->fill($request->all());
        $add->save();

        session()->put('valid', true);

        return  redirect()->route('admin.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->first();
        if(!empty($employee)){
            $employee->delete();
        }
        session()->put('valid', true);
        return  redirect()->route('admin.home');
    }
}
