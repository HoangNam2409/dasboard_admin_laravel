<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class PostCatalogue extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'parentid',
        'left',
        'right',
        'level',
        'image',
        'icon',
        'album',
        'publish',
        'order',
        'user_id',
    ];

    protected $table = 'post_catalogues';
}