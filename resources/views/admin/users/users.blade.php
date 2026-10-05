@extends('layouts.app')

@section('title', 'Painel de Administração - Usuários')

@section('content')

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">

        @include('components.admin.sidebar')

        {{-- CONTEÚDO À DIREITA --}}
        <section class="lg:col-span-3">
            <div class="flex min-h-[400px] flex-col rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                {{-- CABEÇALHO --}}
                <div class="mb-6 flex flex-col gap-5">

                    {{-- TÍTULO E BOTÃO --}}
                    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

                        <div>
                            <h2 class="text-xl font-bold tracking-tight text-slate-800">
                                Usuários cadastrados
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Gerencie e acompanhe os usuários do sistema.
                            </p>
                        </div>

                        <a href="{{ route('admin.users.create') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md">

                            <span class="text-lg leading-none">+</span>
                            Novo usuário
                        </a>

                    </div>

                    {{-- PESQUISA E CONTADOR --}}
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div class="relative w-full sm:max-w-sm">
                            <div class="relative w-full sm:max-w-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.8" stroke="currentColor"
                                    class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6.04 6.04a7.5 7.5 0 0 0 10.61 10.61Z" />
                                </svg>
                                <input type="text" name="search-bar" id="search-bar" placeholder="Buscar usuário..."
                                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm text-slate-700 outline-none transition-all placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100">
                            </div>
                        </div>
                        <span
                            class="inline-flex w-fit items-center gap-2 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-medium text-slate-600">

                            <span class="h-2 w-2 rounded-full bg-blue-500"></span>

                            {{ $users->count() }} usuários
                            
                        </span>
                    </div>
                </div>

                {{-- TABELA --}}
                <div class="w-full overflow-hidden rounded-xl border border-slate-200">

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600">

                            <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                                <tr class="border-b border-slate-200">
                                    <th class="px-6 py-4 font-semibold">RA</th>
                                    <th class="px-6 py-4 font-semibold">Nome</th>
                                    <th class="px-6 py-4 font-semibold">E-mail</th>
                                    <th class="px-6 py-4 font-semibold">Data de Nascimento</th>
                                    <th class="px-6 py-4 text-center font-semibold">Cargo</th>
                                    <th class="px-6 py-4 text-center font-semibold">Situação</th>
                                    <th class="px-6 py-4 text-center font-semibold">Ações</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">

                                @forelse ($users as $user)
                                    <tr class="transition-colors duration-200 hover:bg-blue-50/50">

                                        <td class="whitespace-nowrap px-6 py-4 font-medium text-slate-500">
                                            {{ $user->RA }}
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4 font-semibold text-slate-800">
                                            {{ $user->name }}
                                        </td>

                                        <td class="px-6 py-4 text-slate-500">
                                            {{ $user->email }}
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4">
                                            {{ $user->birth_date }}
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $user->getRoleColor() }}">
                                                {{ $user->getRoleName() }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <spanclass="whitespace-nowrap px-6 py-4">
                                            {{ ucfirst($user->getUserStatus()) }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <button
                                                class="cursor-pointer rounded-lg border border-blue-200 bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-600 transition-all duration-200 hover:border-blue-600 hover:bg-blue-600 hover:text-white">
                                                Ver mais
                                            </button>
                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center gap-2">
                                                <span class="text-base font-semibold text-slate-600">
                                                    Nenhum usuário encontrado
                                                </span>
                                                <span class="text-sm text-slate-400">
                                                    Os usuários cadastrados aparecerão aqui.
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
