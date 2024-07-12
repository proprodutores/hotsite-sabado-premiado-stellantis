<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Award $award
 * @var \Cake\Collection\CollectionInterface|string[] $sweepstakes
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Ver todos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="awards form content">
            <?= $this->Form->create($award) ?>
            <fieldset>
                <legend><?= __('Adicionar Prêmio') ?></legend>
                <?php
                    echo $this->Form->control('sweepstake_id', ['options' => $sweepstakes, 'label' => 'Sorteio', 'value' => $sweepstake_id]);
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
