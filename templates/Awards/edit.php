<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Award $award
 * @var string[]|\Cake\Collection\CollectionInterface $sweepstakes
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Ver todos os prêmios'), ['action' => 'index', $sweepstake_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(
                __('Excluir'),
                ['action' => 'delete', $award->id, $sweepstake_id],
                ['confirm' => __('Confirma exclusão do item # {0}?', $award->id), 'class' => 'side-nav-item']
            ) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="awards form content">
            <?= $this->Form->create($award) ?>
            <fieldset>
                <legend>Editar prêmio</legend>
                <?php
                    echo $this->Form->control('name', ['label' => 'Nome']);
                    echo $this->Form->control('description', ['label' => 'Descrição']);
                    echo $this->Form->control('spaces', ['label' => 'Espaços para ocupar na roleta']);
                    echo $this->Form->control('balance', ['label' => 'Saldo']);
                    echo $this->Form->control('image', ['label' => 'Caminho da imagem']);
                    echo $this->Form->control('active', ['label' => 'Ativo', 'type' => 'checkbox']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
