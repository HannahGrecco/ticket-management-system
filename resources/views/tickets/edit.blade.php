<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Editar chamado</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-lg bg-white p-6 shadow-sm">
                <form method="POST" action="{{ route('tickets.update', $ticket) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="mb-1 block text-sm font-semibold text-gray-700">Titulo</label>
                        <input id="title" name="title" type="text" value="{{ old('title', $ticket->title) }}" class="w-full rounded-md border border-gray-300 px-3 py-2" required>
                        @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="mb-1 block text-sm font-semibold text-gray-700">Descricao</label>
                        <textarea id="description" name="description" rows="5" class="w-full rounded-md border border-gray-300 px-3 py-2" required>{{ old('description', $ticket->description) }}</textarea>
                        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="status" class="mb-1 block text-sm font-semibold text-gray-700">Status</label>
                            <select id="status" name="status" class="w-full rounded-md border border-gray-300 px-3 py-2" required>
                                <option value="aberto" {{ old('status', $ticket->status) === 'aberto' ? 'selected' : '' }}>aberto</option>
                                <option value="em_andamento" {{ old('status', $ticket->status) === 'em_andamento' ? 'selected' : '' }}>em_andamento</option>
                                <option value="resolvido" {{ old('status', $ticket->status) === 'resolvido' ? 'selected' : '' }}>resolvido</option>
                                <option value="fechado" {{ old('status', $ticket->status) === 'fechado' ? 'selected' : '' }}>fechado</option>
                            </select>
                            @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="priority" class="mb-1 block text-sm font-semibold text-gray-700">Prioridade</label>
                            <select id="priority" name="priority" class="w-full rounded-md border border-gray-300 px-3 py-2" required>
                                <option value="baixa" {{ old('priority', $ticket->priority) === 'baixa' ? 'selected' : '' }}>baixa</option>
                                <option value="media" {{ old('priority', $ticket->priority) === 'media' ? 'selected' : '' }}>media</option>
                                <option value="alta" {{ old('priority', $ticket->priority) === 'alta' ? 'selected' : '' }}>alta</option>
                            </select>
                            @error('priority') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="rounded-md bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-700">Atualizar</button>
                        <a href="{{ route('tickets.index') }}" class="text-sm text-gray-600 hover:underline">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
