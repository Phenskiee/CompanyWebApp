<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "company_list";
    protected $fillable = [
        "name",
        "position",
        "email",
        "platform",
        "location",
        "salary",
        "setup",
        "links",
        "job_description",
        "applied_at",
        "status",
        "interview_date",
        "interview_time",
        "interview_status"
    ];

    public function getStatusClassAttribute()
    {
        $status = $this->interview_status ?? $this->status;
        
        return match ($status) {
            'Rejected' => 'reject',
            'For Interview' => 'interview',
            'Pending' => 'pending',
            'Viewed' => 'viewed',
            'Job Offer' => 'job_offer',
            default => '',
        };
    }
}
