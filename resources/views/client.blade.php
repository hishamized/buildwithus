@extends('layouts.app')


@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="container">
    <div class="my-4">
        <h1>Welcome to Client Mode</h1>
    </div>
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <button class="list-group-item list-group-item-action" id="post-job-button">Post a Job Offer</button>
                <button class="list-group-item list-group-item-action" id="my-job-offers-button">My Job Offers</button>
                <button class="list-group-item list-group-item-action" id="open-assignments-button">My Assignments</button>
                <!-- Add more sidebar options as needed -->
            </div>
        </div>

        <!-- Content Area -->
        <div class="col-md-9">
            <div id="post-job-content" style="display: none;">
                <form id="new-job-form" action="{{ route('postJob') }}" method="POST" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-3">
                        <label for="job_title">Job Title</label>
                        <input type="text" class="form-control" id="job_title" name="job_title" required>
                    </div>

                    <div class="form-group my-3">
                        <label for="job_description">Job Description</label>
                        <textarea class="form-control" id="job_description" name="job_description" rows="4" required></textarea>
                    </div>

                    <div class="form-group my-3">
                        <label for="job_requirements">Job Requirements</label>
                        <textarea class="form-control" id="job_requirements" name="job_requirements" rows="4" required></textarea>
                    </div>

                    <div class="form-group my-3">
                        <label for="hiring_capacity">Hiring Capacity</label>
                        <input type="number" class="form-control" id="hiring_capacity" name="hiring_capacity" required>
                    </div>

                    <!-- Individual form fields for address components -->
                    <div class="form-group my-3">
                        <label for="street_address">Street Address</label>
                        <input type="text" class="form-control" id="street_address" name="street_address" required>
                    </div>

                    <div class="form-group my-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>

                    <div class="form-group my-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                    </div>

                    <div class="form-group my-3">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" required>
                    </div>

                    <div class="form-group my-3">
                        <label for="pin_code">Pin Code</label>
                        <input type="text" class="form-control" id="pin_code" name="pin_code" required>
                    </div>

                    <!-- Hidden input field for site_address -->
                    <input type="hidden" id="site_address" name="site_address" value="A">



                    <div class="form-group my-3">
                        <label for="job_type">Job Type:</label>
                        <select class="form-control" id="job_type" name="job_type" required>
                            <option value="full_time">Daily Wage</option>
                            <option value="part_time">Contractual</option>
                            <!-- Add more job types as needed -->
                        </select>
                    </div>

                    <div class="form-group my-3">
                        <label for="start_date">Start Date:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>

                    <div class="form-group my-3">
                        <label for="end_date">End Date:</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>

                    <div class="form-group my-3">
                        <label for="expiration_date">Expiration Date:</label>
                        <input type="date" class="form-control" id="expiration_date" name="expiration_date" required>
                    </div>

                    <div class="form-group my-3">
                        <label for="skill_set">Skill Set</label>
                        <input type="text" class="form-control" id="skill_set" name="skill_set" placeholder="Skills (comma-separated)" required>
                    </div>

                    <div class="form-group my-3">
                        <label for="site_pictures">Site Pictures:</label>
                        <input type="file" class="form-control" id="site_pictures" name="site_pictures[]" multiple accept="image/*">
                        <small class="text-muted">Maximum 4 pictures allowed.</small>
                    </div>

                    <div class="form-group my-3">
                        <label for="wage">Wage:</label>
                        <input type="number" class="form-control" id="wage" name="wage" step="0.01" required>
                    </div>

                    <div class="form-group my-3">
                        <label for="currency">Currency:</label>
                        <select class="form-control" id="currency" name="currency" required>
                            <option value="Indian Rupees">Indian Rupees</option>
                            <option value="Dollars">Dollars</option>
                            <option value="Saudi Arabian Riyal">Saudi Arabian Riyal</option>
                            <!-- Add more currency options as needed -->
                        </select>
                    </div>


                    <button type="submit" value="submit" class="btn btn-primary">Post Job</button>
                </form>

            </div>
            <div id="my-job-offers-content" style="display: none;">
                <div class="container">
                    <h2>My Jobs</h2>
                    <p><span>This is a list of all the Jobs you have posted on this platform</span></p>
                    <ul class="list-group">
                        @foreach($jobs as $job)
                        <li class="list-group-item">
                            <div> <Strong>Job Title: </Strong>{{ $job->job_title }}</div>
                            <div> <strong> Posted On: </strong>{{ $job->created_at->format('Y-m-d') }}</div>
                            <div><span> {{$job->views}} Views</span> <span> {{$job->application_count}} Applications </span> </div>
                            <a href="{{ route('job-details', ['id' => $job->id]) }}" class="btn btn-primary btn-sm float-right">View Full Details</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="open-assignments-content" style="display: none;">
                <div class="container">
                    <h2>Your Assignments  </h2>
                    <small>Jobs assigned by you to others.</small>

                    @if ($assignments->isEmpty())
                    <p>You haven't assigned any jobs yet.</p>
                    @else
                    <ul class="list-group">
                        @foreach ($assignments as $assignment)
                        <li class="list-group-item">
                            <h5 class="mb-3">Job Title: {{ $assignment->job->job_title }}</h5>
                            <p class="mb-1">Hired User: {{ $assignment->employee->name }}</p>
                            <p class="mb-1">Assignment Date: {{ $assignment->created_at->format('F d, Y') }}</p>
                            <p class="mb-1">Assignment Status: {{ $assignment->assignment_status }}</p>

                            <!-- Button to view the profile of the hired user -->
                            <a href="{{ route('generalProfile', ['id' => $assignment->employee->id]) }}" class="btn btn-primary btn-sm mr-2">View User Profile</a>

                            <!-- Button to view the job details -->
                            <a href="{{ route('jobFullView', ['id' => $assignment->job->id]) }}" class="btn btn-success btn-sm">View Job Details</a>

                            @if( $assignment->assignment_status != "cancelled" )
                            <a href="{{ route('cencelAssignment', ['assignmentId' => $assignment->id]) }}"  class="btn btn-warning btn-sm">Cancel Assignment</a>
                             @endif

                            <a href="{{ route('deleteAssignment', ['assignmentId' => $assignment->id]) }}"  class="btn btn-danger btn-sm">Delete Assignment</a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>


            </div>
            <!-- Add more content sections for other features as needed -->
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to the sidebar buttons and content sections
        const postJobButton = document.getElementById('post-job-button');
        const myJobOffersButton = document.getElementById('my-job-offers-button');
        const openAssignmentsButton = document.getElementById('open-assignments-button');

        const postJobContent = document.getElementById('post-job-content');
        const myJobOffersContent = document.getElementById('my-job-offers-content');
        const openAssignmentsContent = document.getElementById('open-assignments-content');

        // Add click event listeners to the sidebar buttons
        postJobButton.addEventListener('click', function() {
            hideAllContentSections();
            postJobContent.style.display = 'block';
        });

        myJobOffersButton.addEventListener('click', function() {
            hideAllContentSections();
            myJobOffersContent.style.display = 'block';
        });

        openAssignmentsButton.addEventListener('click', function() {
            hideAllContentSections();
            openAssignmentsContent.style.display = 'block';
        });

        // Function to hide all content sections
        function hideAllContentSections() {
            postJobContent.style.display = 'none';
            myJobOffersContent.style.display = 'none';
            openAssignmentsContent.style.display = 'none';
            // Add more lines for other content sections as needed
        }

        const sitePicturesInput = document.getElementById('site_pictures');

        sitePicturesInput.addEventListener('change', function() {
            const files = sitePicturesInput.files;

            if (files.length > 4) {
                alert('Maximum 4 pictures allowed. Please select up to 4 pictures.');
                // Clear the input field
                sitePicturesInput.value = '';
            }
        });


    });

    document.getElementById('new-job-form').addEventListener('submit', function (e) {
            var skillSetInput = document.getElementById('skill_set').value;
            var isValid = /^[\w\s]+(,\s[\w\s]+)*$/.test(skillSetInput); // Check for words separated by commas and spaces
            if (!isValid) {
                console.log("Not Valid text");
                e.preventDefault(); // Prevent form submission
                alert('Please enter a valid skill set, separated by commas and spaces.');
            } else {
                console.log("Valid text");
            }
        });
</script>
@endsection

@endsection
