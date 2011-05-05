<?php $this->beginContent('/layouts/main'); ?>
<div class="container">
	<div class="span-18">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-6 last">
		<div id="sidebar">
			<?php if(!Yii::app()->user->isGuest) $this->widget('UserMenu'); ?>
			<?php $this->widget('TagCloud', array(
				'maxTags'=>Yii::app()->params['tagCloudCount'],
			)); ?>
			<?php 
                        $this->beginWidget('zii.widgets.CPortlet', array(
                                'title'=>'Links',
                        ));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
					array('label'=>'Github repos','url'=>'http://www.github.com/dmtrs'),
					array('label'=>'jsfiddle', 'url'=>'http://jsfiddle.net/user/tydeas_dr/'),
					array('label'=>'Yii profile','url'=>'http://www.yiiframework.com/user/4786/'),
				),
				'htmlOptions'=>array('class'=>'mylinks')
			));
			$this->endWidget();?>


			<?php $this->widget('RecentComments', array(
				'maxComments'=>Yii::app()->params['recentCommentCount'],
			)); ?><script id="fedora-banner" type="text/javascript" src="http://fedoraproject.org/static/js/release-counter-ext.js?lang=en"></script>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>
