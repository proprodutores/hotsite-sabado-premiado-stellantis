<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Play $play
 * @var string[]|\Cake\Collection\CollectionInterface $awards
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $play->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $play->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Play'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="play form content">
            <?= $this->Form->create($play) ?>
            <fieldset>
                <legend><?= __('Edit Play') ?></legend>
                <?php
                    echo $this->Form->control('drawn_position');
                    echo $this->Form->control('award_id', ['options' => $awards, 'empty' => true]);
                    echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
