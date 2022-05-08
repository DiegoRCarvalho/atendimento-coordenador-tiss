<?php

namespace act\Http\Controllers\Authenticated;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use act\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = DB::table('users')
            ->select('users.id', 'users.registration', 'users.first_name', 'users.last_name', 'users.level', 'departments.description')
                ->join('departments','users.department_fk','=','departments.id')
                ->get();

        $user = Auth::user();
        $userLog = [
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name
        ];

        $department = DB::table('users')
        ->select('departments.id', 'departments.description')
            ->join('departments','users.department_fk','=','departments.id')
            ->where('users.id', '=', $user->id, 'and')
            ->get()
            ->first();

        $loggedInUser = [
            'id'            =>$user->id,
            'registration'  =>$user->registration,
            'first_name'    =>$user->first_name,
            'last_name'     =>$user->last_name,
            'level'         =>$user->level,
            'description'   =>$department->description
        ];
        //  dd($users);
        if ($loggedInUser['level'] == 1) {
            return view('authenticated.profile/profileAdm', [
                'users'         => $users,
                'loggedInUser'  => $loggedInUser,
                'userLog' => $userLog
            ]);
        } else {
            return view('authenticated.profile/profile', [
                'users'         => $users,
                'loggedInUser'  => $loggedInUser,
                'userLog' => $userLog
            ]);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = DB::select('SELECT * FROM departments');
        $userLog = Auth::user();
        $userLog = [
            'first_name' => $userLog->first_name,
            'last_name'  => $userLog->last_name
        ];

        return view('authenticated.profile/create',[
            'departments'=> $departments,
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
        $department = DB::table('departments')
            ->select('departments.id')
                ->where('departments.description','=',$request->department)
                ->get()->first();
        if(!empty($department)){
            foreach ($department as $departmentId) {
                $departmentId = $department->id;
            }
        }

        if ($request->level == 'Administrador') {
            $level = 1;
        } else {
            $level = 2;
        }

        if (($request->password == $request->confirmPassword)
            and (!empty($request->password))
            and (!empty($request->registration))
            and (!empty($request->firstName))
            and (!empty($request->lastName))
            and (!empty($request->department))
            and (!empty($request->level))
            ){
            $user = [
                $request->registration,
                $request->firstName,
                $request->lastName,
                bcrypt($request->password),
                $level,
                $departmentId
            ];

            // dd($user);
            DB::insert('insert into users (registration, first_name, last_name, password, level, department_fk) values (?, ?, ?, ?, ?, ?)', $user);
            return redirect()->route('authenticated.profile.index');

        } else {
            return redirect()->route('authenticated.profile.index');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $register = DB::table('users')
            ->select('users.id', 'users.registration', 'users.first_name', 'users.last_name', 'users.level' ,'departments.description')
                ->join('departments','departments.id','=','users.department_fk')
                ->where('users.id','=', $id)
                ->get()
                ->first();

        $departments = DB::select('SELECT * FROM departments');
        $user = Auth::user();
        $userLog = [
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name
        ];


        if (!empty($register)) {
            if ($user->level == 1) {
                return view('authenticated.profile/editAdm', [
                    'register' => $register,
                    'departments'=> $departments,
                    'userLog' => $userLog
                ]);
            } else {
                return view('authenticated.profile/edit', [
                    'register' => $register,
                    'userLog' => $userLog
                ]);
            }


        } else {
            return redirect()->route('authenticated.profile.index');

        }
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
        $loggedInUser = Auth::user();

        if ($request->level == 'Administrador') {
            $userLevelEdit = 1;
        } else {
            $userLevelEdit = 2;
        }

        if ($loggedInUser['level'] == 1){
            $department = DB::table('departments')
            ->select('departments.id')
                ->where('departments.description','=',$request->department)
                ->get()->first();
            if(!empty($department)){
                foreach ($department as $departmentId) {
                    $departmentId = $department->id;
                }
                $dbAdm = [
                    $request->registration,
                    $request->firstName,
                    $request->lastName,
                    bcrypt($request->inputNewPassword),
                    $userLevelEdit,
                    $departmentId,
                    $id
                ];
            }
            DB::update("UPDATE users SET registration=?, first_name=?, last_name=?, password=?, level=?, department_fk=? WHERE id=?", $dbAdm);
            return redirect()->route('authenticated.profile.index');
        } else {
            $dbUser = [
                bcrypt($request->inputNewPassword),
                $id
            ];
            DB::update("UPDATE users SET password=? WHERE id=?", $dbUser);
            return redirect()->route('authenticated.profile.index');
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
        $property = DB::select("SELECT * FROM users WHERE id=?", [$id]);
        if(!empty($property)) {
            DB::delete("DELETE FROM users WHERE id=?", [$id]);
        }
        return redirect()->route('authenticated.profile.index');
    }
}
