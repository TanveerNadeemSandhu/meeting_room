<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Form</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
<div class="container mt-5">
    <h2>Create Event</h2>
    <form name="meetingForm" id="meetingForm">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" >
            <p></p>
        </div>
        <div class="mb-3">
            <label for="organizer" class="form-label">Organizer</label>
            <input type="text" class="form-control" id="organizer" name="organizer" >
            <p></p>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" >
            <p></p>
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" class="form-control" id="start_time" name="start_time" >
            <p></p>
        </div>
        <input type="hidden" class="form-control" id="slot" name="slot" >
            <p></p>
        <div class="mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="time" class="form-control" id="end_time" name="end_time" >
            <p></p>
        </div>
        <div class="mb-3">
            <label for="participant" class="form-label">Participant</label>
            <select class="form-control" name="participant[]" id="participant" multiple>
                <option value="">Select Participant</option>
                @foreach($employees as $employee)
                <option value="{{$employee->name}}">{{$employee->name}}</option>
                @endforeach
            </select>
            <p></p>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('welcome')}}" class="btn btn-danger">Back</a>
    </form>
</div>

<!-- Bootstrap 5 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl4R1hHlfxpTWQsdUczU/94pfbrr+fys/TPLqu/U6YlIZ8LGmZ+wejDgiVX" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<script>

$("#meetingForm").submit(function(event){
        event.preventDefault();

        $("button[type=submit]").prop('disabled',true);
        jQuery.ajax({
            url:"{{route('meeting.store')}}",
            type:'post',
            data: jQuery('#meetingForm').serializeArray(),
            dataType:'json',
            success:function(response){
                $("button[type=submit]").prop('disabled',false);
                if(response["status"]== true)
                {
                    window.location.href="{{route('meeting.index')}}";
                    $("#title").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");

                    $("#organizer").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");

                    $("#date").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");

                    $("#start_time").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                    
                    $("#end_time").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");

                    $("#participant").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");


                }else{
                    var errors = response['errors'];

                    if(errors['slot'])
                {
                    $("#slot").addClass('is-invalid').siblings('p')
                    .addClass('invalid-feedback').html(errors['slot']);
                }else{
                    $("#slot").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                    
                }

                if(errors['title'])
                {
                    $("#title").addClass('is-invalid').siblings('p')
                    .addClass('invalid-feedback').html(errors['title']);
                }else{
                    $("#title").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                    
                }

                if(errors['organizer'])
                {
                    $("#organizer").addClass('is-invalid').siblings('p')
                    .addClass('invalid-feedback').html(errors['organizer']);
                }else{
                    $("#organizer").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                    
                }

                if(errors['date'])
                {
                    $("#date").addClass('is-invalid').siblings('p')
                    .addClass('invalid-feedback').html(errors['date']);
                }else{
                    $("#date").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                    
                }
                if(errors['start_time'])
                {
                    $("#start_time").addClass('is-invalid').siblings('p')
                    .addClass('invalid-feedback').html(errors['start_time']);
                }else{
                    $("#start_time").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                    
                }
                if(errors['end_time'])
                {
                    $("#end_time").addClass('is-invalid').siblings('p')
                    .addClass('invalid-feedback').html(errors['end_time']);
                }else{
                    $("#end_time").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                    
                }
                if(errors['participant'])
                {
                    $("#participant").addClass('is-invalid').siblings('p')
                    .addClass('invalid-feedback').html(errors['participant']);
                }else{
                    $("#participant").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                    
                }


                }
                

            }, error : function(jqXHR , exception){
                console.log("something went wrong");
            }
        })
    });

</script>
</body>
</html>
