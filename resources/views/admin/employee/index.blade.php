@extends('admin.layout.app')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Employees</h6>
            <a href="{{route('employees.create')}}">Add New +</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($employees->isNotEmpty())
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->department}}</td>
                        <td>
                            <a href="{{route('employees.edit',$employee->id)}}"><i class="bi bi-pen"></i></a>
                            <a href="#" onclick="DeleteEmployee({{$employee->id}})" class="text-danger"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3">No record found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('custom_js')

<script>
    function DeleteEmployee(id){
        var url = '{{route("employees.destroy","ID")}}';
        var newurl = url.replace("ID",id);
        if(confirm("are you sure to you want delete this data?")){
        jQuery.ajax({
            url: newurl ,
            type:'delete',
            data: {},
            dataType:'json',
            headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
            success:function(response){
                window.location.href="{{route('employees.index')}}";
                
            }
        });
    }
    }

</script>

@endsection