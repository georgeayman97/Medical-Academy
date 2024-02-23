@extends('layouts.admin')


@section('content')

<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">All Users</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Requests</li>
                    <li>All Users</li>
				</ul>
			</div>
            
            <div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title col-12">
							<h4 class="col-6">All Users</h4>
						</div>
						<div class="widget-inner">


                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>
                                        
                                        
                                        <th class="text-center">ID</th>
                                        <th class="text-center">NAME</th>
                                        <th class="text-center">MOBILE</th>
                                        <th class="text-center">EMAIL</th>
                                        <th class="text-center">ROLE</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">ACTIVITY</th>
                                        <th class="text-center">CREATED AT</th>
                                        <th class="text-center">EDIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- we have automatic directives istead of this way -->
                                    <!-- php// foreach($categories as $category) : // : istead of '{'  -->
                                        @foreach($users as $user)
                                    
                                    <tr>
                                        
                                        <td class="text-center">{{ $user->id }}</td>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->mobile }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">{{ $user->role }}</td>
                                        <!-- <a href="#" class="btn button-sm green radius-xl">active</a> -->
                                        @if($user->status == "disabled")
                                        <td class="btn button-md red radius-xl text-center" style="margin-top: 4px;">{{ $user->status }}</td>
                                        @elseif($user->status == "request")
                                        <td class="btn button-md grey radius-xl text-center" style="margin-top: 4px;">{{ $user->status }}</td>
                                        @else
                                        <td class="btn button-md green radius-xl text-center" style="margin-top: 4px;">{{ $user->status }}</td>
                                        @endif
                                        <td class="text-center">{{ $user->logged_in ? 'Online' : 'Offline' }}</td>
                                        <td class="text-center">{{ $user->created_at }}</td>
                                        <td class="text-center"><a style="height:3.5em; width: 5em;" class="uren-add_cart" href="{{ route('accounts.edit', $user->id)}}" data-toggle="tooltip" data-placement="top" title="Edit User"><i
                                                            class="fa fa-edit"> Edit</i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- php// endforeach // istead of '}'  -->
                                </tbody>
                                </table>
                                <div class="d-flex">
                                    {!! $users->links() !!}
                                </div>
                            </div>


                        </div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
			</div>

@endsection