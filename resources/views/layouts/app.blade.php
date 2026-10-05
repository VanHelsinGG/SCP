<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - {{ config('app.name') }} - Sistema de Controle de Pessoal</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif

</head>


<body class="min-h-screen bg-green-950 font-sans text-green-900">
    {{-- Fundo decorativo --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-30 h-96 w-96
                    rounded-full bg-green-600/20 blur-3xl">
        </div>
        <div class="absolute -bottom-40 -left-30 h-96 w-96
                    rounded-full bg-green-600/20 blur-3xl">
        </div>
    </div>
    {{-- Layout principal --}}
    <div class="relative flex min-h-screen flex-col">
        {{-- ========================================================= --}}
        {{-- CABEÇALHO --}}
        {{-- ========================================================= --}}
        <header class="flex h-24 shrink-0 items-center justify-between px-6">
            {{-- Sistema --}}
            <div class="flex items-center gap-3">
                <div
                    class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-green-600
                            shadow-lg shadow-green-600/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold leading-tight tracking-tight text-white">
                        {{ config('app.name') }}
                    </h1>
                    <p class="text-xs text-slate-400">
                        Sistema de Controle de Pessoal
                    </p>
                </div>
            </div>

            {{-- Usuário --}}
            <div class="relative">
                <button type="button" onclick="document.getElementById('userDropdown').classList.toggle('hidden')"
                    class="flex items-center gap-3 rounded-2xl
                           border border-slate-300/50
                           bg-slate-200/80 px-4 py-3
                           shadow-lg backdrop-blur-sm
                           transition hover:border-slate-400
                           hover:bg-slate-400">
                    <div
                        class="flex h-10 w-10 items-center justify-center
                                rounded-xl bg-slate-300 text-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0
                                     3.75 3.75 0 017.5 0z
                                     M4.5 20.25a8.25 8.25 0 0115 0" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-xs font-semibold text-slate-800">
                            {{ ucfirst(Auth::user()->getRoleName()) }}
                        </p>
                        <p class="text-sm font-semibold text-slate-700">
                            {{ Auth::user()->name }}
                        </p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                {{-- Dropdown --}}
                <div id="userDropdown"
                    class="absolute right-0 mt-2 hidden w-full min-w-48
                            overflow-hidden rounded-xl border border-slate-100
                            bg-slate-200 shadow-xl">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center gap-3
                                       px-4 py-3 text-sm text-slate-800
                                       transition hover:bg-red-500/10
                                       hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0
                                         0013.5 3h-6a2.25 2.25 0
                                         00-2.25 2.25v13.5A2.25 2.25
                                         0 007.5 21h6a2.25 2.25 0
                                         002.25-2.25V15M12 9l3 3m0
                                         0l-3 3m3-3H3" />
                            </svg>
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- ========================================================= --}}
        {{-- CONTEÚDO --}}
        {{-- ========================================================= --}}

        <main class="flex-1 px-6 pb-6">
            {{-- PAINEL PRINCIPAL --}}
            <div
                class="flex h-full flex-col overflow-hidden
                        rounded-2xl border border-slate-200/20
                        bg-slate-100 shadow-2xl">

                {{-- ================================================= --}}
                {{-- BARRA DE NAVEGAÇÃO --}}
                {{-- ================================================= --}}

                <div
                    class="grid shrink-0 grid-cols-3
                            divide-x divide-slate-300
                            border-b border-slate-300">
                    {{-- Home --}}
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center justify-center gap-2
                              px-4 py-4 text-sm font-semibold
                              text-green-800 transition
                              hover:bg-green-50 
                              {{ request()->routeIs('dashboard') ? 'bg-green-50' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7
                                     7 7M5 10v10a1 1 0 001
                                     1h3m10-11l2 2m-2-2v10a1
                                     1 0 01-1 1h-3m-6 0a1
                                     1 0 001-1v-4a1 1 0
                                     011-1h2a1 1 0 011
                                     1v4a1 1 0 001 1m-6
                                     0h6" />
                        </svg>
                        Home
                    </a>
                    {{-- Avisos --}}
                    <a href="#"
                        class="flex items-center justify-center gap-2
                              px-4 py-4 text-sm font-semibold
                              text-slate-700 transition
                              hover:bg-green-50 
                              {{ request()->routeIs('notifications') ? 'bg-green-50' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405
                                     A2.032 2.032 0 0118
                                     14.158V11a6.002 6.002
                                     0 00-4-5.659V5a2 2 0
                                     10-4 0v.341C7.67
                                     6.165 6 8.388 6 11v3.159
                                     c0 .538-.214 1.055-.595
                                     1.436L4 17h5m6 0v1a3
                                     3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        Avisos
                    </a>
                    {{-- Painel --}}
                    @if (Auth::user()->hasAdmPermissions())
                        <a href="{{ route('admin.index') }}"
                            class="flex items-center justify-center gap-2
                                  px-4 py-4 text-sm font-semibold
                                  text-slate-700 transition
                                  hover:bg-green-50 
                                  {{ request()->routeIs('admin.index') ? 'bg-green-50' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0
                                         110 5.292M15 21H3v-1a6
                                         6 0 0112 0v1zm0 0h6v-1a6
                                         6 0 00-9-5.197M13 7a4
                                         4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Painel de Controle
                        </a>
                    @endif
                </div>

                {{-- ================================================= --}}
                {{-- DASHBOARD --}}
                {{-- ================================================= --}}

                <div class="flex-1 overflow-auto p-6">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
@stack('scripts')
</body>

</html>
