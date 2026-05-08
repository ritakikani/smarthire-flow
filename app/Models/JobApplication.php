<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'job_title',
        'location',
        'job_description',
        'source',
        'external_url',
        'status',
        'applied_at',
        'next_action_at',
        'salary_range',
        'recruiter_name',
        'recruiter_email',
        'recruiter_phone',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
        'next_action_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function generateDocuments(): HasMany
    {
        return $this->hasMany(GeneratedDocument::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

}
