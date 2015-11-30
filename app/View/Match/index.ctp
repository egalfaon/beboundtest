 <?php if(!isset($match)):?>
 	<h3><i class="fa fa-info-circle"></i> Match not found! </h3>
 <?php else:?>
  <div class='matches'>
 	<div class='match'>
		<i class="fa fa-calendar-o"></i> <?=$match['Match']['match_date']?> <i class="fa fa-clock-o"></i> <?=$match['Match']['match_time']?>
				<?php switch($match['Match']['match_status']){
					case "HT": print '<i class="fa fa-info-circle"></i> In the half time (between the two halves)'; break;
					case "FT": print '<i class="fa fa-info-circle"></i> After the end of the match (full time)'; break;
					case "AET": print '<i class="fa fa-info-circle"></i> After Extra Time'; break;
					case "Pen.": print '<i class="fa fa-info-circle"></i> Penalties'; break;
					case "Post.": print '<i class="fa fa-info-circle"></i> Postponed'; break;
					case "Awarded": print '<i class="fa fa-info-circle"></i> Awarded'; break;
					case "Cancl.": print '<i class="fa fa-info-circle"></i> Cancelled'; break;
				}?>
		<h3><strong><?=$match['Match']['match_localteam_name']?> - <?=$match['Match']['match_visitorteam_name']?></strong></h3>
		<h3><?=$match['Match']['match_localteam_score']?> - <?=$match['Match']['match_visitorteam_score']?></h3>
		<?php if(isset($bet['Bet'])):?>
			<h4>Your bet: <?=$bet['Bet']['localteam_score']?> - <?=$bet['Bet']['visitorteam_score']?></h4>
		<?php endif?>
	</div>
 </div>
 <div class='events'>
 	<i class="fa fa-bell-o"></i> Match Events
 	<?php if(count($match['Matchevent'])==0):?>
		There are no match events!
	<?php else:?>
		<?php foreach($match['Matchevent'] as $event):?>
			<div class='event'>
                	<?php
                    switch($event['event_type']){
						case 'goal': print '<span class="glyphicon glyphicon-cd"></span>'; break;
						case 'yellowcard': print '<span class="glyphicon glyphicon-hand-right"></span><i class="fa fa-square" style="color:yellow"></i>'; break;
						case 'yellowred': print '<span class="glyphicon glyphicon-hand-right"></span><i class="fa fa-square" style="color:yellow"></i><span class="glyphicon glyphicon-hand-right"></span><i class="fa fa-square" style="color:red"></i>'; break;
						case 'redcard': print '<span class="glyphicon glyphicon-hand-right"></span><i class="fa fa-square" style="color:red"></i>'; break;
						default:print '<i class="fa fa-info-circle"></i>';
					}
					print " ".$event['event_type']." <strong>".$match['Match']['match_'.$event['event_team'].'_name']."</strong> (".$event['event_player'].") ".$event['event_result']." <i class='fa fa-clock-o'></i> '".$event['event_minute'];
					?>
                </div>
		<?php endforeach?> 
	<?php endif?>
 </div> <!-- end match events -->
 <div class='bet_div'>
 	<h3> BET NOW </h3>
 	<?php if(!isset($user)):?>
		<h2><div class='label label-warning'>You're not logged in!</div></h2>
	<?php else:?>
	<form class="form-inline" action="" method="post">
	  <div class="form-group">
		<div class="input-group">
		  <div class="input-group-addon"><?=$match['Match']['match_localteam_name']?></div>
		  <input type="text" class="form-control" id="exampleInputAmount" value="<?=(isset($bet['Bet'])?$bet['Bet']['localteam_score']:"0")?>" name="localteam_score">
		  <div class="input-group-addon">-</div>
		  <input type="text" class="form-control" id="exampleInputAmount" value="<?=(isset($bet['Bet'])?$bet['Bet']['visitorteam_score']:"0")?>" name="visitorteam_score">
		  <div class="input-group-addon"><?=$match['Match']['match_visitorteam_name']?></div>
		</div>
	  </div>
	  <button type="submit" class="btn btn-primary" name='placeBet'>Save Bet</button>
	</form>
	<br><br>
	<?php endif?>
 </div>
 <?php endif?>