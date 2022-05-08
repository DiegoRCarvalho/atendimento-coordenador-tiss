<?php

use Illuminate\Database\Seeder;

class SolutionDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('solution_details')->insert([
            ['id' => '1', 'description' => 'Autorização de envio de faturamento fora do prazo'],
            ['id' => '2', 'description' => 'Correção de erros ou manutenção em sistemas da operadora.'],
            ['id' => '3', 'description' => 'Detalhamento da Nota Fiscal'],
            ['id' => '4', 'description' => 'Detalhamento financeiro'],
            ['id' => '5', 'description' => 'Explicação referente a obtenção e utilização de tabelas negociadas'],
            ['id' => '6', 'description' => 'Explicação referente ao atraso no pagamento'],
            ['id' => '7', 'description' => 'Explicação referente ao código de glosa'],
            ['id' => '8', 'description' => 'Explicação referente ao erro relatado'],
            ['id' => '9', 'description' => 'Explicação referente ao processo devolvido'],
            ['id' => '10', 'description' => 'Script de acesso e utilização geral do site'],
            ['id' => '11', 'description' => 'Script de autorização de procedimentos'],
            ['id' => '12', 'description' => 'Script de autorizações de OPME'],
            ['id' => '13', 'description' => 'Script de demonstrativo de pagamento'],
            ['id' => '14', 'description' => 'Script de envio do arquivo XML'],
            ['id' => '15', 'description' => 'Script de preenchimento de guias'],
            ['id' => '16', 'description' => 'Script de recurso de glosa'],
            ['id' => '17', 'description' => 'Script de solicitação de internação'],
            ['id' => '18', 'description' => 'Script de verificação de elegibilidade'],
            ['id' => '19', 'description' => 'Sistemas da operadora estavam em manutenção. Problema solucionado após normalização'],
            ['id' => '20', 'description' => 'Revisão do contrato e criação de aditivo contratual'],
        ]);
    }
}




