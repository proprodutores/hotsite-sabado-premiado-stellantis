<div class="users form content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend>Por favor, entre com seu usuário e senha</legend>
        <?= $this->Form->control('login', ['label' => 'Usuário']) ?>
        <?= $this->Form->control('password', ['label' => 'Senha']) ?>
    </fieldset>
    <?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end() ?>
</div>