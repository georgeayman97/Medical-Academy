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


                                <th class="text-center">NAME</th>
                                <th class="text-center">MOBILE</th>
                                <th class="text-center">FACULTY</th>
                                <th class="text-center">YEAR</th>
                                <th class="text-center">ROLE</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center">ACTIVITY</th>
                                <th class="text-center">CREATED AT</th>
                                <th class="text-center">APPROVE</th>
                                <th class="text-center">BAN</th>
                                <th class="text-center">RESET DEVICE</th>
                                <th class="text-center">EDIT</th>
                                <th class="text-center">DELETE</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- we have automatic directives istead of this way -->
                            <!-- php// foreach($categories as $category) : // : istead of '{'  -->
                            @foreach($users as $user)

                                <tr>

                                    <td class="text-center"><a
                                            href="{{ route('courses.enrolled', $user->id)}}">{{ $user->name }}</a></td>
                                    <td class="text-center">{{ $user->mobile }}</td>
                                    <td class="text-center">{{ $user->faculty->name }}</td>
                                    <td class="text-center">{{ $user->year }}</td>
                                    <td class="text-center">{{ $user->role }}</td>
                                    <!-- <a href="#" class="btn button-sm green radius-xl">active</a> -->
                                    @if($user->status == "disabled")
                                        <td class="btn button-md red radius-xl text-center"
                                            style="margin-top: 4px;">{{ $user->status }}</td>
                                    @elseif($user->status == "request")
                                        <td class="btn button-md grey radius-xl text-center"
                                            style="margin-top: 4px;">{{ $user->status }}</td>
                                    @else
                                        <td class="btn button-md green radius-xl text-center"
                                            style="margin-top: 4px;">{{ $user->status }}</td>
                                    @endif
                                    <td class="text-center">{{ $user->logged_in ? 'Online' : 'Offline' }}</td>
                                    <td class="text-center">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('accounts.approve', $user->id)}}" method="get">
                                            @csrf
                                            <button type="submit" class="btn green btn-sm">Approve</button>
                                        </form>
                                    </td>
                                    <td class="text-center"><a href="{{ route('accounts.ban', $user->id)}}"
                                                               class="btn btn-sm btn-dark">Ban</a></td>
                                    <td class="text-center"><a href="{{ route('accounts.resetDevice', $user->id)}}"
                                                               class="btn btn-sm btn-dark">Reset Device</a></td>
                                    <td class="text-center"><a style="height:3.5em; width: 5em;" class="uren-add_cart"
                                                               href="{{ route('accounts.edit', $user->id)}}"
                                                               data-toggle="tooltip" data-placement="top"
                                                               title="Edit User"><i
                                                class="fa fa-edit"> Edit</i></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('accounts.destroy', $user->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn red btn-sm btn-danger">Delete</button>
                                        </form>
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
