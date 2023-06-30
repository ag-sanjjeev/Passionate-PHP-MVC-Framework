@layout('layouts.main', ['title' => 'Test: page'])

@section('links')
	<link rel="stylesheet" type="text/css" href="./main.css" media="all" />
@endsection

<div>
	this is sample content
</div>

@section('content')
<section>
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	
<br/>

	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</section>
@endsection

@section('content2')
	
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	
	@endsection

<?php echo '<br/>text'; ?>
