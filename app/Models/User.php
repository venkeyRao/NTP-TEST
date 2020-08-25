<?php

namespace App\Models;

use App\Rules\UniqueEmail;
use Illuminate\Validation\Rule;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasApiTokens;

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_DISABLED = 'disabled';

    public static $statuses = [
        self::STATUS_PENDING => ['label' => 'Pending'],
        self::STATUS_APPROVED => ['label' => 'Approved'],
        self::STATUS_DISABLED => ['label' => 'Disabled'],
    ];

    const ROLE_PRACTITIONER = 'practitioner';
    const ROLE_NTP_ADMIN = 'ntp_admin';

    public static $roles = [
        self::ROLE_PRACTITIONER => ['label' => 'Practitioner'],
        self::ROLE_NTP_ADMIN => ['label' => 'NTP Admin'],
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'role',
        'status',
        'zip_code',
        'description',
        'profile_image',
        'category'
    ];

    protected $attributes = [
        'status' => self::STATUS_APPROVED,
    ];

    public static $categories = [
        'category_one' => 'Category One',
        'category_two' => 'Category Two',
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

    public function setEmailAttribute($value)
    {
      $this->attributes['email'] = strtolower($value);
    }
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return
     *  array
     */

    public function getJWTCustomClaims()
    {
        return [
            'role' => $this->role,
        ];
    }

    public static function rules($scenario)
    {
        switch($scenario)
        {
            case 'login':
                $rules = [
                    'username' => ['required'],
                    'password' => ['required'],
                ];
                break;
            case 'register':
                $rules = [
                    'name' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-Za-z_ \-\'\.\,]+$/'],
                    'mobile' => ['required','digits:10', 'regex:/^([+][9][1]|[9][1]|[0]){0,1}([6-9]{1})([0-9]{9})$/'],
                    'email' => ['required', 'string', 'email', 'max:255', new UniqueEmail ],
                    'password' => ['required', 'string', 'min:6', 'confirmed'],
                    'zip_code' => ['string'],
                    'description' => ['string'],
                    'category' => ['string', Rule::in(array_keys(self::$categories))],
                    'profile_image' => ['nullable', 'mimes:jpeg,jpg,png','max:4096'],
                    'gallery_images.*' => ['nullable', 'mimes:jpeg,jpg,png','max:4096']
                ];
                break;
            default :
                $rules = [
                    'mobile' => ['regex:^[6-9]\d{9}$^'],
                    'name' => ['string', 'regex:/^[A-Za-z_ \-\'\.\,]+$/'],
                    'zip_code' => ['string'],
                    'description' => ['string'],
                    'profile_image' => ['nullable', 'mimes:jpeg,jpg,png','max:4096'],
                    'gallery_images.*' => ['nullable', 'mimes:jpeg,jpg,png','max:4096'],
                    'category' => ['string', Rule::in(array_keys(self::$categories))]
                ];
        }
        return $rules;
    }

}
