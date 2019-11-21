<main>
<h1 class="text-center"><?php echo $_GET['date']; ?></h1>
<a href="javascript:void(0);" id="add-event-link" class="btn btn-primary btn-warning" style="margin-bottom:10px;" data-toggle="modal" data-target="#add-event-modal">Add Event</a>
<table id="datatable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Location</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Organizer</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach($viewmodel as $item){ ?>
    <tr data-src="<?php echo $item['id']; ?>" data-toggle="modal" data-target="#show-event">
                <td><?php echo $item['subject']; ?></td>
                <td><?php echo $item['location']; ?></td>
                <td><?php echo $item['startTime']; ?></td>
                <td><?php echo $item['endTime']; ?></td>
                <td><?php echo $item['name']; ?></td>
    </tr>

        <?php } ?>
            
        </tbody>

    </table>


</main>


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
	<label for="ticket">Subject : </label>
	<input type="text" name="subject" class="form-control">
</div>

<div class="form-group">
	<label for="type">Location :</label>
	<input type="text" name="location" class="form-control">
</div>

<div class="form-group">
	<label for="nocSummary">Start Time : </label>
  <input type="text" name="startDate" id="startDate" class="col-3 form-control" style="display:inline;" placeholder="Date"> <input type="text" name="startTime" id="startTime" class="form-control col-3" style="display:inline;" placeholder="Time">
</div>

<div class="form-group">
	<label for="nocSummary">End Time : </label>
  <input type="text" name="endDate" id="endDate" class="col-3 form-control" style="display:inline;" placeholder="Date"> <input type="text" name="endTime" id="endTime" class="form-control col-3" style="display:inline;" placeholder="Time">
</div>

<div class="form-group">
	<label for="priority">Summary : </label>
  <textarea name="textarea" class="form-control" placholder="Write summary"></textarea>
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

<div class="modal fade" id="show-event">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <header class="modal-header">
          <h4 class="modal-title">View Event</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </header>
        
        <!-- Modal body -->
      <main class="modal-body">
     <div class="cat organizer"></div>
     <div class="cat subject"></div>
     <div class="cat location"></div>
     <div class="cat startTime"></div>
     <div class="cat endTime"></div>
     <div class="cat summary"></div>
     <div class="cat file"></div>
      </main>
      <footer class="modal-footer">
      <button type="button" class="btn btn-danger" id="modal-btn-no" data-dismiss="modal">Close</button>
      </footer>
  </div>
</div>
</div>






  <script>
    <?php
    $database = array();
 foreach ($viewmodel as $item) {
  $database[$item['id']] = $item;
 }
     ?>
  const getDateURI = `<?php echo $_GET['date']; ?>`,
        database = <?php echo json_encode($database); ?>
  </script>