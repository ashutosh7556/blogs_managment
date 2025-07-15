<?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Spatie\Permission\Models\Role as SpatieRole;
 use Illuminate\Database\Eloquent\Relations\BelongsToMany;
 use Illuminate\Database\Eloquent\Relations\MorphToMany;


 class Role extends SpatieRole
 {
     use HasFactory;

     /**
      * Get users assigned to this role.
      */
      public function users(): MorphToMany
      {
          return $this->morphedByMany(
              config('auth.providers.users.model'),  // usually App\Models\User
              'model',                               // name of the morph (Spatie uses "model")
              config('permission.table_names.model_has_roles'), // default: model_has_roles
              'role_id',                             // Foreign key to Role
              'model_id'                             // Foreign key to User
          );
      }
 }
