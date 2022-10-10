<?php

namespace App\Models\proedi;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class SeiProedi extends Model
{

    protected $fillable = ['name','numero', 'link', 'tenant_id'];
}
