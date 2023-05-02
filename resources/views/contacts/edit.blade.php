@extends('layouts.dashboard.app')
@section('title', 'Edit Contact')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('plugins/csv_js/css/index.css')}}">
<div class="main-container">
	@include('layouts.shared.alert')
	
	<!-- Controls -->
	<div class="container">
		<nav aria-label="breadcrumb" role="navigation">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('contacts') }}">Contacts</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ $contact->title }}</li>
			</ol>
		</nav>
		<div class="alert-holder text-center"></div>
		<!--     Tables    -->
		<div class="tables text-center" id="tables">
			<div class="table-holder">
				<div class="row pr-3 py-2 align-content-center">
					<div class="col-md-4 offset-md-4 text-center">
						<span id="contact-file-title">{{$contact->title}}</span>
					</div>
					<div class="col-md-4 text-md-right mt-2 mt-md-0">
						<button title="Download the editable table." onClick="downloadTable(1)" class="btn btn-sm btn-primary">  <i class="fa fa-download" id="advanced-controls-display"></i></button>
						<button title="Download the editable table." onClick="saveFile(1)" class="btn btn-sm btn-primary"> Save <i class="fa fa-save ms-auto" id="advanced-controls-display"></i></button>
					</div>
					
					
				</div>
				
			</div>
		</div>
	</div>

	<script>
		function readTextFile(file)
		{
		    var rawFile = new XMLHttpRequest();
		    rawFile.open("GET", file, false);
		    rawFile.onreadystatechange = function ()
		    {
		        if(rawFile.readyState === 4)
		        {
		            if(rawFile.status === 200 || rawFile.status == 0)
		            {
		                var allText = rawFile.responseText;
						
						// clearTables();
						
						$("#go").html("Refresh!");
						
						populate(allText, "<?=$contact->title?>");
						
		            }
		        }
		    }
		    rawFile.send(null);
		}
		

		$(document).ready(function (){
			let fileSource = "<?=$filePath?>";
			console.log(fileSource);
			const fileContent = readTextFile(fileSource);
		});
	</script> 
@endsection