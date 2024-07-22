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

                // ATENÇÃO: 
                // Só podemos mostrar o resultado na tela após receber o OK do registerAward
                // Pois, se duas pessoas acertarem ao mesmo tempo, somente a que deu register primeiro poderá ver que ganhou
                // O segundo parâmetro aqui tem que ser o ID do prêmio
                registerAward(1, data);

            },
            error: function(error) {
                console.log('ERRO GET: ', error.responseText);
                registerAward(1, null);
            }
        })
    }

    function registerAward(user_id, award_id) {
        $.ajax({
            url: "<?php echo Router::url(array('controller' => 'Play', 'action' => 'registerAward')) ?>",
            method: "POST",
            data: {
                user_id: user_id,
                award_id: award_id
            },
            headers: {
                'X-CSRF-Token': "<?= $this->request->getAttribute('csrfToken'); ?>"
            },
            success: function(data) {
                console.log('REGISTRO SALVO: ', data);

            },
            error: function(error) {
                console.log('ERRO POST: ', error.responseText);
            }
        })
    }

    getAwards();
    // getAward();

    for (i = 0; i < 750; i++) {
        setTimeout(() => {
            getAward();
        }, 500);
    }
</script>