<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Winner $winner
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Ver todos ganhadores'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Editar ganhador'), ['action' => 'edit', $winner->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Registrar novo ganhador'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Excluir ganhador'), ['action' => 'delete', $winner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $winner->id), 'class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="winners view content">
            <h3><?= h($winner->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('ID') ?></th>
                    <td><?= $this->Number->format($winner->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Matrícula') ?></th>
                    <td><?= h($winner->sapid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telefone') ?></th>
                    <td><?= h($winner->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Turno') ?></th>
                    <td><?= h($winner->shift) ?></td>
                </tr>
                <tr>
                    <th><?= __('Registrado por') ?></th>
                    <td><?= $winner->has('user') ? $this->Html->link($winner->user->name, ['controller' => 'Users', 'action' => 'view', $winner->user->id]) : '' ?></td>
                </tr>

                <tr>
                    <th><?= __('Registrado em') ?></th>
                    <td><?= h($winner->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Atualizado em') ?></th>
                    <td><?= h($winner->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>