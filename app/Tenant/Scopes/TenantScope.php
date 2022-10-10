<?php

namespace App\Tenant\Scopes;

use App\Tenant\ManagerTenant;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {   
        /* $identify = app(ManagerTenant::class)->getTenantIdentify();

        if ($identify)
            $builder->where('tenant_id', $identify);
*/
        $tenant_id = auth()->user()->tenant_id;

        $id = app(ManagerTenant::class)->getTenantIdentify();;

        $tenant_email = app(ManagerTenant::class)->isAdmin();

        //dd($tenant_email);

        if(!$tenant_email) {
            $builder->where('tenant_id',  app(ManagerTenant::class)->getTenantIdentify());
        }  //aqui já estava

        
        if($id != 1){
            $builder->where('tenant_id',  app(ManagerTenant::class)->getTenantIdentify());
        } 
    }
}