<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Play $play
 * @var \Cake\Collection\CollectionInterface|string[] $awards
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Play'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="play form content">
            <?= $this->Form->create($play) ?>
            <fieldset>
                <legend><?= __('Add Play') ?></legend>
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
