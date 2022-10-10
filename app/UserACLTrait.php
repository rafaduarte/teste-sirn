<?php

namespace App;

use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

/**
 * 
 */
trait UserACLTrait
{
    public function permissions(): array
    {
        $permissionsProfile = $this->permissionsProfile();

        $permissions = [];

        foreach ($permissionsProfile as $permission) {
            array_push($permissions, $permission);
        }

        return $permissions;
    }

   /* public function permissionsProfile(): array
    {
        //$tenant = Tenant::with('profiles.permissions')->where('id', $this->tenant_id)->first();
        $tenant = $this->tenant;
        $profiles = $tenant->profile;

        $permissions = [];

        foreach ($profiles as $profile) {
            foreach($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }
        return $permissions;
    } */

    public function permissionsProfile(): array
    {
        $profiles = $this->profiles()->with('permissions')->get();
        //$profiles = Profile::first();

        $permissions = [];

        foreach ($profiles as $profile) {
            foreach($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }
        return $permissions;
    }

    public function emailsTenant(): array
    {
        $emailsTenans = DB::table('tenants')->pluck('email');
                        
        $emails = [];

        foreach ($emailsTenans as $email) {
            array_push($emails, $email);
        }

        $users = Profile::find(1)->users()->pluck('email');

        foreach ($users as $user) {
            array_push($emails, $user);
        }

        return $emails;
    }

    public function hasPermission(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function hasEmail(string $email): bool
    { 
        return in_array($email, $this->emailsTenant());       
    }

    public function isAdmin(): bool
    {   
        //return 'codit.sedecrn@gmail.com';
        return in_array(auth()->user()->email, config('acl.admins'));
    }

    public function isTenant(): bool
    {
        return !in_array($this->email, config('tenant.admins'));
    }

    public function isTenantAdmin(): bool
    {
        return in_array($this->email, config('tenant.admins'));
    }
}
