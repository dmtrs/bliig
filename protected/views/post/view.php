<?php
$this->breadcrumbs=array(
	$model->title,
);
$this->pageTitle=$model->title;
?>

<div class='row' style='float: right' >
<?php 
$this->widget('ext.mPrint.mPrint', array(
    'tooltip'=>'Print post',
    //'text'=>'Print post',
    'element'=>'#content',
    'exceptions'=>array(
        '#mprint',
        '.form',
        '.admin-actions',
    ),
    'publishCss'=>true,
    'alt'=>'print',
    'id'=>'mprint',
)); ?>
</div>

<?php $this->renderPartial('_view', array(
	'data'=>$model,
)); ?>

<div id="comments" >
	<?php if($model->commentCount>=1): ?>
		<h3>
			<?php echo $model->commentCount>1 ? $model->commentCount . ' comments' : 'One comment'; ?>
		</h3>

		<?php $this->renderPartial('_comments',array(
			'post'=>$model,
			'comments'=>$model->comments,
		)); ?>
	<?php endif; ?>

	<?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
		</div>
	<?php else: ?>
		<?php $this->renderPartial('/comment/_form',array(
			'model'=>$comment,
		)); ?>
	<?php endif; ?>

</div><!-- comments -->

