<html>
<head>
  <title> HTML Input Types </title>
  <h1> HTML Input Types</h1>
  <h2> Esse é um menu, bon appetit! </h2>
</head>
<body>
<h2> Você pode escolher seu lanche aqui</h2>
<form method="post" action="success.htm">
  <p>
    Escolha o prato principal
  </p>
  <p>
    Agora os acompanhamentos
  </p>
  <p>
    Algum adicional?
  </p>
  <p>
    Escolha a quantidade
  </p>
  <p>
    Escolha sua bebida
  </p>
  <p>
    Escolha a forma de pagamento
  </p>
  <p>
    Entrega agendada
  </p>
  <p>
    Seus Dados<br>
    <p><label for="inpname"> Nome:</label>
    <input type="text" name="inpname" id="inpname" size="60"></p>
    <p><label for="inptelefone"> Telefone: </label>
    <input type="inptelefone" name="inptelefone" id="inptelefone" size="40"></p>
    <p><label for="inpemail"> Email: </label>
    <input type="inpemail" name="inpemail" id="inpemail" size="40"></p>
  </p>
  <p>
    Informações Complementares<br>
    <p><label for="inpbox"> O que vc gostaria de nos dizer? <br/>
      <textarea rows="10" cols="40" id="inpbox" name="complementar">
        Sugestões, pedidos, elogios...
      </textarea></p>
  </p>
  <p>
    <input type="submit" name="dopost" value="Submit" />
    <input type="button" onclick="location.href='index.php'; return false;" value="Escape">
  </p>
</form>
</body>
</html>
