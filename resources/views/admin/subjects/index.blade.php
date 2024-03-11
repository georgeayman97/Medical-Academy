@extends('layouts.admin')


@section('content')

            <div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Subjects</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Subjects</li>
				</ul>
			</div>
            <div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title col-12">
							<h4 class="col-6">Subjects</h4>
						</div>
						<div class="widget-inner">


                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>


                                        <th class="text-center">ID</th>
                                        <th class="text-center">NAME</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">DESCRIPTION</th>
                                        <th class="text-center">Action</th>
                                        <th class="text-center">EDIT</th>
                                        <th class="text-center">DELETE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- we have automatic directives istead of this way -->
                                    <!-- php// foreach($categories as $category) : // : istead of '{'  -->
                                        @foreach($subjects as $subject)
                                    <tr>

                                        <td class="text-center">{{ $subject->id }}</td>
                                        <td class="text-center">{{ $subject->name }}</td>
                                        @if($subject->status == "active")
                                            <td class="btn button-md green radius-xl text-center" style="margin-top: 4px;">{{ $subject->status }}</td>
                                        @else
                                            <td class="btn button-md red radius-xl text-center" style="margin-top: 4px;">{{ $subject->status }}</td>
                                        @endif
                                        <td class="text-center">{{ $subject->description }}</td>
                                        @if($subject->status == 'active')
                                            <td><a href="{{ route('subjects.changeStatus', $subject->id)}}" class="btn btn-sm btn-dark">Disable</a></td>
                                        @else
                                            <td><a href="{{ route('subjects.changeStatus', $subject->id)}}" class="btn btn-sm btn-dark">Activate</a></td>
                                        @endif
                                        <td class="text-center"><a style="height:3.5em; width: 5em;" class="uren-add_cart" href="{{ route('subjects.edit', $subject->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Subject"><i
                                                            class="fa fa-edit"> Edit</i></a>
                                        </td>
                                        <td class="text-center"><form action="{{ route('subjects.destroy', $subject->id)}}" method="post">
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
