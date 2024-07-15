<?php

use Cake\Routing\Router; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function getAwards() {
        $.ajax({
            url: "<?php echo Router::url(array('controller' => 'Play', 'action' => 'getAwards')) ?>",
            method: "GET",
            dataType: 'json',
            success: function(data) {
                console.log('PRÊMIOS: ', data);

            },
            error: function(error) {
                console.log('ERRO: ', error.responseText);
            }
        })
    }

    function getAward() {
        $.ajax({
            url: "<?php echo Router::url(array('controller' => 'Play', 'action' => 'getAward')) ?>",
            method: "GET",
            dataType: 'json',
            success: function(data) {
                console.log('SORTEADO: ', data);
                
                // ATENÇÃO: o segundo parâmetro aqui tem que ser o ID do premio
                registerAward(1, data);

            },
            error: function(error) {
                console.log('ERRO: ', error.responseText);
            }
        })
    }

    function registerAward(user_id, award_id) {
        $.ajax({
            url: "<?php echo Router::url(array('controller' => 'Play', 'action' => 'registerAward')) ?>",
            method: "POST",
            data: {user_id: user_id, award_id: award_id},
            headers: {
                'X-CSRF-Token': "<?= $this->request->getAttribute('csrfToken'); ?>"
            },
            success: function(data) {
                console.log('REGISTRO SALVO: ', data);

            },
            error: function(error) {
                console.log('ERRO: ', error.responseText);
            }
        })
    }

    getAwards();
    getAward();

    
</script>