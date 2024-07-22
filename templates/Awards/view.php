<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Award $award
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Ver todos prêmios'), ['action' => 'index', $award->sweepstake->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Novo prêmio'), ['action' => 'add', $award->sweepstake->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Editar prêmio'), ['action' => 'edit', $award->id, $award->sweepstake->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Excluir prêmio'), ['action' => 'delete', $award->id, $award->sweepstake->id], ['confirm' => __('Confirma exclusão do item # {0}?', $award->id), 'class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="awards view content">
            <h3><?= h($award->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($award->id) ?></td>
                </tr>
                <tr>
                    <th>Nome</th>
                    <td><?= h($award->name) ?></td>
                </tr>
                <tr>
                    <th>Descrição</th>
                    <td><?= h($award->description) ?></td>
                </tr>
                <tr>
                    <th>Sorteio</th>
                    <td><?= $award->has('sweepstake') ? $this->Html->link($award->sweepstake->description, ['controller' => 'Sweepstakes', 'action' => 'view', $award->sweepstake->id]) : '' ?></td>
                </tr>
                <tr>
                    <th>Espaços para ocupar na roleta</th>
                    <td><?= $award->spaces === null ? '' : $this->Number->format($award->spaces) ?></td>
                </tr>
                <tr>
                    <th>Quantidade inicial</th>
                    <td><?= $award->quantity === null ? '' : $this->Number->format($award->quantity) ?></td>
                </tr>
                <tr>
                    <th>Saldo</th>
                    <td><?= $award->balance === null ? '' : $this->Number->format($award->balance) ?></td>
                </tr>
                <tr>
                    <th>Imagem</th>
                    <td><?= $award->image ?></td>
                </tr>
                <tr>
                    <th>Ativo</th>
                    <td><?= $award->active === null ? '' : $this->Number->format($award->active) ?></td>
                </tr>
                <tr>
                    <th>Criado em</th>
                    <td><?= h($award->created) ?></td>
                </tr>
                <tr>
                    <th>Alterado em</th>
                    <td><?= h($award->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
