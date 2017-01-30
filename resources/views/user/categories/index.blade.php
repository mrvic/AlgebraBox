@extends('layouts.index')

@section('title', 'Categories | AlgebraBox')

@section('content')

@include('user.categories.status')

<div class="row">
  <ol class="breadcrumb">
    <li><a href="{{route('home')}}">Home</a></li>
	<li class="active">Categories</li>
  </ol>
</div>

<div class="categories" class="row">	
	<div class="col-md-3">
		<div class="list-group">
			<a href="{{route('home')}}" class="list-group-item">Folders &amp; Files </a>
			<a href="#" class="list-group-item active">Categories</a>
			<a href="#" class="list-group-item">Shared</a>
		</div>	
	</div>
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<h3 class="pull-left panel-title">Categories</h3>
				<div class="pull-right">
					<a href="{{route('categories.create')}}">
						<span class="pull-right glyphicon glyphicon-tag" aria-hidden="true"></span>
						<span class="pull-right glyphicon glyphicon-plus" aria-hidden="true"></span>
					</a>
				</div>
			</div>

			<div class="panel-body">
<<<<<<< HEAD
				<div class="list-group">
					@foreach($user_categories as $kategorije)
						<tr>
							<td>{{$kategorije->name}}</td>
						</tr>
					@endforeach
				</div>
=======
				<table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Category name</th>
        <th>Section</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
		
		
	@foreach($categories as $category)

			
			
      <tr>
        <td>{{ $category->id }}</td>
		 <td>{{ $category->name }}</td>
		  <td>{{ $category->sections->name }}</td>
		  <td>
		  <span class="label label-success">Edit</span>
		  <span class="label label-danger">Delete</span> 
		  </td>
		  
        <td>
		</td>
        <td></td>
      </tr>
	  
	@endforeach
      
    </tbody>
  </table>
			<div>
				
>>>>>>> defd0b7a732eeee3f74b1c8b113c7cac6c66369f
			</div>
		</div>
	</div>
</div>


@stop
