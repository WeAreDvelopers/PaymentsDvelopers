<!-- <select name="id_bandeira" id="" class="form-select"> 
    <option value="">Selecionar Bandeira:</option>
    @foreach ($bandeiras as $band)
        <option value="{{ $band->id }}"> 
        <img src="{{$band->file}}" alt="">
        {{ ucfirst(mb_strtolower($band->nome)) }}
    </option>
    @endforeach
</select> -->

<div class="custom-select">
        <div class="custom-select-selected form-select">
            @if ($forma_pagamento?->id_bandeira)
            <img src="{{$forma_pagamento->bandeira->file}}" alt="" id="imgBandeira" class="pe-1">
            <p id="textBandeira" class="mb-0 pt-1" style="font-size: 14px">{{$forma_pagamento->bandeira->nome}}</p>  
            @else
            <img src="" alt="" id="imgBandeira" class="pe-1" style="display: none">
            <p id="textBandeira" class="mb-0 pt-1" style="font-size: 14px">Selecione um Bandeira:</p>  
            @endif
        </div>
        <div class="custom-select-options" style="display: none;">
            <div class="custom-select-option" data-value="">
                <img src=""> Selecione um Bandeira:
            </div>
            @foreach ($bandeiras as $band)
            <div class="custom-select-option" data-value="{{ $band->id }}">
                <img src="{{$band->file}}"> {{ ucfirst(mb_strtolower($band->nome)) }}
            </div>
            @endforeach
        </div>
        <select id="opcoes" name="id_bandeira" style="display: none;">
            @foreach ($bandeiras as $band)
            <option value="{{ $band->id }}" @if ($forma_pagamento?->id_bandeira == $band->id) selected @endif>Crédito>{{ ucfirst(mb_strtolower($band->nome)) }}</option>
            @endforeach
        </select>
    </div>