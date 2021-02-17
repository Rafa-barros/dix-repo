
<div class="erro404">
    <a href="/"><img src="/app/View/assets/css/img/logo_blue.png" alt=""></a>
    <div class="baixo">
        <div class="blue-line"></div>
        <div class="jumbotron">
            <h1 class="display-4">Erro 404!</h1>
            <p class="lead">Infelizmente não conseguimos localizar a página procurada.</p>
            <hr class="my-4">
            <p>A URL requisitada não pode ser encontrada nesse servidor.</p>
            <div class="lead">
                <a class="btn btn-primary btn-lg" id="btn-voltar" href="/" role="button">Voltar</a>
            </div>
        </div>
    </div>
</div>

<script>
    if(window.location.href.split('/')[3] == 'profile'){
        $('.display-4').text('Perfil não encontrado...');
        $('.lead').text('Infelizmente o perfil solicitado ainda não existe.')
    }
</script>

<!-- 
    By: Caio C. Brandini da Silva - 2021

    Linkedin: https://www.linkedin.com/in/caiobrandini/
 -->