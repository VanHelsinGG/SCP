@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        {{-- ========================================= --}}
        {{-- INFORMAÇÕES PESSOAIS --}}
        {{-- ========================================= --}}
        <section class="rounded-2xl border border-slate-200
                                        bg-white shadow-sm">
            {{-- Título --}}
            <div
                class="flex items-center gap-3
                                        border-b border-slate-200
                                        px-6 py-5">
                <div
                    class="flex h-10 w-10 items-center
                                            justify-center rounded-xl
                                            bg-green-100 text-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0
                                                     4 4 0 018 0zM12 14a7
                                                     7 0 00-7 7h14a7 7
                                                     0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-slate-800">
                        Informações pessoais
                    </h2>
                    <p class="text-xs text-slate-500">
                        Dados cadastrais
                    </p>
                </div>
            </div>
            {{-- Informações --}}
            <div class="grid grid-cols-1 gap-5 p-6 sm:grid-cols-2">
                <div>
                    <p
                        class="text-xs font-medium uppercase
                                              tracking-wide text-slate-400">
                        Nome completo
                    </p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ Auth::user()->name }}
                    </p>
                </div>
                <div>
                    <p
                        class="text-xs font-medium uppercase
                                              tracking-wide text-slate-400">
                        Função
                    </p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ ucfirst(Auth::user()->getRoleName()) }}
                    </p>
                </div>
                <div>
                    <p
                        class="text-xs font-medium uppercase
                                              tracking-wide text-slate-400">
                        CPF
                    </p>
                    <p class="mt-1 font-semibold text-slate-800">
                        000.000.000-00
                    </p>
                </div>
                <div>
                    <p
                        class="text-xs font-medium uppercase
                                              tracking-wide text-slate-400">
                        RA
                    </p>
                    <p class="mt-1 font-semibold text-slate-800">
                        000000
                    </p>
                </div>
                <div class="sm:col-span-2">
                    <p
                        class="text-xs font-medium uppercase
                                              tracking-wide text-slate-400">
                        E-mail
                    </p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ Auth::user()->email }}
                    </p>
                </div>
                <div>
                    <p
                        class="text-xs font-medium uppercase
                                              tracking-wide text-slate-400">
                        Data de Nascimento
                    </p>
                    <p class="mt-1 font-semibold text-slate-800">
                        000000
                    </p>
                </div>
            </div>
            <div>
                {{-- Título --}}
                <div
                    class="flex items-center gap-3
                                        border-b border-slate-200
                                        px-6 py-5">
                    <div
                        class="flex h-10 w-10 items-center
                                            justify-center rounded-xl
                                            bg-blue-100 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0
                                                     4 4 0 018 0zM12 14a7
                                                     7 0 00-7 7h14a7 7
                                                     0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">
                            Informações de instrução
                        </h2>
                        <p class="text-xs text-slate-500">
                            Dados de instrução do usuário
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 p-6 sm:grid-cols-2">
                    <div>
                        <p
                            class="text-xs font-medium uppercase
                                              tracking-wide text-slate-400">
                            Pontos Perdidos
                        </p>
                        <p class="mt-1 font-semibold text-slate-800">
                            000000
                        </p>
                    </div>
                    <div>
                        <p
                            class="text-xs font-medium uppercase
                                              tracking-wide text-slate-400">
                            Tempo de Serviço
                        </p>
                        <p class="mt-1 font-semibold text-slate-800">
                            000000
                        </p>
                    </div>
                </div>
        </section>

        {{-- ========================================= --}}
        {{-- PENDÊNCIAS --}}
        {{-- ========================================= --}}
        <section class="rounded-2xl border border-slate-200
                                        bg-white shadow-sm">
            {{-- Título --}}
            <div
                class="flex items-center justify-between
                                        border-b border-slate-200
                                        px-6 py-5">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center
                                                justify-center rounded-xl
                                                bg-amber-100 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M5.07
                                                         19h13.86c1.54 0
                                                         2.5-1.67 1.73-3L13.73
                                                         4c-.77-1.33-2.69-1.33
                                                         -3.46 0L3.34 16c-.77
                                                         1.33.19 3 1.73 3z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">
                            Pendências
                        </h2>
                        <p class="text-xs text-slate-500">
                            Itens que precisam de atenção
                        </p>
                    </div>
                </div>
                {{-- Quantidade --}}
                <span
                    class="rounded-full bg-amber-100
                                             px-3 py-1 text-xs font-bold
                                             text-amber-700">
                    2
                </span>
            </div>
            {{-- Lista de pendências --}}
            <div class="divide-y divide-slate-100">
                {{-- Pendência 1 --}}
                <div
                    class="flex items-center justify-between
                                            gap-4 px-6 py-5
                                            transition hover:bg-slate-50">
                    <div class="flex items-center gap-3">
                        <div
                            class="h-2.5 w-2.5 rounded-full
                                                    bg-red-500">
                        </div>
                        <div>

                            <p
                                class="text-sm font-semibold
                                                      text-slate-800">
                                Documento pendente
                            </p>
                            <p class="text-xs text-slate-500">
                                Atualize seus documentos cadastrais
                            </p>
                        </div>
                    </div>
                    <span class="text-xs font-medium
                                                 text-red-500">
                        Pendente
                    </span>
                </div>
                {{-- Pendência 2 --}}
                <div
                    class="flex items-center justify-between
                                            gap-4 px-6 py-5
                                            transition hover:bg-slate-50">
                    <div class="flex items-center gap-3">
                        <div
                            class="h-2.5 w-2.5 rounded-full
                                                    bg-amber-500">
                        </div>
                        <div>
                            <p
                                class="text-sm font-semibold
                                                      text-slate-800">
                                Atualização cadastral
                            </p>
                            <p class="text-xs text-slate-500">
                                Revise suas informações pessoais
                            </p>
                        </div>
                    </div>
                    <span class="text-xs font-medium
                                                 text-amber-600">
                        Revisar
                    </span>
                </div>
                {{-- Sem pendências --}}
                {{--

                                <div class="flex flex-col items-center
                                            justify-center px-6 py-12">
                                    <div class="flex h-12 w-12
                                                items-center justify-center
                                                rounded-full bg-green-100
                                                text-green-600">

                                        ✓
                                    </div>
                                    <p class="mt-3 text-sm font-semibold
                                              text-slate-700">
                                        Tudo em dia!
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        Não existem pendências no momento.
                                    </p>
                                </div>
                                --}}
            </div>
        </section>
    </div>
    </div>
@endsection
