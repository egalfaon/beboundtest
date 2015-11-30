<?php $totalPoints=0;?>
<div class='matches'>
	<h3><i class="fa fa-money"></i> Your bets </h3>
	<?php if(count($bets)==0):?>
		<h3> You have no bets </h3>
	<?else:?>
		<?php foreach($bets as $bet):?>
			<?php $totalPoints+=$bet['Bet']['result'];?>
			<div class='match'>
				<i class="fa fa-calendar-o"></i> <?=$bet['Match']['match_date']?> <i class="fa fa-clock-o"></i> <?=$bet['Match']['match_time']?>
						<?php switch($bet['Match']['match_status']){
							case "HT": print '<i class="fa fa-info-circle"></i> In the half time (between the two halves)'; break;
							case "FT": print '<i class="fa fa-info-circle"></i> After the end of the match (full time)'; break;
							case "AET": print '<i class="fa fa-info-circle"></i> After Extra Time'; break;
							case "Pen.": print '<i class="fa fa-info-circle"></i> Penalties'; break;
							case "Post.": print '<i class="fa fa-info-circle"></i> Postponed'; break;
							case "Awarded": print '<i class="fa fa-info-circle"></i> Awarded'; break;
							case "Cancl.": print '<i class="fa fa-info-circle"></i> Cancelled'; break;
						}?>
				<h3><strong><?=$bet['Match']['match_localteam_name']?> - <?=$bet['Match']['match_visitorteam_name']?></strong></h3>
				<h3><?=$bet['Match']['match_localteam_score']?> - <?=$bet['Match']['match_visitorteam_score']?></h3>
				<?php if(isset($bet['Bet'])):?>
					<h4>Your bet: <?=$bet['Bet']['localteam_score']?> - <?=$bet['Bet']['visitorteam_score']?> 
					<?php if (date("Y-m-d h:i:s")<$bet['Match']['match_bet_close_time']):?>
						<a href="<?=Webroot?>match/index/<?=$bet['Match']['match_id']?>" class="btn btn-sm btn-default">Change</a>
					<?php endif?>
					</h4>
				<?php endif?>
			</div>
		<?php endforeach?>
	<?php endif?>
</div>

<div class="total_points">Total points: <?=$totalPoints?></div>
