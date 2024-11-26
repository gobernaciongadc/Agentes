<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use App\Models\Persona;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $users = User::with('agente')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = new User();
        $roles = ['Administrador', 'Agente'];
        return view('user.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $params = (object) $request->all(); // Convierte a objeto
        $paramsArray = $request->all(); // Array asociativo

        // Validación
        $validator = Validator::make($request->all(), [
            'rol' => 'required',
            'opcion_id' => 'required',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:8',
        ]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Iniciar transacción
        DB::beginTransaction();


        try {
            // Crear el usuario

            $user = new User();
            $user->rol = $params->rol;
            $user->agente_id = $params->opcion_id;
            $user->email = $params->email;
            $user->password = bcrypt($params->password);
            $user->save();


            // Operaciones adicionales según el rol
            if ($params->rol == 'Administrador') {

                $persona = Persona::find($paramsArray['opcion_id']);
                if (!$persona) {
                    throw new \Exception('Persona no encontrada');
                }
                $persona->estado_user = 0;
                $persona->save();
            }


            if ($params->rol == 'Agente') {


                $agente = Agente::find($paramsArray['opcion_id']);
                if (!$agente) {
                    throw new Exception('Agente no encontrado');
                }
                $agente->estado_user = 0;
                $agente->save();
            }

            // Confirmar transacción
            DB::commit();

            return Redirect::route('users.index')
                ->with('success', 'Usuario creado exitosamente.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Registro no encontrado.'])
                ->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = ['Administrador', 'Agente'];
        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        return Redirect::route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();

        return Redirect::route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
