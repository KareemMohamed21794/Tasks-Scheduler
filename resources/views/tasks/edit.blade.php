@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">{{ __('Edit Tasks Scheduler') }}</div>
                <div class="card-body">

                	{!!Form::open(["url"=>"tasks/$objTask->id","method"=>"PATCH","id"=>"form_sample_3","files"=>"true"])!!}
					  <div class="mb-3">
					    <label for="exampleInputEmail1">Task Name</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" name="name"  value="{{$objTask->name}}">
					    @error('name')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
					  </div>
					  <div class="mb-3">
					    <label for="exampleInputPassword1">Task Url</label>
					    <input type="url" class="form-control" id="exampleInputPassword1" name="task_url"  value="{{$objTask->task_url}}">
					    @error('task_url')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
					  </div>

					    <div class="mb-3">
			               <label for="exampleFormControlSelect1">Select Scheduler</label>
					       <select class="form-control"  name="task_scheduler" id="task_scheduler" onchange="SelectScheduler(this.value)">
						      	<option value="0">select scheduler</option>
						      	<option {{$objTask->task_scheduler == 'everyMinute' ? 'selected' : ""}} value="everyMinute">everyMinute</option>
						      	<option {{$objTask->task_scheduler == 'everyFiveMinutes' ? 'selected' : ""}} value="everyFiveMinutes">everyFiveMinutes</option>
						      	<option {{$objTask->task_scheduler == 'everyTenMinutes' ? 'selected' : ""}} value="everyTenMinutes">everyTenMinutes</option>
						      	<option {{$objTask->task_scheduler == 'everyFifteenMinutes' ? 'selected' : ""}} value="everyFifteenMinutes">everyFifteenMinutes</option>
						      	<option {{$objTask->task_scheduler == 'everyThirtyMinutes' ? 'selected' : ""}} value="everyThirtyMinutes">everyThirtyMinutes</option>
						      	<option {{$objTask->task_scheduler == 'hourly' ? 'selected' : ""}} value="hourly">hourly</option>
						      	<option {{$objTask->task_scheduler == 'hourlyAt' ? 'selected' : ""}} value="hourlyAt">hourlyAt</option>
						      	<option {{$objTask->task_scheduler == 'daily' ? 'selected' : ""}} value="daily">daily</option>
						      	<option {{$objTask->task_scheduler == 'dailyAt' ? 'selected' : ""}} value="dailyAt">dailyAt</option>
  
						    </select>
						     @error('task_scheduler')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
					  </div>
                      

                       <div class="mb-3" id="every_minute_at">
					    <label for="exampleInputPassword1">Every Minute at</label>
					    <input type="number" class="form-control" max="59" min="0" name="minute" id="minute"  value="{{$objTask->minute}}">
					    @error('minute')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
					  </div>

					


					   <div class="mb-3" id="every_hour_at">
			               <label for="exampleFormControlSelect1">Every Hour at</label>
			               <input type="time" class="form-control" id="exampleInputEmail1" name="hour" id="hour"  value="{{$objTask->hour}}">
					     
					  </div>
					  
					  <button type="submit" class="btn btn-primary">Submit</button> 

					  <a href="{{url('tasks')}}"><button type="button" class="btn btn-info">Return back</button></a>
					
					</form>
                  
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

	$( document ).ready(function() {
		var task_scheduler = $('#task_scheduler').val();
        
	  if(task_scheduler == 'hourlyAt'){
			$( "#every_minute_at" ).show();
			$( "#every_hour_at" ).hide();
		}else if(task_scheduler == 'dailyAt'){
			$( "#every_minute_at" ).hide();
			$( "#every_hour_at" ).show();
		}else{
			$( "#every_minute_at" ).hide();
	        $( "#every_hour_at" ).hide();
		}
	});

	function SelectScheduler(value) {

		if(value == 'hourlyAt'){
			$( "#every_minute_at" ).show();
			$( "#every_hour_at" ).hide();
		}else if(value == 'dailyAt'){
			$( "#every_minute_at" ).hide();
			$( "#every_hour_at" ).show();
		}else{
			$( "#every_minute_at" ).hide();
	        $( "#every_hour_at" ).hide();
	      
		}
	}
</script>
@endsection
