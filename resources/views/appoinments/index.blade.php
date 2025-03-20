<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Appointment List</h2>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">Add New Appointment</a>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Consult Date</th>
                    <th>Time Slot</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($appoinments as $appoinment)
                    <tr>
                        <td>{{ $appoinment->id }}</td>
                        <td>{{ $appoinment->patient_id }}</td>
                        <td>
                            <!-- Ensure the doctorAvailabilities exists before accessing the doctor_id -->
                            @if ($appoinment->doctorAvailabilities)
                                {{ $appoinment->doctorAvailabilities->doctor_id }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $appoinment->date }}</td>
                        <td>{{ \Carbon\Carbon::parse($appoinment->time_slot)->format('g:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Appointment found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
