<?php

namespace App\Models;

use \DateTimeInterface;
use App\Notifications\VerifyUserNotification;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
//    use SoftDeletes;
    use Notifiable;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'users';

    protected $appends = [
        'image',
        'unread_notifications',
        'read_notifications',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'verified',
        'verified_at',
        'verification_token',
        'remember_token',
        'registration_code',
        'bio',
        'sector_id',
        'phone_number',
        'jmbg',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            if (auth()->check()) {
                $user->verified = 1;
                $user->verified_at = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
                $user->save();
            } elseif (!$user->verification_token) {
                $token = Str::random(64);
                $usedToken = User::where('verification_token', $token)->first();

                while ($usedToken) {
                    $token = Str::random(64);
                    $usedToken = User::where('verification_token', $token)->first();
                }

                $user->verification_token = $token;
                $user->save();

                $registrationRole = config('panel.registration_default_role');
                if (!$user->roles()->get()->contains($registrationRole)) {
                    $user->roles()->attach($registrationRole);
                }

                $user->notify(new VerifyUserNotification($user));
            }
        });
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getIsDoctorAttribute()
    {
        return $this->roles()->where('id', 3)->exists();
    }

    // hasVerifiedCode() method
    public function hasVerifiedCode()
    {
        return is_null($this->registration_code);
    }

    //markCodeAsVerified() method
    public function markCodeAsVerified()
    {
        return $this->forceFill([
            'registration_code' => null,
        ])->save();
    }

    // Scope for getting all users with role id 3
    public function scopeMedics($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('id', 3);
        });
    }

    // Scope for getting all users with role id 2
    public function scopePatients($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('id', 2);
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function patientDoctorPatients()
    {
        return $this->hasMany(DoctorPatient::class, 'patient_id', 'id');
    }

    public function doctorDoctorPatients()
    {
        return $this->hasMany(DoctorPatient::class, 'doctor_id', 'id');
    }

    public function doctorReports()
    {
        return $this->hasMany(Report::class, 'doctor_id', 'id');
    }

    public function patientReports()
    {
        return $this->hasMany(Report::class, 'patient_id', 'id');
    }

    public function doctorMedications()
    {
        return $this->hasMany(Medication::class, 'doctor_id', 'id');
    }

    public function patientMedications()
    {
        return $this->hasMany(Medication::class, 'patient_id', 'id');
    }

    public function doctorTests()
    {
        return $this->hasMany(Test::class, 'doctor_id', 'id');
    }

    public function patientTests()
    {
        return $this->hasMany(Test::class, 'patient_id', 'id');
    }

    public function doctorAppointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'id');
    }

    public function patientAppointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'id');
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function sector()
    {
        return $this->belongsTo(DoctorField::class, 'sector_id');
    }

    public function doctorField()
    {
        return $this->belongsTo(DoctorField::class, 'sector_id');
    }

    // unreadNotifications
    public function getUnreadNotificationsAttribute()
    {
        $reports = $this->patientReports()->whereNull('isread')->get();
        $medications = $this->patientMedications()->whereNull('isread')->get();
        $tests = $this->patientTests()->whereNull('isread')->get();

        return  [
            'notifications' => $reports->concat($medications)->concat($tests),
            'count' => $reports->count() + $medications->count() + $tests->count(),
        ];

    }

    public function getReadNotificationsAttribute()
    {
        $reports = $this->patientReports()->whereNotNull('isread')->get();
        $medications = $this->patientMedications()->whereNotNull('isread')->get();
        $tests = $this->patientTests()->whereNotNull('isread')->get();

        return [
            'notifications' => $reports->concat($medications)->concat($tests),
            'count' => $reports->count() + $medications->count() + $tests->count(),
        ];
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
