<?php

namespace App\Models\proedi;

use App\proedi\PedirConcessaoProedi;
use Illuminate\Database\Eloquent\Model;

class Proedi extends Model
{
    protected $fillable = ['name','tenant_id' ,'desconto', 'area_atuacao'
    , 'produto', 'tipo_empresa', 'municipio', 'data_inicio', 'data_final',];
}
