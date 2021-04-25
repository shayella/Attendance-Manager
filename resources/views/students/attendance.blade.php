@extends('layouts.app')


@section('content')
  <div class="container">
    <a class="btn btn-secondary" href="/home"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back Home</a>
    <div class="row justify-content-center">
      <br><br>
      <h2>Attendance Sheet for Class id - {{$students[0]->class_id}} </h2>
      <br><br><br>
      <div class="col-11 table-responsive">
        <table class="table table-striped table-bordered table-condensed">
          <tr>
            <th>Student RollNo</th>
            <th>Full Name</th>
            <th>Attendance</th>
            <th>Classes Attended</th>
            <th>Attendance Last Recorded On</th>
          </tr>
          @if(count($students) > 0)
            <form class="form" action="{{ route ('student.update', $students[0]->id)}}" method="post">
              @csrf
              @method('PUT')
              @foreach ($students as $student )
                <tr>
                  <td>{{$student->rollno}}</td>
                  <td>{{$student->name}}</td>

                  @if($student->updated_at->format('Y-m-d') == date('Y-m-d'))
                  <td>
                    <input type="checkbox" value="" disabled title="You already recorded this student's attendance for today" checked name="std[{{$student->id}}]">&nbsp;&nbsp;Present
                  </td>

                  @else
                  <td>
                    <input type="checkbox" value="present" name="std[{{$student->id}}]">&nbsp;&nbsp;Present
                  </td>
                  @endif

                  <td>{{$student->classesAttended}} out of 72 </td>
                  <td>{{$student->updated_at}}</td>

                  </td>
                </tr>

              @endforeach

          @else
            <br><br>
            <h4>There are no registered students in this class yet. <a href='/student/create'>Click Here to register students</a></h4>
            <br><br>

          @endif
        </table>
        <div class="form-group">
          <input type="submit" class="btn btn-lg btn-primary" name="btnsubmit" value="Save Attendance"> &nbsp;&nbsp;
        </div>
    </form>
      </div>

    </div>
  </div>



@endsection
