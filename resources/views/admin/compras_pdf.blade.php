<html>
    <head>
        <title>Relatório de Compras de Livros - Turma: {{$turma}}º ANO</title>
        <style>
            table, th, td {
                border: 1px solid black;
                text-align: center;
              }
        </style>
    </head>
    <body>
    <div>
        <div>
            <h4>Relatório de Compras de Livros - Turma: {{$turma}}º ANO</h4>
            <h5>Solicitante: {{Auth::user()->name}}</h5>
            <table>
                <thead>
                    <tr>
                        <th>Nome do Aluno</th>
                        <th>Série/Turma</th>
                        <th>Responsável</th>
                        <th>Valor</th>
                        <th>Pagamento</th>
                        <th>Usuário</th>
                        <th>Data & Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)
                    <tr>
                        <td>{{$compra->nomeAluno}}</td>
                        <td>{{$compra->serie}}º ANO {{$compra->turma}} ({{$compra->ensino}})</td>
                        <td>{{$compra->nomeResp}}</td>
                        <td>{{ 'R$ '.number_format($compra->valor, 2, ',', '.')}}</td>
                        <td>{{$compra->formaPagamento}}</td>
                        <td>{{$compra->user}}</td>
                        <td>{{date("d/m/Y H:i", strtotime($compra->created_at))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>