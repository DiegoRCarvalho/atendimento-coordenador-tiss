<?php

namespace act\Http\Controllers\Authenticated;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use act\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
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
            'last_name'  => $userLog->last_name,
            'id' => $userLog->id
        ];

        $openAttendances = DB::table('protocols')->distinct()
        ->select('attendances.id','contacts.contact_name','service_providers.company_fancy_name', 'service_providers.cpf_cnpj','protocols.protocol', 'protocols.created_at', 'attendances.action')
            ->join('service_providers','service_providers.id','=','protocols.service_provider_fk', 'left')
            ->join('attendances','attendances.id','=','protocols.attendance_fk')
            ->join('user_attendances','attendances.id','=','user_attendances.attendance')
            ->join('contacts','contacts.id','=','attendances.contact_fk')
            ->where('attendances.action','<>', '3')
            ->orderBy('protocols.created_at', 'asc')
            ->take(12)
            ->get();

        $recentAttendances = DB::table('protocols')->distinct()
        ->select('attendances.id','contacts.contact_name','service_providers.company_fancy_name', 'service_providers.cpf_cnpj','protocols.protocol', 'protocols.created_at', 'attendances.action')
            ->join('service_providers','service_providers.id','=','protocols.service_provider_fk', 'left')
            ->join('attendances','attendances.id','=','protocols.attendance_fk')
            ->join('user_attendances','attendances.id','=','user_attendances.attendance')
            ->join('contacts','contacts.id','=','attendances.contact_fk')
            ->orderBy('protocols.created_at', 'desc')
            ->take(12)
            ->get();

        //$attendancesForwardedToYou = DB::table('protocols')->distinct()
        //->select('attendances.id','contacts.contact_name', 'service_providers.company_fancy_name', 'service_providers.cpf_cnpj','protocols.protocol', 'protocols.created_at', 'attendances.action')
        //    ->join('service_providers','service_providers.id','=','protocols.service_provider_fk')
        //    ->join('attendances','service_providers.id','=','attendances.service_provider_fk')
        //    ->join('user_attendances', 'attendances.id', '=' , 'user_attendances.attendance')
        //    ->join('contacts','contacts.id','=','attendances.contact_fk')
        //    ->where('attendances.action','<>', '3', 'and')
        //    ->where('user_attendances.forward_to', '=', $userLog['id'])
        //    ->orderBy('protocols.created_at', 'asc')
        //    ->take(12)
        //    ->get();

        $attendancesForwardedToYou = DB::table('attendances')->distinct()
        ->select('attendances.id','contacts.contact_name', 'service_providers.company_fancy_name', 'service_providers.cpf_cnpj','protocols.protocol', 'protocols.created_at', 'attendances.action')
            ->join('user_attendances','attendances.id','=','user_attendances.attendance')
            ->join('contacts','contacts.id','=','attendances.contact_fk')
            ->join('service_providers', 'attendances.service_provider_fk', '=' , 'service_providers.id')
            ->join('protocols','protocols.attendance_fk','=','attendances.id')
            ->where('attendances.action','<>', '3', 'and')
            ->where('user_attendances.forward_to', '=', $userLog['id'])
            ->orderBy('protocols.created_at', 'asc')
            ->take(12)
            ->get();

        return view('authenticated.home', [
            'openAttendances' => $openAttendances,
            'recentAttendances' => $recentAttendances,
            'attendancesForwardedToYou' => $attendancesForwardedToYou,
            'userLog' => $userLog

        ]);
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
