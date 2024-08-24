<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal | HBD</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div>
        <div class="navbar">
            <div class="container">
                <a class="logo" href="index.html">H<span>BD</span></a>

                <img id="mobile-btn" class="mobile-menu" src="images/nav-icon.png" alt="Barra de Navegação" width="20" height="20">

                <nav>
                    <img id="mobile-exit" class="mobile-menu-exit" src="images/exit-icon.png" alt="Fechar Barra de Navegação" width="20" height="20">

                    <ul class="first-nav">
                        <list><a href="feed.php">Mural</a></list>
                        <list><a href="new.html">Postar</a></list>
                        <list><a href="#">Sobre Nós</a></list>
                    </ul>

                    <ul class="second-nav">
                        <list><a href="#">Contatos</a></list>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <section class="second-block">
        <div class="container">
            <ul>

                <?php

                header('Content-type: text/html; charset=utf-8');
                    



                //Config. para acesso ao mySql localmente 
                $servername = "sql101.epizy.com";
                $username = "epiz_29083227";
                $password = "sIr4OSljqh1iz";
                $dbname = "epiz_29083227_kontigo"; 

                $conn = mysqli_connect($servername, $username, $password);


                if (!$conn) {
                die("Falha na Conex�o: " . mysqli_connect_error());
                }

                // Selecionando banco
                if (!mysqli_select_db($conn,$dbname)) {
                    echo "N�o foi poss�vel selecionar base de dados \"$dbname\": " . mysqli_error($conn);
                    exit;
                }


                $sql = "SELECT id, nome, mensagem, imagem, datapost FROM postagem ORDER BY datapost DESC";

                $result = mysqli_query($conn, $sql);

                if (!$result) {
                die("Falha na Execu��o da Consulta: " . $sql ."<BR>" .
                    mysqli_error($conn));
                }

                if (mysqli_num_rows($result) == 0) {
                    echo "N�o foram encontradas linhas, nada para mostrar <BR>";
                    exit;
                }

                // Enquanto uma linha de dados existir, coloca esta linha em $row como uma matriz associativa { dici�ario tipo chave (campo) / valor (registro) }
                $id="";
                while ($row = mysqli_fetch_assoc($result)) {
                    $id=$row["id"];
                    echo '<li>';
                    echo '  <blockquote>'.$row["mensagem"].'</blockquote>';
                    echo '  <cite>Para: '.$row["nome"].'</cite><br>';
                    echo '  <img src="'.$row["imagem"].'" alt="Feliz aniversário!" width="150" height="150">';
                    echo '</li>';
                } 

                mysqli_free_result($result); 

                ?>
                
            </ul>
        </div>
    </section>

    <script>

        const mobileBtn = document.getElementById("mobile-btn");
            nav = document.querySelector('nav');
            mobileBtnExit = document.getElementById('mobile-exit');

        mobileBtn.addEventListener('click', () => {
            nav.classList.add('menu-btn');
        })

        mobileBtnExit.addEventListener('click', () => {
            nav.classList.remove('menu-btn');
        })


    </script>

</body>
</html>