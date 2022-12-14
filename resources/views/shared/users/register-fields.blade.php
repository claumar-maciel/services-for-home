<div class="container__auth__form__fields">
    @include('shared.error_success_alert')

    <div class="mb-4">
        <h5>Dados pessoais</h5>
        <div class="form-group my-3">
            <input type="text" class="form-control" placeholder="nome" name="nome" value="{{old('nome')}}">
        </div>

        <div class="form-group my-3">
            <input type="email" class="form-control" placeholder="email" name="email" value="{{old('email')}}">
        </div>
        
        <div class="form-group my-3">
            <input type="text" class="form-control" placeholder="usuário" name="username" value="{{old('username')}}">
        </div>

        <div class="form-group" class="form-group my-3">
            <input type="password" class="form-control" placeholder="senha" name="senha" value="{{old('senha')}}">
        </div>

        <div class="form-group my-3">
            <input type="text" class="form-control cpf-input" placeholder="cpf - ex: 999.999.999-99" name="cpf" value="{{old('cpf')}}">
        </div>
    </div>

    <div class="mb-4">
        <h5>Contato</h5>

        <div class="form-group my-3">
            <input type="text" class="form-control celular-input" placeholder="celular - ex: (99)99999-9999" name="celular" value="{{old('celular')}}">
        </div>

        <div class="form-group my-3">
            <input type="text" class="form-control telefone_residencial-input" placeholder="telefone residencial  - ex: (99)9999-9999" name="telefone_residencial" value="{{old('telefone_residencial')}}">
        </div>
    </div>

    <div class="mb-4">
        <h5>Endereço</h5>

        <div class="form-group my-3">
            <input type="text" class="form-control cep-input" placeholder="CEP - ex: 99999-999" name="cep" value="{{old('cep')}}">
        </div>

        <div class="form-group my-3">
            <input type="text" class="form-control" placeholder="rua" name="rua" value="{{old('rua')}}">
        </div>

        <div class="form-group my-3">
            <input type="text" class="form-control" placeholder="numero" name="numero" value="{{old('numero')}}">
        </div>

        <div class="form-group my-3">
            <input type="text" class="form-control" placeholder="bairro" name="bairro" value="{{old('bairro')}}">
        </div>

        <div class="form-group my-3">
            <input type="text" class="form-control" placeholder="cidade" name="cidade" value="{{old('cidade')}}">
        </div>

        <div class="form-group my-3">
            <input type="text" class="form-control" placeholder="sigla do estado - ex: RS" name="estado" value="{{old('estado')}}">
        </div>

        <div class="form-group my-3">
            <input type="text" class="form-control" placeholder="ponto de referencia" name="ponto_referencia" value="{{old('ponto_referencia')}}">
        </div>

        <div class="form-group my-3">
            <input type="text" class="form-control" placeholder="complemento - opcional" name="complemento" value="{{old('complemento')}}">
        </div> 

        <div class="form-check">
            <input 
                class="form-check-input" 
                type="checkbox" 
                required
                oninvalid="this.setCustomValidity('Você deve aceitar os termos!')" 
                onchange="try{setCustomValidity('')}catch(e){}"    
            >
            
            <label class="form-check-label" for="flexCheckChecked">
                Aceito os termos conforme Lei nº12.965/2014.
            </label>
        </div>          
    </div>
</div>