<html>

<head>
<title>Mensagem recebida!</title>
    <!-- HTML 4 -->
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> -->

  
    <!-- HTML5 -->
    <meta charset="utf-8"/>
    <meta http-equiv="refresh" content="5; URL='feed.php'"/>
</head>
    
<body> 


<?php


//Config. para acesso ao mySql no infinitFree (hairon) 
/*$servername = "sql101.epizy.com";
$username = "epiz_25968604";
$password = "gNRO99MOv4TvsEP"; 
$dbname = "epiz_25968604_hairon";*/


//Config. para acesso ao mySql localmente 
$servername = "sql101.epizy.com"; //127.0.0.1 
$username = "epiz_29083227";
$password = "sIr4OSljqh1iz";
$dbname = "epiz_29083227_kontigo"; 

$conn = mysqli_connect($servername, $username, $password);


if (!$conn) {
  die("Falha na Conex�o: " . mysqli_connect_error());
}
echo "Conectado com Sucesso <BR><BR>";

// Selecionando banco
if (!mysqli_select_db($conn,$dbname)) {
    echo "N�o foi poss�vel selecionar base de dados \"$dbname\": " . mysqli_error($conn);
    exit;
}

$sql = "SELECT id FROM postagem";

$result = mysqli_query($conn, $sql);

$id_atual = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];

    if ($id == $id_atual + 1) {
        $id_atual = $id;
    }

}

$id = $id_atual + 1;

$nome = $_POST['name'];
echo 'Destinatário:' . $nome;
$mensagem = $_POST['message'];
echo 'Mensagem:' . $mensagem;
$imagem = $_POST['image'];
echo '<img src="'.$imagem.'" alt="Feliz aniversário!">';

$sql = "INSERT INTO postagem (id, nome, mensagem, imagem, datapost) VALUES (" . $id . ", '" . $nome . "', '" . $mensagem . "', '" . $imagem . "', NOW())";

$result = mysqli_query($conn, $sql);

if ($result) {
	echo "Criado com sucesso, por favor aguarde 5 segundos.";
} else {
    echo "N�o foi poss�vel executar ($sql) no banco de dados: $dbname <br>  " . mysqli_error($conn);
    exit;
}

?>
</body></html>
