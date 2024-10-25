<?php

namespace App\Http\Controllers;


use App\Models\Heroi;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeroiController extends Controller
{
    public function exibir()
    {
        $customers = Heroi::all();
        return response()->json([
            'status' => true,
            'message' => 'Heroi retornado com sucesso',
            'data' => $customers
        ], 200);
    }
    public function criar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'universo'=>'required|string|max:100',
            'pontos_poder' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'erro na validação',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Heroi::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Heroi criado com sucesso',
            'data' => $customer
        ], 201);
    }

    public function BuscarPorId($id)
    {
        $customer = Heroi::findOrFail($id);
        return JsonResponse::success("Heroi achado com sucesso",  $customer);
        
    }  

    public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'universo'=>'required|string|max:100',
            'pontos_poder' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'erro na validação',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Heroi::findOrFail($id);
        $customer->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Heroi editado com sucesso',
            'data' => $customer
        ], 200);
    }

    public function excluir($id)
    {
        $customer = Heroi::findOrFail($id);
        $customer->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Heroi deletado com sucesso'
        ], 204);
    }
}