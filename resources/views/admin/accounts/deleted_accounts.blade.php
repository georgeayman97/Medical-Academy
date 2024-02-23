@extends('layouts.admin')


@section('content')

            <div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Account Requests</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Requests</li>
                    <li>Account Requests</li>
				</ul>
			</div>

            <div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title col-12">
							<h4 class="col-6">Accounts Requests</h4>
						</div>
						<div class="widget-inner">


                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>


                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>ROLE</th>
                                        <th>STATUS</th>
                                        <th>CREATED AT</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- we have automatic directives istead of this way -->
                                    <!-- php// foreach($categories as $category) : // : istead of '{'  -->
                                        @foreach($users as $user)

                                    <tr>

                                        <td>{{ $user->id }}</td>
                                        <td><a href="{{ route('courses.enrolled', $user->id)}}">{{ $user->name }}</a></td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <!-- <a href="#" class="btn button-sm green radius-xl">active</a> -->
                                        <td class="btn button-md green radius-xl" style="margin-top: 4px;">{{ $user->status }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td><a href="{{ route('accounts.restore', $user->id)}}" class="btn btn-sm btn-dark">Restore</a></td>

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
