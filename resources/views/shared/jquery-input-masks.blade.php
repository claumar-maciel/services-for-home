@section('headScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
@endsection

@section('footerScripts')
    <script>
        $(document).ready(function(){
            $('.telefone_residencial-input').inputmask('(99)9999-9999');
            $('.celular-input').inputmask('(99)99999-9999');
            $('.cep-input').inputmask('99999-999');
            $('.cpf-input').inputmask('999.999.999-99');
        });
    </script>
@endsection