<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'username', 'email', 'password', 'avatar', 'role', 'permissions', 'sync_bimbingan', 'webmail_username', 'webmail_password'])]
#[Hidden(['password', 'remember_token', 'webmail_password'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
            'webmail_password' => 'encrypted',
            'permissions' => 'array',
            'sync_bimbingan' => 'boolean',
        ];
    }

    /**
     * Check if user has permission for a specific module and action.
     */
    public function hasPermission(string $module, string $action = 'view'): bool
    {
        if ($this->role === 'admin') {
            return true;
        }

        $perms = $this->permissions ?? [];
        return isset($perms[$module][$action]) && (bool)$perms[$module][$action];
    }

    /**
     * Check if user can access the admin panel.
     */
    public function hasAdminAccess(): bool
    {
        if ($this->role === 'admin' || $this->role === 'staff' || $this->role === 'dosen') {
            return true;
        }

        $perms = $this->permissions ?? [];
        foreach ($perms as $module => $actions) {
            foreach ($actions as $action => $allowed) {
                if ($allowed) {
                    return true;
                }
            }
        }

        return false;
    }
}
