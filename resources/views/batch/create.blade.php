@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4>Add a class to teach</h4>
              </div>
              <div class="card-body">

                <form class="form" action="{{ route('batch.store') }}" method="POST">
                  @csrf

                  <div class="form-group">
                    <label for="bactchno" class="col-form-label text-md-right">Batch Number(s)</label>
                    <input class="form-control" type="text" id="batchno" name="batchno" placeholder="e.g CP201702C" value="">
                  </div>

                  <div class="form-group">
                    <label for="time" class="col-form-label text-md-right">Time Duration</label>
                    <select id="time" class="form-control" name="time">
                      <option value="9:00 am - 11:00 am">9:00 am - 11:00 am</option>
                      <option value="11:00 am - 1:00 pm">11:00 am - 1:00 pm</option>
                      <option value="3:00 pm - 5:00 pm">3:00 pm - 5:00 pm</option>
                      <option value="5:00 pm - 7:00 pm">5:00 pm - 7:00 pm</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="days" class="col-form-label text-md-right">Lecture Days</label>
                    <select id="days" class="form-control" name="days">
                      <option value="Mon, Wed, Fri">Mon, Wed, Fri</option>
                      <option value="Tues, Thur, Sat">Tues, Thur, Sat</option>
                      <option value="Tues, Thur">Tues, Thur</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="sem" class="col-form-label text-md-right">Semester</label>
                    <input class="form-control" type="number" id="sem" min="1" max="6" name="sem" value="">
                  </div>

                  <div class="form-group">
                    <label for="sd" class="col-form-label text-md-right">Semester StartDate</label>
                    <input class="form-control" type="date" id="sd"  name="sd" value="">
                  </div>

                  <div class="form-group">
                    <label for="ed" class="col-form-label text-md-right">Semester EndDate</label>
                    <input class="form-control" type="date" id="ed" name="ed" value="">
                  </div>

                  <div class="form-group">
                    <label for="course" class="col-form-label text-md-right">Courses Lectured </label>
                    <input type="text" id="course" class="form-control" name="course" value="">
                  </div>

                  <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Save">
                  </div>
                </form>

              </div>
              </div>

        </div>
    </div>
</div>

@endsection
