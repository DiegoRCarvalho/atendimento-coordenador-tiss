<?php

use Illuminate\Database\Seeder;

class ErrorDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('error_details')->insert([
            ['id' => '1' , 'description' => 'Dúvidas de acesso ao site'],
            ['id' => '2' , 'description' => 'Dúvidas de envio do arquivo XML'],
            ['id' => '3' , 'description' => 'Dúvidas referentes a impressão de guias'],
            ['id' => '4' , 'description' => 'Dúvidas referentes a autorização de OPME'],
            ['id' => '5' , 'description' => 'Dúvidas referentes a autorização de procedimentos'],
            ['id' => '6' , 'description' => 'Dúvidas referentes a declaração de INSS'],
            ['id' => '7' , 'description' => 'Dúvidas referentes a fechamento de fatura'],
            ['id' => '8' , 'description' => 'Dúvidas referentes a guias autorizadas'],
            ['id' => '9' , 'description' => 'Dúvidas referentes a Nota Fiscal'],
            ['id' => '10', 'description' => 'Dúvidas referentes a pagamento'],
            ['id' => '11', 'description' => 'Dúvidas referentes a previsão de pagamento'],
            ['id' => '12', 'description' => 'Dúvidas referentes a processo devolvido'],
            ['id' => '13', 'description' => 'Dúvidas referentes a recurso de glosa'],
            ['id' => '14', 'description' => 'Dúvidas referentes a solicitação de internação'],
            ['id' => '15', 'description' => 'Dúvidas referentes a solicitação do contrato atualizado'],
            ['id' => '16', 'description' => 'Dúvidas referentes a tabelas negociadas'],
            ['id' => '17', 'description' => 'Dúvidas referentes a verificação de elegibilidade'],
            ['id' => '18', 'description' => 'Dúvidas referentes ao código de glosa'],
            ['id' => '19', 'description' => 'Dúvidas referentes ao demonstrativo de pagamento'],
            ['id' => '20', 'description' => 'Dúvidas referentes ao preenchimento da guia'],
            ['id' => '21', 'description' => 'Dúvidas referentes ao informe imposto de renda'],
            ['id' => '22', 'description' => 'Envio do faturamento fora do prazo'],
            ['id' => '23', 'description' => 'Erro ao ao digitar número do lote repetido'],
            ['id' => '24', 'description' => 'Erro ao baixar o XML do demonstrativo'],
            ['id' => '25', 'description' => 'Erro ao digitar data de atendimento no faturamento'],
            ['id' => '26', 'description' => 'Erro ao digitar o CPF errado no faturamento'],
            ['id' => '27', 'description' => 'Erro ao solicitar a internação o CPF não cadastrado'],
            ['id' => '28', 'description' => 'Erro de atendimento após o desligamento do beneficiário'],
            ['id' => '29', 'description' => 'Erro de caracter especial'],
            ['id' => '30', 'description' => 'Erro guia já apresentada'],
            ['id' => '31', 'description' => 'Erro não especificado no envio do XML'],
            ['id' => '32', 'description' => 'Erro por falta do procedimento principal'],
            ['id' => '33', 'description' => 'Erro XML - CNPJ ou CPF divergente do logado no portal'],
            ['id' => '34', 'description' => 'Erro XML - Número da carteira inválida'],
            ['id' => '35', 'description' => 'Erro XML - Taxa no campo de procedimento principal'],
            ['id' => '36', 'description' => 'Solicitação de mudança de endereço'],
            ['id' => '37', 'description' => 'Solicitação de senha para o faturamento']
        ]);
    }
}
