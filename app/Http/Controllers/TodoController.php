<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodo;
use Exception;
use Illuminate\Database\QueryException;
use App\Todo;
use Illuminate\Support\Facades\DB;

/**
 * En esta clase deben implementar los metodos vacios de acuerdo a lo
 * previamente estudiado acerca de RESTFul. Recuerda que DEBEN validar los datos
 * de entrada y de regresar lo que les pide el método correctamente.
 *
 * Class TodoController
 * @package App\Http\Controllers
 */
class TodoController extends Controller
{
    /**
     * Este método del controlador regresa el listado del todos de la app
     * en un response del tipo json ordenados desde el más antiguo al más nuevo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $list = Todo::select('id', 'text', 'done')->orderBy('created_at', 'asc')->get();
        return response()->json(['result' => $list]);
    }

    /**
     * Este método del controlador debe crear un nuevo registro todo
     * y al final regresa el registro creado en un response del tipo
     * json.
     *
     * @param StoreTodo $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTodo $request)
    {
        DB::beginTransaction();
        try {
            $todo = new Todo;
            $todo->text = $request->text;
            $todo->done = $request->done;
            $todo->save();
            DB::commit();
            return response()->json(['result' => $todo]);

        } catch (QueryException $ex) {
            // Errores de SQL
            DB::rollBack();
            return response()->json(['result' => $ex->getMessage()], 500);
        } catch (Exception $ex) {
            // Otros errores
            DB::rollBack();
            return response()->json(['result' => $ex->getMessage()], 500);
        }
        //return response()->json(['result' => 'error'], 500);

    }

    /**
     * Modifica el item todo con el $id correspondiente
     * y regresa el mismo item modificado.
     *
     * @param integer $id
     * @param StoreTodo $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, StoreTodo $request)
    {
        DB::beginTransaction();

        try {
            $todo = Todo::find($id);
            $todo->text = $request->text;
            $todo->done = $request->done;
            $todo->save();
            DB::commit();

            return response()->json(['result' => $todo]);
        } catch (QueryException $ex) {
            // Errores de SQL
            DB::rollBack();
            return response()->json(['result' => $ex->getMessage()], 500);
        } catch (Exception $ex) {
            // Otros errores
            DB::rollBack();
            return response()->json(['result' => $ex->getMessage()], 500);
        }

    }

    /**
     * Elimina el registro y devuelve un response 200 en caso de exito o un 400
     * en caso de fallo pero igual en tipo json.
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $todo = Todo::find($id);
            $todo->delete();
            return response()->json(['result' => 'success'], 200);

        } catch (Exception $ex) {
            // Otros errores
            return response()->json(['result' => $ex->getMessage()], 400);
        }
    }
}
