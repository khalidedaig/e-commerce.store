<?php

namespace App\Models;

use App\Traits\Trashed;
use App\Traits\Sortable;
use App\Traits\CamelCasing;
use EloquentFilter\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, HasMedia
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use SoftDeletes, Trashed, Filterable, Sortable, HasFactory, Notifiable, CamelCasing, InteractsWithMedia;

  /**
   * The relations to eager load on every query.
   *
   * @var array
   */
  protected $with = ['media'];

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = ['password'];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = ['type', 'profilePhotoUrl'];

  /**
   * Available sortable fields
   *
   * @var array
   */
  public $sortable = ['*'];

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
   * @return array
   */
  public function getJWTCustomClaims()
  {
    return [];
  }

  /**
   * Register the media collections
   *
   * @return void
   */
  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('profile-photo')->singleFile();
  }

  /**
   * Get the user type attribute
   */
  public function getTypeAttribute()
  {
    return "admin";
  }

  /**
   * Get the profile-photo media
   */
  public function getProfilePhotoUrlAttribute()
  {
    return $this->getFirstMediaUrl('profile-photo') ?? null;
  }
}
