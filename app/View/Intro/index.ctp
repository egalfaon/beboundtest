<div class="row">
	<div class="col-md-3 padding5">
		<div class="events">
			<h3><i class="fa fa-bell-o"></i> Latest Events</h3>
			<?php foreach($events as $event):?>
            	<div class='event'>
                	<?php
                    switch($event['Matchevent']['event_type']){
						case 'goal': print '<span class="glyphicon glyphicon-cd"></span>'; break;
						case 'yellowcard': print '<span class="glyphicon glyphicon-hand-right"></span><i class="fa fa-square" style="color:yellow"></i>'; break;
						case 'yellowred': print '<span class="glyphicon glyphicon-hand-right"></span><i class="fa fa-square" style="color:yellow"></i><span class="glyphicon glyphicon-hand-right"></span><i class="fa fa-square" style="color:red"></i>'; break;
						case 'redcard': print '<span class="glyphicon glyphicon-hand-right"></span><i class="fa fa-square" style="color:red"></i>'; break;
						default:print '<i class="fa fa-info-circle"></i>';
					}
					print " ".$event['Matchevent']['event_type']." <strong>".$event['Match']['match_'.$event['Matchevent']['event_team'].'_name']."</strong> (".$event['Matchevent']['event_player'].") ".$event['Matchevent']['event_result']." <i class='fa fa-clock-o'></i> '".$event['Matchevent']['event_minute'];
					?>
                </div>
			<?php endforeach?>
		</div>
	</div>
	<div class="col-md-9 padding5">
		<div class="matches">
		<h3><a href='<?=Webroot?>intro/index/<?=$week-1?>' class='prev_week'><i class="fa fa-arrow-circle-left"></i></a> <i class="fa fa-calendar"></i> <?=$textForWeeks?> <a  href='<?=Webroot?>intro/index/<?=$week+1?>' class='next_week'><i class="fa fa-arrow-circle-right"></i></a></h3>
		<?php if(count($matches)==0):?>
        	<br><br><br><h3><i class="fa fa-info-circle"></i> There are no matches this week</h3><br><br><br>
        <?php endif?>
		<?php foreach($matches as $match):?>
        <div class="nomargins row match">
			<div class="col-md-10">
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
				<div class="teams row">
					<div class="col-md-5 localteam">
						<?=$match['Match']['match_localteam_name']?>
					</div>
					<div class="col-md-2">
						<font color=red>vs</font>
					</div>
					<div class="col-md-5 visitorteam">
						<?=$match['Match']['match_visitorteam_name']?>
					</div>
				</div>
				<div class="scores">
					<span class=""><?=$match['Match']['match_localteam_score']?> - <span class=""><?=$match['Match']['match_visitorteam_score']?></span>
				</div>
			</div>	<!-- END MATCH -->
            <div class="betnow col-md-2">
            	<?php if (date("Y-m-d h:i:s")<$match['Match']['match_bet_close_time']):?>
            		<a href="<?=Webroot?>match/index/<?=$match['Match']['match_id']?>"><button type="button" class="btn btn-success">BET NOW!</button></a>
            	<?php else:?>
                	Bets are closed!
                <?php endif?>
            </div>
        </div> <!-- END ROW -->
		<?php endforeach?>
		</div>
	</div>
</div>