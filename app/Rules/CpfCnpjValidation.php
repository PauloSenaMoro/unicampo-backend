<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CpfCnpjValidation implements Rule
{
    public function passes($attribute, $value)
    {
        // Remove caracteres não numéricos
        $value = preg_replace('/[^0-9]/', '', $value);

        // Verifica se é um CPF válido
        if (strlen($value) === 11) {
            return $this->validarCpf($value);
        }

        // Verifica se é um CNPJ válido
        if (strlen($value) === 14) {
            return $this->validarCnpj($value);
        }

        return false;
    }

    public function message()
    {
        return 'O campo :attribute deve ser um CPF ou CNPJ válido.';
    }

    protected function validarCpf($cpf)
    {
        // Remove os dígitos verificadores
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se todos os dígitos são iguais, o que é inválido
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Calcula o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += intval($cpf[$i]) * (10 - $i);
        }
        $resto = $soma % 11;
        $digitoVerificador1 = ($resto < 2) ? 0 : 11 - $resto;

        // Calcula o segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += intval($cpf[$i]) * (11 - $i);
        }
        $resto = $soma % 11;
        $digitoVerificador2 = ($resto < 2) ? 0 : 11 - $resto;

        // Verifica se os dígitos verificadores calculados são iguais aos do CPF
        if ($cpf[9] == $digitoVerificador1 && $cpf[10] == $digitoVerificador2) {
            return true;
        }

        return false;
    }

    protected function validarCnpj($cnpj)
    {
        // Remove os dígitos verificadores
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
    
        // Verifica se todos os dígitos são iguais, o que é inválido
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }
    
        // Calcula o primeiro dígito verificador
        $soma = 0;
        $peso = 5;
        for ($i = 0; $i < 12; $i++) {
            $soma += intval($cnpj[$i]) * $peso;
            $peso = ($peso === 2) ? 9 : $peso - 1;
        }
        $resto = $soma % 11;
        $digitoVerificador1 = ($resto < 2) ? 0 : 11 - $resto;
    
        // Calcula o segundo dígito verificador
        $soma = 0;
        $peso = 6;
        for ($i = 0; $i < 13; $i++) {
            $soma += intval($cnpj[$i]) * $peso;
            $peso = ($peso === 2) ? 9 : $peso - 1;
        }
        $resto = $soma % 11;
        $digitoVerificador2 = ($resto < 2) ? 0 : 11 - $resto;
    
        // Verifica se os dígitos verificadores calculados são iguais aos do CNPJ
        if ($cnpj[12] == $digitoVerificador1 && $cnpj[13] == $digitoVerificador2) {
            return true;
        }
    
        return false;
    }
    
}
