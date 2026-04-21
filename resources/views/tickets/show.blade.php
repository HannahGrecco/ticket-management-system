<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Detalhes do chamado</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-lg bg-white p-6 shadow-sm">
                <div class="space-y-3 text-sm text-gray-800">
                    <p><span class="font-semibold">Titulo:</span> {{ $ticket->title }}</p>
                    <p><span class="font-semibold">Descricao:</span> {{ $ticket->description }}</p>
                    <p><span class="font-semibold">Criado por:</span> {{ $ticket->user?->name ?? 'N/A' }}</p>
                    <p><span class="font-semibold">Departamento:</span> {{ $ticket->user?->department ?? 'N/A' }}</p>
                    <p><span class="font-semibold">Status:</span> {{ $ticket->status }}</p>
                    <p><span class="font-semibold">Prioridade:</span> {{ $ticket->priority }}</p>
                    <p><span class="font-semibold">Criado em:</span> {{ $ticket->created_at?->format('d/m/Y H:i') }}</p>
                </div>

                <div class="mt-6 flex items-center gap-3">
                    <a href="{{ route('tickets.edit', $ticket) }}" class="rounded-md bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-700">Editar</a>
                    <a href="{{ route('tickets.index') }}" class="text-sm text-gray-600 hover:underline">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
