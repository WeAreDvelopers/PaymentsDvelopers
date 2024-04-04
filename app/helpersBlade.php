<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

if (! function_exists('getMoney')) {

	function getMoney($value,$moeda = null){
		if($value === null){
			return '0,00';
		}
		if($moeda !== null){
			return $moeda . " " . number_format($value,2,',','.');
		}else{
			return @number_format($value,2,',','.');
		}
		
	}
}
if (! function_exists('saveMoney')) {
	function saveMoney($value){
		
		if($value === null){
			return 0.00;
		}
		$money = str_replace(".", "", $value);
		$money = str_replace(",", ".", $money);
		return $money;
	}
}
if (! function_exists('progressColor')) {
	function progressColor($value){
		if($value < 15){
			return 'bg-danger';
		}
		if($value >= 15 && $value <= 30){
			return 'bg-warning';
		}

		if($value > 30 && $value <= 70){
			return 'bg-primary';
		}

		if($value > 70 ){
			return 'bg-success';
		}
		
	}
}
if (! function_exists('formatNameConta')) {
	function formatNameConta($value){
		 $arrayContas = [
                    "dinheiro"=>'Dinheiro',
                    "cartao_credito"=>'Cartão',
                    "bancaria"=>'Conta',
                    "investimento"=>'Investimento',
            ];
        return data_get($arrayContas,$value,'');
		
	}
}
if (! function_exists('slug')) {
	function slug($value){
		 $slug = Str::slug($value, '-');
        return $slug;
		
	}
}
if (! function_exists('limit_text')) {
	
	function limit_text($value,$limit = 20){
		 $slug = Str::limit($value, $limit);
		 if(Str::length($value) > 20){
        return '<span title="'.$value.'">' . $slug . '</span>' ;
	}else{
		return $value;
	}
		
	}
}
if (! function_exists('status')) {
	function status($value){
		if($value){
		$array = [
			'ativo'=>
				[
					'title'=>'Ativo',
					'color'=> 'text-bg-success',
				],
			'inativo'=>
				[
					'title'=>'Inativo',
					'color'=> "text-bg-warning",
				],
			'removed'=>
				[
					'title'=>'Removido',
					'color'=> "text-bg-danger"
				]
			];
		return '<span class="badge '.$array[$value]['color'].'">'.$array[$value]['title'].'</span>';
		;
		}
	}
}

if (! function_exists('calcParcelaJuros')) {
	function calcParcelaJuros($valor_total,$parcelas = null,$juros=0){
		if($parcelas){
			if($juros==0){
				$string = number_format($valor_total/$parcelas, 2, ",", ".");	
			return $string;
			}else{
				/*
					$I = $juros/100.00;
					$valor_parcela = $valor_total*$I*pow((1+$I),$parcelas)/(pow((1+$I),$parcelas)-1);
					$string = number_format($valor_parcela, 2, ",", ".");
				*/
				$conta = $valor_total * ($juros / 100);
				$conta = ($valor_total + $conta) / $parcelas;

			return number_format($conta, 2, ",", ".");	
			}
		}else{
			return '0,00';
		}
     }

	 if (! function_exists('replaceTerms')) {
	 function replaceTerms($text)
    {
        $user = Auth::user();
		$terms = [
			'@nome' => $user->first_name,
		];
        if ($user) {
			foreach ($terms as $index => $term) {
				
				$text = str_replace($index, $term, $text);
			}

            return $text;
        }

        return $text;
    }
}
if (! function_exists('createDirecrotory')) {
	function  createDirecrotory($folder){
		$path = public_path().'/'.$folder;
		File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
	}
}
if (! function_exists('termosReplace')) {
	function  termosReplace($value){
		$array = [
			'dizimo' 		=> 'Dízimo',
			'oferta' 		=> 'Oferta',
			'presencial'	=> 'Presencial',
			'fisico'		=> 'Físico',
			'online'		=> 'Online',
		];

		return $array[$value] ?? $value;
	}
}


}
?>