<div class="rows">

<header>
<div class="text-left"><a id="add_event_link" href="javascript:void(0);"  class="add_event_link" data-toggle="modal" data-target="#add-event-modal">+ Add Event</a> Handover</div>	
</header>


<main>
Display : <select name="display_days"><option value="15">Last 15 Days</option><option value="30">Last 30 Days</option><option value="45">Last 45 Days</option><option value="60">Last 60 Days</option><option value="90">Last 90 Days</option><option value="0">All Time</option></select>
   <div class="text-right"><a href="javascript:void(0);" id="print_csv"  data-toggle="modal" data-target="#csvModal">CSV</a> <a href="javascript:void(0);" id="print_it">Print</a></div>

<table id="event-results" class="display" style="width:100%"></table>

</main>

<footer>
	
	
</footer>

	</main>

</div>


<div class="modal fade" id="add-event-modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <header class="modal-header">
          <h4 class="modal-title">Add Event</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </header>
        
        <!-- Modal body -->
        <main class="modal-body">
        
        <div class="alert alert-danger" style="display: none;">Please check all field you fill correctly...</div>
       <div class="form-group">
       	<label for="shiftbook">Shiftbook : </label> 
       	<select name="shift" class="form-control"><option value="1">Day Shift</option><option value="2">Night Shift</option></select>
       </div>

<div class="form-group">
	<label for="ticket">Key/Ticket : </label>
	<input type="text" name="ticket" class="form-control">
</div>

<div class="form-group">
	<label for="type">Type :</label>
	<input type="text" name="type" class="form-control">
</div>

<div class="form-group">
	<label for="jiraSummary">Jira Summary : </label>
    <input type="text" name="jiraSummary" class="form-control">
</div>

<div class="form-group">
	<label for="nocSummary">NOC Summary : </label>
    <input type="text" name="nocSummary" class="form-control">
</div>

<div class="form-group">
	<label for="priority">Priority : </label>
  <select name="priority" class="form-control"><option value="1">S1</option><option value="2">S2</option><option value="3">S3</option><option value="4">S4</option></select>  	
</div>


<div class="form-group">
	<label for="Attachment">Attachment :</label>
	<input class="form-control" type="file" name="files">
</div>

<div class="loader"></div>

        </main>
        <footer class="modal-footer">
        <button type="button" class="btn btn-success" id="submitevent">SUBMIT</button>
        <button type="button" class="btn btn-danger" id="modal-btn-no" data-dismiss="modal">CANCEL</button>
      </footer>
      </div>
    </div>
  </div>


<div class="modal fade" id="csvModal">
 <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <header class="modal-header">
          <h4 class="modal-title">Compile to CSV</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </header>
        
        <!-- Modal body -->
        <main class="modal-body text-center">        
        <div uk-spinner class="spinner" style="display: none;"></div>
        <div class="alert-danger" style="display: none;">Fail to compile, try again later..</div>
        <div class="csv-link" style="display: none;">
          Csv file successfully compiled.<br/>
          <a href="javascript:void(0);" class="btn btn-success">Download</a>
        </div>
        <div class="h-text">Click to get download of csv</div>
        <button type="button" class="btn btn-outline-danger" id="csvCompile">Compile CSV</button>
        </main>
      <footer class="modal-footer">
      </footer>
      </div>
    </div>

</div>