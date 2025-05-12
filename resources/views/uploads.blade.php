<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CSV Uploads – YoPrint</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: sans-serif; padding: 2rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 2rem; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f0f0f0; }
        .status-pending { color: orange; font-weight: bold; }
        .status-processing { color: blue; font-weight: bold; }
        .status-completed { color: green; font-weight: bold; }
        .status-failed { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h1>📄 Upload CSV File</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form method="POST" action="/upload" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv" required>
        <button type="submit">Upload</button>
    </form>

    <h2>📊 Upload History</h2>

    <table id="upload-table">
        <thead>
            <tr>
                <th>File Name</th>
                <th>Uploaded At</th>
                <th>Status</th>
                <th>Completed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uploads as $upload)
                <tr>
                    <td>{{ basename($upload->filename) }}</td>
                    <td>{{ $upload->uploaded_at }}</td>
                    <td class="status-{{ $upload->status }}">{{ ucfirst($upload->status) }}</td>
                    <td>{{ $upload->completed_at ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        setInterval(() => {
            fetch(window.location.href)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newTable = doc.querySelector('#upload-table');
                    document.querySelector('#upload-table').innerHTML = newTable.innerHTML;
                });
        }, 5000); // auto-refresh every 5 seconds
    </script>
</body>
</html>
