<?
if (!Yii::app()->user->isGuest) {
	$role = Yii::app()->user->role;
}
else {
	$role = NULL;
}  

	//  <input name="button" type="button" id="close" onclick="self.parent.location.reload()" value="Close" />
	
	
?>

<script>
<? 
 $url = User::getRedirectURL($role);
 ?>
self.parent.location.href='<?=$url?>';

</script>
 
