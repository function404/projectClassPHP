<form action="recPesquisa.php" method="GET">
    <h2>O que você achou do site?</h2>
    <input type="radio" name="site" value="Muito Bom" checked>Muito Bom
    <input type="radio" name="site" value="Bom">Bom
    <input type="radio" name="site" value="Regular">Regular
    <input type="radio" name="site" value="Um Lixo">Um Lixo

    <h2>Qual a seção que você mais gostou?</h2>
    <select name="secao">
        <option value="">---</option>
        <option value="Em cartaz">Em Cartaz</option>
        <option value="Dicas">Dicas</option>
        <option value="Quiz">Quiz</option>
    </select>
    <label for="outra">Outra: </label>
    <input type="text" name="outra">

    <h2>Digite seus comentários no campo abaixo:</h2>
    <textarea name="comentario" cols="60" rows="10"></textarea>

    <h2>Diga-nos como entrar em contato com você:</h2>
    <label for="nome">Nome: </label>
    <input type="text" name="nome"><br>
    <label for="email">email: </label>
    <input type="text" name="email"><br>
    <label for="fone">Fone: </label>
    <input type="text" name="fone"><br>

    <input type="checkbox" name="novidades">
    <label for="novidades">Quero receber as novidades do site por email</label><br>

    <input type="submit" value="Enviar">
    <input type="reset" value="Limpar Formulário">    
</form>

