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
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sweepstakes form content">
            <?= $this->Form->create($sweepstake) ?>
            <fieldset>
                <legend><?= __('Adicionar Sorteio') ?></legend>
                <?php
                    echo $this->Form->control('description', ['label' => 'Descrição']);
                    echo $this->Form->control('date_start', ['empty' => true, 'label' => 'Início']);
                    echo $this->Form->control('date_end', ['empty' => true, 'label' => 'Fim']);
                    echo $this->Form->control('difficulty', ['label' => 'Probabilidade de acerto (%)', 'value' => '5']);
                    echo $this->Form->control('spaces', ['label' => 'Qtde de espaços na roleta']);
                    echo $this->Form->control('active', ['label' => 'Ativo', 'type' => 'checkbox', 'checked']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
