<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request('company') && Company::find(\request('company'))) {
            $employees = Employee::where('company_id', \request('company'))->latest()->paginate(2);
        } else {
            $employees = Employee::latest()->paginate(2);
        }

        $companies = Company::latest()->get();
        return view('front.employee.index', compact('employees', 'companies'));
    }
    function rules()
    {
        return [
            'name' => 'required|max:30',
            'company_id' => 'required'
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
        return view('front.employee.create');
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
        Employee::create($data);
        session()->flash('success', trans('success'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($employee)
    {
        $companies=Company::latest()->get();
        $employee=Employee::find($employee);
        return view('front.employee.edit', compact('employee','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$employee)
    {
        $rules = $this->rules();
        $message = $this->message();
        $data = $this->validate(\request(), $rules, [], $message);

        Employee::where('id',$employee)->update($data);
        session()->flash('success', trans('success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee)
    {

        Employee::where('id',$employee)->delete();
        session()->flash('success', trans('success'));
        return redirect()->back();
    }
}
