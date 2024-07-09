<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'activation_code',
        'reset_token',
        'reset_token_expires_at',
        'role_id',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'reset_token_expires_at' => 'datetime',
    ];
  /**
     * Generate and set the reset token and its expiration time.
     */
    public function setResetToken()
    {
        $this->reset_token = Str::random(60);
        $this->reset_token_expires_at = now()->addHour();
        $this->save();
    }

    /**
     * Clear the reset token and its expiration time.
     */
    public function clearResetToken()
    {
        $this->reset_token = null;
        $this->reset_token_expires_at = null;
        $this->save();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function designer()
    {
        return $this->hasOne(Designer::class, 'user_id');
    }

    public function saleRep()
    {
        return $this->hasOne(SaleRep::class, 'user_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'user_permissions')->withPivot('enabled');
    }


    public function socialRep()
    {
        return $this->hasOne(SocialRep::class, 'user_id');
    }

    public function multiEmployee()
    {
        return $this->hasOne(MultiEmployee::class, 'user_id');
    }
    public function getUserImageAttribute()
    {
        if ($this->designer) {
            return $this->designer->image;
        } elseif ($this->saleRep) {
            return $this->saleRep->image;
        } elseif ($this->MultiEmployee) {
            return $this->MultiEmployee->image;
        } elseif ($this->socialRep) {
            return $this->socialRep->image;
        }

        return null;
    }
}
