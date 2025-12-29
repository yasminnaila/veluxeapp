<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activity Logs</title>
    <style>
      body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
      table { width: 100%; border-collapse: collapse; }
      th, td { border: 1px solid #ddd; padding: 8px; }
      th { background: #f4f4f4; text-align: left; }
    </style>
  </head>
  <body>
    <h2>Activity Logs</h2>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Event</th>
          <th>Description</th>
          <th>IP</th>
          <th>Agent</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
        @foreach($logs as $log)
        <tr>
          <td>{{ $log->id }}</td>
          <td>{{ $log->username ?? $log->user_id }}</td>
          <td>{{ $log->event }}</td>
          <td>{{ $log->description }}</td>
          <td>{{ $log->ip_address }}</td>
          <td style="max-width:200px;">{{ Str::limit($log->user_agent, 100) }}</td>
          <td>{{ $log->created_at }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Activity Logs</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        h2 { margin: 0 0 10px 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; vertical-align: top; }
        th { background: #f2f2f2; }
        .small { font-size: 10px; }
    </style>
</head>
<body>
    <h2>Laporan Activity Logs</h2>
    <div class="small">Dicetak: {{ now()->format('Y-m-d H:i:s') }}</div>
    <br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Event</th>
                <th>Deskripsi</th>
                <th>IP</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->username ?? '-' }}</td>
                    <td>{{ $log->event }}</td>
                    <td>{{ $log->description ?? '-' }}</td>
                    <td>{{ $log->ip_address ?? '-' }}</td>
                    <td>{{ optional($log->created_at)->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
