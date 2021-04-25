@extends('layouts.app')


@section('content')
  <div class="container">
    <a href="/admin" class="btn btn-lg btn-primary">Back Home</a>
    <br>
    <div class="row justify-content-center">
      <br>
      <h2>Here are all The Registered Faculty Members</h2>
      <br><br>
      <div class="col-11 table-responsive">
        <table class="table table-striped table-bordered table-condensed">
          <tr>
            <th>Tutor's ID</th>
            <th>Tutor's Full Name</th>
            <th>Tutor's Email</th>
            <th>Tutor's Phone Number</th>
            <th>Registered_On</th>
            <th>Courses Teaching</th>
            <th>Actions</th>
          </tr>
          @if(count($tutors) > 0)
              @foreach ($tutors as $tutor )
                <tr>
                  <td>{{$tutor->id}}</td>
                  <td>{{$tutor->name}}</td>
                  <td><a href="mailto:{{$tutor->email}}?Subject = Email">{{$tutor->email}}</a></td>
                  <td><a href="tel:{{$tutor->phone}}">{{$tutor->phone}}</a></td>
                  <td>{{$tutor->created_at}}</td>
                  <td>{{$tutor->user_name}}</td>
                  <script>
                    function ConfirmDelete()
                    {
                    var x = confirm("Are you sure you want to delete this tutor?");
                    if (x)
                      return true;
                    else
                      return false;
                    }

                  </script>
                  <td>

                    <a href="/faculty/{{$tutor->id}}/edit" class="btn btn-secondary rounded-circle mb-2" title="Edit Tutor"><i class="far fa-edit"></i></a>

                    @if(!Auth::guest())
                      @if(Auth::user()->role == 'Admin')
                          {!!Form::open(['route' => ['faculty.destroy', $tutor->id], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()']) !!}
                            {{Form::hidden('tutor_id', $tutor->id)}}
                            {{Form::hidden('_method','DELETE')}}
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'title'=>'Delete Tutor','class'=> 'btn btn-danger rounded-circle']) !!}
                          {!! Form::close() !!}
                          <span></span>
                      @else
                      @endif
                   @endif
                  </td>
                </tr>

              @endforeach

          @else
            <br><br>
            <h4>There are no registered tutors/faculty members yet. <a href='/faculty/create'>Click Here to register a faculty member</a></h4>
            <br><br>
          @endif
        </table>
      </div>

    </div>
  </div>



@endsection
