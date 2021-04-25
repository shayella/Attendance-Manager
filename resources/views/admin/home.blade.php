@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>Hello there , Admin {{ Auth::user()->name }}</h2>
            <div class="card">
                <div class="card-header">Welcome to the Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                      <div class="container">
                        <div class="row">
                          <h3>Overview</h3><br>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-4">
                            <h4 class="bg-dark text-light p-3"><a href="/faculty" class="text-white text-center" >Faculty Members &nbsp;</a><br><br>
                              <span class="display-10">Total : {{$total}}</span>
                            </h4>

                          </div>

                          <div class="col-4">
                              <h4 class="bg-dark text-light p-3"><a href="/student" class="text-white">Registered Students</a><br><br>
                                <span class=" display-10"> Total : {{$totalS}} </span>
                              </h4>
                          </div>

                          <div class="col-4">
                            <h4 class="bg-dark text-light p-3"><a href="/admin/classes" class="text-white">Registered Classes</a><br><br>
                              <span class=" display-10"> Total : {{$totalC}} </span>
                            </h4>
                          </div>

                        </div>
                        <br><br>
                        <div class="row">
                          <br>
                          <h3>Actions</h3><br>
                        </div>
                        <div class="row justify-content-center">
                          <a class="btn bg-success text-white lead font-weight-bold  p-3 mr-3" href="/batch/create"><i class="fas fa-users"></i>&nbsp;&nbsp;Add a Class</a> &nbsp;&nbsp;&nbsp;&nbsp;
                          <a class="btn bg-secondary text-white p-3 font-weight-bold mr-3" href="/student/create"><i class="fas fa-user"></i>&nbsp;&nbsp;Add Student To Class</a> &nbsp;&nbsp;&nbsp;&nbsp;
                          <a class="btn bg-primary text-white p-3 font-weight-bold mr-3" href="/import"><i class="fas fa-file-import"></i>&nbsp;&nbsp;Import Student Details</a> &nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="/faculty/create" class="btn bg-dark text-white p-3 font-weight-bold mr-3">&nbsp;&nbsp;<i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;Add Faculty Member</a>&nbsp;&nbsp;&nbsp;
                        </div>
                        <br><br>
                        <!-- <div class="row">
                          <h3>Percentage Class Attendance</h3><br>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-5 card ml-3 bg-primary">
                            <div class="card-body">
                              <h4 class="bg-default p-2"><a href="/faculty/create" class="text-white">Add Faculty Member</a> </h4>
                            </div>
                          </div>

                          <div class="col-5 card ml-3 bg-secondary">
                            <div class="card-body">
                              <h4 class="bg-default p-2"><a href="/faculty/create" class="text-white">Add Faculty Member</a> </h4>
                            </div>
                          </div>
                        </div>
                        <br><br> -->
                        <div class="row">
                          <h3>Today's Class Attendance &nbsp;&nbsp;</h3><span class="label label-info bg-info p-2">On: {{date('Y-m-d')}}</span>
                        </div>
                        <br>
                        <div class="row">
                          <table class="table  table-hover table-striped table-bordered">
                            <thead class="thead-info bg-primary text-light">
                              <th>ClassID - BatchNo</th>
                              <th>Semester</th>
                              <th>Courses Being Covered</th>
                              <th>Trainer</th>
                              <th title="students that attended today out of total students in class">Attendance (today's attendance)</th>
                              <th>Percentage Attendance </th>
                              <th>Contact Trainer</th>
                            </thead>

                            @if(count($batches)>0)
                            <?php $ind = 0; ?>
                            @foreach($batches as $batch)
                              <tr>
                                <td>{{$batch->id}} - {{$batch->batchno}}</td>
                                <td>{{$batch->semester}}</td>
                                <td>{{$batch->courses}}</td>
                                <td>{{$batch->tutor->name}}</td>
                                <td>{{$presentStudents[$ind]}} out of {{count($batch->students)}}</td>
                                @if(number_format($presentStudents[$ind] / count($batch->students) * 100, 2) >= 75)
                                  <td class="bg-success text-white">{{ number_format($presentStudents[$ind] / count($batch->students) * 100, 2) }}%</td>
                                @else
                                  <td class="bg-danger text-light">{{ number_format($presentStudents[$ind] / count($batch->students) * 100, 2) }}%</td>
                                @endif
                                <td>{{$batch->tutor->phone}}</td>
                              </tr>
                              <?php $ind++; ?>
                            @endforeach

                              @else
                              <h4>There are no classes registered yet!!</h4>

                            @endif
                          </table>
                        </div>
                      </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
