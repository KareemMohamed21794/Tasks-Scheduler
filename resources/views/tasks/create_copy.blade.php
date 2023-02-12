@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">{{ __('Create Tasks Scheduler') }}</div>
                <div class="card-body">

                	{!! Form::open(['url' => 'tasks' , 'files' => true]) !!}
					  <div class="form-group">
					    <label for="exampleInputEmail1">Task Name</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" name="name" required value="{{old('name')}}">
					    @error('name')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Task Url</label>
					    <input type="url" class="form-control" id="exampleInputPassword1" name="task_url" required value="{{old('task_url')}}">
					    @error('task_url')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
					  </div>

					   <div class="form-group">
			               <label for="exampleFormControlSelect1">Every Minute at</label>
					       <select class="form-control" id="exampleFormControlSelect1" name="minute" id="minute" >
						      	<option value="0">select minute</option>
						        @php
						        for($i = 1; $i < 60; $i++){
                                echo "<option>" . $i . "</option>";
						        	
						         }
						        @endphp
						    </select>
					  </div>


					   <div class="form-group">
			               <label for="exampleFormControlSelect1">Every Hour at</label>
					       <select class="form-control" id="exampleFormControlSelect1" name="hour" id="hour" >
						      	<option value="0">select hour</option>
						        @php
						        for($i = 1; $i < 24; $i++){
                                echo "<option>" . $i . "</option>";
						        	
						         }
						        @endphp
						    </select>
					  </div>

					   <div class="form-group">
			               <label for="exampleFormControlSelect1">Every Day Of Month at</label>
					       <select class="form-control" id="exampleFormControlSelect1" name="day_month" id="day_month" >
						      	<option value="0">select day of month</option>
						        @php
						        for($i = 1; $i <= 31; $i++){
                                echo "<option>" . $i . "</option>";
						        	
						         }
						        @endphp
						    </select>
					  </div>

					   <div class="form-group">
			               <label for="exampleFormControlSelect1">Every  Month at</label>
					       <select class="form-control" id="exampleFormControlSelect1" name="month" id="month" >
						      	<option value="0">select month</option>
						        @php
						        for($i = 1; $i <= 12; $i++){
                                echo "<option>" . $i . "</option>";
						        	
						         }
						        @endphp
						    </select>
					  </div>

					   <div class="form-group">
			               <label for="exampleFormControlSelect1">Every Day Of Week at</label>
					       <select class="form-control" id="exampleFormControlSelect1" name="day_week" id="day_week" >
						      	<option value="0">select day of week</option>
						        @php
						        for($i = 1; $i <= 7; $i++){
                                echo "<option>" . $i . "</option>";
						        	
						         }
						        @endphp
						    </select>
					  </div>
					  
					  <button type="submit" class="btn btn-primary">Submit</button> 

					  <a href="{{url('tasks')}}"><button type="button" class="btn btn-info">Return back</button></a>
					
					</form>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
