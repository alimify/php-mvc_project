<div class="row">
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
Register
		</h3>
	</div>
	<div class="panel-contet">
<?php if(USER_REGISTRATION){ ?>


<form method="post">
	<label for="name">Name</label>
	<input type="text" name="name" class="form-control">

		<label for="email">Email</label>
	<input name="email" class="form-control" type="text">
			<label for="link">Password</label>
	<input type="text" name="password" class="form-control">
<input type="submit" name="submit" value="Register">
</form>
<?php 
}else{ ?>

 Currently Registration have been closed...

<?php }  ?>
	</div>
</div>
</div>