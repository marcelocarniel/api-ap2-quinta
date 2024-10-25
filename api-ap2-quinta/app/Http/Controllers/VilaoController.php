<?php

namespace App\Http\Controllers;


use App\Models\Vilao;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VilaoController extends Controller
{
    public function exibir()
    {
        $customers = Vilao::all();
        return response()->json([
            'status' => true,
            'message' => 'Vilao retornado com sucesso',
            'data' => $customers
        ], 200);
    }
    
    public function criar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'universo'=>'required|string|max:100',
            'pontosPoder' => 'required|int'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'erro na validação',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Vilao::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Vilão criado com sucesso',
            'data' => $customer
        ], 201);
    }

    public function BuscarPorId($id)
    {
        $customer = Vilao::findOrFail($id);
        return JsonResponse::success("Filme achado com sucesso",  $customer);
        
    }  

    public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'universo'=>'required|string|max:100',
            'pontosPoder' => 'required|int'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'erro na validação',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Vilao::findOrFail($id);
        $customer->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Vilão editado com sucesso',
            'data' => $customer
        ], 200);
    }

    public function excluir($id)
    {
        $customer = Vilao::findOrFail($id);
        $customer->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Vilão deletado com sucesso'
        ], 204);
    }

    
}    