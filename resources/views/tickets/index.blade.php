<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Chamados</h2>
            <a href="{{ route('tickets.create') }}" class="rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Novo chamado</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 p-3 text-green-800">{{ session('success') }}</div>
            @endif

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Titulo</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Criado por</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Departamento</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Prioridade</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Criado em</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">Acoes</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($tickets as $ticket)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $ticket->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $ticket->user?->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $ticket->user?->department ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $ticket->status }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $ticket->priority }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $ticket->created_at?->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3 text-right text-sm">
                                    <a href="{{ route('tickets.show', $ticket) }}" class="mr-3 text-slate-700 hover:underline">Ver</a>
                                    <a href="{{ route('tickets.edit', $ticket) }}" class="mr-3 text-blue-700 hover:underline">Editar</a>
                                    <form method="POST" action="{{ route('tickets.destroy', $ticket) }}" class="inline" onsubmit="return confirm('Deseja excluir este chamado?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-700 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">Nenhum chamado cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $tickets->links() }}</div>
        </div>
    </div>
</x-app-layout>
