<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Solicitud de Vacaciones</title>
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
        .info-section {
            margin-bottom: 20px;
        }
        .holiday-details {
            margin-top: 30px;
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
        <h1>Solicitud de Vacaciones</h1>
    </div>

    <table>
        <tr>
            <th colspan="4">Información del Empleado</th>
        </tr>
        <tr>
            <td><strong>Nombre:</strong> {{ $user->name }}</td>
            <td><strong>Email:</strong> {{ $user->email }}</td>
            <td><strong>Teléfono:</strong> {{ $user->phone }}</td>
            <td><strong>Dirección:</strong> {{ $user->address }}</td>
        </tr>
        <tr>
            <td colspan="4"><strong>Departamento:</strong> {{ $user->departament->name }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Fecha de Solicitud</th>
                <th>Fecha de Vacaciones</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ \Carbon\Carbon::parse($holiday->created_at)->locale('es')->isoFormat('DD, MMMM YYYY') }}</td>
                <td>{{ \Carbon\Carbon::parse($holiday->day)->locale('es')->isoFormat('DD, MMMM YYYY') }}</td>
                <td>{{ ucfirst($holiday->type) }}</td>
            </tr>
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
        <p>Generado el {{ \Carbon\Carbon::now()->locale('es')->isoFormat('DD [de] MMMM [del] YYYY [a las] HH:mm:ss') }}</p>
        <p>Este documento es oficial de la empresa</p>
    </footer>
</body>
</html>