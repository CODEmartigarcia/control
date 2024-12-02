@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Panel del Usuario</h1>

    @if ($currentSession)
        <div class="bg-blue-100 text-blue-800 p-4 rounded mb-4">
            <p>Jornada activa iniciada a las: <span class="font-semibold">{{ $currentSession->start_time }}</span></p>
            <p>
                Duración actual:
                <span id="current-duration" data-start-time="{{ $currentSession->start_time->format('Y-m-d\TH:i:s') }}">
                    {{ now()->diffForHumans($currentSession->start_time, true) }}
                </span>
            </p>
        </div>
        <form action="{{ route('worksession.end', $currentSession) }}" method="POST" class="mt-2">
            @csrf
            @method('PATCH')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Finalizar Jornada
            </button>
        </form>
    @else
        <form action="{{ route('worksession.start') }}" method="POST">
            @csrf
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Iniciar Jornada
            </button>
        </form>
    @endif

    <h2 class="text-xl font-semibold mt-6 mb-4">Jornadas de Hoy</h2>
    @if ($sessions->isEmpty())
        <p class="text-gray-600">No hay jornadas registradas para hoy.</p>
    @else
        <table class="table-auto w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2">Inicio</th>
                    <th class="px-4 py-2">Fin</th>
                    <th class="px-4 py-2">Duración</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sessions as $session)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $session->start_time }}</td>
                        <td class="px-4 py-2">{{ $session->end_time ?? 'En curso' }}</td>
                        <td class="px-4 py-2">
                            @if ($session->end_time)
                                {{ gmdate('H:i:s', $session->total_duration) }}
                            @else
                                En curso
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection