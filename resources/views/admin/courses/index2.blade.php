@extends('layouts.admin')


@section('content')


			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Courses</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Courses</li>
				</ul>
			</div>	
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h4>Your Courses</h4>
						</div>
						<div class="widget-inner">
							@foreach($courses as $course)
							
							<div class="card-courses-list admin-courses">
								<div class="card-courses-media">
									<a href="{{ route('sessions.show', $course->id)}}"><img src="{{ $course->image_url }}" alt=""/></a>
								</div>
								<div class="card-courses-full-dec">
									<div class="card-courses-title">
										<a href="{{ route('sessions.show', $course->id)}}"><h4>{{ $course->name }}</h4></a>
									</div>
									<div class="card-courses-list-bx">
										<ul class="card-courses-view">
											<li class="card-courses-user col-4">
												<!-- <div class="card-courses-user-pic">
													<img src="assets/images/testimonials/pic3.jpg" alt=""/>
												</div> -->
												<div class="card-courses-user-info">
													<h5>Teacher</h5>
													<h4>{{ $course->instructor_name }}</h4>
												</div>
											</li>
											<!-- <li class="card-courses-categories">
												<h5>3 Categories</h5>
												<h4>Backend</h4>
											</li> -->
											<!-- <li class="card-courses-review">
												<h5>3 Review</h5>
												<ul class="cours-star">
													<li class="active"><i class="fa fa-star"></i></li>
													<li class="active"><i class="fa fa-star"></i></li>
													<li class="active"><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
												</ul>
											</li> -->
											<li class="card-courses-stats col-6">
												<a href="#" class="btn button-sm green radius-xl">{{ $course->status }}</a>
											</li>
											<li class="card-courses-price col-4">
												<!-- <del>$190</del> -->
												<h5 class="text-primary">${{ $course->price }}</h5>
											</li>
										</ul>
									</div>
									<div class="row card-courses-dec">
										<div class="col-md-12">
											<h6 class="m-b10">Course Description</h6>
											<p>{{ $course->description }}</p>	
										</div>
										<div class="col-md-12">
											<a href="{{ route('courses.edit', $course->id)}}" class="btn green radius-xl outline">Edit</a>
											<form action="{{ route('courses.destroy', $course->id)}}" style="display:inline;"  method="post">
												@csrf
												@method('delete')
												<button type="submit" class="btn red outline radius-xl">Delete</button>
											</form>
											<a href="{{ route('sessions.create', $course->id)}}" class="btn gray outline radius-xl">Add Session</a>
											<a href="{{ route('accounts.enrolled', $course->id)}}" class="btn gray outline radius-xl">Enrollment</a>
										</div>
										
										
									</div>
									
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
			</div>

            
    @endsection