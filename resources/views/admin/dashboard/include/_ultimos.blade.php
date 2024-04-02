@foreach($pagamentos as $key => $value)
    <div class="row">
        <div class="col">
            <h6>{{ $key }}</h6>
        </div>
    </div>
    @foreach($value as $k => $v)
        <div class="row">
            <div class="col">
                {{$v->transacao_key}}
            </div>
            <div class="col">
            {{$v->created_at->format('H:i:s')}}
            </div>
            <div class="col-3">
                R$ {{getMoney($v->valor)}}
            </div>
        </div>

    @endforeach
@endforeach