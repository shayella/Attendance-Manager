@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
          <h3>Hello there, Tutor {{Auth::user()->name}}</h3>
            <div class="card">
                <div class="card-header">Faculty's Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br>
                    <hr>
                    <h3>Your Registered Classes</h3>
                    <hr>
                    <div class="row justify-content-center">
                      @if(count($batches) > 0)
                        @foreach ($batches as $batch )
                        <div class="card col-md-3.1 ml-4 mt-3">
                            <div class="card-header ">
                              <div class="row">
                                <div class="col-9">
                                  <h5>ClassID - {{$batch->id}}</h5>
                                </div>

                                <div class="col-3">
                                  <script>
                                    function ConfirmDelete()
                                    {
                                    var x = confirm("Are you sure you want to delete this class?");
                                    if (x)
                                      return true;
                                    else
                                      return false;
                                    }

                                  </script>


                                  <!-- @if(!Auth::guest())
                                    @if(Auth::user()->id == $batch->tutor_id)
                                        {!!Form::open(['route' => ['batch.destroy', $batch->id], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                          {{Form::hidden('batch_id', $batch->id)}}
                                          {{Form::hidden('_method','DELETE')}}
                                          {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'title'=>'Delete This Class','class'=> 'btn btn-danger rounded-circle']) !!}
                                        {!! Form::close() !!}
                                        <span></span>
                                    @else
                                    @endif
                                 @endif -->
                                </div>
                              </div>
                            </div>
                            <div class="card-body">
                              <h6>BatchNumber: {{$batch->batchno}}</h6>
                              <h6>Lecture Time: {{$batch->time}}</h6>
                              <h6>Lecture Days: {{$batch->dayofweek}}</h6>
                              <h6>Semester : {{$batch->semester}}</h6>
                              <h6>Course(s) : {{$batch->courses}}</h6>
                              <h6>Semester Duration : {{$batch->startdate}} to {{$batch->enddate}}</h6>
                              <h6>Total Students in class : <span class="badge badge-success p-2">{{count($batch->students)}}</span></h6>
                            </div>

                            <div class="card-footer">
                              <div class="row justify-content-center">
                                <div class="col-5">
                                <button class="btn btn-secondary text-light" type="button" name="button"><a href="/student/{{$batch->id}}" class="text-white" title="View Students in this Batch"><i class="far fa-eye"></i>&nbsp;View Students</a></button>
                                </div>

                                <div class="col-7">
                                  <button class="btn btn-info text-light" type="button" name="button"><a href="/student/{{$batch->id}}/edit" class="text-white" title="Take Attendance"><i class="far fa-eye"></i>&nbsp;Take Attendance</a></button>

                                </div>


                              </div>


                            </div>

                        </div>
                        @endforeach

                        @else
                        <h4>OOPS!! You dont have any registered classes yet. <a href="/batch/create">Click Here to register a class</a></h4>
                      @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
