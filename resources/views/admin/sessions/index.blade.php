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
                    <div class="form-row">
                <div class="wc-title col-md-11">
							<h4 class="col-6">Your Sessions For <span>{{$course->name}}</span></h4>

                </div>
                <div class="wc-title col-md-1">
                <a class="btn btn-primary" href="{{ route('sessions.create', $course->id)}}" role="button">
                    <i class="fa fa-plus"> Sessions</i></a>
                </div>

            </div>



						<div class="widget-inner">


                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr class="sortable">

                                        <th>LOOB</th>
                                        <th>ORDER</th>
                                        <th>
                                            <a href="?sort=name&amp;direction={{ request('direction') === 'asc' ? 'desc' : 'asc' }}">NAME</a>
                                            @if($sortColumn == 'name')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fa fa-sort-asc" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                                @endif
                                            @endif
                                        </th>
                                        <th>
                                            <a href="?sort=description&amp;direction={{ request('direction') === 'asc' ? 'desc' : 'asc' }}">DESCRIPTION</a>
                                            @if($sortColumn == 'description')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fa fa-sort-asc" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                                @endif
                                            @endif
                                        </th>
                                        <th>COURSE NAME</th>
                                        <th>
                                            <a href="?sort=status&amp;direction={{ request('direction') === 'asc' ? 'desc' : 'asc' }}">STATUS</a>
                                            @if($sortColumn == 'status')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fa fa-sort-asc" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                                @endif
                                            @endif
                                        </th>
                                        <th>
                                            <a href="?sort=created_at&amp;direction={{ request('direction') === 'asc' ? 'desc' : 'asc' }}">CREATED AT</a>
                                            @if($sortColumn == 'created_at')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fa fa-sort-asc" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                                @endif
                                            @endif
                                        </th>
                                        <th>Action</th>
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
                                        <td>{{ $session->order }}</td>
                                        <td>{{ $session->name }}</td>
                                        <td>{{ $session->description }}</td>
                                        <td>{{ $course->name }}</td>
                                        @if($session->status == "disabled")
                                        <td class="btn button-md red radius-xl text-center" style="margin-top: 4px;">{{ $session->status }}</td>
                                        @else
                                        <td class="btn button-md green radius-xl text-center" style="margin-top: 4px;">{{ $session->status }}</td>
                                        @endif
                                        <td>{{ $session->created_at }}</td>
                                        @if($session->status == 'active')
                                        <td><a href="{{ route('sessions.changeStatus', $session->id)}}" class="btn btn-sm btn-dark">Disable</a></td>
                                        @else
                                        <td><a href="{{ route('sessions.changeStatus', $session->id)}}" class="btn btn-sm btn-dark">Activate</a></td>
                                        @endif
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
