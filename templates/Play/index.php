<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Play> $play
 */
?>
<style>
    label[for="award"] {
        font-size: 1.5rem;
        font-weight: unset;
    }

    fieldset {
        border-width: 0.1rem;
        border-radius: .5rem;
        border-style: solid;
        padding: 1rem;
    }
</style>
<div class="play index content">
    <h3>Relatórios de jogadas</h3>
    <?= $this->Form->create(null, ['role' => 'form', 'method' => 'get', 'class' => 'form-search']) ?>
    <div class="row">
        <div class="column"><?= $this->Form->control('sweepstake_id', ['label' => 'Sorteio', 'empty' => 'Selecione', 'options' => $sweepstakes]) ?></div>
        <div class="column"><?= $this->Form->control('user_id', ['label' => 'Local', 'empty' => 'Selecione', 'options' => $users]) ?></div>
        <div class="column"><?= $this->Form->control('start_date', ['label' => 'Início', 'type' => 'datetime']) ?></div>
        <div class="column"><?= $this->Form->control('end_date', ['label' => 'Fim', 'type' => 'datetime']) ?></div>
    </div>
    <div class="row">
        <div class="column" style="text-align: left; font-size:.8rem">
            <?= $this->Form->control('award', ['label' => 'Somente registros com prêmio', 'type' => 'checkbox']) ?>
        </div>
        <div class="column" style="text-align: right;">
            <?= $this->Form->submit('Pesquisar', ['id' => 'btn-search', 'class' => 'float-center button']) ?>
            <?= $this->Html->link(__('Limpar pesquisa'), ['action' => 'index']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
    <br>
    <fieldset>
        <legend>&nbsp;Resumo do sorteio: <?= $sweepstake_name ?>&nbsp;</legend>
        <?php if ($summary != "") { ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Local</th>
                            <th>Jogadas</th>
                            <th>Com prêmio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total1 = 0;
                        $total2 = 0;
                        foreach ($summary as $summ) {
                            $total1 += $summ['val1'];
                            $total2 += $summ['val2'];
                        ?>
                            <tr>
                                <td><?= $summ['name'] ?></td>
                                <td><?= $summ['val1'] ?></td>
                                <td><?= $summ['val2'] ?></td>
                            </tr>

                        <?php } ?>
                    </tbody>
                    <thead>
                        <tr>
                            <th>TOTAL</th>
                            <th><?= $total1 ?></th>
                            <th><?= $total2 ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php } ?>
    </fieldset>
    <fieldset>
        <legend>&nbsp;Detalhado&nbsp;</legend>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id', ['label' => '#']) ?></th>
                        <th><?= $this->Paginator->sort('sweepstake_id', ['label' => 'Sorteio']) ?></th>
                        <th><?= $this->Paginator->sort('award_id', ['label' => 'Prêmio']) ?></th>
                        <th><?= $this->Paginator->sort('user_id', ['label' => 'Local']) ?></th>
                        <th><?= $this->Paginator->sort('created', ['label' => 'Registrado em']) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($play as $play): ?>
                        <tr>
                            <td><?= $this->Number->format($play->id) ?></td>
                            <td><?= $play->award != null ? $play->award->sweepstake->description : '' ?></td>
                            <td><?= $play->has('award') ? $this->Html->link($play->award->name, ['controller' => 'Awards', 'action' => 'view', $play->award->id]) : '' ?></td>
                            <td><?= $play->has('user') ? $this->Html->link($play->user->name, ['controller' => 'Users', 'action' => 'view', $play->user->id]) : '' ?></td>
                            <td><?= h($play->created) ?></td>
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
    </fieldset>
</div>