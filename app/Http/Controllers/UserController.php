<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use App\Models\Periodo;
use App\Models\Persona;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
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
        $users = User::with('agente')->orderBy('id', 'desc')->get();

        // Identificar el el tipo de agente
        foreach ($users as $user) {
            if ($user->agente) {
                $user->tipo = 'Agente';
            } else {
                $user->tipo = 'Administrador';
            }
        }

        return view('user.index', compact('users'), ['titulo' => 'Gestión de Usuarios', 'currentPage' => 'Usuarios']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = new User();
        $roles = ['Administrador', 'Agente'];
        $respaldoUrl = false;
        return view('user.create', compact('user', 'roles', 'respaldoUrl'), ['titulo' => 'Gestión de Usuarios', 'currentPage' => 'Usuarios']);
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

            if ($params->rol == 'Agente') {
                $user = new User();
                $user->rol = $params->rol;
                $user->agente_id = $params->opcion_id;
                $user->email = $params->email;
                $user->password = bcrypt($params->password);
                $user->save();

                // Asignar rol al usuario
                $user->assignRole($request->get('rol'));

                // Si es agente crear su registro automatico de periodo
                $periodo = Periodo::create([
                    'year' => now()->year,
                    'usuario_id' => $user->id,
                ]);
            }
            if ($params->rol == 'Administrador') {
                $user = new User();
                $user->rol = $params->rol;
                $user->persona_id = $params->opcion_id;
                $user->email = $params->email;
                $user->password = bcrypt($params->password);
                $user->save();

                // Asignar rol al usuario
                $user->assignRole($request->get('rol'));
            }

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

        return view('user.show', compact('user'), ['titulo' => 'Gestión de Usuarios', 'currentPage' => 'Usuarios']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = ['Administrador', 'Agente'];
        $estados = [
            0 => 'Inactivo',
            1 => 'Activo',
        ]; // Asociamos un valor numérico con su significado para mostrarlo en el formulario.

        // Verificar si el archivo existe y pasar a la vista
        $respaldoUrl = true;
        return view('user.edit', compact('user', 'roles', 'respaldoUrl', 'estados'), ['titulo' => 'Gestión de Usuarios', 'currentPage' => 'Usuarios']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {

        $usuario = User::findOrFail($user->id);

        // dd($usuario);

        $usuario->update([
            'estado' => $request->estado,
        ]);

        return Redirect::route('users.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            // Buscar el agente
            $user = Agente::findOrFail($id);

            // Cambiar el estado a 0 (inactivo)
            $user->estado = 0;
            $user->save();

            // Redirigir con un mensaje de éxito
            return Redirect::route('users.index')
                ->with('success', 'El estado del usuario se cambió a inactivo exitosamente.');
        } catch (\Exception $e) {
            // Manejar cualquier error
            return Redirect::back()->with('error', 'Hubo un error al intentar cambiar el estado: ' . $e->getMessage());
        }
    }

    function perfilusuario($id): View
    {
        $user = User::find($id);

        return view('user.perfil', compact('user'), ['titulo' => 'Perfil de Usuario', 'currentPage' => 'Perfil de usuario']);
    }


    function viewPassword()
    {
        // Encuentra el funcionario por su ID
        $userAutencated = Auth::user(); // Accede al usuario autenticado
        $idUsuario = $userAutencated->id;
        return view('user.viewPassword', compact('idUsuario'), ['titulo' => 'Configuración de Usuario', 'currentPage' => 'Configuración']);
    }

    function changesPassword(Request $request)
    {

        // 1.-VALIDAR DATOS
        $validate = Validator::make($request->all(), [
            'new_password' => 'required|string|min:6',
        ]);

        // 2.-Recoger los usuarios por post
        $params = (object) $request->all(); // Devuelve un obejto

        // 3.- SI LA VALIDACION FUE CORRECTA
        // Comprobar si los datos son validos
        if ($validate->fails()) { // en caso si los datos fallan la validacion
            // La validacion ha fallado
            $data = array(
                'status' => 'validacion',
                'code' => 200,
                'message' => 'Los datos enviados no son correctos.',
                'errors' => $validate->errors()
            );
            return response()->json($data, $data['code']);
        } else {
            $user = Auth::user();
            $usuario = User::find($user->id);

            // Verificar si la contraseña actual es válida
            if (!Hash::check($request->current_password, $user->password)) {
                $data = [
                    'code' => 200,
                    'status' => 'error',
                    'message' => 'Datos no validos',
                    'errors' => 'Sin errores'
                ];
                return response()->json($data, $data['code']);
            }

            // Actualizar la contraseña en la base de datos
            $usuario->password = Hash::make($request->new_password);
            $usuario->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'La contraseña de cambio correctamente',
                'errors' => 'Sin errores'
            ];

            return response()->json($data, $data['code']);
        }
    }
}
