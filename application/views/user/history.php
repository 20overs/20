<div class="container-fluid margin-top-5">
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<?php
				echo $this->load->view('inc/sidebar');
			?>
		</div>
		<div class="col-lg-8 col-md-8">
					<div class="panel panel-info">
					    <div class="panel-heading" class="panel-heading">
					        <center><span class="h4 handover">MANAGE HISTORY</span></center>
					    </div>
					    <div  id="collapseThree" class="panel-collapse collapse in">
					      <div class="panel-body">

					  		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <h4>Batting histories</h4>
                                <ul class="list-group">
                                <?php
                                if(count($batting_history) < 1){
                                ?>
                                <li class="list-group-item">No Batting history is found</li>
                                <?php
                                }else{
                                    foreach ($batting_history as $row) {
                                ?>
                                    <li class="list-group-item"><?=$row['MyTeamName']?> vs <?=$row['OpponentTeam']?>|<small><?=$row['MatchDate']?> @ <?=$row['MatchVenue']?></small><span data-id="<?=$row['Id']?>" class="btn btn-xs btn-danger pull-right delete_batting">X</span>
                                    </li>
                                <?php
                                    }
                                ?>
                                </ul>
                                <?php
                                    }
                                ?>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <h4>Bowling histories</h4>
                                <ul class="list-group">
                                <?php
                                if(count($bowling_history) < 1){
                                ?>
                                <li class="list-group-item">No Bowling history is found</li>
                                <?php
                                }else{
                                    foreach ($bowling_history as $row) {
                                ?>
                                    <li class="list-group-item"><?=$row['MyTeamName']?> vs <?=$row['OpponentTeam']?>|<small><?=$row['MatchDate']?> @ <?=$row['MatchVenue']?></small><span  data-id="<?=$row['Id']?>" class="delete_bowling btn btn-xs btn-danger pull-right">X</span>
                                    </li>
                                <?php
                                    }
                                ?>
                                </ul>
                                <?php
                                    }
                                ?>
                            </div>

					      </div>
					    </div>
					  </div>
				</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    $('.delete_batting').click(function(){
    var r = confirm("Sure want to delete?");
    if (r == true) {
    $(this).parent().fadeOut(800);
    $.ajax({
      url:'del_batting',
      data:{id:$(this).data('id')},
      method:"POST",
      success :function(data){
        if(data.errors == 0)
        {
            swal("Deleted!", data.message, "success");
            $(this).parent().fadeOut(500);
        }
        else
        {
            swal("Not Deleted!", data.message, "error");
            $(this).parent().fadeIn(500);
        }
      },
      error: function(){
        swal("Error !", "Server error try again later", "error");
        $(this).parent().fadeIn(500);
      }
    });
  }
  });

 $('.delete_bowling').click(function(){
    var r = confirm("Sure want to delete?");
    if (r == true) {
    $(this).parent().fadeOut(800);
    $.ajax({
      url:'del_bowling',
      data:{id:$(this).data('id')},
      method:"POST",
      success :function(data){
        if(data.errors == 0)
        {
            swal("Deleted!", data.message, "success");
            $(this).parent().fadeOut(500);
        }
        else
        {
            swal("Not Deleted!", data.message, "error");
            $(this).parent().fadeIn(500);
        }
      },
      error: function(){
        alert("Server error try again later");
        $(this).parent().fadeIn(500);
      }
    });
  }
  });
</script>