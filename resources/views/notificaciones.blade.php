<x-app-layout>
    <div class="container">
        <h1>Todas las notificaciones</h1>
        <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            onclick="marcarTodasComoLeidas()">
            Marcar todas como leídas
        </button>
        @foreach ($notifications as $notification)
            <a href="{{ getNotificationLink($notification) }}"
                class="py-2 px-4 flex items-center hover:bg-gray-50 group {{ $notification->read_at ? 'bg-gray-200' : 'bg-white' }}"
                onclick="marcarNotificacionLeida('{{ $notification->id }}')">
                <div class="ml-2">
                    <div class="text-[10px] text-gray-600 font-medium truncate">
                        {{ getNotificationTitle($notification) }}
                    </div>
                    <div class="text-[11px] text-gray-500">
                        {{ getNotificationMessage($notification) }}
                    </div>
                </div>
            </a>
        @endforeach
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

        function getNotificationLink(notification) {
            switch (notification.data.type) {
                case 'entrevista':
                    return '{{ route('entrevistas.visualizar', '') }}/' + notification.data.entrevista_id;
                case 'contrato':
                    return '{{ route('generarContratoPDF', '') }}/' + notification.data.postulante_id;
                case 'permisonuevo':
                case 'permisoaceptado':
                case 'permisorechazado':
                    return '{{ route('permisos.historial') }}';
                default:
                    return '#';
            }
        }

        function getNotificationTitle(notification) {
            switch (notification.data.type) {
                case 'entrevista':
                    return 'Tienes una entrevista';
                case 'contrato':
                    return 'Felicidades!';
                case 'permisonuevo':
                    return 'Nueva Solicitud de Permiso';
                case 'permisoaceptado':
                    return 'Permiso Aceptado!';
                case 'permisorechazado':
                    return 'Permiso Rechazado!';
                default:
                    return 'Notificación';
            }
        }

        function getNotificationMessage(notification) {
            switch (notification.data.type) {
                case 'entrevista':
                    return notification.data.fecha_inicio + ' a las ' + notification.data.hora;
                case 'contrato':
                    return 'Has sido seleccionado para el puesto al que postulaste. Revisa los detalles del precontrato.';
                case 'permisonuevo':
                    return 'El usuario ' + notification.notifiable.name + ' ha solicitado un nuevo permiso. Desde: ' +
                        notification.data.fecha_inicio + ' Hasta: ' + notification.data.fecha_fin;
                case 'permisoaceptado':
                    return 'El permiso que solicitaste ha sido aceptado.';
                case 'permisorechazado':
                    return 'El permiso que solicitaste ha sido rechazado.';
                default:
                    return '';
            }
        }
    </script>
</x-app-layout>
