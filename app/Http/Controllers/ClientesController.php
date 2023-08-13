<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Rules\CpfCnpjValidation;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;

class ClientesController extends Controller
{

    public function create()
    {
        
        return view('cliente.create');
    }

    /**
     * @OA\Post(
     *   path="/clientes",
     *   summary="Inserir um novo cliente",
     *   @OA\Response(response="201", description="Cliente criado com sucesso"),
     *   @OA\Response(response="422", description="Erro de validação dos campos")
     * )
     */

    public function store(Request $request)
    {
        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'O :attribute deve ser um endereço de e-mail válido.',
            // Outras mensagens de validação aqui
            // ...
        ];

        try {
            $validatedData = $request->validate([
                'nome' => 'required',
                'data_nascimento' => 'required|date',
                'tipo_pessoa' => 'required|in:Física,Jurídica',
                'cpf_cnpj' => ['required', new CpfCnpjValidation],
                'email' => 'required|email',
                'endereco' => 'required',
                'cep' => 'required|max:10', // Validar o campo CEP
                'cidade' => 'required',     // Validar o campo Cidade
                'latitude' => 'required',
                'longitude' => 'required',
            ], $messages);

            Cliente::create($validatedData);

            return response()->json(['message' => 'Cliente criado com sucesso.'], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * @OA\Get(
     *   path="/clientes",
     *   summary="Listar todos os clientes",
     *   @OA\Response(response="200", description="Lista de clientes"),
     * )
     */
    public function autocomplete(Request $request)
    {
        $cep = $request->input('cep');

        $response = Http::get("https://maps.googleapis.com/maps/api/place/autocomplete/json", [
            'input' => $cep,
            'types' => '(regions)',
            'key' => config('services.google_places.key'),
        ]);

        $predictions = $response->json()['predictions'] ?? [];

        if (!empty($predictions)) {
            $city = $predictions[0]['description'];
            return response()->json(['city' => $city]);
        }

        return response()->json(['city' => '']);
    }

    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }
}
