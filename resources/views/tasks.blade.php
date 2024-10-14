<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des tâches') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="space-y-2 mb-8" action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Nom')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name')" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>
                    </form>

                    <ul>
                        @forelse ($tasks as $task)
                            <li class="flex items-center space-x-4 my-2">
                                <form action="{{ route('tasks.update', $task) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="{{ $task->is_done ? 'bg-green-300' : 'bg-red-300' }}">
                                        {{ $task->is_done ? 'Fait' : 'À faire' }}
                                    </button>
                                </form>
                                <form action="{{ route('tasks.update', $task) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="checkbox" name="is_done" id="task-{{ $task->id }}"
                                        @checked($task->is_done) onchange="submit()">
                                </form>
                                <div>
                                    <label for="task-{{ $task->id }}">
                                        {{ $task->name }}
                                    </label>
                                </div>
                                <div>
                                    <x-danger-button x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-task-deletion-{{ $task->id }}')">{{ __('Supprimer') }}</x-danger-button>

                                    <x-modal name="confirm-task-deletion-{{ $task->id }}" :show="$errors->userDeletion->isNotEmpty()"
                                        focusable>
                                        <form method="post" action="{{ route('tasks.destroy', $task) }}"
                                            class="p-6">
                                            @csrf
                                            @method('delete')

                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Êtes-vous certain de supprimer cette tâche ?') }}
                                            </h2>

                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Annuler') }}
                                                </x-secondary-button>

                                                <x-danger-button class="ms-3">
                                                    {{ __('Supprimer') }}
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                </div>
                            </li>
                        @empty
                            <li>

                                Vous n'avez pas encore de tâche.
                            </li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
