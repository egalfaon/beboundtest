<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>	
    <title><?php echo $this->fetch('title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Bebound Test page" />
    <meta name="author" content="Anusca Bogdan" />
    <meta name="keywords" content="test page" />
	<?php
		echo $this->Html->meta('icon');	
		echo $this->Html->css('main');
		echo $this->Html->css('bootstrap.min.css');
		echo $this->Html->css('font-awesome.min.css');
	?>
    
</head>

<body>
 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=Webroot?>">Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        <?php if(!isset($user)):?>
          <form class="navbar-form navbar-right" action="<?=Webroot?>cont/login" method="post">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control" name="email">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="pass">
            </div>
            <button type="submit" class="btn btn-success" name="login">Sign in</button>
          </form>
        <?php else:?>
        	<div class="navbar-form navbar-right"><font color='gray'>Welcome, <?=$user['name']?></font> <a href='<?=Webroot?>cont'><i class="fa fa-cogs"></i> My Bets</a> <a href="<?=Webroot?>cont/logout"><button type="button" class="btn btn-success">Sign Out</button></a></div>
        <?php endif?>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
    <div class="site container">
        <div class='comp_name'><h1><strong><?=comp_name?></strong></h1></div>
        <div class='comp_region'><h2><i class="fa fa-globe"></i> <?=comp_region?></h2></div>
        
        <?php echo $this->fetch('content'); ?>
        
        <hr>
        <footer>
            <p>&copy; 2015 Anusca Bogdan for Be Bound.</p>
        </footer>
    </div>

</body>        

<?php 
echo $this->Html->script('jquery-1.11.1.min.js');
echo $this->Html->script('bootstrap.min.js');

/* main script */
echo $this->Html->script('main.js');

//echo $this->element('sql_dump'); 
?>
</html>
