<?php

namespace App\Models\Mensagens;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class adminMensagem extends Model
{
    //use TenantTrait;

    protected $fillable = ['tenant_id','name', 'assunto', 'mensagem','destinatario'];
}
