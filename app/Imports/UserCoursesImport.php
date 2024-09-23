<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserCourse;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserCoursesImport implements ToModel, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::where('mobile', $row[1])->first();
        if(!$user) {
            $user = User::create([
                'name' => $row[0],
                'mobile' => $row[1],
            ]);
        }

        if($row[2] == 'A') {
            UserCourse::firstOrCreate([
                'user_id'  => $user->id,
                'course_id' => 2,
            ]);
        } elseif($row[2] == 'B') {
            UserCourse::firstOrCreate([
                'user_id'  => $user->id,
                'course_id' => 1,
            ]);
        } elseif($row[2] == 'C') {
            UserCourse::firstOrCreate([
                'user_id'  => $user->id,
                'course_id' => 2,
            ]);
            UserCourse::firstOrCreate([
                'user_id'  => $user->id,
                'course_id' => 1,
            ]);
        }
    }

    /**
     * Define validation rules for each row
     */
    public function rules(): array
    {
        return [
            '0' => 'required|string|between:3,255', // User name
            '1' => 'required|numeric|digits:11|regex:/(09)[0-9]{9}/', // User mobile number
            '2' => 'required|string|in:A,B,C', // course
        ];
    }
}
