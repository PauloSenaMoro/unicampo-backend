<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
 
        <!-- Styles -->
        <style>
         
        </style>
    </head>
    <body class="antialiased">
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Adicione os links para as bibliotecas de estilo aqui -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <div class="container mt-5">
        <h1>Cadastro de Cliente</h1>

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite o CEP" required>
            </div>

            <div class="form-group">
                <label for="latitude">Latitude:</label>
                <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" readonly required>
            </div>
            
            <div class="form-group">
                <label for="longitude">Longitude:</label>
                <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" readonly required>
            </div>
            
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" required>
            </div>

            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" required>
            </div>

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
            </div>

            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
            </div>

            <div class="form-group">
                <label for="tipo_pessoa">Tipo de Pessoa:</label>
                <select class="form-control" id="tipo_pessoa" name="tipo_pessoa" required>
                    <option value="Física">Física</option>
                    <option value="Jurídica">Jurídica</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cpf_cnpj">CPF/CNPJ:</label>
                <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="CPF ou CNPJ" required>
            </div>



            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <!-- Adicione os scripts das bibliotecas aqui -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Script da API do Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnXubp8E3-pZN4XRh1svLn1uSVePsRcrk&libraries=places&callback=initMap"></script>
  
    <script>

        
         const cepInput = document.getElementById('cep');
    const enderecoInput = document.getElementById('endereco');
    const cidadeInput = document.getElementById('cidade');
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');

    cepInput.addEventListener('blur', async function () {
        event.preventDefault();

        const cep = cepInput.value.replace(/\D/g, '');

        if (cep.length === 8) {
            const response = await fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${cep}&key=AIzaSyCnXubp8E3-pZN4XRh1svLn1uSVePsRcrk`);
            const data = await response.json();

            if (data.status === 'OK') {
                const endereco = data.results[0].formatted_address;
                const cidadeComponent = data.results[0].address_components.find(comp => comp.types.includes('administrative_area_level_2'));
                const location = data.results[0].geometry.location;

                enderecoInput.value = endereco;
                latitudeInput.value = location.lat;
                longitudeInput.value = location.lng;

                if (cidadeComponent) {
                    cidadeInput.value = cidadeComponent.long_name;
                }
            }
        }
    });
    const tipoPessoaSelect = document.getElementById('tipo_pessoa');
        const cpfCnpjInput = document.getElementById('cpf_cnpj');

        tipoPessoaSelect.addEventListener('change', function () {
            const selectedValue = tipoPessoaSelect.value;

            if (selectedValue === 'Física') {
                cpfCnpjInput.placeholder = 'CPF';
                cpfCnpjInput.pattern = '\\d{3}\\.\\d{3}\\.\\d{3}-\\d{2}';
            } else if (selectedValue === 'Jurídica') {
                cpfCnpjInput.placeholder = 'CNPJ';
                cpfCnpjInput.pattern = '\\d{2}\\.\\d{3}\\.\\d{3}/\\d{4}-\\d{2}';
            }

            cpfCnpjInput.value = '';
        });

        cpfCnpjInput.addEventListener('input', function () {
            const value = cpfCnpjInput.value.replace(/\D/g, '');
            const isCnpj = tipoPessoaSelect.value === 'Jurídica';

            if (isCnpj) {
                cpfCnpjInput.maxLength = 18; // Para a máscara completa de CNPJ
            } else {
                cpfCnpjInput.maxLength = 14; // Para a máscara completa de CPF
            }

            if (value.length <= 11) {
                cpfCnpjInput.value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            } else {
                cpfCnpjInput.value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
            }
        });
    </script>

</html>

    </body>
</html>
