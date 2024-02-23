@extends('layouts.admin')


@section('content')
            <div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Courses</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Courses</li>
				</ul>
			</div>
<div class="shop-content_wrapper">

            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-3 col-md-5 order-2 order-lg-1 order-md-1">
                        <div class="uren-sidebar-catagories_area">
                            <div class="category-module uren-sidebar_categories">
                                <div class="category-module_heading">
                                    <h5>Doctors</h5>
                                </div>
                                @php
                                    if(isset($status)){
                                        $status = $status.'/';
                                        $statusLink = $status;
                                    }else{
                                        $statusLink = '';

                                    }

                                @endphp
                                <div class="module-body">
                                    <ul class="module-list_item">
                                        <li>
                                            <a href="/admin/filtering/{{$statusLink}}courses?doctor={{ '' }}&{{ http_build_query(request()->except('doctor','page')) }}">All Doctors</a>
                                            @for($i = 0 ; $i < count($doctors) ; $i++)
                                            <a href="/admin/filtering/{{$statusLink}}courses?doctor={{ $doctors[$i][0] }}&{{ http_build_query(request()->except('doctor','page')) }}">{{$doctors[$i][1]}} <span>{{$doctors[$i][2]}}</span></a>
                                            @endfor

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 order-2 order-lg-1 order-md-1">
                        <div class="uren-sidebar-catagories_area">
                            <div class="category-module uren-sidebar_categories">
                                <div class="category-module_heading">
                                    <h5>Years</h5>
                                </div>
                                <div class="module-body">
                                    <ul class="module-list_item">
                                        <li>
                                            <a href="/admin/filtering/{{$statusLink}}courses?course_year={{ '' }}&{{ http_build_query(request()->except('course_year','page')) }}">All Years</a>
                                            @for($i = 0 ; $i < count($years) ; $i++)
                                            <a @if(isset( $currentYear) && $currentYear == $years[$i][0]) class="active" @endif
                                                href="/admin/filtering/{{$statusLink}}courses?course_year={{ $years[$i][0] }}&{{ http_build_query(request()->except('course_year','page')) }}">
                                                {{$years[$i][0]}} <span>{{$years[$i][1]}}</span></a>
                                            @endfor
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-12 col-md-9 order-1 order-lg-2 order-md-2">
                        <div class="shop-toolbar">

                        </div>
                        <div class="wc-title">
							<h4>Your Courses</h4>
						</div>

                        <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>

                                        <th>LOOB</th>
                                        <th>COURSE NAME</th>
                                        <th>DOCTOR</th>
                                        <th>DESCRIPTION</th>
                                        <th>STATUS</th>
                                        <th>YEAR</th>
                                        <th>PRICE</th>
                                        @if(auth()->user()->role == 'admin')
                                        <th>Action</th>
                                        <th>Edit</th>
                                        <th>ADD SESSION</th>
                                        @endif
                                        <th>ENROLLED</th>
                                        <th>REQUESTS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- we have automatic directives istead of this way -->
                                    <!-- php// foreach($categories as $category) : // : istead of '{'  -->
                                        @foreach($courses as $course)

                                    <tr>

                                        <td>{{ $loop->first?'First':($loop->last?'Last':$loop->iteration)}}</td>
                                        <td>
                                            @if(auth()->user()->role == 'admin')
                                                <a href="{{ route('sessions.show', $course->id)}}">{{ $course->name }}</a>
                                            @else
                                                {{ $course->name }}
                                            @endif
                                        </td>
                                        <td>Dr. {{ $course->doctor->name }}</td>
                                        <td>{{ $course->description }}</td>
                                        @if($course->status == "active")
                                        <td class="btn button-md green radius-xl text-center" style="margin-top: 4px;">{{ $course->status }}</td>
                                        @else
                                        <td class="btn button-md red radius-xl text-center" style="margin-top: 4px;">{{ $course->status }}</td>
                                        @endif
                                        <td>{{ $course->course_year }}</td>
                                        <td>{{ $course->price }} EGP</td>
                                        @if(auth()->user()->role == 'admin')
                                        @if($course->status == 'active')
                                        <td><a href="{{ route('courses.changeStatus', $course->id)}}" class="btn btn-sm btn-dark">Disable</a></td>
                                        @else
                                        <td><a href="{{ route('courses.changeStatus', $course->id)}}" class="btn btn-sm btn-dark">Activate</a></td>
                                        @endif
                                        <td>
                                            <a style="height:3.5em; width: 5em;" class="uren-add_cart" href="{{ route('courses.edit', $course->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Course">
                                                <i class="fa fa-edit"> Edit</i>
                                            </a>
                                        </td>
                                        <td>
                                            <a style="height:3.5em; width: 7em;" class="uren-add_cart" href="{{ route('sessions.create', $course->id)}}" data-toggle="tooltip" data-placement="top" title="Add new Session">
                                                <i class="fa fa-plus"> Sessions</i>
                                            </a>
                                        </td>
                                        @endif
                                        <td>
                                            <a style="height:3.5em; width: 7em;" class="uren-add_cart" href="{{ route('accounts.enrolled', $course->id)}}" data-toggle="tooltip" data-placement="top" title="Add new Course">
                                                <i class="fa fa-users">Enrolled</i>
                                            </a>
                                        </td>
                                        <td>
                                            <a style="height:3.5em; width: 7em;" class="uren-add_cart" href="{{ route('courseaccess.requests', $course->id)}}" data-toggle="tooltip" data-placement="top" title="Add new Course">
                                                <i class="fa fa-users">Requests</i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- php// endforeach // istead of '}'  -->
                                </tbody>
                                </table>
                            </div>



                    </div>
                </div>
            </div>
        </div>
        @endsection
