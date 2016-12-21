@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
				<div class="panel-heading">Edit recipe</div>
				<div class="panel-body">
					{!!Form::open(array('url'=> 'recipes/edit', 'method' => 'post'))!!}
					{{FORM::hidden('id', $recipe->id)}}
				
					<div class="form-group">
						{{FORM::label('name', 'Ime')}}
						{{FORM::text('name', $recipe->ime, ['placeholder' => 'Unesite ime...', 'class'=> 'form-control'])}}
					</div>
						
					<div class="form-group">
						{{FORM::label('name', 'Opis')}}
						{{FORM::textarea('description', $recipe->description, ['placeholder' => 'Unesite opis...', 'class'=> 'form-control'])}}
					</div>
					
					<h3>Popis sastojaka</h3>
					
					<div id="ing-coll-fields">
						@foreach($recipe->ingredients as $ingredient)
						<div class="form-group">
							<label for="ingredient">Sastojak:<input name="ingredient[]" type="text" value="{{$ingredient->name}}"/></label>
							<a href="#" class="remScnt"><i class="fa fa-btn fa-close">Remove</i></a>
						</div>
						@endforeach
						
					</div>
					
					<a href="#" id="addLink"><i class="fa fa-btn fa-plus">Dodaj novi sastojak</i></a>
					<br>
					{!!FORM::submit('Uredi recept', ['class' => 'btn btn-default'])!!}
					{!!FORM::close()!!}

				</div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
	$(function(){
		var scntDiv = $('#ing-coll-fields');
		var i = $('#ing-coll-fields div').size()+1;
		
		$('#addLink').click(function(){
			$('<div class="form-group">' + 
				'<label for="ingredient">Sastojak:<input name="ingredient[]" type="text"/></label>' + 
				'<a href="#" class="remScnt">'+
				'<i class="fa fa-btn fa-close">Remove</i>'+ '</a></div>').appendTo(scntDiv);
				
				i++;
				return false;
		});
		scntDiv.on('click', '.remScnt', function(){
			if(i > 2){
				$(this).parents('div .form-group').remove();
				i--;
			}
			return false;
		});
	});
</script>

@endsection