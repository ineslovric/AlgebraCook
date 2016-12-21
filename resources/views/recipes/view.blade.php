@extends('layouts.app')

@section('title', $recipe->name)

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Detalji za recept{{$recipe->name}}
					@if(auth()->user()->id == $recipe->creator_id)
					<br><a href="http://localhost:8000/recipes/edit/{{$recipe->id}}">
					<i class="fa fa-btn fa-pencil">Uredi recept</i></a>
					@endif
				</div>
				
				<div class="panel-body">
					<article>
						<h2>{{$recipe->name}}</h2>
						<h4>Sastojci:</h4>
						<ul class="list-group">
							@foreach($recipe->ingredients as $ingredient)
							
							<li class="list-group-item">{{$ingredient->name}}</li>
							@endforeach
						</ul>
						<h4>Opis: </h4>
						<p>{{$recipe->description}}</p>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection	
