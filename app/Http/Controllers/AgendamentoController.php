<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Horario;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendamentoController extends Controller
{

    public $servico;
    public $funcionarios;
    public $agendamento;

    public function __construct(Agendamento $agendamento)
    {
        $this->agendamento = $agendamento;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servico = Servico::all();

        return view('dashboard.agendar.index', compact('servico'));
    }
    // public function obterFuncionariosDisponiveis(Request $request)
    // {
    //     $this->day = $request->input('day');
    //     $this->month = $request->input('month');

    //     if ($this->month == 'Abril') {
    //         $this->month = '04';
    //     }

    //     // Aqui você executa a consulta SQL com base na data recebida
    //     // e retorna os funcionários disponíveis

    //     // Exemplo de consulta (não inclui a execução real da consulta)


    //     // return response()->json(['funcionarios' => $funcionarioAJAX]);
    //     $this->funcionarios = $funcionarioAJAX;
    //     //dd($this->funcionarios, 'Cheguei');
    // }


    public $day;
    public $month;





    public function calendario(Request $request){


        $servico = Servico::all();
        $idCliente = session('id');

        $cliente = Cliente::find($idCliente);


        if($request->json() && $request->has('day','month')){
            $this->day = $request->day;
            $this->month = $request->month;
            if($this->month == 'Abril'){
                $this->month = '4';
            }

            // $funcionarioAJAX = Funcionario::whereDoesntHave('agendamento', function ($query) use ($day, $month) {
            //     $query->whereMonth('data', '=', $month)
            //     ->whereDay('data', '=', $day);
            // })->get();

            $funcionarios = DB::select("SELECT f.id, f.nomeFuncionario, f.sobrenomeFuncionario, f.fotoFuncionario,f.especialidadeFuncionario
            FROM funcionarios f");

            return response()->json($funcionarios);
        }


        return view('dashboard.agendar.calendario', compact('servico','cliente'));
    }

    public function consultarHorarios(Request $request){

         if($request->json() && $request->has('day','month')){
        // Se day e month estiverem presentes na solicitação
        $day = $request->day;
        $month = $request->month;
        if($month == 'Abril'){
            $month = '4';
        }



        $dataHorarios = date('Y-m-d', strtotime("2024-$month-$day"));

        // Restante do seu código para obter horários disponíveis...

        // Recupera os parâmetros da solicitação (por exemplo, ID do funcionário e data)
        $funcionarioId = $request->input('funcionario_id');
        $nomeFunc = $request->input('nome_funcionario');

        // Executa a consulta SQL para obter os horários disponíveis para o funcionário e data fornecidos
        $horariosDisponiveis = DB::select("
        SELECT h.id AS horario_id, h.horarios
        FROM horarios h
        LEFT JOIN (
            SELECT DISTINCT horario_id
            FROM agendamento
            WHERE funcionario_id = ?
            AND dataAgendamento = ?
        ) a ON h.id = a.horario_id
        WHERE a.horario_id IS NULL;", [$funcionarioId, $dataHorarios]);

        foreach ($horariosDisponiveis as $horario) {
            $horarioId = $horario->horario_id;
            $horario->horario_id = (int)$horarioId; // Garante que o ID do horário seja inteiro
        }
       // Cria um array associativo contendo os horários disponíveis e o ID do funcionário
            $dados = [
                'funcionario_id' => $funcionarioId,
                'horarios_disponiveis' => $horariosDisponiveis,
                'nome_funcionario' => $nomeFunc,
                'data_horario' =>$dataHorarios
            ];

            // Retorna os dados como JSON
            return response()->json($dados);

        } else {
            // Se day e month não estiverem presentes na solicitação
            return response()->json(['error' => 'Os parâmetros "day" e "month" são obrigatórios.'], 400);
        }

       }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agendamento = $this->agendamento->create([
                'funcionario_id' => $request->funcionario_id,
                'cliente_id' => $request->cliente_id,
                'servico_id' => $request->servico_id,
                'horario_id' => $request->horario_id,
                'dataAgendamento' => $request->dataAgendamento
        ]);

        return response()->json($agendamento, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function show(Agendamento $agendamento, $servico)
    {
        return $servico;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Agendamento $agendamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agendamento $agendamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agendamento $agendamento)
    {
        //
    }
}
