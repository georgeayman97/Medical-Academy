@extends('layouts.admin')


@section('content')

<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Sessions</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Course Name</li>
                    <li>Sessions</li>
				</ul>
			</div>
            
            <div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title col-12">
							<h4 class="col-6">Your Courses</h4>
						</div>
						<div class="widget-inner">


                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>
                                        
                                        <th>LOOB</th>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>DESCRIPTION</th>
                                        <th>COURSE NAME</th>
                                        <th>CREATED AT</th>
                                        <th>UPDATED AT</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- we have automatic directives istead of this way -->
                                    <!-- php// foreach($categories as $category) : // : istead of '{'  -->
                                        @foreach($sessions as $session)
                                    
                                    <tr>
                                        
                                        <td>{{ $loop->first?'First':($loop->last?'Last':$loop->iteration)}}</td>
                                        <td>{{ $session->id }}</td>
                                        <td>{{ $session->name }}</td>
                                        <td>{{ $session->description }}</td>
                                        <td>{{ $course_name }}</td>
                                        <td>{{ $session->created_at }}</td>
                                        <td>{{ $session->updated_at }}</td>
                                        <td><a href="{{ route('sessions.edit', $session->id)}}" class="btn btn-sm btn-dark">Edit</a></td>
                                        <td><form action="{{ route('sessions.destroy', $session->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form></td>
                                    </tr>
                                    @endforeach
                                    <!-- php// endforeach // istead of '}'  -->
                                </tbody>
                                </table>
                            </div>


                        </div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
			</div>

@endsection