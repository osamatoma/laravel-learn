<form method="POST" enctype="multipart/form-data">

	{!! csrf_field()!!}

	<input type="text" name="image_name" placeholder="image name">

	<input type="file" name="image">

	<input type="submit" name="send">
</form>