@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Send a request</div>
				<div class="panel-body">
                    <h1>Your friends</h1>

                    @if (!$friends->count())
                    <p>You have no friends.</p>
                    @else 
                        @foreach ($friends as $user)
                        123123
                        @endforeach
                        $endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/script.js')}}"></script>
@endsection
