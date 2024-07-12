<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Award $award
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Award'), ['action' => 'edit', $award->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Award'), ['action' => 'delete', $award->id], ['confirm' => __('Confirma exclusão do item # {0}?', $award->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Awards'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Award'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="awards view content">
            <h3><?= h($award->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($award->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($award->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sweepstake') ?></th>
                    <td><?= $award->has('sweepstake') ? $this->Html->link($award->sweepstake->id, ['controller' => 'Sweepstakes', 'action' => 'view', $award->sweepstake->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($award->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $award->active === null ? '' : $this->Number->format($award->active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $award->quantity === null ? '' : $this->Number->format($award->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Balance') ?></th>
                    <td><?= $award->balance === null ? '' : $this->Number->format($award->balance) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($award->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($award->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
