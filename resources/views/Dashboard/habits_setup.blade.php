<!doctype html>
<html lang="en">
  <head>
  	<title>Checkbox 04</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/ListStyle.css">
</head>
<body>
	
	<section class="ftco-section">
		<div class="container">
			<div class="">
				<div class="col-md-12 text-center">
					<h2 class="heading-section mb-5 pb-md-4">teste</h2>
				</div>
			</div>
			@foreach($habits as $category => $habits_array)
			<br>
				<div class="row justify-content-center">
					<div class="col-md-4">
						<div class="wrap w-100">
							<div class="heading-title mb-4 text-center">
								<h3>{{$category}}</h3>
							</div>
							<ul class="ks-cboxtags p-0 m-0">
						    <form method="post" action="{{route('dashboard.habits.setup')}}">
							@csrf
								@foreach($habits_array as $habit)
									<li> {{-- need to bring id to make it easier when uploading to database--}}
										<input type="checkbox" id="{{$habit}}" value="{{$habit}}" name="{{$category}}.{{$habit}}" >
										<label for="{{$habit}}">"{{$habit}}"</label>
									</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</section>
		<center>
		<button type="submit">salvar</button>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>