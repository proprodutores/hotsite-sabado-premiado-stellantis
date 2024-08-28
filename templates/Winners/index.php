<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Winner> $winners
 */
?>
<div class="winners index content">
    <?= $this->Html->link(__('Registrar Ganhador'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3>Ganhadores</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', ['label' => 'ID']) ?></th>
                    <th><?= $this->Paginator->sort('name', ['label' => 'Nome']) ?></th>
                    <th><?= $this->Paginator->sort('sapid', ['label' => 'Matrícula']) ?></th>
                    <th><?= $this->Paginator->sort('created', ['label' => 'Registrado em']) ?></th>
                    <th class="actions">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($winners as $winner): ?>
                <tr>
                    <td><?= $this->Number->format($winner->id) ?></td>
                    <td><?= h($winner->name) ?></td>
                    <td><?= h($winner->sapid) ?></td>
                    <td><?= h($winner->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $winner->id]) ?>
                        <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $winner->id], ['confirm' => __('Confirma a exclusão do ganhador # {0}?', $winner->id)]) ?>
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
