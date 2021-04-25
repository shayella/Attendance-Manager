@extends('layouts.app')

@section('content')

  <div class="container">
    <hr>
    <h3>All Registered Classes</h3>
    <hr>
    <table class="table table-striped table-bordered table-condensed">
    <tr>
      <th>ClassID</th>
      <th>Batch No</th>
      <th>Lecture Days</th>
      <th>Lecture Time</th>
      <th>Semester</th>
      <th>Course(s) Being Covered</th>
      <th>Semester Duration</th>
      <th>Trainer's Name</th>
      <th>No of Students in class</th>
    </tr>

    <script>
      function ConfirmDelete()
      {
      var x = confirm("Are you sure you want to delete this student?");
      if (x)
        return true;
      else
        return false;
      }

    </script>

    @if(count($batches) > 0)
        @foreach ($batches as $batch )
          <tr>
            <td>{{$batch->id}}</td>
            <td>{{$batch->batchno}}</td>
            <td>{{$batch->dayofweek}}</td>
            <td>{{$batch->time}}</td>
            <td>{{$batch->semester}}</td>
            <td>{{$batch->courses}}</td>
            <td>{{$batch->startdate}} to {{$batch->enddate}}</td>
            <td>{{$batch->tutor->name}}</td>
            <td>{{count($batch->students)}}</td>

            <!-- <td> -->
              <!-- <a href="/student/{{$batch->id}}/edit" class="btn btn-secondary rounded-circle mb-2" title="Edit Student Details"><i class="far fa-edit"></i></a> -->
              <!-- @if(!Auth::guest()) -->
                <!-- @if(Auth::user()->id  ) -->
                    <!-- {!!Form::open(['route' => ['student.destroy',$batch->id ], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()']) !!}
                      {{Form::hidden('batchid', $batch->id)}}
                      {{Form::hidden('_method','DELETE')}}
                      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'title'=>'Delete Student','class'=> 'btn btn-danger rounded-circle']) !!}
                    {!! Form::close() !!}
                    <span></span> -->
                <!-- @else -->
                <!-- @endif -->
             <!-- @endif
            </td> -->
          </tr>
        @endforeach
        <br>
    @else
      <br><br>
      <h4>There are no registered students in this class yet. <a href='/student/create'>Click Here to register students</a></h4>
      <br><br>
    @endif
  </table>

</div>


@endsection
