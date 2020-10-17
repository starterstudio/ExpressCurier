@extends('layouts.app')

@section('content')
<form name="frmPaymentRedirect" id="fmsb" method="post" action="{{ config('app.netopia_paymenturl') }}">
    @csrf
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="font-weight-normal">Vei fi redirectionat pentru a plati in siguranta</h1>
       
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets8.lottiefiles.com/packages/lf20_gQ6TyP.json" mode="bounce" background="transparent" speed="1" style="width: 100%; height: 60%;" loop="" autoplay=""></lottie-player>
        </div>
    </div>
    <input type="hidden" name="env_key" value="{{ $env_key }}"/>
    <input type="hidden" name="data" value="{{ $data }}"/>
    <script type="text/javascript">
        secs = 5;
        timer = setInterval(function () {					
            if(secs < 1)
            {
                clearInterval(timer);
                document.getElementById('fmsb').submit();
            }
            secs--;
        }, 1000)
    </script>
</form>
@endsection