<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sweepstake> $sweepstakes
 */
?>
<div class="sweepstakes index content">
    <?= $this->Html->link(__('Novo Sorteio'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3>Sorteios</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', ['label' => 'ID']) ?></th>
                    <th><?= $this->Paginator->sort('description', ['label' => 'Descrição']) ?></th>
                    <th><?= $this->Paginator->sort('date_start', ['label' => 'Início']) ?></th>
                    <th><?= $this->Paginator->sort('date_end', ['label' => 'Fim']) ?></th>
                    <th></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sweepstakes as $sweepstake): ?>
                <tr>
                    <td><?= $this->Number->format($sweepstake->id) ?></td>
                    <td><?= $sweepstake->description ?></td>
                    <td><?= $sweepstake->date_start->format('d/m/Y H:i') ?></td>
                    <td><?= $sweepstake->date_end->format('d/m/Y H:i') ?></td>
                    <td><?= $this->Html->link('Acessar prêmios', ['action' => 'index', 'controller' => 'Awards', $sweepstake->id]) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $sweepstake->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $sweepstake->id]) ?>
                        <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $sweepstake->id], ['confirm' => __('Confirma a exclusão do item # {0}?', $sweepstake->id)]) ?>
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
