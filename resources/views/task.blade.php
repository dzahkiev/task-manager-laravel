@extends('layouts.app')
@section('content')

<div class="container">
		@include('errors')
		<form action="{{ url('task') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-row">
				<div class="form-group">
					<label for="task" class="col-xs-3 col-form-label">
						<h4>Create Task</h4>
					</label>
					<div class="form-row">
						<div class="col-xs-6">
							<input type="text" name="name" id="task-name" placeholder="Task name" class="form-control">
						</div>
						<div class="col-xs-6">
							<button type="submit" class="btn btn-success">
								Add Task
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
</div>

@if (count($task))
	<div class="container">
		<div class="card">
			<h4 class="card-header">
				Current Tasks
			</h4>
			<div class="card-body">
				<table class="table table-condensed">
					<thead>
						<th>Name</th>
						<th>&nbsp;</th>
					</thead>
					<tbody>
						@foreach ($task as $t)
							<tr>
								<td class="table-text">
									{{ $t->name }}
								</td>
								<td>
									<form action="{{ url('task/' . $t->id) }}" method="POST">
										{{csrf_field()}}
										{{method_field('DELETE')}}
										<button class="btn btn-danger">
											Delete
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
@endif
@endsection	
