<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container.mt-4.card {
            padding: 16px;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-10 offset-1">
            <div class="container mt-4 card">
                <h2 class="mb-4">Add New Doctor</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('doctors.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="doctor_id" class="form-label">Doctor Name</label>
                        <input type="text" name="doctor_id" id="doctor_id" class="form-control" value="{{ old('doctor_id') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Consultation Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="time_slot" class="form-label">Time Slot</label>
                        <input type="time" name="time_slot" id="time_slot" class="form-control" value="{{ old('time_slot') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Doctor</button>
                    <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
