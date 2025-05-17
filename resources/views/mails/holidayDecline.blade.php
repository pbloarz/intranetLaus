@extends('layouts.layoutsEmail')
@section('content')
<div class="container">
    <div class="header">
        <h1>Solicitud de Vacaciones Rechazada</h1>
    </div>
    
    <div class="content">
        <div class="info-box">
            <h2>Notificación Importante</h2>
            <p>Lamentamos informarte que tu solicitud de vacaciones ha sido rechazada.</p>
        </div>

        <div class="message">
            <p>Hola {{ $data['name'] }},</p>
            <p>Tu solicitud de vacaciones ha sido revisada y no ha sido aprobada en esta ocasión.</p>
        </div>

        <div class="date">
            <strong>Fecha solicitada:</strong><br>
            {{ $data['day'] }}
        </div>

        <p>Por favor, contacta con tu supervisor para más información o para programar una fecha alternativa.</p>
    </div>

    <div class="footer">
        <p>Este es un correo automático, por favor no responda a este mensaje.</p>
        <p>&copy; {{ date('Y') }} Intranet Laus. Todos los derechos reservados.</p>
    </div>
</div>
@endsection
