@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	
            <div class="row justify-content-center">
                <div class="card-header"> <a href="{{url('tasks/create')}}"><button type="button" class="btn btn-primary">{{ __('Add Tasks Scheduler') }}</button></a></div>
                @if(count($arrTask) > 0)
                <div class="col-md-12">
                   <table class="table table-hover">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">enable / disable</th>
					      <th scope="col">Task Name</th>
					      <th scope="col">URL</th>
					      <th scope="col">EDIT</th>
					      <th scope="col">DELETE</th>
					      <th scope="col">Task History</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($arrTask as $key=> $objTask)
					    <tr>
					      <th scope="row">{{$key+1}}</th>
					      <td>
					      	<div class="form-check form-switch">
							  <input class="form-check-input" type="checkbox" id="radio_button" {{$objTask->status == 1 ? "checked" : ""}} onchange="Enable_Disable({{$objTask->id}})">
							 
							</div>
                      </td>
					      <td>{{$objTask->name}}</td>
					      <td>{{$objTask->task_url}}</td>
					      <td><a href="{{ route('tasks.edit', $objTask->id) }}"><button type="button" class="btn btn-info">Edit</button></a></td>
					      <td>
		                    {!!Form::open(["url"=>"tasks/$objTask->id","method"=>"DELETE","onclick"=>"return confirm('Are U Sure To Delete !!')"])!!}
		                    <button type="submit" class="btn btn-danger">Delete</button>
		                    {!! Form::close() !!}
		                  </td>

		                  <td ><a href="{{ url('task_history') }}/{{$objTask->id}}"><button type="button" class="btn btn-primary">History</button></a></td>

					    </tr>
					    @endforeach
					  </tbody>
					</table>
                </div>
                @else
                <div class="card-body">
                 <div class="card-header" style="text-align: center;font-size:20px;font-weight: bold;"> {{ __('No data') }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
	function Enable_Disable(task_id) {

		
		var url = "<?php echo url(''); ?>";
		if($('#radio_button').is(':checked')){
            var status = 1;
		}else{
			var status = 0;
		}

		if(status == 1){
			var response = confirm("Are you sure you want to Enable Task?");
		}else if(status == 0){
			var response = confirm("Are you sure you want to Disable Task?");
			
		}
		

		if (response) {
		    // add code if the user pressed the Ok button
		    console.log("Ok was pressed");
		} else {
		    // add code if the user pressed the Cancel button
		    if(status == 0){
				$("#radio_button").prop( "checked", true );
			}else if(status == 1){
				$("#radio_button").prop( "checked", false );
			}
		    console.log("Cancel was pressed");
		    console.log(status);
		    return false;
		}


		$.ajax({
		    type: "GET",
		    url: url+'/update_status_task',
		    data: {status: status,task_id:task_id},
		    headers: {
    		'X-CSRF-TOKEN': $('meta[name_1="csrf-token"]').attr('content')
  			},
	 	    success: function( data ) {
	 	    	
	 	    	data = jQuery.parseJSON(data);
	 	    	console.log(data);
	 	    	
		    }
		});
	}
</script>
@endsection
