@extends('admin.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Add Emplyee Data</h6>
                <form name="employeeForm" id="employeeForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <p></p>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control" id="department" name="department">
                        <p></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{route('employees.index')}}" class="btn btn-danger">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<script>

$("#employeeForm").submit(function(event){
        event.preventDefault();

        $("button[type=submit]").prop('disabled',true);
        jQuery.ajax({
            url:"{{route('employees.store')}}",
            type:'post',
            data: jQuery('#employeeForm').serializeArray(),
            dataType:'json',
            success:function(response){
                $("button[type=submit]").prop('disabled',false);
                if(response["status"]== true)
                {
                    window.location.href="{{route('employees.index')}}";
                    $("#name").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");

                    $("#department").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");


                }else{
                    var errors = response['errors'];
                if(errors['name'])
                {
                    $("#name").addClass('is-invalid').siblings('p')
                    .addClass('invalid-feedback').html(errors['name']);
                }else{
                    $("#name").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                    
                }

                if(errors['department'])
                {
                    $("#department").addClass('is-invalid').siblings('p')
                    .addClass('invalid-feedback').html(errors['department']);
                }else{
                    $("#department").removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html("");
                    
                }
                }
                

            }, error : function(jqXHR , exception){
                console.log("something went wrong");
            }
        })
    });

</script>

@endsection
