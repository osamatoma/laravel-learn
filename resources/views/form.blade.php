<style>
	input {
		display: block;
		margin: 20px auto;
		padding: 5px;
		width: 350px;
	}
	h1 {
		text-align: center;
	}
	input[type="submit"] {
	    border: none;
	    background: #f00;
	    color: #fff;
	    padding: 10px;
	    font-size: 22px;
	}
	 
</style>
 
<form method="POST" action="{{ route('formPost') }}"> <!-- url get the index url only   -->
	{{ csrf_field()  }}
	<input type="text" name="name" placeholder="name">
 
	<input type="submit" name="submit">
</form>
<!--  both ways is accepted but the second one may cuse problem in long urls   -->
<form method="POST" action="form/new">  
	{!! csrf_field() !!}
	<input type="text" name="name" placeholder="name">
	<input type="email" name="email" placeholder="email">
	<input type="number" name="number" placeholder="number">
	<input type="submit" name="submit">
</form>