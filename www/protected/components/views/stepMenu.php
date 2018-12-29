<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/step_menu.css" />

<ul id="mainNav" class="fiveStep">

	<li <?= $this->step == 1? 'class="current"': ($this->step == 2? 'class="lastDone"': ($this->step > 2? 'class="done"':'')) ?>>
		<a title="" <?= $this->step >= 1? 'href="section1?reqHdrId='.$this->reqHdrId.'"': '' ?>>
			<em>SECTION 1 - FACTORY PROFILE</em>
		</a>
	</li> 
	<li <?= $this->step == 2? 'class="current"': ($this->step == 3? 'class="lastDone"': ($this->step > 3? 'class="done"':'')) ?>>
		<a title="" <?= $this->step >= 2? 'href="section2?reqHdrId='.$this->reqHdrId.'"': '' ?>>
			<em>SECTION 2 - FACTORY ORGANIZATION AND PRODUCTION PROCESS</em>
		</a>
	</li> 
	<li <?= $this->step == 3? 'class="current"': ($this->step == 4? 'class="lastDone"': ($this->step > 4? 'class="done"':'')) ?>>
		<a title="" <?= $this->step >= 3? 'href="section3?reqHdrId='.$this->reqHdrId.'"': '' ?>>
			<em>SECTION 3 - POWER SUPPLY & TRANSPORATION CAPABILTY</em>
		</a>
	</li> 
	<li <?= $this->step == 4? 'class="current"': ($this->step == 5? 'class="lastDone"': ($this->step > 5? 'class="done"':'')) ?>>
		<a title="" <?= $this->step >= 4? 'href="section4?reqHdrId='.$this->reqHdrId.'"': '' ?>>
			<em>SECTION 4 - SUPPLY CHAIN MANAGEMENT</em>
		</a>
	</li>
	<li <?= $this->step == 5? 'class="current"': ($this->step == 6? 'class="lastDone"': ($this->step > 6? 'class="done"':'')) ?>>
		<a title="" <?= $this->step >= 5? 'href="section7?reqHdrId='.$this->reqHdrId.'"': '' ?>>
			<em>LAST SECTION - RELATED CERTIFICATION</em>
		</a>
	</li> 
	<li <?= $this->step == 6? 'class="current"': ($this->step == 7 && $this->requestSts != RequestHeader::STS_COMPLETE ? 'class="lastDone"': ($this->step == 7? 'class="done"':'')) ?>">
		<a title="" <?= $this->step >= 6? 'href="sectionMC?reqHdrId='.$this->reqHdrId.'"': '' ?>>
			<em>SECTION - MC</em>
		</a>
	</li>
	<li class="mainNavNoBg <?= $this->step == 7 && $this->requestSts != RequestHeader::STS_COMPLETE ? 'current' : ($this->requestSts == RequestHeader::STS_COMPLETE ? 'done' : '') ?>">
		<a title="" <?= $this->step >= 7? 'href="sectionComplete?reqHdrId='.$this->reqHdrId.'"': '' ?>>
			<em>COPMLETE</em>
		</a>
	</li>
</ul>

<br>
