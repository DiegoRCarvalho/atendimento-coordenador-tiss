<?php

namespace act\Http\Controllers\Authenticated;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use act\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function getCpfCnpj(Request $request)
    {

        $dbCompany = DB::table('service_providers')
        ->select('service_providers.id', 'service_providers.company_fancy_name', 'service_provider_types.description')
            ->join('service_provider_types', 'service_providers.type_fk', '=', 'service_provider_types.id')
            ->where('service_providers.cpf_cnpj', '=', $request ->cpfCnpj)
            ->get()
            ->first();

        if(!empty($dbCompany)){
            //Busca na tabela de endereços a UF, logradouro, Nº, compl., bairro, cidade e estado pesquisando pelo ID encontrado em $dbCompany
            $dbAddress = DB::table('addresses')
            ->select('addresses.address', 'addresses.number', 'addresses.complement', 'addresses.neighborhood', 'addresses.city', 'addresses.uf', 'addresses.zipcode')
                ->join('service_provider_addresses','addresses.id','=','service_provider_addresses.address')
                ->join('service_providers','service_provider_addresses.service_provider','=','service_providers.id')
                ->where('service_providers.id', '=', $dbCompany->id, 'and')
                ->where('addresses.main_address', '=', '1')
                ->get()
                ->first();

            $dbContact = DB::table('contacts')
            ->select('contacts.contact_name', 'contacts.ddd', 'contacts.telephone', 'contacts.telephone_extension', 'contacts.email', 'contacts.sector')
                ->join('service_provider_contacts','contacts.id','=','service_provider_contacts.contact')
                ->join('service_providers','service_provider_contacts.service_provider','=','service_providers.id')
                ->where('service_providers.id', '=', $dbCompany->id)
                ->get()
                ->first();


            $dbProtocols = DB::table('protocols')
            ->select('protocols.protocol')
                ->join('service_providers', 'protocols.service_provider_fk', '=', 'service_providers.id')
                ->where('service_providers.id', '=', $dbCompany->id)
                ->orderBy('protocols.created_at')
                ->get();
                $i=0;
                if(count($dbProtocols) > 0){
                    foreach ($dbProtocols as $key ) {
                            $protocolList [$i] = [$key->protocol];
                            $i++;
                        }
                    } else{
                        $protocolList = null;
                    }

            $dataResponse = [
                'company_fancy_name'    => $dbCompany->company_fancy_name,
                'type'                  => $dbCompany->description,
                'providerAddress'       => "$dbAddress->address, $dbAddress->number - $dbAddress->complement / $dbAddress->neighborhood - $dbAddress->city - $dbAddress->uf - CEP: $dbAddress->zipcode",
                'registeredPhone'       => "($dbContact->ddd) $dbContact->telephone / R:$dbContact->telephone_extension",
                'registeredContact'     => $dbContact->contact_name,
                'registeredSector'      => $dbContact->sector,
                'registeredEmail'       => $dbContact->email,
                'protocolList'          => $protocolList,
            ];
        } else{
            $dataResponse = [
                'company_fancy_name'    => '',
                'type'                  => '',
                'providerAddress'       => '',
                'registeredPhone'       => '',
                'registeredContact'     => '',
                'registeredSector'      => '',
                'registeredEmail'       => '',
                'protocolList'          => null,
            ];
        }

        $json['dataResponse'] = $dataResponse;
        return response()->json($json);

}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     * Método responsável por exibir um formulário.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userLog = Auth::user();
        $userLog = [
            'first_name' => $userLog->first_name,
            'last_name'  => $userLog->last_name
        ];

        $error_details = DB::select('SELECT * FROM error_details');
        $solution_details = DB::select('SELECT * FROM solution_details');
        $serviceProviders = DB::select('SELECT * FROM service_providers');
        $users = DB::table('users')
            ->select('users.id', 'users.registration', 'users.first_name', 'departments.description')
                ->join('departments', 'users.department_fk', '=', 'departments.id')
                ->orderBy('users.first_name')
                ->get();
        foreach ($users as $key ) {
            $userDepartments[] = [
                'userDepartments' => ($key->first_name . ' / ' . $key->description),
                'userId' => $key->id,
                'userRegistration' => $key->registration
            ];
        }

        return view('authenticated.attendance.create', [
            'error_details'=> $error_details,
            'solution_details'=> $solution_details,
            'forwardTo'=> $userDepartments,
            'serviceProviders' => $serviceProviders,
            'store' => '',
            'message' => '',
            'userLog' => $userLog
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // obter o id do usuário conectado
        $user = Auth::user();
        $user = $user->id;

        // buscar id pelo cpfCnpj
        $serviceProviders = DB::table('service_providers')
        ->select('id')
        ->where('cpf_cnpj', '=', $request->cpfCnpj)
        ->get()
        ->first();
        $serviceProvider = $serviceProviders->id;
        //dd($serviceProvider);

        //Se o campo contact estiver vazio, significa que o contato é o mesmo e não mudou. Senão teremos que inserir um novo contato.
        if ($request->contact == null) {
            $contacts = DB::table('contacts')
            ->select('contacts.id')
                ->join('service_provider_contacts','contacts.id','=','service_provider_contacts.contact')
                ->join('service_providers','service_provider_contacts.service_provider','=','service_providers.id')
                ->where('service_providers.id', '=', $serviceProvider)
                ->get()
                ->first();
                $contact = $contacts->id;
                //dd($contacts, $contact);
        } else {
            $db = [
                $request->contact,
                $request->ddd,
                $request->firstPhone,
                $request->firstPhoneExtension,
                $request->firstEmail,
                $request->sector,
                date('Y-m-d H:i:s'),
            ];
            DB::insert('insert into contacts (contact_name, ddd, telephone, telephone_extension, email, sector, created_at) values (?, ?, ?, ?, ?, ?, ?)', $db);
            $contacts = DB::table('contacts')
                            ->select('id')
                            ->where('contact_name', '=', $db[0] , 'and')
                            ->where('ddd', '=', $db[1] , 'and')
                            ->where('telephone', '=', $db[2] , 'and')
                            ->where('telephone_extension', '=', $db[3] , 'and')
                            ->where('email', '=', $db[4] , 'and')
                            ->where('sector', '=', $db[5] , 'and')
                            ->where('created_at', '=', $db[6])
                            ->get()
                            ->first();
            $contact = $contacts->id;
            //dd($contacts, $contact);
        }


         // Dados que serão inseridos nas tabelas attendances e user_attendances
         if (($request->solutionDetails == 'Escolher...') && ($request->forwardTo == 'Escolher...')) {
            $action = 1;
            $forwardTo = NULL;
        } else if (($request->solutionDetails <> 'Escolher...')){
            $action = 3;
            $forwardTo = NULL;
        }else {
            $action = 2;
            $forwardTo = $request->forwardTo;
        }

        if ($request->solutionDetails == 'Escolher...') {
            $solution = NULL;
        } else {
            $solution = $request->solutionDetails;
        }
        $created_at = date('Y-m-d H:i:s');
        $insertAttendance = [
            $serviceProvider,
            $contact,
            $action,
            $created_at
        ];
        //dd($insertAttendance);
        DB::insert('insert into attendances (service_provider_fk, contact_fk, action, created_at) values ( ?, ?, ?, ?)', $insertAttendance);
        $attendances = DB::table('attendances')
            ->select('id')
            ->where('service_provider_fk', '=', $insertAttendance[0] , 'and')
            ->where('contact_fk', '=', $insertAttendance[1] , 'and')
            ->where('action', '=', $insertAttendance[2], 'and')
            ->where('created_at', '=', $insertAttendance[3])
            ->get()
            ->first();
        //dd($insertAttendance[0],$insertAttendance[1], $insertAttendance[2], $insertAttendance[3], $attendances);
        $attendance = $attendances->id;

        $insertUserAttendance = [
            date('Y-m-d H:i:s'),
            $user,
            $attendance,
            $forwardTo,
            $request->note,
            $request->errorDetails,
            $solution
        ];
        DB::insert('insert into user_attendances (created_at, user, attendance,forward_to, note, error_detail_fk, solution_detail_fk) values (?, ?, ?, ?, ?, ?, ?)', $insertUserAttendance);

        // Vetor com os dados que serão inseridos na tabela service_provider_contacts
        $insertServiceProviderContact = [
            date('Y-m-d H:i:s'),
            $serviceProvider,
            $contact,
        ];
        DB::insert('insert into service_provider_contacts (created_at, service_provider, contact) values (?, ?, ?)', $insertServiceProviderContact);

        //Grava o Protocolo
        $protocol = date('YmdHis').rand(0, 9);
        $dbProtocol = [
            $protocol,
            date('Y-m-d H:i:s'),
            $serviceProvider,
            $attendance
        ];
        DB::insert('insert into protocols (protocol, created_at, service_provider_fk, attendance_fk) values ( ?, ?, ?, ?)', $dbProtocol);

        if ($solution == null) {
            return redirect()->route('authenticated.attendance.edit', [$attendance]);
        } else {
            return redirect()->route('authenticated.attendance.show', [$attendance]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userLog = Auth::user();
        $userLog = [
            'first_name' => $userLog->first_name,
            'last_name'  => $userLog->last_name
        ];

        $error_details = DB::select('SELECT * FROM error_details');
        $solution_details = DB::select('SELECT * FROM solution_details');
        $users = DB::table('users')
            ->select('users.id', 'users.registration', 'users.first_name', 'departments.description')
                ->join('departments', 'users.department_fk', '=', 'departments.id')
                ->orderBy('users.first_name')
                ->get();
        foreach ($users as $key ) {
            $userDepartments[] = [
                'userDepartments' => ($key->first_name . ' / ' . $key->description),
                'userId' => $key->id,
                'userRegistration' => $key->registration
            ];
        }

        $attendance = DB::table('attendances')
            ->select('*')
            ->where('id', '=', $id)
            ->get()
            ->first();

        $user_attendance = DB::table('user_attendances')
            ->select('*')
            ->where('attendance', '=', $attendance->id)
            ->get()
            ->first();

        $contact = DB::table('contacts')
            ->select('*')
            ->where('id', '=', $attendance->contact_fk)
            ->get()
            ->first();

        $service_provider = DB::table('service_providers')
            ->select('*')
            ->where('id', '=', $attendance->service_provider_fk)
            ->get()
            ->first();

        $protocol = DB::table('protocols')
        ->select('*')
        ->where('attendance_fk', '=', $attendance->id)
        ->get()
        ->first();

        //Busca o tipo de prestador
        $type = DB::table('service_provider_types')
        ->select('description')
        ->where('id', '=', $service_provider->type_fk)
        ->get()
        ->first();
        $type = $type->description;

        // Dados do prestador
        $dbCompany = DB::table('service_providers')
        ->select('service_providers.id', 'service_providers.company_fancy_name', 'service_provider_types.description')
            ->join('service_provider_types', 'service_providers.type_fk', '=', 'service_provider_types.id')
            ->where('service_providers.cpf_cnpj', '=', $service_provider->cpf_cnpj)
            ->get()
            ->first();

        if(!empty($dbCompany)){
            //Busca na tabela de endereços a UF, logradouro, Nº, compl., bairro, cidade e estado pesquisando pelo ID encontrado em $dbCompany
            $dbAddress = DB::table('addresses')
            ->select('addresses.address', 'addresses.number', 'addresses.complement', 'addresses.neighborhood', 'addresses.city', 'addresses.uf', 'addresses.zipcode')
                ->join('service_provider_addresses','addresses.id','=','service_provider_addresses.address')
                ->join('service_providers','service_provider_addresses.service_provider','=','service_providers.id')
                ->where('service_providers.id', '=', $dbCompany->id, 'and')
                ->where('addresses.main_address', '=', '1')
                ->get()
                ->first();

            $dbContact = DB::table('contacts')
            ->select('contacts.contact_name', 'contacts.ddd', 'contacts.telephone', 'contacts.telephone_extension', 'contacts.email', 'contacts.sector')
                ->join('service_provider_contacts','contacts.id','=','service_provider_contacts.contact')
                ->join('service_providers','service_provider_contacts.service_provider','=','service_providers.id')
                ->where('service_providers.id', '=', $dbCompany->id)
                ->get()
                ->first();


            $dbProtocols = DB::table('protocols')
            ->select('protocols.protocol', 'attendance_fk')
                ->join('service_providers', 'protocols.service_provider_fk', '=', 'service_providers.id')
                ->where('service_providers.id', '=', $dbCompany->id)
                ->orderBy('protocols.created_at', 'desc')
                ->get();
        }


        //Busca o erro informado
        $error = DB::table('error_details')
            ->select('description')
            ->where('id', '=', $user_attendance->error_detail_fk)
            ->get()
            ->first();
            $error = $error->description;

        //Busca a solução informado
        if($user_attendance->solution_detail_fk == NULL){
            $solution = NULL;
        } else{
            $solution = DB::table('solution_details')
            ->select('description')
            ->where('id', '=', $user_attendance->solution_detail_fk)
            ->get()
            ->first();
            $solution = $solution->description;
        }


        //Busca o usuário encaminhado
        if($user_attendance->forward_to == null){
            $userDepartment = NULL;
        }else{
            $userF = DB::table('users')
            ->select('users.id', 'users.registration', 'users.first_name', 'departments.description')
                ->join('departments', 'users.department_fk', '=', 'departments.id')
                ->where('users.id', '=', $user_attendance->forward_to)
                ->get();
            if(!empty($userF)){
                foreach ($userF as $key ) {
                    $userDepartment = ($key->first_name . ' / ' . $key->description);
                }
            } else{
                $userDepartment = NULL;
            }
        }

        $query = [
            'cpf_cnpj' => $service_provider->cpf_cnpj,
            'company_fancy_name' => $service_provider->company_fancy_name,
            'protocol' => $protocol->protocol,
            'type' => $type,
            'address' => "$dbAddress->address, $dbAddress->number - $dbAddress->complement / $dbAddress->neighborhood - $dbAddress->city - $dbAddress->uf - CEP: $dbAddress->zipcode",
            'register_contact' => $dbContact->contact_name,
            'register_sector' => $dbContact->sector,
            'register_telephone' => "($dbContact->ddd) $dbContact->telephone / R:$dbContact->telephone_extension",
            'register_email' => $dbContact->email,
            'contact' => $contact->contact_name,
            'sector' => $contact->sector,
            'ddd' => $contact->ddd,
            'telephone' => $contact->telephone,
            'telefone_extension' => $contact->telephone_extension,
            'email' => $contact->email,
            'error_detail' => $error,
            'solution_detail' => $solution,
            'forward_to' => $userDepartment,
            'note' => $user_attendance->note,
        ];

        return view('authenticated.attendance.show', [
            'query' => $query,
            'protocols' => $dbProtocols,
            'error_details'=> $error_details,
            'solution_details'=> $solution_details,
            'forwardTo'=> $userDepartments,
            'userLog' => $userLog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userLog = Auth::user();
        $userLog = [
            'first_name' => $userLog->first_name,
            'last_name'  => $userLog->last_name
        ];

        $error_details = DB::select('SELECT * FROM error_details');
        $solution_details = DB::select('SELECT * FROM solution_details');
        $users = DB::table('users')
            ->select('users.id', 'users.registration', 'users.first_name', 'departments.description')
                ->join('departments', 'users.department_fk', '=', 'departments.id')
                ->orderBy('users.first_name')
                ->get();
        foreach ($users as $key ) {
            $userDepartments[] = [
                'userDepartments' => ($key->first_name . ' / ' . $key->description),
                'userId' => $key->id,
                'userRegistration' => $key->registration
            ];
        }

        $attendance = DB::table('attendances')
            ->select('*')
            ->where('id', '=', $id)
            ->get()
            ->first();

        $user_attendance = DB::table('user_attendances')
            ->select('*')
            ->where('attendance', '=', $attendance->id)
            ->get()
            ->first();

        $contact = DB::table('contacts')
            ->select('*')
            ->where('id', '=', $attendance->contact_fk)
            ->get()
            ->first();

        $service_provider = DB::table('service_providers')
            ->select('*')
            ->where('id', '=', $attendance->service_provider_fk)
            ->get()
            ->first();

        $protocol = DB::table('protocols')
        ->select('*')
        ->where('attendance_fk', '=', $attendance->id)
        ->get()
        ->first();

        //Busca o tipo de prestador
        $type = DB::table('service_provider_types')
        ->select('description')
        ->where('id', '=', $service_provider->type_fk)
        ->get()
        ->first();
        $type = $type->description;

        // Dados do prestador
        $dbCompany = DB::table('service_providers')
        ->select('service_providers.id', 'service_providers.company_fancy_name', 'service_provider_types.description')
            ->join('service_provider_types', 'service_providers.type_fk', '=', 'service_provider_types.id')
            ->where('service_providers.cpf_cnpj', '=', $service_provider->cpf_cnpj)
            ->get()
            ->first();

        if(!empty($dbCompany)){
            //Busca na tabela de endereços a UF, logradouro, Nº, compl., bairro, cidade e estado pesquisando pelo ID encontrado em $dbCompany
            $dbAddress = DB::table('addresses')
            ->select('addresses.address', 'addresses.number', 'addresses.complement', 'addresses.neighborhood', 'addresses.city', 'addresses.uf', 'addresses.zipcode')
                ->join('service_provider_addresses','addresses.id','=','service_provider_addresses.address')
                ->join('service_providers','service_provider_addresses.service_provider','=','service_providers.id')
                ->where('service_providers.id', '=', $dbCompany->id, 'and')
                ->where('addresses.main_address', '=', '1')
                ->get()
                ->first();

            $dbContact = DB::table('contacts')
            ->select('contacts.contact_name', 'contacts.ddd', 'contacts.telephone', 'contacts.telephone_extension', 'contacts.email', 'contacts.sector')
                ->join('service_provider_contacts','contacts.id','=','service_provider_contacts.contact')
                ->join('service_providers','service_provider_contacts.service_provider','=','service_providers.id')
                ->where('service_providers.id', '=', $dbCompany->id)
                ->get()
                ->first();


            $dbProtocols = DB::table('protocols')
            ->select('protocols.protocol', 'attendance_fk')
                ->join('service_providers', 'protocols.service_provider_fk', '=', 'service_providers.id')
                ->where('service_providers.id', '=', $dbCompany->id)
                ->orderBy('protocols.created_at', 'desc')
                ->get();
        }


        //Busca o erro informado
        $error = DB::table('error_details')
            ->select('id', 'description')
            ->where('id', '=', $user_attendance->error_detail_fk)
            ->get()
            ->first();
            $errorDescription = $error->description;
            $errorId = $error->id;

        //Busca a solução informado
        if($user_attendance->solution_detail_fk == NULL){
            $solutionDescription = NULL;
            $solutionId = NULL;
        } else{
            $solution = DB::table('solution_details')
            ->select('id', 'description')
            ->where('id', '=', $user_attendance->solution_detail_fk)
            ->get()
            ->first();
            $solutionDescription = $solution->description;
            $solutionId = $solution->id;
        }


        //Busca o usuário encaminhado
        if($user_attendance->forward_to == null){
            $userDepartmentDescription = NULL;
            $userDepartmentId = NULL;
        }else{
            $userF = DB::table('users')
            ->select('users.id', 'users.registration', 'users.first_name', 'departments.description')
                ->join('departments', 'users.department_fk', '=', 'departments.id')
                ->where('users.id', '=', $user_attendance->forward_to)
                ->get();
            if(!empty($userF)){
                foreach ($userF as $key ) {
                    $userDepartmentDescription = ($key->first_name . ' / ' . $key->description);
                    $userDepartmentId = $key->id;
                }
            } else{
                $userDepartmentDescription = NULL;
                $userDepartmentId = NULL;
            }
        }

        $query = [
            'cpf_cnpj' => $service_provider->cpf_cnpj,
            'company_fancy_name' => $service_provider->company_fancy_name,
            'protocol' => $protocol->protocol,
            'type' => $type,
            'address' => "$dbAddress->address, $dbAddress->number - $dbAddress->complement / $dbAddress->neighborhood - $dbAddress->city - $dbAddress->uf - CEP: $dbAddress->zipcode",
            'register_contact' => $dbContact->contact_name,
            'register_sector' => $dbContact->sector,
            'register_telephone' => "($dbContact->ddd) $dbContact->telephone / R:$dbContact->telephone_extension",
            'register_email' => $dbContact->email,
            'contact' => $contact->contact_name,
            'sector' => $contact->sector,
            'ddd' => $contact->ddd,
            'telephone' => $contact->telephone,
            'telefone_extension' => $contact->telephone_extension,
            'email' => $contact->email,
            'error_detail' => $errorDescription,
            'error_id' => $errorId,
            'solution_detail' => $solutionDescription,
            'solution_id' => $solutionId,
            'forward_to' => $userDepartmentDescription,
            'forward_id' => $userDepartmentId,
            'note' => $user_attendance->note,
        ];

        return view('authenticated.attendance.edit', [
            'attendanceId' => $attendance->id,
            'query' => $query,
            'protocols' => $dbProtocols,
            'error_details'=> $error_details,
            'solution_details'=> $solution_details,
            'forwardTo'=> $userDepartments,
            'userLog' => $userLog,
            'store' => null,
            'message' => 'Atendimento gravado com sucesso!',
        ]);

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
        $user = Auth::user();

        $originAttendance = DB::table('protocols')->distinct()
        ->select('attendances.id','error_details.description','user_attendances.solution_detail_fk', 'user_attendances.forward_to', 'attendances.action', 'user_attendances.created_at')
            ->join('service_providers','service_providers.id','=','protocols.service_provider_fk', 'left')
            ->join('attendances','attendances.id','=','protocols.attendance_fk')
            ->join('user_attendances','attendances.id','=','user_attendances.attendance')
            ->join('contacts','contacts.id','=','attendances.contact_fk')
            ->join('error_details', 'error_details.id','=','user_attendances.error_detail_fk')
            ->where('attendances.id','=', $id)
            ->get()
            ->first();
            //Busca o usuário encaminhado
            if($originAttendance->forward_to == null){
                $userDepartment = NULL;
            }else{
                $userF = DB::table('users')
                ->select('users.id', 'users.registration', 'users.first_name', 'departments.description')
                    ->join('departments', 'users.department_fk', '=', 'departments.id')
                    ->where('users.id', '=', $originAttendance->forward_to)
                    ->get();
                if(!empty($userF)){
                    foreach ($userF as $key ) {
                        $userDepartment = ($key->first_name . ' / ' . $key->description);
                    }
                } else{
                    $userDepartment = NULL;
                }
            }

            if ($originAttendance->description == $request->errorDetails  &&  $request->solutionDetails == "Escolher..." && $request->forwardTo == $userDepartment) {
                // Se não houverem alterações nos campos errorDetails, solutionDetails, forwardTo então redireciona para a própria página com mensagem de erro
                return redirect()->route('authenticated.attendance.edit', [$id]);

            } else {
                if ($request->solutionDetails <> null) {
                    //Se a solução for diferente de null

                    DB::update('update user_attendances set updated_at = ?, user = ?, note = ?, error_detail_fk = ?, solution_detail_fk = ?  where attendance = ?', [date('Y-m-d H:i:s'), $user->id, $request->note, $request->errorDetails, $request->solutionDetails ,$originAttendance->id]);
                    DB::update('update attendances set action = ?, updated_at = ? where id = ?', ['3', date('Y-m-d H:i:s') ,$originAttendance->id]);
                    return redirect()->route('authenticated.attendance.show', [$id]);

                } else if($request->forwardTo <> $userDepartment || $request->errorDetails <> "Escolher...") {
                    //Se o usuário encaminhado for diferente do anterior OU o erro for diferente de "Escolher..."
                    //gravar errorDetails, forwardTo, action = 2, note

                    DB::update('update user_attendances set updated_at = ?, user = ?, forward_to = ?, note = ?, error_detail_fk = ? where attendance = ?', [date('Y-m-d H:i:s'), $user->id, $request->forwardTo, $request->note, $request->errorDetails, $originAttendance->id]);
                    if ($request->forwardTo == null) {
                        DB::update('update attendances set action = ?, updated_at = ? where id = ?', ['1', date('Y-m-d H:i:s') ,$originAttendance->id]);
                    } else {
                        DB::update('update attendances set action = ?, updated_at = ? where id = ?', ['2', date('Y-m-d H:i:s') ,$originAttendance->id]);

                    }

                    return redirect()->route('authenticated.attendance.edit', [$id]);

                } else {
                    //Se mudar só o erro então não gravar nada
                    //redireciona para a própria página
                    return redirect()->route('authenticated.attendance.edit', [$id]);
                }
            }

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
