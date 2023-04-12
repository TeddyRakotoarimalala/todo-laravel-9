@extends('layout')

@section('content')

<div class="todo-container">
	<h1 class="title">Todo List</h1>

	@if (session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
	@endif

	@if (session('danger'))
	<div class="alert alert-danger">
		{{ session('danger') }}
	</div>
	@endif

	@if ($errors->any())
	<div class="alert alert-danger">
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</div>
	@endif

	<div class="todo-add" >
		<form class="input-group" method="POST" action="{{ route('addTodo') }}">
			@csrf
			<input class="form-control" type="text" name="title" placeholder="Ajouter une tache" value="{{ old('title') }}" />
			<div class="input-group-append">
				<button class="btn btn-primary" type="submit">Ajouter</button>
			</div>
		</form>
	</div>
	<div class="filter-container">
		<a href="{{ route('index') }}" class="filter {{ (Route::currentRouteName() == 'index') ? 'active' : '' }}">Tous</a>
		<a href="{{ route('remainingTodo') }}" class="filter {{ (Route::currentRouteName() == 'remainingTodo') ? 'active' : '' }}">En cours</a>
		<a href="{{ route('completedTodo') }}" class="filter {{ (Route::currentRouteName() == 'completedTodo') ? 'active' : '' }}">Terminer</a>
	</div>	
	<hr>
	<ul>
		@forelse( $todos as $todo)
		<li>
			<span class="todo-title">
				@if( $todo->completed)
				<small>√</small>
				@endif
				{{ $todo->title }}
			</span>
			<div class="actions">
				@if( !$todo->completed)
				<a href="{{ route('completeTodo', ['todo' => $todo]) }}" class="completed" onclick="event.preventDefault();document.getElementById('complete-form-{{ $todo->id }}').submit();" >√</a>
				<form id="complete-form-{{ $todo->id }}" action="{{ route('completeTodo', ['todo' => $todo]) }}" method="POST">
					@csrf
				</form>
				@endif
				<a href="{{ route('removeTodo', ['todo' => $todo]) }}" class="delete" onclick="event.preventDefault();document.getElementById('remove-form-{{ $todo->id }}').submit();" >X</a>
				<form id="remove-form-{{ $todo->id }}" action="{{ route('removeTodo', ['todo' => $todo]) }}" method="POST">
					@csrf
				</form>
			</div>
		</li>
		@empty
		<p class="empty">
		<span>La liste est vide</span>
	</p>
		@endforelse
	</ul>
	<hr> 
	<div class="todo-footer">
		<span class="remaining"><small> {{ $remaining }} </small> {{ ($remaining < 2)  ? 'tache restante' : 'taches restantes'; }} sur {{ $total }}</span>
		@if( $clear )
		<a href="{{ route('clearCompletedTodo') }}" class="clear" onclick="event.preventDefault();document.getElementById('removeCompleted-form').submit();">Effacer taches terminer</a>
		<form id="removeCompleted-form" action="{{ route('clearCompletedTodo') }}" method="POST">
			@csrf
		</form>
		@endif
	</div>
</div>

@endsection