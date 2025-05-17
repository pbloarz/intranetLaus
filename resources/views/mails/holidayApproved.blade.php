@extends('layouts.layoutsEmail')
@section('content')
<div class="container">
    <div class="header">
        <h1>¡Solicitud de Vacaciones Aprobada!</h1>
    </div>

    <div class="content">
        <div class="info-box">
            <h2>¡Buenas noticias!</h2>
            <p>Tu solicitud de vacaciones ha sido aprobada.</p>
        </div>

        <div class="message">
            <p>Hola {{ $data['name'] }},</p>
            <p>Nos complace informarte que tu solicitud de vacaciones ha sido aprobada.</p>
        </div>

        <div class="date">
            <strong>Fecha aprobada:</strong><br>
            {{ $data['day'] }}
        </div>

        <p>Por favor, asegúrate de coordinar la entrega de pendientes antes de iniciar tu periodo de vacaciones.</p>
    </div>

    <div class="footer">
        <p>Este es un correo automático, por favor no responda a este mensaje.</p>
        <p>&copy; {{ date('Y') }} Intranet Laus. Todos los derechos reservados.</p>
    </div>
</div>
@endsection