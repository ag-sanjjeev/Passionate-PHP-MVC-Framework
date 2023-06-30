@layout('layouts.secondary', ['title' => 'demo'])

@section('content')
<?php echo $userName ?? 'no exist'; ?>
@endsection
