<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // plic sau colet
            $table->string('greutate');
            $table->string('lungime')->nullable();
            $table->string('latime')->nullable();
            $table->string('inaltime')->nullable();

            $table->string('valoarea_declarata')->nullable();
            $table->string('continut');
            $table->string('observatii')->nullable();
            $table->string('ramburs')->nullable();
            $table->string('iban')->nullable();

            $table->string('nume_expeditor');
            $table->string('judet_expeditor');
            $table->string('localitate_expeditor');
            $table->string('codpostal_expeditor');
            $table->string('strada_expeditor');
            $table->string('nrstrada_expeditor');
            $table->string('bloc_expeditor')->nullable();
            $table->string('intrare_expeditor')->nullable();
            $table->string('etaj_expeditor')->nullable();
            $table->string('apartament_expeditor')->nullable();
            $table->string('telefon_expeditor');
            $table->string('persoana_contact_expeditor')->nullable();

            $table->string('nume_destinatar');
            $table->string('judet_destinatar');
            $table->string('localitate_destinatar');
            $table->string('codpostal_destinatar');
            $table->string('strada_destinatar');
            $table->string('nrstrada_destinatar');
            $table->string('bloc_destinatar')->nullable();
            $table->string('intrare_destinatar')->nullable();
            $table->string('etaj_destinatar')->nullable();
            $table->string('apartament_destinatar')->nullable();
            $table->string('telefon_destinatar');
            $table->string('persoana_contact_destinatar')->nullable();

            $table->string('date_facturare_importate')->nullable();

            $table->string('nume_factura');
            $table->string('cui_factura')->nullable();
            $table->string('reg_comert_factura')->nullable();
            $table->string('judet_factura');
            $table->string('localitate_factura');
            $table->string('codpostal_factura');
            $table->string('strada_factura');
            $table->string('nrstrada_factura');
            $table->string('bloc_factura')->nullable();
            $table->string('intrare_factura')->nullable();
            $table->string('etaj_factura')->nullable();
            $table->string('apartament_factura')->nullable();
            $table->string('telefon_factura');
            $table->string('email_factura');

            $table->string('status');
            $table->string('awb')->nullable();
            $table->string('curier');
            $table->string('pret_curier');
            $table->string('pret_site');
            $table->string('data_ridicare')->nullable();
            $table->string('data_livrare')->nullable();

            $table->string('transaction_id')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
