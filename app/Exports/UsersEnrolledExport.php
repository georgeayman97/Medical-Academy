<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersEnrolledExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            "NAME",
            "MOBILE NUMBER",
            "FACULTY",
            "YEAR",
            "EMAIL ADDRESS",
            "STATUS",
            "ENROLLMENT DATE",
            "Course Name" ,
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $enrolled = Session::get('enrolledUsers');
        $exportEnrolled = collect();
        foreach($enrolled as $enroll){
            
                $tempCollection = collect([
                    'name' => optional($enroll->user)->name,
                    'mobile' => optional($enroll->user)->mobile,
                    'faculty' => optional($enroll->user->faculty)->name,
                    'year' => optional($enroll->user)->year,
                    'email' => optional($enroll->user)->email,
                    'status' => $enroll->status,
                    'updated_at' => $enroll->updated_at,
                    'course_name' => optional($enroll->course)->name,
                ]);
                $exportEnrolled->add($tempCollection);
            
        }
        
        return $exportEnrolled;
    }
    
}
