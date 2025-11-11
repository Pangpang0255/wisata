<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Wisata extends Model
{
    protected $table = 'wisata';
    protected $primaryKey = 'id';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_wisata',
        'deskripsi',
        'lokasi',
        'kategori',
        'harga_tiket',
        'jam_buka',
        'jam_tutup',
        'foto',
        'rating'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}