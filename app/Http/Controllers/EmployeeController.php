<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Employee;
use Exception;
use Session;
use Redirect;

class EmployeeController extends Controller
{
    public function index()
    {
        $data['title'] = "Employees List";
        $data['employees'] = Employee::with('company')->paginate(10);
        return view('employees.listing', $data);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        try {
            $data['title'] = "Edit Employee";
            $data['details'] = Employee::find($id);
            $data['companies'] = Company::all();
            return view('employees.edit', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validation = Validator::make($request->all(), [
                'first_name' => 'required|max:50|min:3',
                'last_name' => 'required|max:50|min:3',
                'email' => 'required|unique:employees,email,' . $id,
                'phone' => 'required|unique:employees,phone,' . $id,
                'company_id' => 'required',

            ]);
            if ($validation->fails()) {
                return redirect()->back()->withInput($request->input())
                    ->withMessage($validation->errors()->first());
            }
            $employee = Employee::find($id);
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->company_id = $request->company_id;
            $employee->save();
            return redirect()->back()->withSuccess("Data has been successfully Updated.");
        } catch (\Exception $e) {
            return redirect()->back()->withMessage($e->getMessage());
        }
    }

    public function create()
    {
        $data['title'] = "Add New Employee";
        $data['companies'] = Company::all();
        return view('employees.add', $data);
    }

    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'first_name' => 'required|max:50|min:3',
                'last_name' => 'required|max:50|min:3',
                'email' => 'required|unique:employees,email',
                'phone' => 'required|unique:employees,phone',
                'company_id' => 'required',

            ]);
            if ($validation->fails()) {
                return redirect()->back()->withInput($request->input())
                    ->withMessage($validation->errors()->first());
            }
            $employee = new Employee;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->company_id = $request->company_id;
            $employee->save();
            return redirect()->back()->withSuccess("Data has been successfully inserted.");

        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->input())
                ->withMessage($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Employee::where('id', $id)->delete();
            return redirect()->back()->withSuccess("Data has been successfully Deleted.");
        } catch (\Exception $e) {
            return redirect()->back()->withMessage($e->getMessage());
        }

    }
}
