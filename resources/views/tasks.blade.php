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
                    <ul>
                        @forelse ($tasks as $task)
                            <li>
                                {{ $task->name }}
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
