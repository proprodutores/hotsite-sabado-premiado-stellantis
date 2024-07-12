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
            <?= $this->Html->link(__('Ver todos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $award->id],
                ['confirm' => __('Confirma exclusão do item # {0}?', $award->id), 'class' => 'side-nav-item']
            ) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="awards form content">
            <?= $this->Form->create($award) ?>
            <fieldset>
                <legend><?= __('Edit Award') ?></legend>
                <?php
                    echo $this->Form->control('name', ['label' => 'Nome']);
                    echo $this->Form->control('description', ['label' => 'Descrição']);
                    echo $this->Form->control('quantity', ['label' => 'Quantidade']);
                    echo $this->Form->control('spaces', ['label' => 'Espaços para ocupar']);
                    echo $this->Form->control('active', ['label' => 'Ativo', 'type' => 'checkbox']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
