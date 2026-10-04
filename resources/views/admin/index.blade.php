@extends('layouts.app')

@section('title', 'Painel de Administração')

@section('content')

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
        
        @include('components.admin.sidebar')

        {{-- CONTEÚDO À DIREITA --}}
        <section class="lg:col-span-3">
            <div
                class="flex min-h-[400px] flex-col items-center justify-center rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="w-full text-center text-xl font-semibold text-slate-700">
                    Selecione uma opção ao lado
                </h3>
            </div>
        </section>

    </div>

@endsection
