<x-app-layout>
    <x-slot name="header">
        <div class = "flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Todas las notificaciones') }}
            </h2>
        </div>
    </x-slot>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-5">
        @if (!$notifications->isEmpty())
            <button class="w-full text-left px-4 py-2 text-sm text-blue-600 hover:bg-gray-100"
                onclick="marcarTodasComoLeidas()">
                Marcar todas como leídas
            </button>
            @foreach ($notifications as $notification)
                @if ($notification->data['type'] == 'entrevista')
                    <a href="{{ route('entrevistas.visualizar', $notification->data['entrevista_id']) }}"
                        class="py-2 px-4 flex items-center hover:bg-gray-50 group"
                        onclick="marcarNotificacionLeida('{{ $notification->id }}')">
                        <div class="ml-2">
                            <div class="text-[10px] text-gray-600 font-medium truncate">
                                Tienes una entevista</div>
                            <div
                                class="text-[11px] {{ $notification->data['fecha_inicio'] > now() ? 'text-green-500' : ($notification->data['fecha_inicio'] < now() ? 'text-red-500' : '') }}">
                                {{ $notification->data['fecha_inicio'] }} a las
                                {{ $notification->data['hora'] }}</div>
                        </div>
                    </a>
                @endif
                @if ($notification->data['type'] == 'New Permiso')
                    <a href="{{ route('permisos.historial') }}"
                        class="py-2 px-4 flex items-center hover:bg-gray-50 group"
                        onclick="marcarNotificacionLeida('{{ $notification->id }}')">
                        <div class="ml-2">
                            <div class="text-[10px] text-gray-600 font-medium truncate">
                                Nueva Solicitud de Permiso</div>
                            <div class="text-[11px] text-gray-500">
                                El usuario {{ $notification->notifiable->name }} ha solicitado
                                un nuevo permiso</div>
                            <div class="text-[11px] text-gray-500">
                                Desde: {{ $notification->data['fecha_inicio'] }} Hasta:
                                {{ $notification->data['fecha_fin'] }}</div>
                        </div>
                    </a>
                @endif
                @if ($notification->data['type'] == 'Permiso Aceptado')
                    <a href="{{ route('permisos.historial') }}"
                        class="py-2 px-4 flex items-center hover:bg-gray-50 group"
                        onclick="marcarNotificacionLeida('{{ $notification->id }}')">
                        <div class="ml-2">
                            <div class="text-[10px] text-gray-600 font-medium truncate">
                                Permiso Aceptado!</div>
                            <div class="text-[11px] text-gray-500">
                                El que permiso que solicitaste </div>
                            <div class="text-[11px] text-gray-500">
                                Ha sido aceptado</div>
                        </div>
                    </a>
                @endif
                @if ($notification->data['type'] == 'Permiso Rechazado')
                    <a href="{{ route('permisos.historial') }}"
                        class="py-2 px-4 flex items-center hover:bg-gray-50 group"
                        onclick="marcarNotificacionLeida('{{ $notification->id }}')">
                        <div class="ml-2">
                            <div class="text-[10px] text-gray-600 font-medium truncate">
                                Permiso Rechazado!</div>
                            <div class="text-[11px] text-gray-500">
                                El que permiso que solicitaste </div>
                            <div class="text-[11px] text-gray-500">
                                Ha sido Rechazado</div>
                        </div>
                    </a>
                @endif
            @endforeach
        @else
            <div class="w-full text-left px-4 py-2 text-sm text-blue-600 hover:bg-gray-100">No hay notificaciones
            </div>
        @endif

    </div>

    <script>
        function marcarTodasComoLeidas() {
            axios.post('{{ route('notificaciones.marcarTodasComoLeidas') }}')
                .then(response => {
                    location.reload();
                })
                .catch(error => {
                    console.error('Error marcando todas como leídas:', error);
                });
        }

        function marcarNotificacionLeida(notificationId) {
            axios.post('{{ route('notificaciones.marcarComoLeida', '') }}/' + notificationId)
                .then(response => {
                    location.reload();
                })
                .catch(error => {
                    console.error('Error marcando notificación como leída:', error);
                });
        }
    </script>
</x-app-layout>
