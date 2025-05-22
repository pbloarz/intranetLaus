<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Tiempo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 15px;
            font-size: 11px;
            color: #333;
        }
        .header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background: #34495e;
            color: white;
            padding: 8px;
            text-align: left;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }
        .stat-box {
            background: #3498db;
            color: white;
            padding: 10px;
            text-align: center;
            flex: 1;
            margin: 0 5px;
        }
        .signature-section {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .signature-line {
            text-align: center;
            border-top: 1px solid #333;
            padding-top: 5px;
            width: 200px;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Tiempo Trabajado</h1>
        <p>{{ \Carbon\Carbon::now()->startOfMonth()->format('d/m/Y') }} - {{ \Carbon\Carbon::now()->endOfMonth()->format('d/m/Y') }}</p>
    </div>

    <table>
        <tr>
            <th colspan="4">Información del Empleado</th>
        </tr>
        <tr>
            <td><strong>Nombre:</strong> {{ $user->name }}</td>
            <td><strong>ID:</strong> {{ $user->id }}</td>
            <td><strong>Email:</strong> {{ $user->email }}</td>
            <td><strong>Teléfono:</strong> {{ $user->phone }}</td>
        </tr>
        <tr>
            <td><strong>País:</strong> {{ \App\Models\Country::find($user->country_id)?->name }}</td>
            <td><strong>Estado:</strong> {{ \App\Models\State::find($user->state_id)?->name }}</td>
            <td><strong>Ciudad:</strong> {{ \App\Models\City::find($user->city_id)?->name }}</td>
            <td><strong>Dirección:</strong> {{ $user->address }}</td>
        </tr>
    </table>

    <div class="stats">
        <div class="stat-box">
            <h4>Días Trabajados</h4>
            <p>{{ $timesheets->count() }}</p>
        </div>
        <div class="stat-box">
            <h4>Total Horas</h4>
            <p>
                @php
                    $totalSeconds = $timesheets->sum(function($t) {
                        return \Carbon\Carbon::parse($t->day_in)->diffInSeconds(\Carbon\Carbon::parse($t->day_out));
                    });
                    $hours = floor($totalSeconds / 3600);
                    $minutes = floor(($totalSeconds % 3600) / 60);
                    $seconds = $totalSeconds % 60;
                @endphp
                {{ sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) }}
            </p>
        </div>
        <div class="stat-box">
            <h4>Promedio por Día</h4>
            <p>
                @php
                    $avgSeconds = $timesheets->count() ? ($totalSeconds / $timesheets->count()) : 0;
                    $avgHours = floor($avgSeconds / 3600);
                    $avgMinutes = floor(($avgSeconds % 3600) / 60);
                    $avgSeconds = floor($avgSeconds % 60);
                @endphp
                {{ sprintf('%02d:%02d:%02d', $avgHours, $avgMinutes, $avgSeconds) }}
            </p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Día</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Tipo</th>
                <th>Tiempo Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($timesheets->sortBy('day_in') as $t)
            <tr>
                <td>{{ \Carbon\Carbon::parse($t->day_in)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($t->day_in)->locale('es')->isoFormat('dddd') }}</td>
                <td>{{ \Carbon\Carbon::parse($t->day_in)->format('H:i:s') }}</td>
                <td>{{ \Carbon\Carbon::parse($t->day_out)->format('H:i:s') }}</td>
                <td>{{ ucfirst($t->type) }}</td>
                <td>
                    @php
                        $seconds = \Carbon\Carbon::parse($t->day_in)->diffInSeconds(\Carbon\Carbon::parse($t->day_out));
                        $hours = floor($seconds / 3600);
                        $minutes = floor(($seconds % 3600) / 60);
                        $seconds = $seconds % 60;
                    @endphp
                    {{ sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-line">
            <p>Firma del Empleado</p>
            <p>{{ $user->name }}</p>
        </div>
        <div class="signature-line">
            <p>Firma del Supervisor</p>
            <p>_____________________</p>
        </div>
    </div>

    <footer>
        <p>Generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
        <p>Este documento es oficial de la empresa</p>
    </footer>
</body>
</html>