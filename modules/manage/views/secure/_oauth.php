<?php
use yii\helpers\Html;
use yii\authclient\widgets\AuthChoice;
/* @var $this yii\web\View */
/* @var $model \app\models\forms\LoginForm */
$this->title = 'Pls Login';
?>
<div class="social-auth-links text-center">
    <p>- OR -</p>
 <?php
	$authAuthChoice = AuthChoice::begin([
	    'baseAuthUrl' => ['/manage/secure/oauth'],
	]);
	foreach ($authAuthChoice->getClients() as $client){
	   echo $authAuthChoice->clientLink($client ,$client->title,[
	   		'class' => "btn btn-block btn-{$client->id} btn-flat text-center"
	   ]);
	}
	AuthChoice::end(); ?>
</div>