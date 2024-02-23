@extends('layouts.admin')


@section('content')

    <div class="db-breadcrumb">
        <h4 class="breadcrumb-title">Course Requests</h4>
        <ul class="db-breadcrumb-list">
            <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
            <li>Requests</li>
            <li>Course Requests</li>
        </ul>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <!-- Your Profile Views Chart -->
        <div class="col-lg-12 m-b30">
            <div class="widget-box">
                <div class="wc-title">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="col-6">Course Requests</h4>
                        </div>
                        <div class="col-6 text-right">
                            @if($course_id == null)
                                <a class="btn btn-primary" href="{{ route('requests.disabled')}} ">Disabled</a>
                            @else
                                <a class="btn btn-primary" href="{{ route('requests.disabled',['id'=>$course_id] )}} ">Disabled</a>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="widget-inner">
                    <div class="row mb-3">
                        @if($status == "disabled")
                            <form action="{{ route('requests.disabled') }}" method="GET" class="form-inline d-flex">
                                @else
                                    <form action="{{ route('courseaccess.requests') }}" method="GET"
                                          class="form-inline d-flex">
                                        @endif
                                        <!-- Instructor Filter -->
                                        <div class="form-group mr-3">
                                            <label for="instructor_id" class="mr-2">Instructor:</label>
                                            <select name="instructor_id" id="instructor_id" class="form-control">
                                                <option value="">Select Instructor</option>
                                                @foreach($instructors as $instructor)
                                                    <option
                                                        value="{{ $instructor->id }}" {{ request('instructor_id') == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Course Year Filter -->
                                        <div class="form-group mr-3">
                                            <label for="course_year" class="mr-2">Course Year:</label>
                                            <select name="course_year" id="course_year" class="form-control">
                                                <option value="">Select Course Year</option>
                                                @foreach($courseYears as $year)
                                                    <option
                                                        value="{{ $year }}" {{ request('course_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary" style="margin-top: 25px;">Apply
                                            Filters
                                        </button>
                                    </form>
                    </div>


                    <div class="table-responsive">
                        <form action="{{ route('courseaccess.action') }}" method="POST">
                            @csrf
                            <button type="submit" name="action" value="approve" class="btn btn-primary"
                                    style="margin-bottom: 10px;" disabled>Approve
                            </button>
                            @if($status == "requests")
                                <button type="submit" name="action" value="disable" class="btn btn-danger"
                                        style="margin-bottom: 10px;" disabled>Disable
                                </button>
                            @endif
                            @if($status == "disabled")
                                <button type="submit" name="action" value="delete" class="btn btn-danger"
                                        style="margin-bottom: 10px;" disabled>Delete
                                </button>
                            @endif

                            <div id="message" class="text-danger"></div>
                            <table class="table">
                                <thead>
                                <tr>


                                    <th><input type="checkbox" id="check-all"></th>
                                    <th>USER NAME</th>
                                    <th>MOBILE</th>
                                    <th>COURSE NAME</th>
                                    <th>DOCTOR NAME</th>
                                    <th>YEAR</th>
                                    <th>STATUS</th>
                                    <th>REQUEST DATE</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($coursesAccesses as $coursesAccess)

                                    <tr>
                                        <td><input type="checkbox" name="coursesAccess[]"
                                                   value="{{ $coursesAccess->id }}"></td>
                        </form>
                        <td><a href="{{ route('courses.enrolled', $coursesAccess->user->id)}}">{{ $coursesAccess->user->name }}</a></td>
                        <td>{{ $coursesAccess->user->mobile }}</td>
                        <td>{{ $coursesAccess->course->name }}</td>
                        <td>{{ $coursesAccess->course->doctor->name }}</td>
                        <td>{{ $coursesAccess->course->course_year }}</td>
                        <td class="btn button-md green radius-xl"
                            style="margin-top: 4px;">{{ $coursesAccess->status }}</td>
                        <td>{{ $coursesAccess->created_at }}</td>
                        <td>
                            <form action="{{ route('courseaccess.approve', $coursesAccess->id) }}" method="post">
                                @csrf
                                <button type="submit" name="action" class="btn btn-primary"
                                        style="margin-bottom: 10px;">Approve
                                </button>
                            </form>
                        </td>
                        @if($status == "disabled")
                            <td>
                                <form action="{{ route('courseaccess.destroy', $coursesAccess->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn red btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        @endif
                        @if($status == "requests")
                            <td>
                                <form action="{{ route('courseaccess.disable', $coursesAccess->id)}}" method="get">
                                    @csrf
                                    <button type="submit" class="btn red btn-sm">Disable</button>
                                </form>
                            </td>
                            @endif
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
