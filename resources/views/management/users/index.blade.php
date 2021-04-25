@extends('layouts.admin_layout')

@section('title' , 'Dashboard')

@section('content')


 <div class="col-md-12">
 	<div>
 		<a href="{{ route('users.create')  }}" class="btn btn-success">Create new user</a>
 	</div>
    <div class="card">
	    <div class="card-header card-header-primary ">
	      <h4 class="card-title">Employees Stats</h4>
	      <p class="card-category">New employees on 15th September, 2016</p>
	      
	    </div>

        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="text-primary ">
			        <th>ID</th>
			        <th>Name</th>
			        <th>Phone</th>
			        <th>Created at</th>
			        <th></th>
                </thead>
                <tbody>
                @foreach($users as $user)	
		        <tr>
		        	<td>{{$user->id}}</td>
		            <td>{{$user->name}}</td>
		            <td>{{$user->phone}}</td>
		            <td>{{$user->created_at}}</td>
		            <td class="td-actions text-right">

		            	<a href="{{ route('users.edit',$user->id) }}" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                        </a>


                          
                        <form method="POST" action="{{ route('users.destroy',$user->id) }}" style="display: inline-block;">
			                {{ csrf_field() }}
			                @method('delete')
	                        <button rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure you want to delete {{$user->name}}?')">
	                            <i class="material-icons">close</i>
	                        </button>
	                    </form>
	                    
		            </td>  
		        </tr>
		        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection@extends('layouts.admin_layout')

@section('title' , 'Dashboard')

@section('content')


 <div class="col-md-12">
    <div class="card">
	    <div class="card-header card-header-warning">
	      <h4 class="card-title">Employees Stats</h4>
	      <p class="card-category">New employees on 15th September, 2016</p>
	    </div>

        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="text-warning">
			        <th>ID</th>
			        <th>Name</th>
			        <th>Salary</th>
			        <th>Country</th>
			        <th></th>
                </thead>
                <tbody>
		        <tr>
		        	<td>1</td>
		            <td>Dakota Rice</td>
		            <td>$36,738</td>
		            <td>Niger</td>
		            <td class="td-actions text-right">
		            	<a href="" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                        </a>
		            </td>
		        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection