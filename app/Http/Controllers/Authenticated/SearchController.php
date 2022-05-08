<?php

namespace act\Http\Controllers\Authenticated;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use act\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
     /**
     * display previous search result.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $userLog = Auth::user();
        $userLog = [
            'first_name' => $userLog->first_name,
            'last_name'  => $userLog->last_name
        ];

        if (!empty(($request->initialDate) and ($request->finalDate))) {
            list($day, $month, $year) = explode('/', $request->initialDate);
            $initialDate = (new \DateTime($year .'-'. $month .'-'. $day . ' '. '00:00:00'))->format('Y-m-d H:i:s');

            list($day, $month, $year) = explode('/', $request->finalDate);
            $finalDate = (new \DateTime($year .'-'. $month .'-'. $day . ' '. '23:59:59'))->format('Y-m-d H:i:s');
        } else {
            $initialDate = null;
            $finalDate = null;
        }

        if ($request->protocol <> null){
            // Buscar apenas por Protocolo
            $results = DB::table('protocols')->distinct()
                ->select('attendances.action','attendances.id','contacts.contact_name', 'service_providers.company_fancy_name', 'service_providers.cpf_cnpj','protocols.protocol', 'protocols.created_at')
                ->join('service_providers','service_providers.id','=','protocols.service_provider_fk', 'left')
                ->join('attendances','attendances.id','=','protocols.attendance_fk')
                ->join('user_attendances','attendances.id','=','user_attendances.attendance')
                ->join('contacts','contacts.id','=','attendances.contact_fk')
                ->where('protocols.protocol', '=', $request->protocol)
                ->get();

        } else if (($request->cpfCnpj <> null) and ($initialDate == null) and ($finalDate == null)){
            // Buscar apenas por CPF/CNPJ
            $results = DB::table('protocols')->distinct()
            ->select('attendances.action','attendances.id','contacts.contact_name', 'service_providers.company_fancy_name', 'service_providers.cpf_cnpj','protocols.protocol', 'protocols.created_at')
                ->join('service_providers','service_providers.id','=','protocols.service_provider_fk', 'left')
                ->join('attendances','attendances.id','=','protocols.attendance_fk')
                ->join('user_attendances','attendances.id','=','user_attendances.attendance')
                ->join('contacts','contacts.id','=','attendances.contact_fk')
                ->where('service_providers.cpf_cnpj', '=', $request->cpfCnpj)
                ->orderBy('user_attendances.created_at', 'desc')
                ->get();
        } else if (($request->cpfCnpj <> null) and ($initialDate <> null) and ($finalDate <> null)){
            // Buscar por CPF/CNPJ e Período

            $results = DB::table('protocols')->distinct()
            ->select('attendances.action','attendances.id','contacts.contact_name', 'service_providers.company_fancy_name', 'service_providers.cpf_cnpj','protocols.protocol', 'protocols.created_at')
                ->join('service_providers','service_providers.id','=','protocols.service_provider_fk', 'left')
                ->join('attendances','attendances.id','=','protocols.attendance_fk')
                ->join('user_attendances','attendances.id','=','user_attendances.attendance')
                ->join('contacts','contacts.id','=','attendances.contact_fk')
                ->where('service_providers.cpf_cnpj', '=', $request->cpfCnpj)
                ->where('protocols.created_at', '>=',$initialDate, 'and')
                ->where('protocols.created_at', '<=', $finalDate)
                ->orderBy('protocols.created_at', 'desc')
                ->get();
        } else if (($request->cpfCnpj == null) and ($initialDate <> null) and ($finalDate <> null)){
            // Buscar por Período

            $results = DB::table('protocols')->distinct()
            ->select('attendances.action','attendances.id','contacts.contact_name', 'service_providers.company_fancy_name', 'service_providers.cpf_cnpj','protocols.protocol', 'protocols.created_at')
                ->join('service_providers','service_providers.id','=','protocols.service_provider_fk', 'left')
                ->join('attendances','attendances.id','=','protocols.attendance_fk')
                ->join('user_attendances','attendances.id','=','user_attendances.attendance')
                ->join('contacts','contacts.id','=','attendances.contact_fk')
                ->where('protocols.created_at', '>=',$initialDate, 'and')
                ->where('protocols.created_at', '<=', $finalDate)
                ->orderBy('protocols.created_at', 'desc')
                ->get();
        } else {
            // Informar que a data inicial e final devem ser preenchidas
            $results = null;
        }
        return view('authenticated.search.list', [
            'results' => $results,
            'userLog' => $userLog
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userLog = Auth::user();
        $userLog = [
            'first_name' => $userLog->first_name,
            'last_name'  => $userLog->last_name
        ];
        return view('authenticated.search.search', ['userLog' => $userLog]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
