<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Doctors List</h2>
        <a href="{{ route('doctors.create') }}" class="btn btn-primary mb-3">Add New Doctor</a>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Doctor Name</th>
                    <th>Consult Date</th>
                    <th>Time Slot</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($doctors_availabilities as $doctor)
                    <tr>
                        <td>{{ $doctor->id }}</td>
                        <td>{{ $doctor->doctor_id }}</td>
                        <td>{{ $doctor->date }}</td>
                        <td>{{ \Carbon\Carbon::parse($doctor->time_slot)->format('g:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No doctors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
