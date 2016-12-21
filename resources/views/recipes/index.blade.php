@extends('layouts.app')

@section('title', 'Recepti')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Recepti
				<br>
				<a href="http://localhost:8000/recipes/add"><i class="fa fa-btn fa-plus">Dodaj novi recept</i></a>
				</div>
				
				<div class="panel-body">
					<ul class="list-group">
						@foreach($recipes as $recipe)
						<li class="list-group-item">
							<a href="recipes/view/{{$recipe->id}}">{{$recipe->ime}}</a>
							
							<form action="/recipes/{{$recipe->id}}" method="POST">
									{{csrf_field()}}
									{{method_field('DELETE')}}
									
									<button>Izbriši recept</button>
							</form>
						</li>
						@endforeach
					</ul>
				</div>
                
            </div>
        </div>
    </div>
</div>
@endsection