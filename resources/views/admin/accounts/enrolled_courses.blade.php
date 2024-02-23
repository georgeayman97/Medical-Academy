@extends('layouts.admin')


@section('content')

<div class="db-breadcrumb">
    <h4 class="breadcrumb-title">Course Requests</h4>
    <ul class="db-breadcrumb-list">
        <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
        <li>Requests</li>
        <li>Course Enrollment</li>
    </ul>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="row">
    <!-- Your Profile Views Chart -->
    <div class="col-lg-12 m-b30">
        <div class="widget-box">
            <div class="wc-title col-12">
                <div class="form-row">
                    <h4 class="col-10">Course Enrollment <span class="text-primary" style="display: block;">Users Enrolled {{$enrollment->count()}}</span></h4>
                    @if($enrollment->count() != 0)
                    @if($enrollment->first()->course_id == null)
                    <a class="btn btn-primary" href="{{ route('requests.disabled')}} " style="margin-right: 18px;">Disabled</a>
                    @else
                    <a class="btn btn-primary" href="{{ route('requests.disabled', ['id' => $enrollment->first()->course_id] )}}" style="margin-right: 18px;">Disabled</a>
                    @endif
                    @endif
                </div>
            </div>
            <div class="widget-inner">


                <div class="table-responsive">
                    <form action="{{ route('accounts.action') }}" method="POST">
                        @csrf
                        <button type="submit" name="action" value="enroll" class="btn btn-primary" style="margin-bottom: 10px;" disabled>Enroll</button>
                        <button type="submit" name="action" value="disable" class="btn btn-danger" style="margin-bottom: 10px;" disabled>Disable</button>

                        <div id="message" class="text-danger"></div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="check-all"></th>
                                    <th>NAME</th>
                                    <th>EMAIL ADDRESS</th>
                                    <th>MOBILE NUMBER</th>
                                    <th>COURSE NAME</th>
                                    <th>STATUS</th>
                                    <th>ENROLLMENT DATE</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- we have automatic directives istead of this way -->
                                <!-- php// foreach($categories as $category) : // : istead of '{'  -->

                                @foreach($enrollment as $enroll)

                                <tr>
                                    <td><input type="checkbox" name="users[]" value="{{ $enroll->id }}"></td>
                                    </form>
                                    <td>{{ $enroll->user->name }}</td>
                                    <td>{{ $enroll->user->email }}</td>
                                    <td>{{ $enroll->user->mobile }}</td>
                                    <td>{{ $enroll->course->name }}</td>
                                    @if($enroll->status == 'enrolled')
                                    <td class="btn button-md green radius-xl" style="margin-top: 4px;">{{ $enroll->status }}</td>
                                    @else
                                    <td class="btn button-md red radius-xl" style="margin-top: 4px;">{{ $enroll->status }}</td>
                                    @endif
                                    <td>{{ $enroll->updated_at }}</td>
                                    @if($enroll->status == 'enrolled')
                                    <td>
                                        <form action="{{ route('accounts.disable', $enroll->id)}}" method="get">
                                            @csrf
                                            <button type="submit" class="btn red btn-sm btn-danger">Disable</button>
                                        </form>
                                    </td>
                                    @else
                                    <td>
                                        <form action="{{ route('accounts.enroll', $enroll->id)}}" method="get">
                                            @csrf
                                            <button type="submit" class="btn green btn-sm">Enroll</button>
                                        </form>
                                    </td>
                                    @endif
                                    <!-- <td><form action="{{ route('usertracking.counter', ['user_id' => $enroll->user->id,
                                                    'course_id'=>$enroll->course_id])}}" method="get">
                                            @csrf
                                            <button type="submit" class="btn red btn-sm btn-danger">Views</button>
                                        </form></td> -->
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
<script>
    // Get the "check-all" checkbox, all the checkboxes in the table, the buttons, and the message element
    const checkAll = document.getElementById('check-all');
    const checkboxes = document.querySelectorAll('table input[type="checkbox"]');
    const buttons = document.querySelectorAll('form button[type="submit"]');
    const message = document.getElementById('message');

    // Add an event listener to the "check-all" checkbox
    checkAll.addEventListener('change', () => {
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkAll.checked;
        });
        updateButtons();
    });

    // Add event listeners to the checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            updateButtons();
        });
    });

    // Function to update the disabled state of the buttons and display a message if no checkboxes are checked
    function updateButtons() {
        let isChecked = false;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                isChecked = true;
            }
        });
        buttons.forEach(button => {
            button.disabled = !isChecked;
        });
        if (!isChecked) {
            message.innerHTML = 'Please select at least one user.';
        } else {
            message.innerHTML = '';
        }
    }
</script>
@endsection
