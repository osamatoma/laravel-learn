

<h1>
	{{ $post->title }}
</h1>

<form method="get" action="/">
	{{ csrf_field() }}
	<input type="submit">
</form>
