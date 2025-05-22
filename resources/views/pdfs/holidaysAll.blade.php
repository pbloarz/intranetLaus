<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Vacaciones</title>
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
        .admin-info {
            background: #f8f9fa;
            padding: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #3498db;
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
        .status-pending {
            color: #f39c12;
            font-weight: bold;
        }
        .status-approved {
            color: #27ae60;
            font-weight: bold;
        }
        .status-rejected {
            color: #c0392b;
            font-weight: bold;
        }
        .summary-box {
            background: #3498db;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte General de Vacaciones</h1>
        <p>Generado el {{ \Carbon\Carbon::now()->locale('es')->isoFormat('DD [de] MMMM [del] YYYY') }}</p>
    </div>

    <div class="admin-info">
        <p><strong>Generado por:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Cargo:</strong> Administrador</p>
    </div>

    <div class="summary-box">
        <h3>Resumen de Solicitudes</h3>
        <p>Total de Solicitudes: {{ $holidays->count() }}</p>
        <p>Pendientes: {{ $holidays->where('type', 'pending')->count() }}</p>
        <p>Aprobadas: {{ $holidays->where('type', 'approved')->count() }}</p>
        <p>Rechazadas: {{ $holidays->where('type', 'rejected')->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Departamento</th>
                <th>Fecha Solicitada</th>
                <th>Fecha de Solicitud</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($holidays as $holiday)
            <tr>
                <td>{{ $holiday->user->name }}</td>
                <td>{{ $holiday->user?->departament?->name ?? '' }}</td>
                <td>{{ \Carbon\Carbon::parse($holiday->day)->locale('es')->isoFormat('DD [de] MMMM [del] YYYY') }}</td>
                <td>{{ \Carbon\Carbon::parse($holiday->created_at)->locale('es')->isoFormat('DD [de] MMMM [del] YYYY') }}</td>
                <td class="status-{{ $holiday->type }}">
                    {{ ucfirst($holiday->type) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        <p>Este reporte fue generado automáticamente por el sistema de gestión de vacaciones.</p>
        <p>Fecha y hora de generación: {{ \Carbon\Carbon::now()->locale('es')->isoFormat('DD [de] MMMM [del] YYYY [a las] HH:mm:ss') }}</p>
    </footer>
</body>
</html>