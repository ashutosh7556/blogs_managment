<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Foundation\Auth\User as Authenticatable;
  use Illuminate\Notifications\Notifiable;
  use Tymon\JWTAuth\Contracts\JWTSubject; // ✅ Add this
  use Spatie\Permission\Traits\HasRoles;

  class User extends Authenticatable implements JWTSubject // ✅ Implement JWTSubject
  {
      use HasFactory, Notifiable, HasRoles;

      protected $fillable = [
          'name',
          'email',
          'password',
      ];

      protected $hidden = [
          'password',
          'remember_token',
      ];

      protected $casts = [
          'email_verified_at' => 'datetime',
          'password' => 'hashed',
      ];

      // ✅ Required by JWT package
      public function getJWTIdentifier()
      {
          return $this->getKey();
      }

      // ✅ Optional: add custom claims if needed
      public function getJWTCustomClaims()
      {
          return [ 'email' => $this->email,
                              'name' => $this->name,
                              'roles' => $this->getRoleNames(),];
      }
  }
