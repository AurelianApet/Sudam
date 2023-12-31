<?php if($this->request->is('ajax')): ?>
<script type="text/javascript">
    require(["jquery","mooComment"], function($,mooComment) {
        mooComment.initOnCommentForm();
    });
</script>
<?php else: ?>
<?php $this->Html->scriptStart(array('inline' => false, 'domReady' => true, 'requires'=>array('jquery','mooComment'), 'object' => array('$', 'mooComment'))); ?>
mooComment.initOnCommentForm();
<?php $this->Html->scriptEnd(); ?> 
<?php endif; ?>

<form id="<?php echo empty($commentFormId) ? 'commentForm' : $commentFormId; ?>"> 
<?php
echo $this->Form->hidden('target_id', array('value' => $target_id));
echo $this->Form->hidden('type', array('value' => $type));

if ( !empty( $class ) ){
    $cls = $class;
}
else{
    $cls = 'commentForm';
}
?>

<div class="comment_box_add">
<?php $implementMention = ($type == APP_CONVERSATION)? false : true ?>
    <?php echo $this->Form->textarea('message', array('id'=> empty($commentFormTextId) ? 'postComment' : $commentFormTextId,'class' => $cls . " showCommentBtn", 'placeholder' => __('Write a comment'), 'data-id' => '0'),$implementMention);?>
    <div class="commentButton" id="commentButton_0">
        <?php if ( $uid ): ?>
        <input type="hidden" name="thumbnail" id="comment_image_<?php echo $target_id;?>" />
		<div id="comment_button_attach_<?php echo $target_id;?>"></div>
            <a href="javascript:void(0)" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored shareButton"  data-id="<?php echo $target_id;?>">
                <?php if ($type == APP_CONVERSATION): ?>
                <?php echo __('Reply')?>
                <?php else: ?>
                <?php echo __('Post')?>
                <?php endif; ?>

            </a>
	        <?php if($this->request->is('ajax')): ?>
                    <script type="text/javascript">
                        require(["jquery","mooAttach"], function($,mooAttach) {
                            mooAttach.registerAttachComment(<?php echo $target_id;?>,'<?php echo empty($commentFormId) ? 'commentForm' : $commentFormId; ?>');
                        });
                    </script>
                <?php else: ?>
                <?php $this->Html->scriptStart(array('inline' => false, 'domReady' => true, 'requires'=>array('jquery','mooAttach'),'object'=>array('$','mooAttach'))); ?>
                mooAttach.registerAttachComment(<?php echo $target_id;?>);
                <?php $this->Html->scriptEnd(); ?>
		<?php endif; ?>
        <?php else: ?>
        <?php echo __('Login or register to post your comment')?>
        <?php endif; ?>
    </div>
    <div id="comment_preview_image_<?php echo $target_id;?>"></div>
</div>	
</form>
