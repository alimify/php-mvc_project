<div class="text-center">

	<div class="alert btn-block date-plus-minus" style="font-family: fantasy;font-weight: bold;font-size: 20px;border: 1px solid gray;">
	<a href="javascript:void(0);" class="btn-danger" id="date-minus" style="padding: 10px;border-radius: 40%;"><span uk-icon="icon:triangle-left"></span></a>

<span id="showing-date"></span>

 <a href="javascript:void(0);" class="btn-danger" id="date-plus" style="padding: 10px;border-radius: 40%;"><span uk-icon="icon:triangle-right"></span></a>

</div>

<table id="month-calender" style="width:100%;"> <thead></thead> <tfoot></tfoot> <tbody></tbody></table>


	Shift Data Acquisition

<a class="btn btn-warning" id="closeModalcall" style="color: white;font-weight: bold;" data-toggle="modal" data-target="#shiftCloseModal">Close Shift</a>
<div class="shift">
	<div class="shift1">
		 <header>
			<img src="<?= ROOT_URL ?>assets/images/day.png">
		 </header>
		 <main>
			<table id="shift1" class="display" style="width:100%"></table>
		</main>
	</div>
<div class="shift2">
		 <header>
			<img src="<?= ROOT_URL ?>assets/images/night.png">
		 </header>
		 <main>
			<table id="shift2" class="display" style="width:100%"></table>
		</main>
</div>

</div>
</div>



<div class="modal fade" id="shiftCloseModal">
 <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <header class="modal-header">
          <h4 class="modal-title">Events</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </header>
        
        <!-- Modal body -->
        <main class="modal-body text-center">        
<table id="eventCloseList" class="display" style="width:100%"></table>

        </main>
        <footer class="modal-footer">
		<textarea placeholder="Write something" class="form-control"></textarea><br/>
        <button type="button" class="btn btn-success" id="submitshift">SUBMIT</button>
        <button type="button" class="btn btn-danger" id="modal-btn-no" data-dismiss="modal">CANCEL</button>
      </footer>
      </div>
    </div>
</div>