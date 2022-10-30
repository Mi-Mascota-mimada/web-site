@extends('layouts.app')

@section('title', 'GRACIAS !!!')

@section('content')
    
    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="p-5 shadow bg-white mt-4">
                        <h2 class="text-2xl font-semibold text-center text-gray-700 dark:text-white">
                            <img src="{{ asset("assets/img/mi_Mascota.png") }}" alt="Mi mascota mimada" class="mx-auto img-fluid img-logo" style="margin:-80px;"/>
                        </h2>
                        <h4>Gracias por tu compra</h4>
                        @if (session('message'))
                            <input type="hidden" value="{{ session('message') }}" id="ref">
                            <h4>La referencia del pedido es: {{ session('message') }}</h4>
                        @endif
                        <a href="{{ url('collections') }}" class="btn btn-danger text-white">Seguir Comprando</a>
                    </div>                    
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
<script>
    var referencia = document.getElementById('ref');
    function sendWhatsappReference(ref) {            
            let apilink = 'https://';
            let message = "";
            let method = ref.substring(0, 2);
            console.log(method);
            switch (method) {
                case 'PP':
                    message = `Hola 'Mascota Mimada' he realizado la compra de un producto de ustedes con referencia N° " ${ref} ", lo he pagado por Pay Pal. Muchas gracias `
                    break;
                case 'CE':
                    message = `Hola 'Mascota Mimada' he realizado la compra de un producto de ustedes con referencia N° " ${ref} ", lo pagaré al momento de la entrega. Muchas gracias `
                    break;
                case 'MC':
                    message = `Hola 'Mascota Mimada' he canjeado mis mimado coins, el pedido tiene la referencia N° " ${ref} ", podrían explicarme que prosigue. Muchas gracias `
                    break;
                default:
                    break;
            }
            apilink += isMobile() ? 'api' : 'web';
            apilink += '.whatsapp.com/send?phone=573158957774&text=' + encodeURI(message);
            window.open(apilink);
    }
    const isMobile = () => {
        if(
            navigator.userAgent.match(/Android/i)
            || navigator.userAgent.match(/webOS/i)
            || navigator.userAgent.match(/iPhone/i)
            || navigator.userAgent.match(/iPad/i)
            || navigator.userAgent.match(/iPod/i)
            || navigator.userAgent.match(/BlackBerry/i)
            || navigator.userAgent.match(/Windows Phoe/i)
        ){
            return true;
        }else{
            return false;
        }
    }
    if(referencia != null)
        sendWhatsappReference(referencia.value)

</script>
@endpush