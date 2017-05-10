@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Select your study</div>
                <div class="panel-body">
                    <form class="" action="/locations" method="POST">
                        {{ csrf_field() }}

                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" onclick="optionForms();" >
                            Monitoring
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" onclick="alert('bye');">
                            Study Group
                          </label>
                        </div>


                       

                        <div class="form-group">
                            <label for="inputBuilding">Building:</label>
                            <input type="text" name="building" class="form-control" id="inputName" placeholder="Enter the location's building">
                        </div>


                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
  function optionForms() {
    echo 'TESTE';>
     <div class="form-group">
                            <label for="inputDescription">Description:</label>
                            <input type="text" name="description" class="form-control" id="inputName" placeholder="Enter the location's description">
                        </div>

                        <div class="form-group">
                            <label for="inputRoom">Room:</label>
                            <input type="text" name="room" class="form-control" id="inputName" placeholder="Enter the location's room">
                        </div>
  <?php
  } >

  if (isset($_GET['optionsRadios1'])) {
    getMonitoringForms();

  }
?>

@endsection
