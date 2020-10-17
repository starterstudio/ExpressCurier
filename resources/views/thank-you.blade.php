@extends('layouts.app')

@section('content')
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 font-weight-normal">Comanda a fost transmisa!</h1>
            <p class="lead font-weight-normal">Un curier se va prezenta la adresa pentru a ridica coletul</p>
            <h6>Nr. Document transport (AWB): <b>{{ $awb_nr }}</b></h6>
           
        </div>
    </div>
    <div class="container">
    <div class="row text-center">
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data ridicare Colet:</h5>
              <h6 class="card-text">{{ $pickup_date }}</h6>
            
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data trimitere Colet:</h5>
                <h6 class="card-text">{{ $delivery_date }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    
    <p>Nr Tranzactie card: {{ $card_transaction }}</p>
    <i class="far fa-map-marked-alt"></i>
  
   
</div>
@endsection