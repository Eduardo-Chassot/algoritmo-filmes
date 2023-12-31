<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Barra de Pesquisa</title>
</head>
<body>
    <div class="search-container">
        <input type="text" id="search-bar" class="search-bar" placeholder="Digite sua pesquisa...">
        <select id="search-select" class="search-bar" placeholder="Digite sua pesquisa...">
            <option value="id">Id</option>
            <option value="titulo">Titulo</option>
            <option value="lancamento">Lancamento</option>
            <option value="lingua">Lingua</option>            
            <option value="votos_medios">Votos Medios</option>
            <option value="votos_contagem">Votos Contagem</option>
            <option value="popularidade">Popularidade</option>
            <option value="resumo">Resumo</option>
            <option value="orcamento">Orcamento</option>
            <option value="lucro">Lucro</option>
        </select>
        <button id="search-button">Pesquisar</button>
    </div>
    <div>
        <table class="table">
            <tr>
                <td>Titulo</td>
                <td>Receita</td>
                <td>Subtitulo</td>
            </tr>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            let $select = $("#search-select"),
                $pesquisa = $("#search-bar");

            const padrao = "<tr><td>Titulo</td><td>Receita</td><td>Subtitulo</td></tr>"

            $select.on("change", function(){
                chamarFilmes();
            })

            $pesquisa.on("change", function(){
                chamarFilmes();
            })

            function chamarFilmes() {
                if ($select.val() && $pesquisa.val()) {
                    $.post("ajax/pesquisa.php",
                        { pesquisa: $pesquisa.val(), select: $select.val() },
                        function(data) { // Colocar a função diretamente aqui
                            let inserir = padrao;

                            data.forEach(function(item) { // Usar forEach para iterar sobre os elementos
                                inserir += `<tr><td>${item.title}</td><td>${item.revenue}</td><td>${item.overview}</td></tr>`;
                            });

                            $(".table").html(inserir);
                        },
                        "json" // Tipo de dados esperado
                    );
                }
            }
        })
    </script>
</body>
</html>
