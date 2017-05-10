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
                        {{ @checkedOne == null }}

                        <div class="radio" >
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked onclick="monitoringForms()">
                            Monitoring
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" onclick="studyGroupForms()">
                            Study Group
                          </label>
                        </div>

                       


                        
                          <div class="form-group" id="monitoringForm" style = "display:block">
                              <label for="inputDescription">Description:</label>
                              <input type="text" name="description" class="form-control" id="inputName" placeholder="Enter the location's description">
                          </div>

                       
                        <div class="form-group" id="studyGroupForm" , style = "display:none" >
                            <label for="inputBuilding">Building:</label>
                            <input type="text" name="building" class="form-control" id="inputName" placeholder=" Enter the location's building">
                        </div>


                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <script>
  function monitoringForms() {

    document.getElementById("monitoringForm").style.display = "block";
    document.getElementById("studyGroupForm").style.display = "none"

  }

  function studyGroupForms() {
    
    document.getElementById("monitoringForm").style.display = "none";
    document.getElementById("studyGroupForm").style.display = "block";
  }

  
</script>






@endsection



