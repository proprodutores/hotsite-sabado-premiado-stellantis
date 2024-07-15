<?php use Cake\Routing\Router; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $.ajax({
        url: "<?php echo Router::url(array('controller' => 'Play', 'action' => 'getAwards')) ?>",
        method: "GET",
        dataType: 'json',
        success: function(data) {
            console.log('PRÊMIOS: ', data);

        },
        error: function(error) {
            console.log('ERRO: ', error.responseText)
        }
    })
    $.ajax({
        url: "<?php echo Router::url(array('controller' => 'Play', 'action' => 'getAward')) ?>",
        method: "GET",
        dataType: 'json',
        success: function(data) {
            console.log('SORTEADO: ', data)

        },
        error: function(error) {
            console.log('ERRO: ', error.responseText)
        }
    })
</script>