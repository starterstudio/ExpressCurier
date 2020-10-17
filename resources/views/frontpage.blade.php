@extends('layouts.app')

@section('content')
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-cover">
    <span class="bg-color"></span>
    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Servicii de Curierat</h1>
        <p class="lead font-weight-normal">Trimite colet oriunde in Romania la cele mai bune preturi!</p>
        <a class="btn btn-outline-secondary" href="#">Coming soon</a>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>
<div class="container">
        <!-- Example row of columns -->
        <div class="row mt--7" >
            <div class="col-md-12">
                <div class="card   shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <h2 class="card-title">Tip Trimitere: </h2>

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-top:30px;">

                            <li class="nav-item" role="presentation">
                                
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#Colet" role="tab" aria-controls="Colet" aria-selected="true">
                                    <p class="icon-text">Colet</p>
                                    <h1 class="fas fa-box-open"></h1>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#Plic" role="tab" aria-controls="Plic" aria-selected="false">
                                    <p class="icon-text">Plic</p>
                                    <h1 class="fas fa-envelope"></h1>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="Colet" role="tabpanel" aria-labelledby="pills-home-tab">
                                <hr>
                                <h4>Detalii Colet:</h4>

                                <div class="row">

                                    <div class="col-md-3">
                                        <label>Greutate</label>

                                        <div class="input-group">
                                            <input type="number" class="fvalid form-control" id="greutate" placeholder="Ex:1" required="">
                                            <div class="text-danger invalid-feedback mt--2 mb-2">
                                                
                                            </div>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Kg.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"><label>Lungime</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="lungime" placeholder="Ex:10" required="">
                                                <div class="text-danger invalid-feedback mt--2 mb-2">
                                                    
                                                </div>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Cm.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"><label>Latime</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="latime" placeholder="Ex:10" required="">
                                                <div class="text-danger invalid-feedback mt--2 mb-2">
                                                    
                                                </div>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Cm.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"><label>Inaltime</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="inaltime" placeholder="Ex:30" required="">
                                                <div class="text-danger invalid-feedback mt--2 mb-2">
                                                    
                                                </div>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Cm.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <label>Valoare Declarata</label>

                                        <div class="input-group">
                                            <input type="number" class="form-control" id="valoare" placeholder="Ex:100">
                                            <div class="text-danger invalid-feedback mt--2 mb-2">
                                                
                                            </div>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Lei</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"><label>Continut</label>
                                            <div class="input-group">
                                                <input type="text" class="fvalid form-control" id="continut" placeholder="continut" required="" />
                                                <div class="text-danger invalid-feedback mt--2 mb-2">
                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"><label>Observatii</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="observatii" placeholder="observatii">
                                                <div class="text-danger invalid-feedback mt--2 mb-2">
                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div>
                                    <h4>Servicii Aditionale:</h4>
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <label>Ramburs</label>

                                        <div class="input-group">
                                            <input type="number" class="fvalid form-control" id="ramburs" placeholder=" Ex.100">
                                            <div class="text-danger invalid-feedback mt--2 mb-2">
                                                
                                            </div>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Lei</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="ibanc" class="col-md-6" style="display:none;">
                                        <label>Cont IBAN - contul in care se va transfera suma ramburs</label>

                                        <div class="input-group">
                                            <input type="text" class="fvalid form-control" id="fibanc">
                                            <div class="text-danger invalid-feedback mt--2 mb-2">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Plic" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <hr>
                                <h4>Detalii Plic:</h4>

                                <div class="row">

                                    <div class="col-md-4">
                                        <label>Valoare Declarata</label>

                                        <div class="input-group">
                                            <input type="text" class="form-control" id="plic_valoare" placeholder="100">
                                            <div class="text-danger invalid-feedback mt--2 mb-2">
                                                
                                            </div>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Lei</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"><label>Continut</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="plic_continut" placeholder="Documente" required>
                                                <div class="text-danger invalid-feedback mt--2 mb-2">
                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"><label>Observatii</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="plic_observatii">
                                                <div class="text-danger invalid-feedback mt--2 mb-2">
                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <h4>Servicii Aditionale:</h4>
                                </div>
                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <!-- /container -->

    <div class="container">
        <div class="row" style="padding-bottom:50px;">
            <div class="col-md-6">
                <div class="card   shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <h2 class="card-title">Expeditor</h2>
                        <h6 class="card-subtitle mb-2 text-muted">De unde se ridica</h6>

                        <form class="expfrmv" id="fexp">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <input name="Nume_Expeditor" type="text" id="expname" class="fvalid form-control" id="validationDefault01" placeholder="Companie / Nume Prenume" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <select name="Judet_Expeditor" class="fvalid judet custom-select" id="validationDefault04" required>
                <option selected disabled="true" value="">Judet...</option>
              </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-8 mb-3">
                                    <input name="Localitate_Expeditor" type="text" data-toggle="tooltip" title="" class="fvalid locality form-control" placeholder="Localitate" id="exploc validationDefault03" required>
                                    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="fresult"></div>
                                                </div>
                                                <div class="modal-footer">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <input name="CodPostal_Expeditor" type="number" class="fvalid postalcode form-control" placeholder="Cod Postal" id="ecodp validationDefault05" required>
                                </div>

                                <div class="col-md-8 mb-3">
                                    <input name="Strada_Expeditor" type="text" class="fvalid form-control" placeholder="Strada" id="estrd validationDefault03" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <input name="StradaNr_Expeditor" type="number" class="fvalid form-control" placeholder="Nr." id="estrdnr validationDefault05" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <input name="Bloc_Expeditor" type="text" class="form-control" placeholder="Bloc" id="ebloc validationDefault03">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input name="Intrare_Expeditor" type="text" class="form-control" placeholder="Intrare" id="eintrare validationDefault05">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input name="Etaj_Expeditor" type="text" class="form-control" placeholder="Etaj" id="eetaj validationDefault03">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input name="Apartament_Expeditor" type="text" class="form-control" placeholder="Apartament" id="eapart validationDefault05">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input name="Telefon_Expeditor" type="text" class="fvalid form-control" placeholder="Telefon" id="enrtel validationDefault03" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input name="NumeContact_Expeditor" type="text" class="form-control" placeholder="Persoana de contact" id="econtpers validationDefault05">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card   shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <h2 class="card-title">Destinatar</h2>
                        <h6 class="card-subtitle mb-2 text-muted">Unde se trimite</h6>

                        <form class="destfrmv" id="fdest" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <input name="Nume_Destinatar" type="text" class="fvalid form-control" id="destname validationDefault01" placeholder="Companie / Nume Prenume" required>
                                </div>
                                <div class="col-md-12 mb-3">

                                    <select name="Judet_Destinatar" class="fvalid judet custom-select" id="validationDefault04" required>
              <option selected disabled value="">Judet...</option>
            </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-8 mb-3">
                                    <input name="Localitate_Destinatar" type="search" class="fvalid locality form-control" placeholder="Localitate" id="dloc validationDefault03" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <input name="CodPostal_Destinatar" type="number" class="fvalid postalcode form-control" placeholder="Cod Postal" id="dpost validationDefault05" required>
                                </div>

                                <div class="col-md-8 mb-3">
                                    <input name="Strada_Destinatar" type="text" class="fvalid form-control" placeholder="Strada" id="dstrd validationDefault03" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <input name="StradaNr_Destinatar" type="number" class="fvalid form-control" placeholder="Nr." id="dstrdnr validationDefault05" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <input name="Bloc_Destinatar" type="text" class="form-control" placeholder="Bloc" id="dbloc validationDefault03">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input name="Intrare_Destinatar" type="text" class="form-control" placeholder="Intrare" id="dintrare validationDefault05">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input name="Etaj_Destinatar" type="text" class="form-control" placeholder="Etaj" id="detaj validationDefault03">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input name="Apartament_Destinatar" type="text" class="form-control" placeholder="Apartament" id="dapart validationDefault05">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input name="Telefon_Destinatar" type="text" class="fvalid form-control" placeholder="Telefon" id="dtel validationDefault03" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input name="NumeContact_Destinatar" type="text" class="form-control" placeholder="Persoana de contact" id="dcontpers validationDefault05">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /container -->

    <div class="container">
        
        <h2 class="card-title">Alege Curierul: </h2>
        <!-- Example row of columns -->
        <div class="row" style="margin-top:30px;">

            <div class="col-md-4">
                <div class="card shadow bg-white rounded" style="text-align:center; margin-bottom: 15px;">
                    <h5 class="card-header" style="background:red; color:#ffffff;">DPD</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5 id="dpd_price">00 Lei</h5>
                        </li>
                        <li class="list-group-item"><a class="btn btn-secondary btn-lg btn-block" type="button" data-toggle="collapse" href="#" data-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm" name="DPD">Alege &raquo;</a></li>

                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow bg-white rounded" style="text-align:center; margin-bottom: 15px;">
                    <h5 class="card-header" style="background:#6c757db8; color:#ffffff;">FAN Curier</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5>00 Lei</h5>
                        </li>
                        <li class="list-group-item"><a class="btn btn-secondary btn-lg btn-block disabled" href="#" tabindex="-1" type="button" role="button" aria-disabled="true" name="FAN Curier">Alege &raquo;</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow bg-white rounded" style="text-align:center; margin-bottom: 15px;">
                    <h5 class="card-header" style="background:#6c757db8; color:#ffffff;">Urgent Cargus</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5>00 Lei</h5>
                        </li>
                        <li class="list-group-item"><a class="btn btn-secondary btn-lg btn-block disabled" href="#" tabindex="-1" role="button" type="button" aria-disabled="true" name="Urgent Cargus">Alege &raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="collapse" id="collapseForm" style="padding-top: 50px;">
            <div class="row shadow p-3 mb-5 bg-white rounded">
                <div class="col-md-8 md-1">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="card-title">Date pentru Facturara </h2>
                    </h4>
                    <form class="ffactfrmv" action="/pay" method="POST" id="ffact">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <p>Importa:</p>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="import_option" id="import_expeditor inlineRadio1">
                                    <label class="form-check-label" for="inlineRadio1">Date Expeditor</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="import_option" id="import_destinatar inlineRadio2">
                                    <label class="form-check-label" for="inlineRadio2">Date Destinatar</label>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <input name="Nume_Bill" type="text" class="fvalid form-control" id="bfname validationDefault01" placeholder="Companie / Nume Prenume" required="true">
                            </div>

                            <div class="col-md-6 mb-3">
                                <input type="number" class="form-control" placeholder="C.U.I" id="bfcui validationDefault03">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="number" class="form-control" placeholder="Nr. Registru Comertului" id="bfregnr validationDefault05">
                            </div>

                            <div class="col-md-12 mb-3">

                                <select name="Judet_Bill" class="fvalid judet custom-select" id="bfjudet validationDefault04" required="">
                  <option selected="" disabled="" value="">Judet...</option>
                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <input name="Localitate_Bill" type="search" name="bfloc" class="fvalid locality form-control" placeholder="Localitate" id="bfloc validationDefault03" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <input name="CodPostal_Bill" type="number" class="fvalid postalcode form-control" placeholder="Cod Postal" id="bfpcode validationDefault05" required="">
                            </div>

                            <div class="col-md-8 mb-3">
                                <input name="Strada_Bill" type="text" class="fvalid form-control" placeholder="Strada" id="bfstr validationDefault03" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <input name="StradaNr_Bill" type="number" class="fvalid form-control" placeholder="Nr." id="bfstrnr validationDefault05" required="">
                            </div>

                            <div class="col-md-3 mb-3">
                                <input type="text" name="bfbloc" class="form-control" placeholder="Bloc" id="bfbloc validationDefault03">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" name="bfentr" class="form-control" placeholder="Intrare" id="bfintr validationDefault05">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" name="bfetaj" class="form-control" placeholder="Etaj" id="bfetaj validationDefault03">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" name="bfapart" class="form-control" placeholder="Apartament" id="bfapart validationDefault05">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input name="Telefon_Bill" type="text" class="fvalid form-control" placeholder="Telefon" id="bftel validationDefault03" required="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input name="Email_Bill" type="text" class="fvalid form-control" placeholder="Email" id="bfemail validationDefault05" required="">
                            </div>
                        </div>
                        <input type="hidden" name="ffshi">
                    </form>
                </div>
                <div class="col-md-4  mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="card-title">Comanda Dumneavoastra:</h2>

                    </h4>
                    </br>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Greutate Colet</h6>
                                <small class="text-muted"></small>
                            </div>
                            <span id="kgparcel" class="text-muted">1 KG</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Curier</h6>
                                <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">DPD</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Pret Transport</h6>
                                <small class="text-muted"></small>
                            </div>
                            <span id="pret_transport" class="text-muted">00 Lei</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Ramburs</h6>
                                <small class="text-muted">In cont colector</small>
                            </div>
                            <span id="pret_ramburs" class="text-muted">0 LEI</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <h6 class="my-0">Total</h6>
                            <strong id="pret_total">0 Lei</strong>
                        </li>
                    </ul>
                    <button type="submit" id="sendcmd" class="btn btn-primary btn-lg btn-block">Trimite Comanda</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /container -->
    </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2020 {{ config('app.name') }}</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    <div id="preloader"></div>  
    <script>
        $(document).ready(function ()
        {
            GetStates();
            GetSites();
            $('input').bind('change', function(e) { CalculateChange(); });
            $('input[id=ramburs]').bind('input', function(e) { document.getElementById('ibanc').style = (this.value.length > 0 ? "display:visible;" : "display:none;"); });
        });
        $('input[type=radio]').bind('change', function(e) { ImportAddressInfo(this.id.split(" ")[0]); });
        $('#sendcmd').click(function(){ SendPack(); });
    </script>
@endsection
