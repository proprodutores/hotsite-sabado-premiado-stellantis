<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Award> $awards
 */
?>
<div class="awards index content">
    <?= $this->Html->link(__('Novo Prêmio'), ['action' => 'add', $sweepstake_id], ['class' => 'button float-right']) ?>
    <h3>Prêmios do sorteio: <?= $sweepstake->description; ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', ['label' => 'ID']) ?></th>
                    <th><?= $this->Paginator->sort('name', ['label' => 'Nome']) ?></th>
                    <th><?= $this->Paginator->sort('balance', ['label' => 'Saldo']) ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($awards as $award): ?>
                <tr>
                    <td><?= $this->Number->format($award->id) ?></td>
                    <td><?= h($award->name) ?></td>
                    <td><?= $award->balance === null ? '' : $this->Number->format($award->balance) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $award->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $award->id, $sweepstake_id]) ?>
                        <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $award->id, $sweepstake_id], ['confirm' => __('Confirma exclusão do item # {0}?', $award->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primeiro')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('próximo') . ' >') ?>
            <?= $this->Paginator->last(__('último') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, exibindo {{current}} registro(s) de {{count}} total')) ?></p>
    </div>
</div>
