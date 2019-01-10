<style>
	h1 {
	    text-align: center;
	    font-size: 60px;
	    color: red;
	    text-shadow: 1px 11px 12px red;
	}
	p {
		text-align: center;
		color: red;
		font-size: 50px;
	}
</style>
<h1> 404 page  </h1>
<p>
	back to <a href="{{ url('') }}">home</a> or <a href="{{url()->previous() }}">back</a>
</p>