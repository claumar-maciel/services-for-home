@extends('layouts.client.panel')
 
@section('title', 'Avaliar Prestador')
 
@section('content')
<div class="rate_provider_main">
    <div class="rate_provider_body">
        <h5 class="mb-4">
            <span class="text-primary">O que você achou do prestador {{ $scheduling->provider->name }}?</span> 
            <br>
            <small class="text-secondary">Ajude outros clientes avaliando o prestador.</small>
        </h5>
        
        <div class="rate_provider_body_stars">
            <a href="" id="rate_provider_btn_star-1" class="rate_provider_btn_star">
                <x-star />
            </a>
            <a href="" id="rate_provider_btn_star-2" class="rate_provider_btn_star">
                <x-star />
            </a>
            <a href="" id="rate_provider_btn_star-3" class="rate_provider_btn_star">
                <x-star />
            </a>
            <a href="" id="rate_provider_btn_star-4" class="rate_provider_btn_star">
                <x-star />
            </a>
            <a href="" id="rate_provider_btn_star-5" class="rate_provider_btn_star">
                <x-star />
            </a>
        </div>

        <div class="rate_provider_body_btns">
            <form action="{{ route('client.schedulings.rate.store', ['scheduling' => $scheduling->id]) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="rating" id="rate_provider_body_input">

                <textarea name="client_comment" id="rate_provider_mensagem_input"
                    placeholder="Deixe uma mensagem sobre sua experiência com esse prestador (opcional)"></textarea>

                <div class="mb-3">
                    <a class="btn btn-dark d-flex justify-content-center align-items-center flex-column p-4" onclick="document.getElementById('hidden-images-input').click()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                        </svg>
                        <span class="mt-2">adicionar imagens do serviço</span>
                    </a>
                    <input type='file' name="images[]" id="hidden-images-input" style="display:none" multiple>
                </div>

                <div id="imgs-preview" class="mb-3">

                </div>

                <button type="submit" class="btn btn-primary" id="rate_provider_btn_submit" disabled>
                    <x-star-fill /> Avaliar
                </button>
            </form>
        </div>
    </div>
</div>  
@endsection

@section('footerScripts')
    <script defer>
        const btns = document.getElementsByClassName("rate_provider_btn_star");

        var updateRateBtns = function(e) {
            e.preventDefault();

            document.getElementById('rate_provider_btn_submit').disabled = false;

            const id = this.id.split('-')[1]
            const btn = document.getElementById(`rate_provider_btn_star-${id}`)
            const input = document.getElementById(`rate_provider_body_input`)
            input.value = id

            const star =
                "<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='currentColor' class='bi bi-star' viewBox='0 0 16 16'><path d='M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z' /></svg>"
            const star_active =
                '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" /></svg>'

            for (i = 1; i <= parseInt(id); i++) {
                document.getElementById(`rate_provider_btn_star-${i}`).innerHTML = star_active
            }

            const startLoop = parseInt(id) + 1
            for (i = startLoop; i <= 5; i++) {
                document.getElementById(`rate_provider_btn_star-${i}`).innerHTML = star
            }
        };

        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener('click', updateRateBtns, false);
        }

        function readURL(evt) {
            var files = evt.target.files;
            document.getElementById('imgs-preview').innerHTML = null;

            for (var i = 0, f; f = files[i]; i++) {
                if (!f.type.match('image.*')) {
                    continue;
                } //verifica se os arquivos são imagens

                var reader = new FileReader();

                reader.onload = (function(filei) {
                    return function(e) {
                        var tag = document.createElement('span');
                        
                        tag.innerHTML = ['<img width="120px" class="img-fluid m-1" src="', e.target.result,
                                            '" title="', escape(filei.name), '"/>'].join('');
                                            
                        document.getElementById('imgs-preview').insertBefore(tag, null);
                    };
                })(f);
                
                reader.readAsDataURL(f);
            }
        }

        document.getElementById('hidden-images-input').addEventListener('change', readURL, false);
    </script>
@endsection