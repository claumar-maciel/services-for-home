@extends('layouts.admin.panel')
 
@section('title', "Criar post")
 
@section('content')
    <form class="w-100 mt-4" action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data"> 
        @csrf
        
        <div class="mb-4">
            <div class="form-group my-3">
                <label>Título</label>
                <input type="text" class="form-control" placeholder="descreva a postagem com um título curto" name="title">
            </div>
    
            <div class="form-group my-3">
                <label>Conteúdo</label>
                <textarea type="text" class="form-control" placeholder="coloque o conteúdo da postagem aqui!" name="content"></textarea>
            </div>

            <div class="my-3">
                <a class="btn btn-outline-dark d-flex justify-content-center align-items-center flex-column p-4" onclick="document.getElementById('hidden-image-input').click()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                    </svg>
                    <span class="mt-2">Escolher banner</span>
                </a>
                <input type='file' name="banner" id="hidden-image-input" style="display:none">
            </div>

            <div id="imgs-preview" class="mb-3 d-flex justify-content-center">
        </div>

        <div class="d-flex justify-content-end form-group my-3">
            <a class="btn btn-secondary ms-2" href="{{ route('admin.posts.index') }}">cancelar</a>
            <button class="btn btn-primary ms-2">criar</button>
        </div>
    </form>
@endsection

@section('footerScripts')
    <script defer>
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
                        
                        tag.innerHTML = ['<img width="100%" style="max-width: 300px;" class="img-fluid m-1" src="', e.target.result,
                                            '" title="', escape(filei.name), '"/>'].join('');
                                            
                        document.getElementById('imgs-preview').insertBefore(tag, null);
                    };
                })(f);
                
                reader.readAsDataURL(f);
            }
        }

        document.getElementById('hidden-image-input').addEventListener('change', readURL, false);
    </script>
@endsection