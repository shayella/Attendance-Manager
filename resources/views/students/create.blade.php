@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4>Add Student to a Class</h4>
              </div>
              <div class="card-body">

                <form class="form" action="{{ route('student.store') }}" method="POST">
                  @csrf

                  <div class="form-group">
                    <label for="rollno" class="col-form-label text-md-right">Roll Number</label>
                    <input class="form-control" type="text" id="rollno" name="rollno" placeholder="e.g CP201702C012" value="">
                  </div>

                   <div class="form-group">
                      <label for="classid" class="col-form-label text-md-right">Class ID / Class Batch No</label>
                      <select class="form-control" name="classid">
                        @if(count($batches) > 0)
                        @foreach($batches as $batch)
                          <option value="{{$batch->id}}">{{$batch->batchno}} (class id - {{$batch->id}})</option>
                        @endforeach
                        @else
                        <p>You don't have any registered classes. First <a href="/batch/create"> register a class </a> then add students to it.</p>
                        @endif
                      </select>
                    </div>

                  <div class="form-group">
                    <label for="name" class="col-form-label text-md-right">Full Name</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="" value="">
                  </div>

                  <div class="form-group">
                   <label for="gender" class="col-form-label text-md-right">Gender</label><br>
                   <input class="" type="radio" group="gender" id="gender" name="gender" placeholder="" value="Male">Male &nbsp;&nbsp;&nbsp;
                   <input class="" type="radio" group="gender" id="gender" name="gender" placeholder="" value="Female">Female

                 </div>

                  <div class="form-group">
                    <label for="email" class="col-form-label text-md-right">Email</label>
                    <input class="form-control" type="email" id="email" name="email" placeholder="" value="">
                  </div>

                  <div class="form-group">
                    <label for="phone" class="col-form-label text-md-right">Phone Number</label>
                    <input class="form-control" type="tel" id="phone" name="phone" placeholder="" value="">
                  </div>

                   <div class="form-group">
                    <label for="gname" class="col-form-label text-md-right">Guardian's /sponsor Name</label>
                    <input class="form-control" type="text" id="gname" name="gname" placeholder="" value="">
                  </div>



                  <div class="form-group">
                    <label for="gemail" class="col-form-label text-md-right">Guardian's Email</label>
                    <input class="form-control" type="gemail" id="gemail" name="gemail" placeholder="" value="">
                  </div>

                  <div class="form-group">
                    <label for="gphone" class="col-form-label text-md-right">Guardian's Phone Number</label>
                    <input class="form-control" type="tel" id="gphone" name="gphone" placeholder="" value="">
                  </div>


                  <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Add Student">
                  </div>
                </form>

              </div>
              </div>

        </div>
    </div>
</div>

@endsection
