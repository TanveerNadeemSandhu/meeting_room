<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::all();
        return view('admin.employee.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'       => 'required',
            'department' => 'required'
        ]);
        if($validator->passes()){
            Employee::create($request->all());
            $request->session()->flash('success','Data added successfully');
            return response()->json([
                'status' => true,
                'message' => 'Data added successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee)
    {
        $employee = Employee::find($employee->id);
        return view('admin.employee.edit',compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $employee = Employee::find($employee->id);
        $validator = Validator::make($request->all(),[
            'name'       => 'required',
            'department' => 'required'
        ]);
        if($validator->passes()){
            $employee->update($request->all());
            $request->session()->flash('success','Data updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'Data updated successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        } 
    }

    public function destroy(Employee $employee, Request $request)
    {
        $employee = Employee::find($employee->id);
        $employee->delete();
        $request->session()->flash('success','data deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'data deleted successfully'
        ]);
    }
}
