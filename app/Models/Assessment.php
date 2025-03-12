<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = 'assessments';

    protected $fillable = [
        'student_id',  'assessor_id', 'assessment_date', 'package_id', 'assessment_category_id'
    ];

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function assessor()
    {
        return $this->belongsTo(User::class, 'assessor_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function category()
    {
        return $this->belongsTo(AssessmentCategory::class, 'assessment_category_id');
    }
}
