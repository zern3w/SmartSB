@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1" style="margin-top: 15px;">
			<div class="panel panel-default">
				<div class="panel-heading">Maps</div>
				<div class="panel-body">
					<input type="text" name="search" id="search" class="form-control"></input>

					<meta name="csrf-token" content="{{ csrf_token() }}" />
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$('#search').on('keyup',function(){
		$value=$(this).val();
		$.ajax({
			type : 'get',
			url : '{{ URL::to('search') }}',
			data : {'search':$value},
			success:function(data){
				// console.log(data);
				$('tbody').html(data);
			}
		});
	})
</script>
@endsection
