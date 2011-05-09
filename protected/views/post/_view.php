<div class="post">
	<div class="title">
        <?php $this->beginWidget('ext.EReplacer', array(
            'bag'=>'{}',
            'data'=>array(
                'yii'=>'icons/yii32.png',
                'ext'=>'icons/widget.png',
                'wiki'=>'icons/wiki.png',
                'cli'=>'icons/terminal.png',
                'f14'=>'icons/fedora.png',
                'cen'=>'icons/centos.png',
                'cult'=>'icons/cult.png',
                'mysql'=>'icons/mysql.png',
                'java'=>'icons/java.png',
                'nb'=>'icons/netbeans.png',
                'stoli'=>'icons/stoli.png',
                'spam'=>'icons/spam.png',
                'git'=>'icons/git.png',
                'gem'=>'icons/gem.png',
            ),
            'replace'=>'(isset($data[$el])) ? "<img src=\''.Yii::app()->request->baseUrl.'/".$data[$el]."\' />" : null;'
        ));?>
		<?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?>
        <?php $this->endWidget(); ?>
	</div>
	<div class="author">
		posted by <?php echo $data->author->username . ' on ' . date('F j, Y',$data->create_time); ?>
	</div>
	<div class="content">
		<?php
            if(!$data->htmlflag)
			    $this->beginWidget('CMarkdown', array('purifyOutput'=>true));

			echo $data->content;

            if(!$data->htmlflag)
			    $this->endWidget();
		?>
	</div>
	<div class="nav">
		<b>Tags:</b>
		<?php echo implode(', ', $data->tagLinks); ?>
		<br/>
		<?php echo CHtml::link('Permalink', $data->url); ?> |
		<?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?> |
		Last updated on <?php echo date('F j, Y',$data->update_time); ?>
	</div>
</div>
<?php
if($data->imgs) {
    $this->widget('application.extensions.fancybox.EFancyBox', array(
        'target'=>'.fancybox',
        'config'=>array(),
        )
    );
    Yii::app()->clientScript->registerCss('fancybox-imgs', 
    '
    .fsmall
    { 
        height: 32px; 
    }
    .fnormal
    {
        height: 64px;
    }
    .fbig
    {
        height: 128px;
    }');
}
