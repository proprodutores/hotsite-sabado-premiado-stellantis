<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Winner $winner
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Ver todos ganhadores'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(
                __('Excluir'),
                ['action' => 'delete', $winner->id],
                ['confirm' => __('Confirma exclusão do registro # {0}?', $winner->id), 'class' => 'side-nav-item']
            ) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="winners form content">
            <?= $this->Form->create($winner) ?>
            <fieldset>
                <legend><?= __('Editar ganhador') ?></legend>
                <?php
                    echo $this->Form->control('name', ['label' => 'Nome']);
                    echo $this->Form->control('sapid', ['label' => 'Matrícula']);
                    echo $this->Form->control('phone', ['label' => 'Telefone']);
                    echo $this->Form->control('shift', ['label' => 'Turno']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
