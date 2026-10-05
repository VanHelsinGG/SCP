<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Sistema de Controle de Pessoal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif
</head>

<body class="min-h-screen bg-green-950 font-sans text-green-900">

    <!-- Fundo decorativo -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-30 h-96 w-96 rounded-full bg-green-600/20 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-30 h-96 w-96 rounded-full bg-green-600/20 blur-3xl"></div>
    </div>

    <!-- Conteúdo -->
    <main class="relative min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-md">

            <!-- Logo / Cabeçalho -->
            <div class="text-center mb-8">

                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center
                            rounded-2xl bg-green-600 shadow-lg shadow-green-600/30">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8 text-white"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-10a4 4 0 110 8 4 4 0 010-8zm6 4a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>

                </div>

                <h1 class="text-2xl font-bold tracking-tight text-white">
                    {{ config('app.name') }}
                </h1>

                <p class="mt-2 text-sm text-slate-400">
                    Sistema de Controle de Pessoal
                </p>

            </div>

            <!-- Card de Login -->
            <div class="rounded-2xl border border-white/10 bg-white p-8 shadow-2xl">

                <div class="mb-7">
                    <h2 class="text-xl font-semibold text-slate-900">
                        Acesso ao sistema
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Entre com suas credenciais para continuar.
                    </p>
                </div>

                <!-- Erros -->
                @if ($errors->any())
                    <div
                        class="mb-6 flex gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700"
                        role="alert"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v2m0 4h.01M10.29 3.86l-7.82 13a2 2 0 001.71 3h15.64a2 2 0 001.71-3l-7.82-13a2 2 0 00-3.42 0z"
                            />
                        </svg>

                        <div>
                            @if ($errors->has('CPF'))
                                <p class="font-medium">
                                    {{ $errors->first('CPF') }}
                                </p>
                            @else
                                <p class="font-medium">
                                    Verifique os dados informados.
                                </p>
                            @endif
                        </div>
                    </div>
                @endif
                <!-- Formulário -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <!-- CPF -->
                    <div>
                        <label
                            for="CPF"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            CPF
                        </label>

                        <div class="relative">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-slate-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 9h.01M9 9h.01M12 12h.01M12 16h.01M7 20h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                            </div>

                            <input
                                id="CPF"
                                type="text"
                                name="CPF"
                                value="{{ old('CPF') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Digite seu CPF"
                                class="@if ($errors->has('CPF')) border-red-400 ring-red-100 @else border-slate-200 @endif
                                       w-full rounded-xl border bg-slate-50 py-3 pl-11 pr-4
                                       text-sm text-slate-900 placeholder-slate-400
                                       outline-none transition
                                       focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                            >

                        </div>
                    </div>

                    <!-- Senha -->
                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <label
                                for="password"
                                class="block text-sm font-medium text-slate-700"
                            >
                                Senha
                            </label>
                        </div>

                        <div class="relative">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-slate-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.5 10.5V7a4.5 4.5 0 00-9 0v3.5m-1 0h11a1 1 0 011 1v8a1 1 0 01-1 1h-11a1 1 0 01-1-1v-8a1 1 0 011-1z"
                                    />
                                </svg>
                            </div>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Digite sua senha"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       py-3 pl-11 pr-4 text-sm text-slate-900
                                       placeholder-slate-400 outline-none transition
                                       focus:border-blue-500 focus:bg-white
                                       focus:ring-4 focus:ring-blue-500/10"
                            >

                        </div>
                    </div>

                    <!-- Botão -->
                    <button
                        type="submit"
                        class="group flex w-full items-center justify-center gap-2 rounded-xl
                               bg-blue-600 py-3 text-sm font-semibold text-white
                               shadow-lg shadow-blue-600/20 transition-all
                               hover:bg-blue-700 hover:shadow-blue-600/30
                               focus:outline-none focus:ring-4 focus:ring-blue-500/20
                               active:scale-[0.99] cursor-pointer"
                    >
                        Entrar

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 transition-transform group-hover:translate-x-0.5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"
                            />
                        </svg>
                    </button>

                </form>

            </div>

            <!-- Rodapé -->
            <p class="mt-6 text-center text-xs text-slate-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}.
                Todos os direitos reservados.
            </p>

        </div>

    </main>

</body>

</html>

