<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'profile_picture',
        'CPF',
        'phone',
        'RG',
        'birth_date',
        'RA',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getUserStatus(): string
    {
        return match ($this->status) {
            'active' => 'Ativo',
            'inactive' => 'Desativado',
            'fired' => 'Desligado',
        };
    }

    public function getRoleColor(): string
    {
        return match ($this->role) {
            'sec' => 'bg-blue-100 text-blue-700',
            'master' => 'bg-red-100 text-red-700',
            'atdr' => 'bg-green-100 text-green-700',
            'aux' => 'bg-orange-100 text-orange-700',
        };
    }

    public function isMaster(): bool
    {
        return $this->role === 'master';
    
    }

    public function getRoleName(): string
    {
        return match ($this->role) {
            'master' => 'Mestre',
            'sec' => 'Secretaria',
            'atdr' => 'Atirador',
            'aux' => 'Auxiliar de Instrução',
        };
    }

    public function hasAdmPermissions(): bool
    {
        return in_array($this->role, ['master', 'sec']);
    }

}
