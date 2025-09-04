<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;
    
    protected $table = 'data_siswas_pkl';
    
    protected $fillable = [
        'nama', 'nis', 'gender', 'alamat', 
        'kontak', 'email', 'foto', 'status_lapor_pkl'
    ];
}