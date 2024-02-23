@extends('layouts.admin')


@section('content')

            <div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Doctors</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Doctors</li>
				</ul>
			</div>
            <div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title col-12">
							<h4 class="col-6">Doctors</h4>
						</div>
						<div class="widget-inner">


                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>
                                        
                                        
                                        <th class="text-center">ID</th>
                                        <th class="text-center">NAME</th>
                                        <th class="text-center">EMAIL</th>
                                        <th class="text-center">ROLE</th>
                                        <th class="text-center">COURSES</th>
                                        <th class="">YEARS</th>
                                        <th class="">STATUS</th>
                                        <th class="text-center">CREATED AT</th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- we have automatic directives istead of this way -->
                                    <!-- php// foreach($categories as $category) : // : istead of '{'  -->
                                        @foreach($doctors as $user)
                                    <tr>
                                        
                                        <td class="text-center">{{ $user->id }}</td>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">{{ $user->role }}</td>
                                        <td class="text-center">
                                        @foreach($user->teaches as $subject)
                                            <li>{{$subject->name}}</li>
                                        @endforeach
                                        </td>
                                        <td class="">
                                        @foreach($user->teaches as $subject)
                                            <li>{{$subject->course_year}}</li>
                                        @endforeach
                                        </td>
                                        <!-- <a href="#" class="btn button-sm green radius-xl">active</a> -->
                                        <td class="btn button-md green radius-xl" style="margin-top: 4px;">{{ $user->status }}</td>
                                        <td class="text-center">{{ $user->created_at }}</td>
                                        <td class="text-center"><a style="height:3.5em; width: 5em;" class="uren-add_cart" href="{{ route('accounts.edit', $user->id)}}" data-toggle="tooltip" data-placement="top" title="Edit User"><i
                                                            class="fa fa-edit"> Edit</i></a>
                                        </td>   
                                        <td class="text-center"><form action="{{ route('accounts.destroy', $user->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn red btn-sm btn-danger">Delete</button>
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