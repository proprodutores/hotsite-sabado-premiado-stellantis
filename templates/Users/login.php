<style>
    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .content {
        width: 50%;
    }
</style>
<div class="users form content">
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('login', ['label' => 'Usuário']) ?>
        <?= $this->Form->control('password', ['label' => 'Senha']) ?>
    </fieldset>
    <?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end() ?>
</div>