<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Collection;
use Illuminate\Support\Facades\DB;
class productoController extends Controller
{
    public function Guardar(Request $request) : JsonResponse{
        try{
            $data = DB::transaction(function ($query) use ($request){
                return Producto::create([
                    "nombreprod" => $request->nombreprod,
                    "cantidad" => $request->cantidad,
                    "codigoprod" => $request->codigoprod,
                    "precio" => $request->precio,
                ]);
            });
            return response()->json(["status" => 200, "data" => $data]);
        }catch(Exception $e){
            return response()->json(["status" => 400, "message" => $e]);
        }
    }
    public function Actualizar(Request $request, $id) : JsonResponse{
        try{
            $data = DB::transaction(function($query) use($request, $id){
                print_r($request->cantidad);
                return Producto::findOrFail($id)
                ->update(
                    [
                        "nombreprod" => $request->nombreprod,
                        "cantidad" => $request->cantidad,
                        "codigoprod" => $request->codigoprod,
                        "precio" => $request->precio,
                    ]);
            });
            return response()->json(["status" => 200, "data" => $data]);
        }catch(Exception $e){
            return response()->json(["status" => 400, "message" => $e]);
        }
    }
    public function Obtener() : JsonResponse{
        try{
            $data = DB::transaction(function ($query) {
                return Producto::select(DB::raw("cantidad"))
                ->whereRaw("cantidad % 2 = 0")
                ->orWhere("nombreprod", "LIKE", "%A%")
                ->get();
            });
            return response()->json(["status" => 200, "data" => $data]);
        }catch(Exception $e){
            return response()->json(["status" => 400, "message" => $e]);
        }
    }
    public function ObtenerDatosRelacionados() : JsonResponse{
        try{
            $data = DB::transaction(function ($query) {
                return Producto::select("*")
                    ->join("factura", "factura.idprod", "=", "productos.id")
                    ->get();
                });
            return response()->json(["status" => 200,"data" => $data]);
        }catch(Exception $e){
            return response()->json(["status" => 400, "message" => $e]);
        }

    }
}
