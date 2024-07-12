<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Play> $play
 */
?>
<div class="play index content">
    <?= $this->Html->link(__('New Play'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Play') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('drawn_position') ?></th>
                    <th><?= $this->Paginator->sort('award_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($play as $play): ?>
                <tr>
                    <td><?= $this->Number->format($play->id) ?></td>
                    <td><?= h($play->drawn_position) ?></td>
                    <td><?= $play->has('award') ? $this->Html->link($play->award->name, ['controller' => 'Awards', 'action' => 'view', $play->award->id]) : '' ?></td>
                    <td><?= $play->has('user') ? $this->Html->link($play->user->name, ['controller' => 'Users', 'action' => 'view', $play->user->id]) : '' ?></td>
                    <td><?= h($play->created) ?></td>
                    <td><?= h($play->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $play->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $play->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $play->id], ['confirm' => __('Are you sure you want to delete # {0}?', $play->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
