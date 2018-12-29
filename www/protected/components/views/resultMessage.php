<? if (isset($this->msg['info'])) {?>
	<div class="infoMsg"><?=CHtml::encode($this->msg['info']); ?></div>
<? }?>
<? if (isset($this->msg['success'])) {?>
	<div class="successMsg"><?=CHtml::encode($this->msg['success'])?></div>
<? }?>
<? if (isset($this->msg['error'])) {?>
	<div class="errorMsg"><?=CHtml::encode($this->msg['error']); ?></div>
<? }?>