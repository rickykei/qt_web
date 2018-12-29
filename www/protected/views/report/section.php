<? $this->widget('StepMenu', array('reqHdrId'=>$model->id, 'step'=>$model->process_step, 'requestSts'=>$model->sts)); ?>

<p>&nbsp;</p>
<p>&nbsp;</p>

<? include($sectionPage.'.php'); ?>