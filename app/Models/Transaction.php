<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'greutate',
        'lungime',
        'latime',
        'inaltime',

        'valoarea_declarata',
        'continut',
        'observatii',
        'ramburs',
        'iban',

        'nume_expeditor',
        'judet_expeditor',
        'localitate_expeditor',
        'codpostal_expeditor',
        'strada_expeditor',
        'nrstrada_expeditor',
        'bloc_expeditor',
        'intrare_expeditor',
        'etaj_expeditor',
        'apartament_expeditor',
        'telefon_expeditor',
        'persoana_contact_expeditor',

        'nume_destinatar',
        'judet_destinatar',
        'localitate_destinatar',
        'codpostal_destinatar',
        'strada_destinatar',
        'nrstrada_destinatar',
        'bloc_destinatar',
        'intrare_destinatar',
        'etaj_destinatar',
        'apartament_destinatar',
        'telefon_destinatar',
        'persoana_contact_destinatar',

        'date_facturare_importate',

        'nume_factura',
        'cui_factura',
        'reg_comert_factura',
        'judet_factura',
        'localitate_factura',
        'codpostal_factura',
        'strada_factura',
        'nrstrada_factura',
        'bloc_factura',
        'intrare_factura',
        'etaj_factura',
        'apartament_factura',
        'telefon_factura',
        'email_factura',

        'status',
        'awb',
        'curier',
        'data_ridicare',
        'data_livrare',
        'transaction_id',
        'pret_curier',
        'pret_site'
    ];

    //  /**
    //  * The table associated with the model.
    //  *
    //  * @var string
    //  */
    // protected $table = 'transactions';

    // public function getTransaction_idAttribute($value)
    // {
    //     return hash("sha512", $value);
    // }
}
