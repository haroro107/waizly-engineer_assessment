<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Transformers\Result;
use App\Models\Employee;

class EmployeeController extends Controller
{
   public function index()
   {
      $employee = Employee::all();
      return Result::response($employee, 'Data berhasil didapatkan');
   }

   public function show($id)
   {
      try {
         $employee = Employee::findOrFail($id);
         return Result::response($employee, 'Data berhasil didapatkan');
      } catch (\Throwable $th) {
         return Result::error($th, 'Data gagal didapatkan');
      }
   }

   public function store(EmployeeRequest $request)
   {
      try {
         $employee = Employee::create($request->all());
         return Result::response($employee, 'Data berhasil dibuat');
      } catch (\Throwable $th) {
         return Result::error($th, 'Data gagal dibuat');
      }
   }

   public function update(EmployeeRequest $request, $id)
   {
      try {
         $employee = Employee::findOrFail($id);
         $employee->update($request->all());
         return Result::response($employee, 'Data berhasil diubah');
      } catch (\Throwable $th) {
         return Result::error($th, 'Data gagal didapatkan');
      }
   }

   public function destroy($id)
   {
      try {
         $employee = Employee::findOrFail($id);
         $employee->delete();
         return Result::response($employee, 'Data berhasil dihapus');
      } catch (\Throwable $th) {
         return Result::error($th, 'Data gagal didapatkan');
      }
   }
}
