@extends('layouts.admin')


@section('content')


			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Edit listing</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Edit Course</li>
				</ul>
			</div>	
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h4>Edit Course <i class="fa fa-book"></i>  {{ $course->name }}</h4>
						</div>
						<div class="widget-inner">
							<form class="edit-profile m-b30" action="{{ route('courses.update',$course->id) }}" method="post" enctype="multipart/form-data">
								@csrf
								@method('put')

								@include('admin.courses._form',[
								'button' => 'Update'
								])
								
							</form>
						</div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
			</div>
	

    @endsection