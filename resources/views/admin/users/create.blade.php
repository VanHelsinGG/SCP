@extends('layouts.app')

@section('title', 'Painel de Administração - Criar Usuário')

@push('scripts')
    @vite('resources/js/admin/users/create.js')
@endpush

@section('content')

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">

        @include('components.admin.sidebar')

        <section class="lg:col-span-3">

            <div class="flex min-h-[400px] flex-col rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- CABEÇALHO --}}
                <div class="border-b border-slate-100 px-6 py-6 sm:px-8">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="10" cy="7" r="4" />
                                <line x1="20" y1="8" x2="20" y2="14" />
                                <line x1="23" y1="11" x2="17" y2="11" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-xl font-bold tracking-tight text-slate-800">
                                Cadastrar Usuário
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Preencha os dados abaixo para adicionar um novo usuário ao sistema.
                            </p>
                        </div>

                    </div>

                </div>
                @if (session('success'))
                    <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">

                        <div class="flex items-start gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg>
                            </div>

                            <div>
                                <p class="font-semibold">
                                    Não foi possível cadastrar o usuário.
                                </p>

                                <p class="mt-1 text-sm text-red-600">
                                    Verifique os campos abaixo:
                                </p>

                                <ul class="mt-2 list-inside list-disc space-y-1 text-sm">
                                    @if ($errors->has('name'))
                                        <li>O nome completo é obrigatório.</li>
                                    @endif

                                    @if ($errors->has('RA'))
                                        <li>O RA informado é inválido ou está vazio.</li>
                                    @endif

                                    @if ($errors->has('email'))
                                        <li>O e-mail informado é inválido ou já está cadastrado.</li>
                                    @endif

                                    @if ($errors->has('birthdate'))
                                        <li>A data de nascimento é inválida.</li>
                                    @endif

                                    @if ($errors->has('CPF'))
                                        <li>O CPF informado é inválido.</li>
                                    @endif

                                    @if ($errors->has('RG'))
                                        <li>O RG informado é inválido.</li>
                                    @endif

                                    @if ($errors->has('phone'))
                                        <li>O telefone informado é inválido.</li>
                                    @endif

                                    @if ($errors->has('role'))
                                        <li>Selecione um cargo válido.</li>
                                    @endif
                                </ul>
                            </div>

                        </div>
                    </div>
                @endif
                {{-- FORMULÁRIO --}}
                <form method="POST" action="{{ route('admin.users.store') }}" class="flex flex-col">
                    @csrf
                    <div class="space-y-8 px-6 py-8 sm:px-8">

                        {{-- DADOS PESSOAIS --}}
                        <div>

                            <div class="mb-5 flex items-center gap-2">
                                <div class="h-5 w-1 rounded-full bg-blue-600"></div>

                                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-700">
                                    Dados pessoais
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 gap-x-5 gap-y-5 md:grid-cols-2 xl:grid-cols-3">

                                <div>
                                    <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
                                        Nome completo <span class="text-red-500">*</span>
                                    </label>

                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        placeholder="Ex: João da Silva" required
                                        class="w-full rounded-xl border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }} px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                                </div>

                                <div>
                                    <label for="RA" class="mb-2 block text-sm font-medium text-slate-700">
                                        RA <span class="text-red-500">*</span>
                                    </label>

                                    <input type="text" name="RA" id="RA" value="{{ old('RA') }}"
                                        placeholder="Número do RA" required
                                        class="w-full rounded-xl border {{ $errors->has('RA') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }} px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                                </div>

                                <div>
                                    <label for="email" class="mb-2 block text-sm font-medium text-slate-700">
                                        E-mail <span class="text-red-500">*</span>
                                    </label>

                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        placeholder="usuario@email.com" required
                                        class="w-full rounded-xl border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }} px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                                </div>

                                <div>
                                    <label for="birthdate" class="mb-2 block text-sm font-medium text-slate-700">
                                        Data de nascimento
                                    </label>

                                    <input type="date" name="birthdate" id="birthdate"
                                        class="w-full rounded-xl border {{ $errors->has('birthdate') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }} px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                                </div>

                                <div>
                                    <label for="CPF" class="mb-2 block text-sm font-medium text-slate-700">
                                        CPF
                                    </label>

                                    <input type="text" name="CPF" id="CPF" placeholder="000.000.000-00"
                                        class="w-full rounded-xl border {{ $errors->has('CPF') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }} px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                                </div>

                                <div>
                                    <label for="RG" class="mb-2 block text-sm font-medium text-slate-700">
                                        RG
                                    </label>

                                    <input type="text" name="RG" id="RG" placeholder="Número do RG"
                                        class="w-full rounded-xl border {{ $errors->has('RG') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }} px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                                </div>

                                <div>
                                    <label for="phone" class="mb-2 block text-sm font-medium text-slate-700">
                                        Telefone
                                    </label>

                                    <input type="tel" name="phone" id="phone" placeholder="(00) 00000-0000"
                                        class="w-full rounded-xl border {{ $errors->has('phone') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }} px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                                </div>

                            </div>
                        </div>

                        {{-- DADOS DE ACESSO --}}
                        <div class="border-t border-slate-100 pt-7">

                            <div class="mb-5 flex items-center gap-2">
                                <div class="h-5 w-1 rounded-full bg-blue-600"></div>

                                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-700">
                                    Dados de acesso
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                                <div>
                                    <label for="role" class="mb-2 block text-sm font-medium text-slate-700">
                                        Cargo / Função <span class="text-red-500">*</span>
                                    </label>

                                    <select name="role" id="role" required
                                        class="w-full cursor-pointer rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">

                                        <option value="atdr">Atirador</option>
                                        <option value="aux">Auxiliar de instrução</option>
                                        <option value="sec">Secretaria</option>

                                    </select>
                                </div>

                            </div>
                        </div>

                    </div>

                    {{-- RODAPÉ / BOTÕES --}}
                    <div
                        class="flex flex-col-reverse gap-3 rounded-b-2xl border-t border-slate-100 bg-slate-50/70 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8">

                        <p class="text-xs text-slate-400">
                            <span class="text-red-500">*</span> Campos obrigatórios
                        </p>

                        <div class="flex flex-col gap-3 sm:flex-row">

                            <button type="reset"
                                class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-800">
                                Limpar campos
                            </button>

                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm shadow-blue-600/20 transition hover:bg-blue-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-blue-500/20">

                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z" />
                                    <polyline points="17 21 17 13 7 13 7 21" />
                                    <polyline points="7 3 7 8 15 8" />
                                </svg>

                                Cadastrar usuário
                            </button>

                        </div>
                    </div>

                </form>

            </div>

        </section>

    </div>

@endsection
