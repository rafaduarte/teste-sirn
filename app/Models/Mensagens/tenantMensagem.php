<?php

namespace App\Models\Mensagens;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class tenantMensagem extends Model
{
    use TenantTrait;
    
    protected $fillable = ['name', 'assunto', 'mensagem', 'files'];
}
