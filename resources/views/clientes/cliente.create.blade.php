@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cadastro de Cliente</h1>

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" placeholder="Digite o CEP">
            <br>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" placeholder="Endereço">
            <br>

            <!-- Outros campos de cliente -->
            
            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <script>
        // Seu código de autocomplete aqui
    </script>
@endsection
