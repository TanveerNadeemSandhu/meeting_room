<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meetings Table</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-10">
    <h2>Meetings Table</h2>
        </div>
        <div class="col-md-2">

        <a href="{{route('welcome')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Organizer</th>
                    <th scope="col">Date</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Participant</th>
                </tr>
            </thead>
            <tbody>
                @if($meetings->isNotEmpty())
                @foreach($meetings as $meeting)
                <tr>
                    <td>{{$meeting->title}}</td>
                    <td>{{$meeting->organizer}}</td>
                    <td>{{ \Carbon\Carbon::parse($meeting->date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($meeting->start_time)->format('h:i A') }}</td>
                    <td>{{ \Carbon\Carbon::parse($meeting->end_time)->format('h:i A') }}</td>
                    <td>{{$meeting->participants}}</td>
                </tr>
                @endforeach

                @else
                <tr>
                    <td colspan="6">No Meeting Available</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap 5 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl4R1hHlfxpTWQsdUczU/94pfbrr+fys/TPLqu/U6YlIZ8LGmZ+wejDgiVX" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
