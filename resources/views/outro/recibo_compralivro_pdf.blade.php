<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Recibo - {{$recibo->nomeAluno}}</title>
        <link rel="shortcut icon" href="/storage/images/favicon.png"/>
    </head>
    <body>
    <div class="card border">
        <img src="storage/images/liceu.png" width="200" class="d-inline-block align-top" loading="lazy"/>
        @php
        if($recibo->formaPagamento==="Cartão Crédito (2x)"){
            $parcela = 2;
            $valorParcela = $recibo->valor/2;
        }
        if($recibo->formaPagamento==="Cartão Crédito (3x)"){
            $parcela = 3;
            $valorParcela = $recibo->valor/3;
        }
        if($recibo->formaPagamento==="Cartão Crédito (4x)"){
            $parcela = 4;
            $valorParcela = $recibo->valor/4;
        }
        if($recibo->formaPagamento==="Cartão Crédito (5x)"){
            $parcela = 5;
            $valorParcela = $recibo->valor/5;
        }
        if($recibo->formaPagamento==="Cartão Crédito (6x)"){
            $parcela = 6;
            $valorParcela = $recibo->valor/6;
        }
        $meses = array(
            "01" => 'Janeiro',
            "02" => 'Fevereiro', 
            "03" => 'Março', 
            "04" => 'Abril', 
            "05" => 'Maio', 
            "06" => 'Junho', 
            "07" => 'Julho', 
            "08" => 'Agosto', 
            "09" => 'Setembro', 
            "10" => 'Outubro', 
            "11" => 'Novembro', 
            "12" => 'Dezembro');
        $mes_numero = date('m', strtotime($recibo->created_at));
        @endphp
        <div class="card-body">
            <br/><br/><br/><br/><br/><br/>
            <h4 class="text-center">RECIBO</h4>
            <br/>
            <p class="text-justify">Pelo presente, a empresa SIDARTA - SISTEMA DE ENSINO EDUCACIONAL EIRELI, inscrita no CNPJ sob nº 13.139.893/0001-00, declara que RECEBEU na data de hoje, o valor de {{ 'R$ '.number_format($recibo->valor, 2, ',', '.')}}, pago @if($recibo->formaPagamento==="Dinheiro" || $recibo->formaPagamento==="Cartão Débito" || $recibo->formaPagamento==="Cartão Crédito (à Vista)") em valor integral @else em {{$parcela}} parcelas iguais de {{ 'R$ '.number_format($valorParcela, 2, ',', '.')}} @endif por meio de {{$recibo->formaPagamento}}, de {{$recibo->nomeResp}}, inscrito no CPF sob nº {{$recibo->cpf}}, referente a Compra dos Livros Didáticos (Ano 2021) do {{$recibo->turma}}º Ano do @if($recibo->ensino=='EFI') Ensino Fund. 1 @else @if($recibo->ensino=='EFII') Ensino Fund. 2 @else @if($recibo->ensino=='EM') Ensino Médio @else Todos Ensinos @endif @endif @endif para o Aluno {{$recibo->nomeAluno}}.</p>
            <br/><br/>
            <p class="text-justify">Campo Grande - MS, {{date('d', strtotime($recibo->created_at))}} de {{$meses[$mes_numero]}} de {{date('yy', strtotime($recibo->created_at))}}.</p>
            <br/><br/><br/><br/>
            <p class="text-center">____________________________________________________________________<br/>SIDARTA - SISTEMA DE ENSINO EDUCACIONAL EIRELI</p>
        </div>
    </div>
</body>
</html>