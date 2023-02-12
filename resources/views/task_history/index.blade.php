@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	@if (\Session::has('success'))
				<div class="alert alert-success">
			        <ul>
			            <li>{!! \Session::get('success') !!}</li>
			        </ul>
				</div>
		    @endif

		  
            <div class="card">
                <div class="card-header"> {{ __(' Task History') }}</div>
                
                <div class="card-body">
                   <table class="table">
					  <thead>
					    <tr>
					      <th scope="col">ID</th>
					     
					      <th scope="col">Response</th>
					      <th scope="col">Task Date</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($arrTaskHistory as $key=> $objTaskHistory)
					    <tr>
					      <th scope="row">{{$objTaskHistory->id}}</th>
					    
					      <td>{{$objTaskHistory->response}}</td>
					      <td>{{$objTaskHistory->date}}</td>
					      

					    </tr>
					    @endforeach
					  </tbody>
					</table>
					<a href="{{url('tasks')}}"><button type="button" class="btn btn-info">Return back</button></a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
