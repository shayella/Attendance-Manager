@extends('layouts.app')

@section('content')

  <div class="card">

    <div class="card-header">
      <h2>Import Student Details</h2>
    </div>

      <div class="card-body">
        <form class="form" action="/import" enctype="multipart/form-data" method="post">
          @csrf
          <div class="form-group">
             <label for="classid" title="What class are you adding these students to?" class="col-form-label text-md-right">Class ID / Class Batch No </label>&nbsp;&nbsp;
             <select class="" name="classid">
               @if(count($batches) > 0)
               @foreach($batches as $batch)
                 &nbsp;&nbsp;<option value="{{$batch->id}}">{{$batch->batchno}} (ClassID - {{$batch->id}}) &nbsp;&nbsp;&nbsp;</option>
               @endforeach
               @else
               <p>You don't have any registered classes. First <a href="/batch/create"> register a class </a> then add students to it.</p>
               @endif
             </select>
           </div>
          <div class="form-group">
            <label for="excelfile" class="col-form-label text-md-right">Select a spreadsheet </label>&nbsp;&nbsp;
            <input id="excelfile" type="file" name="excelfile" value="Upload File">
          </div>
          <br>

          <div class="form-group">
            <input type="submit" name="btnsubmit"  class="btn btn-primary btn-lg " value="Import Students">
          </div>
        </form>
      </div>
  </div>

@endsection
