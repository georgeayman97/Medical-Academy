@extends('layouts.admin')


@section('content')

            <div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Faculties</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Faculties</li>
				</ul>
			</div>
            <div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title col-12">
							<h4 class="col-6">Faculties</h4>
						</div>
						<div class="widget-inner">


                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>
                                        
                                        
                                        <th class="text-center">ID</th>
                                        <th class="text-center">NAME</th>
                                        <th class="text-center">COUNTRY</th>
                                        <th class="text-center">CITY</th>
                                        <th class="text-center">YEARS</th>
                                        <th class="text-center">DESCRIPTION</th>
                                        <th class="text-center">CREATED AT</th>
                                        <th class="text-center">EDIT</th>
                                        <th class="text-center">DELETE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- we have automatic directives istead of this way -->
                                    <!-- php// foreach($categories as $category) : // : istead of '{'  -->
                                        @foreach($faculties as $faculty)
                                    <tr>
                                        
                                        <td class="text-center">{{ $faculty->id }}</td>
                                        <td class="text-center">{{ $faculty->name }}</td>
                                        <td class="text-center">{{ $faculty->country }}</td>
                                        <td class="text-center">{{ $faculty->city }}</td>
                                        <td class="text-center">{{ $faculty->years }}</td>
                                        <td class="text-center">{{ $faculty->description }}</td>
                                        <td class="text-center">{{ $faculty->created_at }}</td>
                                        <td class="text-center"><a style="height:3.5em; width: 5em;" class="uren-add_cart" href="{{ route('faculty.edit', $faculty->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Faculty"><i
                                                            class="fa fa-edit"> Edit</i></a>
                                        </td>     
                                        <td class="text-center"><form action="{{ route('faculty.destroy', $faculty->id)}}" method="post">
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