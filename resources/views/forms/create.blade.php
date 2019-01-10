

<form action="{{ url('/resource')}}" method="post">
	{!! csrf_field() !!}
	<input type="text" name="firstName" placeholder="firstName">
	<input type="text" name="lastName" placeholder="last Name">
	<input type="submit" name="go" value="create">
</form>

<form action="{{ action('resourceController@update',500)}}" method="post">
	{!! csrf_field() !!}
	{{ method_field('PATCH') }}
	<input type="submit" name="go" value="update">
</form>

<form action="{{ route('resource.destroy', 8) }}" method="post">
	{!! csrf_field() !!}
	{{ method_field('DELETE') }}
	<input type="text" name="del">
	<input type="submit" name="go" value="delete">
</form>