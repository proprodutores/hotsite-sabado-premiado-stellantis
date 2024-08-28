<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Winner $winner
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading">Ações</h4>
            <?= $this->Html->link(__('Ver todos ganhadores'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="winners form content">
            <?= $this->Form->create($winner) ?>
            <fieldset>
                <legend><?= __('Adicionar ganhador') ?></legend>
                <?php
                    echo $this->Form->control('name', ['label' => 'Nome *', 'required']);
                    echo $this->Form->control('sapid', ['label' => 'Matrícula *', 'required']);
                    echo $this->Form->control('phone', ['label' => 'Telefone']);
                    echo $this->Form->control('shift', ['label' => 'Turno']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
