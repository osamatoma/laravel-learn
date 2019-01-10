<style>
body {
	margin: 0
}
.video {
	margin: 1px;
	height: 400px;
    border: 1px solid;
    display: flex;
    justify-content: center;
    align-items: center;
}
p {
	color: white;
	width: 50%;
	line-height: 1.8;
	padding: 4px
}
.level-1 {
	background:  black;
	padding: 7px
}
.level-2:before,
.level-3:before {
	content: '- ';
	font-weight: bold;
	font-size: 25px
}
.level-2 {
	margin-left: 30px;
	background: #ff6000;
}
.level-3 {
	margin-left: 60px;
	background: #005080;
}
</style>

<div class="video">
	Vimeo Video
</div>
@foreach ($comments as $comment)
	@if($comment->level == 2)

	@endif
	<p class="level-{{ $comment->level }}">
		{{ $comment->comment }}
	</p>
@endforeach
