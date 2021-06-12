<?php

namespace App\Http\Controllers;

use App\Company;
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
        $companies = Company::paginate(2);
        return view('front.company.index', compact('companies'));
    }

    function rules()
    {
        return [
            'name' => 'required|max:30',
            'description' => 'nullable|max:1000'
        ];
    }

    function message()
    {
        return [
            'name' => trans('name'),
            'description' => trans('description')
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->rules();
        $message = $this->message();
        $data = $this->validate(\request(), $rules, [], $message);
        Company::create($data);
        session()->flash('success', trans('success'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('front.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $rules = $this->rules();
        $message = $this->message();
        $data = $this->validate(\request(), $rules, [], $message);

        $company->update($data);
        session()->flash('success', trans('success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        session()->flash('success', trans('success'));
        return redirect()->back();
    }
}
