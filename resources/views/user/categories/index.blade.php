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
		  <a href="{{ route('categories.edit', $category->id) }}"><span class="label label-success">Edit</span></a>
		  </td>
		  <td>
			<form class="delete" action="{{ route('categories.destroy', $category->id) }}" method="POST">
				<input type="hidden" name="_method" value="DELETE">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				
				<button type="submit" class="btn btn-default"><span class="label label-danger">Delete</span></button>
			</form>
		   </td>
        
      </tr>
	  
	@endforeach
      
    </tbody>
  </table>
			<div>
				
			</div>
		</div>
	</div>
</div>


@stop
