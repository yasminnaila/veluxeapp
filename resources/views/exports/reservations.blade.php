<!DOCTYPE html>
<html>
<head>
    <title>Reservations</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Reservations</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Penyewa</th>
                <th>Nama Kamar</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->guests->name }}</td>
                    <td>{{ $reservation->room->name }}</td>
                    <td>{{ $reservation->check_in }}</td>
                    <td>{{ $reservation->check_out }}</td>
                    <td>{{ $reservation->room->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
