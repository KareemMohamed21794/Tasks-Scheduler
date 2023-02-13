@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">{{ __('Create Tasks Scheduler') }}</div>
                <div class="card-body">

                	{!! Form::open(['url' => 'tasks' , 'files' => true]) !!}
					  <div class="mb-3">
					    <label for="exampleInputEmail1">Task Name</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" name="name" required value="{{old('name')}}">
					    @error('name')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
					  </div>
					  <div class="mb-3">
					    <label for="exampleInputPassword1">Task Url</label>
					    <input type="url" class="form-control" id="exampleInputPassword1" name="task_url" required value="{{old('task_url')}}">
					    @error('task_url')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
					  </div>

					  <div class="mb-3">
			               <label for="exampleFormControlSelect1">Select Scheduler</label>
					       <select class="form-control" id="exampleFormControlSelect1" name="task_scheduler" id="task_scheduler" onchange="SelectScheduler(this.value)">
						      	<option value="0">select scheduler</option>
						      	<option value="everyMinute">everyMinute</option>
						      	<option value="everyFiveMinutes">everyFiveMinutes</option>
						      	<option value="everyTenMinutes">everyTenMinutes</option>
						      	<option value="everyFifteenMinutes">everyFifteenMinutes</option>
						      	<option value="everyThirtyMinutes">everyThirtyMinutes</option>
						      	<option value="hourly">hourly</option>
						      	<option value="hourlyAt">hourlyAt</option>
						      	<option value="daily">daily</option>
						      	<option value="dailyAt">dailyAt</option>
  
						    </select>
						    @error('task_scheduler')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
					  </div>
                      
					   <div class="mb-3" id="every_minute_at">
					    <label for="exampleInputPassword1">Every Minute at</label>
					    <input type="number" class="form-control" max="59" min="0" name="minute" id="minute"  value="{{old('minute')}}">
					    @error('minute')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
					  </div>


					


					   <div class="mb-3" id="every_hour_at">
			               <label for="exampleFormControlSelect1">Every Hour at</label>
			               <input type="time" class="form-control" id="exampleInputEmail1" name="hour"  value="{{old('hour')}}">
					     
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
	   $( "#every_minute_at" ).hide();
	   $( "#every_hour_at" ).hide();
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
