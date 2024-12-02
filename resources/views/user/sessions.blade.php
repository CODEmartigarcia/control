@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Mis Jornadas</h1>

    @if ($sessions->isEmpty())
        <p class="text-gray-600">No tienes jornadas registradas.</p>
    @else
        <div class="space-y-4">
            @foreach ($sessions->groupBy(function ($session) {
                    return $session->start_time->toDateString();
                }) as $date => $dailySessions)
                    <div class="border rounded shadow">
                        <button class="w-full bg-gray-200 px-4 py-2 text-left font-semibold text-gray-800 hover:bg-gray-300"
                            onclick="toggleAccordion('accordion-{{ $date }}')">
                            {{ $date }} (Total: {{ gmdate('H:i:s', $dailySessions->sum('total_duration')) }})
                        </button>
                        <div id="accordion-{{ $date }}" class="hidden bg-white p-4">
                            <table class="table-auto w-full text-left">
                                <thead>
                                    <tr class="bg-gray-100 border-b">
                                        <th class="px-4 py-2">Inicio</th>
                                        <th class="px-4 py-2">Fin</th>
                                        <th class="px-4 py-2">Duración</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dailySessions as $session)
                                        <tr class="border-b">
                                            <td class="px-4 py-2">{{ $session->start_time }}</td>
                                            <td class="px-4 py-2">{{ $session->end_time ?? 'En curso' }}</td>
                                            <td class="px-4 py-2">
                                                @if ($session->total_duration)
                                                    {{ gmdate('H:i:s', $session->total_duration) }}
                                                @else
                                                    En curso
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

<script>
    function toggleAccordion(id) {
        const element = document.getElementById(id);
        if (element.classList.contains('hidden')) {
            element.classList.remove('hidden');
        } else {
            element.classList.add('hidden');
        }
    }
</script>