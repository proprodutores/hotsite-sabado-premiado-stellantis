<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Play $play
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Play'), ['action' => 'edit', $play->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Play'), ['action' => 'delete', $play->id], ['confirm' => __('Are you sure you want to delete # {0}?', $play->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Play'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Play'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="play view content">
            <h3><?= h($play->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Drawn Position') ?></th>
                    <td><?= h($play->drawn_position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Award') ?></th>
                    <td><?= $play->has('award') ? $this->Html->link($play->award->name, ['controller' => 'Awards', 'action' => 'view', $play->award->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $play->has('user') ? $this->Html->link($play->user->name, ['controller' => 'Users', 'action' => 'view', $play->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($play->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($play->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($play->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
