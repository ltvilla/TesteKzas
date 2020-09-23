<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company as CompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.company');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  redirect()->route('admin.companies.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $createCompany = Company::create($request->all());
        if(!empty($request->file('logo'))) {
            $createCompany->logo = $request->file('logo')->store('company');
            $createCompany->save();
        }

        session()->put('valid', false);

        return  redirect()->route('admin.home');
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
        $company = Company::where('id', $id)->first();

        return view('admin.company_edit', [
            'company' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company = Company::where('id', $id)->first();
        $company->fill($request->all());
        $company->save();

        if(!empty($request->file('logo'))) {
            $company->logo = $request->file('logo')->store('company');
            $company->save();
        }

        session()->put('valid', false);
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
        $company = Company::where('id', $id)->first();
        if(!empty($company)){
            $company->delete();
        }
        session()->put('valid', false);
        return  redirect()->route('admin.home');
    }

    public function apiPuraReturn()
    {
        $companies = Company::all();
        return $companies;
    }
}
