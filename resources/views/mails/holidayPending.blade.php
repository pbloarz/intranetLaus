@extends('layouts.layoutsEmail')
@section('content')
<div class="container">
    <div class="header">
        <h1>Solicitud de Vacaciones</h1>
    </div>
    
    <div class="content">
        <div class="info-box">
            <h2>Nueva Solicitud de Vacaciones</h2>
            <p>Se ha recibido una nueva solicitud de vacaciones con los siguientes detalles:</p>
        </div>

        <div class="employee-info">
            <p><strong>Empleado:</strong> {{ $data['name'] }}</p>
            <p><strong>Correo electrónico:</strong> {{ $data['email'] }}</p>
        </div>

        <div class="date">
            <strong>Fecha solicitada:</strong><br>
            {{ $data['day'] }}
        </div>

        <p>Por favor, revise esta solicitud y tome las acciones correspondientes.</p>
    </div>

    <div class="footer">
        <p>Este es un correo automático, por favor no responda a este mensaje.</p>
        <p>&copy; {{ date('Y') }} Intranet Laus. Todos los derechos reservados.</p>
    </div>
</div>
@endsection