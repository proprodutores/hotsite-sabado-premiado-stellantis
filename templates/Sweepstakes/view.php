<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sweepstake $sweepstake
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Ver todos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Novo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $sweepstake->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $sweepstake->id], ['confirm' => __('Confirma exclusão do sorteio # {0}?', $sweepstake->id), 'class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sweepstakes view content">
            <h3><?= h($sweepstake->description) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($sweepstake->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Início') ?></th>
                    <td><?= h($sweepstake->date_start) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fim') ?></th>
                    <td><?= h($sweepstake->date_end) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fator de doficuldade') ?></th>
                    <td><?= h($sweepstake->difficulty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qtde de Espaços') ?></th>
                    <td><?= $sweepstake->spaces === null ? '' : $this->Number->format($sweepstake->spaces) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ativo') ?></th>
                    <td><?= $sweepstake->active === null ? '' : $this->Number->format($sweepstake->active) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Prêmios') ?></h4>
                <?php if (!empty($sweepstake->awards)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Nome') ?></th>
                            <th><?= __('Quantidade') ?></th>
                            <th><?= __('Saldo') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($sweepstake->awards as $awards) : ?>
                        <tr>
                            <td><?= h($awards->id) ?></td>
                            <td><?= h($awards->name) ?></td>
                            <td><?= h($awards->quantity) ?></td>
                            <td><?= h($awards->balance) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Ver'), ['controller' => 'Awards', 'action' => 'view', $awards->id]) ?>
                                <?= $this->Html->link(__('Editar'), ['controller' => 'Awards', 'action' => 'edit', $awards->id]) ?>
                                <?= $this->Form->postLink(__('Excluir'), ['controller' => 'Awards', 'action' => 'delete', $awards->id], ['confirm' => __('Confirma a exclusão do item # {0}?', $awards->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
