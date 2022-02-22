<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reports()
    {
        return $this->hasMany('App\Models\Reports');
    }
    public function schedule()
    {
        return $this->hasMany('App\Models\Schedule');
    }
    public function store_request()
    {
        return $this->hasMany('App\Models\StoreRequest');
    }
    public function ob_logs()
    {
        return $this->hasMany('App\Models\OBlogs');
    }
    public function production_logs()
    {
        return $this->hasMany('App\Models\ProductionShowLogs');
    }
    public function graphics_logs()
    {
        return $this->hasMany('App\Models\GraphicsLogs');
    }
    public function graphics_logShow()
    {
        return $this->hasMany('App\Models\GraphicsLogShow');
    }
    public function prompter_logs()
    {
        return $this->hasMany('App\Models\PrompterLogs');
    }
    public function prompter_logs_Shows()
    {
        return $this->hasMany('App\Models\PrompterLogShow');
    }
    public function video_editors_reports()
    {
        return $this->hasMany('App\Models\VideoEditorsReports');
    }
    public function transmission()
    {
        return $this->hasMany('App\Models\TransmissionReport');
    }
    public function mcr_logs()
    {
        return $this->hasMany('App\Models\McrLogs');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }
    public function hod()
    {
        return $this->hasOne('App\Models\Department');
    }
    public function maintenance_schedule()
    {
        return $this->hasOne('App\Models\MaintenanceScheduler');
    }
}
