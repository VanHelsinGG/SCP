<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function userIndex()
    {
        $users = User::paginate(10);

        return view('admin.users.users', compact('users'));
    }

    public function admIndex()
    {
        return view('admin.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Verifica se um CPF é matematicamente válido.
     */
    private function isValidCPF(string $cpf): bool
    {
        // Remove pontos, traços e qualquer outro caractere
        $cpf = preg_replace('/\D/', '', $cpf);

        // CPF precisa ter exatamente 11 dígitos
        if (strlen($cpf) !== 11) {
            return false;
        }

        // Rejeita CPFs com todos os dígitos iguais
        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        // Validação do primeiro dígito verificador
        $sum = 0;

        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $cpf[$i] * (10 - $i);
        }

        $remainder = $sum % 11;
        $digit1 = $remainder < 2 ? 0 : 11 - $remainder;

        if ((int) $cpf[9] !== $digit1) {
            return false;
        }

        // Validação do segundo dígito verificador
        $sum = 0;

        for ($i = 0; $i < 10; $i++) {
            $sum += (int) $cpf[$i] * (11 - $i);
        }

        $remainder = $sum % 11;
        $digit2 = $remainder < 2 ? 0 : 11 - $remainder;

        return (int) $cpf[10] === $digit2;
    }

    public function store(Request $request)
    {
        // Remove caracteres não numéricos antes da validação
        $request->merge([
            'RA' => preg_replace('/\D/', '', $request->RA ?? ''),
            'CPF' => preg_replace('/\D/', '', $request->CPF ?? ''),
            'RG' => preg_replace('/\D/', '', $request->RG ?? ''),
            'phone' => preg_replace('/\D/', '', $request->phone ?? ''),
        ]);

        $request->validate([
            'RA' => [
                'required',
                'digits:12',
                'unique:users,RA',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'role' => [
                'required',
                'string',
                'in:sec,atdr,aux',
            ],

            'CPF' => [
                'required',
                'digits:11',
                'unique:users,CPF',
                function ($attribute, $value, $fail) {
                    if (!$this->isValidCPF($value)) {
                        $fail('O CPF informado é inválido.');
                    }
                },
            ],

            'phone' => [
                'nullable',
                'digits_between:10,11',
            ],

            'RG' => [
                'nullable',
                'digits_between:5,12',
            ],

            'birthdate' => [
                'required',
                'date',
            ],

        ], [
            'name.required' => 'O nome completo é obrigatório.',
            'name.max' => 'O nome pode ter no máximo 255 caracteres.',

            'RA.required' => 'O RA é obrigatório.',
            'RA.digits' => 'O RA deve possuir exatamente 12 números.',
            'RA.unique' => 'Este RA já está cadastrado.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',

            'role.required' => 'O cargo é obrigatório.',
            'role.in' => 'O cargo selecionado é inválido.',

            'CPF.required' => 'O CPF é obrigatório.',
            'CPF.digits' => 'O CPF deve possuir exatamente 11 números.',
            'CPF.unique' => 'Este CPF já está cadastrado.',

            'phone.digits_between' => 'O telefone deve possuir 10 ou 11 números.',

            'RG.digits_between' => 'O RG deve possuir entre 5 e 12 números.',

            'birthdate.required' => 'A data de nascimento é obrigatória.',
            'birthdate.date' => 'A data de nascimento informada é inválida.',
        ]);

        User::create([
            'RA' => $request->RA,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(Carbon::parse($request->birthdate)->format('dmY')),
            'role' => $request->role,
            'status' => 'active',
            'CPF' => $request->CPF,
            'phone' => $request->phone,
            'RG' => $request->RG,
            'birth_date' => $request->birthdate,
        ]);

        return redirect()
            ->route('admin.users.create')
            ->with('success', 'Usuário criado com sucesso!');
    }
}
