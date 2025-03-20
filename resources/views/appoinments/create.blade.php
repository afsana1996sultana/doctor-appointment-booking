<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Appointment</title>
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
                <h2 class="mb-4">Add New Appointment</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="doctor_id" class="form-label">Doctor Name</label>
                        <select name="doctor_id" id="doctor_id" class="form-control" required>
                            <option value="">Select Doctor</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->doctor_id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="patient_id" class="form-label">Patient Name</label>
                        <input type="text" name="patient_id" id="patient_id" class="form-control" value="{{ old('patient_id') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Consultation Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="time_slot" class="form-label">Time Slot</label>
                        <select name="time_slot" id="time_slot" class="form-control" required>
                            <option value="">Select Time Slot</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Appointment Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Pending</option>
                            <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Confirmed</option>
                            <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Book Appointment</button>
                    <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Listen for changes to the doctor_id select
        document.getElementById('doctor_id').addEventListener('change', function() {
            var doctorId = this.value;
            var timeSlotSelect = document.getElementById('time_slot');

            // Clear the time_slot dropdown before populating it
            timeSlotSelect.innerHTML = '<option value="">Select Time Slot</option>';

            // If a doctor is selected
            if (doctorId) {
                // Make an AJAX request to get the time slots
                fetch('/appointments/time-slots/' + doctorId)
                    .then(response => response.json())
                    .then(data => {
                        // If time slots are available, populate the time_slot dropdown
                        if (data.length > 0) {
                            data.forEach(function(item) {
                                var option = document.createElement('option');
                                option.value = item.time_slot;
                                option.textContent = item.time_slot;
                                timeSlotSelect.appendChild(option);
                            });
                        } else {
                            // If no time slots, inform the user
                            var option = document.createElement('option');
                            option.value = '';
                            option.textContent = 'No available time slots';
                            timeSlotSelect.appendChild(option);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching time slots:', error);
                    });
            }
        });
    </script>
</body>
</html>
