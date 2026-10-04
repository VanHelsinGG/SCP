{{-- BARRA LATERAL --}}
<aside class="lg:col-span-1">

    <div class="flex flex-col rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
        <h2 class="mb-4 px-3 text-xs font-bold uppercase tracking-wider text-slate-400">
            Gerenciamento
        </h2>
        {{-- Usuários --}}
        <a href="{{ route('admin.users.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-semibold transition hover:text-green-700 hover:bg-slate-100 {{ request()->routeIs('admin.users.index') ? 'bg-green-50 text-green-700' : 'text-slate-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Usuários
        </a>

        {{-- Permissões --}}
        <a href="#"
            class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-green-700 {{ request()->routeIs('admin.permissions.index') ? 'bg-green-50 text-green-700' : 'text-slate-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.053-.382-3.016z" />

            </svg>
            Cargos e Permissões
        </a>

        {{-- Configurações --}}
        <a href="#"
            class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-green-700 {{ request()->routeIs('admin.config.index') ? 'bg-green-50 text-green-700' : 'text-slate-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">

                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Configurações
        </a>
    </div>
</aside>
