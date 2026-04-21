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

            <form method="GET" action="{{ route('tickets.index') }}" class="mb-4 rounded-lg bg-white p-4 shadow-sm">
                <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
                    <div>
                        <label for="status" class="mb-1 block text-sm font-semibold text-gray-700">Filtrar por status</label>
                        <select id="status" name="status" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                            <option value="">Todos</option>
                            <option value="aberto" {{ request('status') === 'aberto' ? 'selected' : '' }}>aberto</option>
                            <option value="em_andamento" {{ request('status') === 'em_andamento' ? 'selected' : '' }}>em_andamento</option>
                            <option value="resolvido" {{ request('status') === 'resolvido' ? 'selected' : '' }}>resolvido</option>
                            <option value="fechado" {{ request('status') === 'fechado' ? 'selected' : '' }}>fechado</option>
                        </select>
                    </div>

                    <div>
                        <label for="department" class="mb-1 block text-sm font-semibold text-gray-700">Filtrar por departamento</label>
                        <select id="department" name="department" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                            <option value="">Todos</option>
                            <option value="Financeiro" {{ request('department') === 'Financeiro' ? 'selected' : '' }}>Financeiro</option>
                            <option value="Comercial" {{ request('department') === 'Comercial' ? 'selected' : '' }}>Comercial</option>
                            <option value="Tecnologia" {{ request('department') === 'Tecnologia' ? 'selected' : '' }}>Tecnologia</option>
                            <option value="RH" {{ request('department') === 'RH' ? 'selected' : '' }}>RH</option>
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit" class="rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Filtrar</button>
                        <a href="{{ route('tickets.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Limpar</a>
                    </div>
                </div>
            </form>

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
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    @php
                                        $statusStyles = [
                                            'aberto' => 'border-blue-200 bg-blue-50 text-blue-700',
                                            'em_andamento' => 'border-amber-200 bg-amber-50 text-amber-700',
                                            'resolvido' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                                            'fechado' => 'border-slate-200 bg-slate-100 text-slate-700',
                                        ];
                                        $statusStyle = $statusStyles[$ticket->status] ?? 'border-gray-200 bg-gray-100 text-gray-700';
                                    @endphp
                                    <form method="POST" action="{{ route('tickets.status.update', $ticket) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="inline-flex rounded-full border px-3 py-1 {{ $statusStyle }}">
                                            <select name="status" class="min-w-[120px] border-0 bg-transparent p-0 pr-5 text-sm font-semibold focus:ring-0 {{ $statusStyle }}" onchange="this.form.submit()">
                                                <option value="aberto" {{ $ticket->status === 'aberto' ? 'selected' : '' }}>aberto</option>
                                                <option value="em_andamento" {{ $ticket->status === 'em_andamento' ? 'selected' : '' }}>em_andamento</option>
                                                <option value="resolvido" {{ $ticket->status === 'resolvido' ? 'selected' : '' }}>resolvido</option>
                                                <option value="fechado" {{ $ticket->status === 'fechado' ? 'selected' : '' }}>fechado</option>
                                            </select>
                                        </div>
                                    </form>
                                </td>
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
