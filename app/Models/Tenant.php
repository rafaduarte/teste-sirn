<?php

namespace App\Models;

use App\Models\proedi\PedirConcessaoProedi;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'social_name','name', 'cnpj', 'inscricao_estadual', 'endereco_empresa', 'municipio', 'uf',
        'cep', 'telefone', 'email', 'inicio_atividade', 'tipo_empresa', 'nome_empresario', 'cpf',
        'endereco_empresario', 'municipio_empresario', 'municipio_empresario', 'uf_empresario',
         'cep_empresario', 'telefone_empresario', 'email_empresario', 'active', 'subscription', 
    ];

   /* public function pedirConcessaoProedi()
    {
        return $this->hasMany(PedirConcessaoProedi::class);
    } */

    /**
     *  Get Profiles
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function formatCnpj($cnpj) {

        $cnpj = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
    
        return $cnpj;
     }

       /**
 * Método para gerar CNPJ válido, com máscara ou não
 * @example cnpjRandom(0)
 *          para retornar CNPJ sem máscar
 * @param int $mascara 
 * @return string
 */
public function cnpjRandom($mascara = "1") {
    $n1 = rand(0, 9);
    $n2 = rand(0, 9);
    $n3 = rand(0, 9);
    $n4 = rand(0, 9);
    $n5 = rand(0, 9);
    $n6 = rand(0, 9);
    $n7 = rand(0, 9);
    $n8 = rand(0, 9);
    $n9 = 0;
    $n10 = 0;
    $n11 = 0;
    $n12 = 1;
    $d1 = $n12 * 2 + $n11 * 3 + $n10 * 4 + $n9 * 5 + $n8 * 6 + $n7 * 7 + $n6 * 8 + $n5 * 9 + $n4 * 2 + $n3 * 3 + $n2 * 4 + $n1 * 5;
    $d1 = 11 - (self::mod($d1, 11) );
    if ($d1 >= 10) {
        $d1 = 0;
    }
    $d2 = $d1 * 2 + $n12 * 3 + $n11 * 4 + $n10 * 5 + $n9 * 6 + $n8 * 7 + $n7 * 8 + $n6 * 9 + $n5 * 2 + $n4 * 3 + $n3 * 4 + $n2 * 5 + $n1 * 6;
    $d2 = 11 - (self::mod($d2, 11) );
    if ($d2 >= 10) {
        $d2 = 0;
    }
    $retorno = '';
    if ($mascara == 1) {
        $retorno = '' . $n1 . $n2 . "." . $n3 . $n4 . $n5 . "." . $n6 . $n7 . $n8 . "/" . $n9 . $n10 . $n11 . $n12 . "-" . $d1 . $d2;
    } else {
        $retorno = '' . $n1 . $n2 . $n3 . $n4 . $n5 . $n6 . $n7 . $n8 . $n9 . $n10 . $n11 . $n12 . $d1 . $d2;
    }
    return $retorno;
}

private static function mod($dividendo, $divisor) {
    return round($dividendo - (floor($dividendo / $divisor) * $divisor));
}

}
