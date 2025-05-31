<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'site',
        'status',
        'api_key',
    ];

    /**
     * Gera uma API key única para o cliente.
     *
     * @return string
     */
    public static function generateApiKey(): string
    {
        return hash('sha256', Str::random(40) . time());
    }
}
