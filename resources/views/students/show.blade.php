@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="">
        <a href="/home" class="btn btn-lg btn-primary">Back Home</a>
      </div>
      <br><br><br>
      <h2>Here are all The Registered Students from this Class </h2>
      <br><br>
      <div class="col-12 table-responsive" >
        <table class="table table-striped table-bordered table-condensed">
          <tr>
            <th>Student RollNo</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Gender</th>
            <th>Guardian's Name</th>
            <th>Guardian's Phone Number</th>
            <th>Attendance Percentange</th>
            <th>Actions</th>

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

          @if(count($students) > 0)
              @foreach ($students as $student )
                <tr>
                  <td>{{$student->rollno}}</td>
                  <td>{{$student->name}}</td>
                  <td><a href="mailto:{{$student->email}}?Subject = Email">{{$student->email}}</a></td>
                  <td><a href="tel:{{$student->phone}}">{{$student->phone}}</a></td>
                  <td>{{$student->gender}}</td>
                  <td>{{$student->gname}}</td>
                  <td><a href="tel:{{$student->gphone}}">{{$student->gphone}}</a></td>
                  <td>{{ number_format($student->classesAttended / 72 * 100, 2) }}%</td>
                  <td>
                    <a href="/student/{{$student->id}}/edit" class="btn btn-secondary rounded-circle mb-2" title="Edit Student Details"><i class="far fa-edit"></i></a>
                    @if(!Auth::guest())
                      <!-- @if(Auth::user()->id  ) -->
                          {!!Form::open(['route' => ['student.destroy', $student->id], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()']) !!}
                            {{Form::hidden('student_id', $student->id)}}
                            {{Form::hidden('_method','DELETE')}}
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'title'=>'Delete Student','class'=> 'btn btn-danger rounded-circle']) !!}
                          {!! Form::close() !!}
                          <span></span>
                      <!-- @else -->
                      <!-- @endif -->
                   @endif
                  </td>
                </tr>
              @endforeach
          @else
            <br><br>
            <h4>There are no registered students in this class yet. <a href='/student/create'>Click Here to register students</a></h4>
            <br><br>
          @endif
        </table>
      </div>

    </div>
  </div>



@endsection
