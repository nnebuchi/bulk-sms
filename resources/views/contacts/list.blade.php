@extends('layouts.dashboard.app')
@section('title', 'Contact List')
@section('actionLink', route('create-contact'))
@section('actionText', 'New Contact')
@section('actionIcon', `<i class="fa fa-pencil"></i>`)
@section('content')

<div class="main-container">
	@include('layouts.shared.alert')
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				@include('layouts.shared.dashboard.page-header')
				@include('layouts.shared.alert')
				<!-- Checkbox select Datatable start -->
				<div class="card-box mb-30">
					@include('layouts.shared.dashboard.action-panel')
					<div class="pb-20">
						<table class="checkbox-datatable table nowrap">
							<thead>

								<tr>
									<th><div class="dt-checkbox">
											<input type="checkbox" name="select_all" value="1" id="example-select-all">
											<span class="dt-checkbox-label"></span>
										</div>
									</th>
									<th>S/N</th>
									<th>Title</th>
									<th>Numbers</th>
									<th>Created</th>
									<th>Last Updated</th>
									<th>Action</th> 
								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($contacts as $contact)
								@php $count ++ @endphp
								<tr>
									<td></td>
									<td>{{ $count }}</td>
									<td>{{ $contact->title }}</td>
									<td>{{number_format(count(explode(',', $contact->numbers)))  }}</td>
									<td>{{ date('d.m.Y', strtotime($contact->created_at)) }}</td>
									<td>{{ date('d.m.Y', strtotime($contact->updated_at)) }}</td>
									<td>
										<a href="{{ route('contact-detail', $contact->slug) }}" class="btn btn-secondary btn-sm">View <i class="fa fa-eye"></i></a>
										{{-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-{{ $count }}">Edit <i class="fa fa-edit"></i></button> --}}
										<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-{{ $contact->slug }}">Delete <i class="fa fa-trash"></i></button>
									</td> 
								</tr>

								<!--Delete Modal -->
								<div class="modal fade" id="delete-{{ $contact->slug }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								    	<form action="{{ route('delete-contact') }}" method="post">
								    		@csrf
										      <div class="modal-heade pt-3 row pr-1">
										      	<div class="col-11">
										      		<h6 class="text-center modal-title">Confirm action</h6>
										      	</div>
										      	<div class="col-1 text-left">
											      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
										      	</div>
										        

										        
										      </div>
										      <hr>
										      <div class="modal-bod text-center">
										      	Delete {{ $contact->title }}?
										        	<input type="hidden" name="contact_slug" value="{{ $contact->slug }}">
										        	
										      </div>
										      <hr>
										      <div class="modal-foote text-center py-3">
										        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Go back</button>
										        <button type="" class="btn btn-primary">Proceed >></button>
										      </div>
								      	</form>
								    </div>
								  </div>
								</div>
								@endforeach
								
							</tbody>
						</table>
					</div>
				</div>

				
@endsection