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
                    @if(!isset($users[0]->name))
                    <div class="col-lg-3 col-md-5 order-2 order-lg-1 order-md-1">
                        <div class="uren-sidebar-catagories_area">
                            <div class="category-module uren-sidebar_categories">
                                <div class="category-module_heading">
                                    <h5>Doctors</h5>
                                </div>
                                <div class="module-body">
                                    <ul class="module-list_item">
                                        <li>
                                            <a href="/search?doctor={{ '' }}&{{ http_build_query(request()->except('doctor','page')) }}">All Doctors</a>
                                            @for($i = 0 ; $i < count($doctors) ; $i++)
                                            <a href="/search?doctor={{ $doctors[$i][0] }}&{{ http_build_query(request()->except('doctor','page')) }}">{{$doctors[$i][1]}} <span>{{$doctors[$i][2]}}</span></a>
                                            @endfor

                                            <!-- <a class="active" href="javascript:void(0)">Shop <span>(18)</span></a> -->
                                            <!-- <ul class="module-sub-list_item">
                                                <li>
                                                    <a href="javascript:void(0)">Brakes & Rotors <span>(8)</span></a>
                                                    <a href="javascript:void(0)">Lighting <span>(8)</span></a>
                                                    <a href="javascript:void(0)">Perfomance <span>(13)</span></a>
                                                    <a href="javascript:void(0)">Wheels & Tires <span>(13)</span></a>
                                                </li>
                                            </ul> -->
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="uren-sidebar_categories">
                                <div class="uren-categories_title">
                                    <h5>Years</h5>
                                </div>
                                <ul class="sidebar-checkbox_list">
                                            
                                    <li>
                                        <a href="/search?course_year={{ '' }}&{{ http_build_query(request()->except('course_year','page')) }}">All Years</a>
                                    </li>
                                    @for($i = 0 ; $i < count($years) ; $i++)
                                    <li>
                                        <a @if(isset( $currentYear) && $currentYear == $years[$i][0]) class="active" @endif 
                                        href="/search?course_year={{ $years[$i][0] }}&{{ http_build_query(request()->except('course_year','page')) }}">{{$years[$i][0]}} <span>{{$years[$i][1]}}</span></a>
                                    </li>
                                    @endfor
                                    
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-7 order-1 order-lg-2 order-md-2">
                    @else
                    <div class="col-lg-12 col-md-12 " style="padding-right: 0px; padding-left: 0px;">
                    @endif
                    
                        <div class="shop-toolbar">
                            
                        </div>
                        @if(isset($courses[0]->name))
                        <div class="wc-title">
							<h4>Your Courses</h4>
						</div>
                        @if(isset($users[0]->name))
                        <div class="shop-product-wrap grid gridview-3 img-hover-effect_area row" style="margin-right: -50px; margin-left: -50px;">
                        @else
                        <div class="shop-product-wrap grid gridview-2 img-hover-effect_area row">
                        @endif

                        @foreach($courses as $course)
                            <div class="col-lg-4">
                                <div class="product-slide_item">
                                    <div class="inner-slide">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('sessions.show', $course->id)}}">
                                                    <img class="primary-img" style="width:100%; height:32em;" src="{{ $course->image_url }}" >
                                                    <div class="secondary-img" style="text-align: center; background-color: rgba(0, 0, 0, .3); height:inherit; width:100%; margin-top: 20px;">
                                                        <h3 style="color: white;">Dr. {{ $course->doctor->name }}</h3>
                                                        <h4 style="color: white;">Description</h4>
                                                        <p style="color: white;">{{ $course->description }}</p>
                                                    </div>
                                                    </a>
                                                @if($course->status == "active")
                                                <div class="sticker">
                                                    <span class="sticker" style="background-color: #5FDBA7;">{{ $course->status }}</span>
                                                </div>
                                                @else
                                                <div class="sticker">
                                                    <span class="sticker" style="background-color: red;">{{ $course->status }}</span>
                                                </div>
                                                @endif
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a style="height:3.5em; width: 7em;" class="uren-add_cart" href="{{ route('sessions.create', $course->id)}}" data-toggle="tooltip" data-placement="top" title="Add new Session"><i
                                                            class="fa fa-plus"> Sessions</i></a>
                                                        </li>
                                                        <li><a style="height:3.5em; width: 5em;" class="uren-add_cart" href="{{ route('courses.edit', $course->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Course"><i
                                                            class="fa fa-edit"> Edit</i></a>
                                                        </li>
                                                        <li><a style="height:3.5em; width: 7em;" class="uren-add_cart" href="{{ route('accounts.enrolled', $course->id)}}" data-toggle="tooltip" data-placement="top" title="Add new Course"><i
                                                            class="fa fa-users">Enrolled</i></a>
                                                        </li>
                                                        <li>
                                                            <a style="height:3.5em; width: 7em;" class="uren-add_cart" href="{{ route('courseaccess.requests', $course->id)}}" data-toggle="tooltip" data-placement="top" title="Add new Course">
                                                                <i class="fa fa-users">Requests</i>
                                                            </a>
                                                        </li>
                                                        <li><form class="uren-add_cart" action="{{ route('courses.destroy', $course->id)}}"  method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" style="background-color:red; height:3.5em; width: 3em; border-radius: 6px;" class="uren-add_cart" data-toggle="tooltip" data-placement="top" title="Delete Course"><i
                                                            class="fa fa-remove"></i></button>
                                                        </form></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-desc_info">
                                                    <h6 style="margin-top: 5px;"><a class="fa product-name" href="{{ route('sessions.show', $course->id)}}" >{{ $course->name }}</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">EGP {{ $course->price }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-slide_item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="single-product.html">
                                                <img class="primary-img" src="{{ $course->image_url }}" >
                                                <img class="secondary-img" alt="{{ $course->name }}" >
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">
                                                <div class="rating-box">
                                                    <ul>
                                                        <li><i class="ion-android-star"></i></li>
                                                        <li><i class="ion-android-star"></i></li>
                                                        <li><i class="ion-android-star"></i></li>
                                                        <li class="silver-color"><i class="ion-android-star"></i>
                                                        </li>
                                                        <li class="silver-color"><i class="ion-android-star"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <h6><a class="product-name" href="{{ route('sessions.show', $course->id)}}">{{ $course->name }}</a></h6>
                                                <div class="price-box">
                                                    <span class="new-price">$150.00</span>
                                                </div>
                                                <div class="product-short_desc">
                                                    <p>{{ $course->name }}</p>
                                                </div>
                                            </div>

                                            <div class="add-actions">
                                                <ul>
                                                    <li><a class="uren-add_cart" href="" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                    </li>
                                                    <li><a class="uren-wishlist" href="" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                        class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                    <li><a class="uren-add_compare" href="" data-toggle="tooltip" data-placement="top" title="Compare This Product"><i
                                                        class="ion-android-options"></i></a>
                                                    </li>
                                                    <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                        class="ion-android-open"></i></a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        @endif
                        

                        @if(isset($users[0]->name))
                        <div class="wc-title">
							<h4>Your Users</h4>
						</div>
                        @endif
                        <div class="shop-product-wrap grid gridview-3 img-hover-effect_area row" style="margin-right: -50px; margin-left: -50px;">

                        @foreach($users as $user)
                        <div class="col-lg-4">
                            <div class="product-slide_item">
                                <div class="inner-slide">
                                    <div class="single-product">
                                        <div class="product-img">
                                            
                                                @if($user->role == 'doctor')
                                                <img class="primary-img" style="width:100%; height:32em;" src="/uploads/no-profile-photo.png" >
                                                @else
                                                <img class="primary-img" style="width:100%; height:32em;" src="/uploads/no-profile-photo-student.png" >
                                                @endif
                                                <div class="secondary-img" style="text-align: center; background-color: rgba(0, 0, 0, .3); height:inherit; width:100%; margin-top: 20px;">
                                                    <h3 style="color: white;">Email</h3>
                                                    <h4 style="color: white;">{{ $user->email }}</h4>
                                                    <p style="color: white;">{{ $user->year }}</p>
                                                </div>
                                                
                                                <!-- <img class="secondary-img" alt="qq" style="left: 1em; text-align:right ; background-color: rgba(0, 0, 0, .3); height:inherit; width:inherit; margin-top: 20px;"> -->
                                            
                                            @if($user->status == "active")
                                            <div class="sticker">
                                                <span class="sticker" style="background-color: #5FDBA7; width:5rem;">{{$user->status}}</span>
                                            </div>
                                            @else
                                            <div class="sticker">
                                                <span class="sticker" style="background-color: red; width:5rem;">{{$user->status}}</span>
                                            </div>
                                            @endif
                                            <div class="add-actions">
                                                <ul>
                                                    <li>
                                                        <form class="uren-add_cart" action="{{ route('accounts.approve', $user->id)}}" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn uren-add_cart">Approve</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form class="uren-add_cart" action="{{ route('courses.enrolled', $user->id)}}" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn uren-add_cart">Enrollment</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form class="uren-add_cart" action="{{ route('accounts.ban', $user->id)}}" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn uren-add_cart">Ban</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form class="uren-add_cart" action="{{ route('accounts.resetDevice', $user->id)}}" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn uren-add_cart">Reset Device</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form class="uren-add_cart" action="{{ route('accounts.edit', $user->id)}}" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn uren-add_cart">Edit</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form class="uren-add_cart" action="{{ route('accounts.destroy', $user->id)}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger uren-add_cart">Delete</button>
                                                        </form>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">
                                                
                                                <h6 style="margin-top: 5px;"><a class="fa product-name" href="{{ route('sessions.show', $user->id)}}" >{{($user->role == 'doctor') ? 'Dr. '. $user->name:$user->name }}</a></h6>
                                                <div class="price-box">
                                                    <span class="new-price">Mobile: {{ $user->mobile }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-slide_item">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img class="primary-img" src="https://i.pravatar.cc/356?u={{ $user->id }}" >
                                            <img class="secondary-img" alt="{{ $user->name }}" >
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <div class="rating-box">
                                                <ul>
                                                    <li><i class="ion-android-star"></i></li>
                                                    <li><i class="ion-android-star"></i></li>
                                                    <li><i class="ion-android-star"></i></li>
                                                    <li class="silver-color"><i class="ion-android-star"></i>
                                                    </li>
                                                    <li class="silver-color"><i class="ion-android-star"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <h6><a class="product-name" href="{{ route('sessions.show', $user->id)}}">{{ $user->name }}</a></h6>
                                            <div class="price-box">
                                                <span class="new-price">$150.00</span>
                                            </div>
                                            <div class="product-short_desc">
                                                <p>{{ $user->name }}</p>
                                            </div>
                                        </div>

                                        <div class="add-actions">
                                            <ul>
                                                <li><a class="uren-add_cart" href="" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                </li>
                                                <li><a class="uren-wishlist" href="" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                    class="ion-android-favorite-outline"></i></a>
                                                </li>
                                                <li><a class="uren-add_compare" href="" data-toggle="tooltip" data-placement="top" title="Compare This Product"><i
                                                    class="ion-android-options"></i></a>
                                                </li>
                                                <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                    class="ion-android-open"></i></a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if(!isset($courses[0])&&!isset($users[0]))
                        <div class="wc-title">
							<h4>Sorry We could not find what you were searching for ! </h4>
						</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endsection