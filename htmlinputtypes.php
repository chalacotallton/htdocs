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
    Escolha o prato principal<br>
    <input type="radio" name="prato principal" value="Pizza"> Pizza<br>
    <input type="radio" name="prato principal" value="Macarrão"> Macarrão<br>
    <input type="radio" name="prato principal" value="Sanduíche"> Sanduíche<br>
    <input type="radio" name="prato principal" value="Almoço Completo">Almoço Executivo <br>
  </p>
  <p>
    Agora os acompanhamentos<br>
      <input type="checkbox" name="Queijo" value="Queijo"> Queijo<br>
      <input type="checkbox" name="Oregano" value="Oregano"> Orégano<br>
      <input type="checkbox" name="peito de peru" value="Peito de Peru"> Peito de Peru<br>
      <input type="checkbox" name="Milho" value="Milho"> Milho<br>
      <input type="checkbox" name="Azeitona" value="Azeitona"> Azeitona<br>
      <input type="checkbox" name="Cebola" value="Cebola"> Cebola

  </p>
  <p>
    Algum adicional?<br>
    <input type="checkbox" name="Bacon" value="Bacon"> Bacon (R$ 2,00)<br>
    <input type="checkbox" name="Bp2g" value="Bp2g"> Trocar a batata pequena pela grande (R$ 1,50)</p>
  </p>
  <p>
    Escolha a quantidade<br>
    Quantidade: <input type="number" name="quantidade" min="1" max="19" value="1">
  </p>
  <p>
    Escolha sua bebida<br>
    <input type="checkbox" name="Suco de limao" value="Suco de limao"> Suco de limão<br>
    <input type="checkbox" name="Suco de laranja" value="Suco de laranja"> Suco de laranja<br>
    <input type="checkbox" name="Suco de maracujá" value="Suco de maracuja"> Suco de maracujá<br>
    <input type="checkbox" name="Coca-cola" value="Coca-cola"> Coca-cola<br>
    <input type="checkbox" name="Guarana antartica" value="Guarana antartica" checked> Guarana antartica<br>
    <input type="checkbox" name="Fanta laranja" value="Fanta laranja"> Fanta laranja<br>
  </p>
  <p>
    Escolha a forma de pagamento<br>
    <input type="radio" name="pagamento" value="Cartao"> Cartao de crédito<br>
    <input type="radio" name="pagamento" value="Dinheiro"> Dinheiro<br>
  </p>
  <p>
    Entrega agendada<br>
    <input type="radio" name="agendar" value="nao"> Não<br>
    <input type="radio" name="agendar" value="sim"> Sim.  Horário: <label for="horadaentregas"></label>
    <input type="time" name="horadaentregas" id="horadaentregas"><br>
  </p>
  <p>
    Seus Dados<br>
    <p><label for="inpname"> Nome:</label>
    <input type="text" name="inpname" id="inpname" size="60" value="seu nome aqui"></p>
    <p><label for="inptelefone"> Telefone: </label>
    <input type="text" name="inptelefone" id="inptelefone" size="40"></p>
    <p><label for="inpemail"> Email: </label>
    <input type="text" name="inpemail" id="inpemail" size="40"></p>
  </p>
  <p>
    Informações Complementares<br>
    <label for="dropdownmenu">
    <select name="talheres" id="dropdownmenu">
      <option value="0">Não preciso de talheres</option>
      <option value="1" selected>Preciso de talheres</option>
    </select>
    <p><label for="inpbox"> O que vc gostaria de nos dizer? <br/>
      <textarea rows="10" cols="40" id="inpbox" name="complementar">
        Sugestões, pedidos, elogios...
      </textarea></p>
  </p>
  <p>
    <input type="submit" name="dopost" value="Confirmar pedido" />
    <input type="button" onclick="location.href='index.php'; return false;" value="Cancelar pedido">
  </p>

</form>
<?= htmlentities("&") ?>
</body>
</html>
