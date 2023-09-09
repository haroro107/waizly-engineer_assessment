<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Employee::create(
         [
            "name" => "John Smith",
            "job_title" => "Manager",
            "salary" => "10000000",
            "department" => "IT",
            "joined_date" => "2023-09-10",
         ],

      );
   }
}
