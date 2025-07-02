<?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Spatie\Permission\Models\Role as SpatieRole;
 use Illuminate\Database\Eloquent\Relations\BelongsToMany;

 class Role extends SpatieRole
 {
     use HasFactory;

     /**
      * Get users assigned to this role.
      */
     public function users(): BelongsToMany
     {
         return $this->belongsToMany(
             config('auth.providers.users.model'), // usually App\Models\User
             config('permission.table_names.model_has_roles'), // usually 'model_has_roles'
             'role_id', // foreign key on pivot table to the Role
             'model_id' // foreign key on pivot table to the User
         );
     }
 }
