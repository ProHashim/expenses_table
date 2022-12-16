<?php

$con = mysqli_connect('localhost', 'root', '', 'income');
if (isset($_POST['einnahme'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $datum = $_POST['datum'];
        $titel = $_POST['titel'];
        $betrag_green = $_POST['betrag'];

    }

    $sql = "INSERT INTO `expenses` (`datum`, `titel`, `betrag_green`) VALUES ('$datum', '$titel', '$betrag_green' ) ";
    $rs = mysqli_query($con, $sql);

} elseif (isset($_POST['ausgabe'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $datum = $_POST['datum'];
        $titel = $_POST['titel'];
        $betrag_red = $_POST['betrag'];

    }

    $sql = "INSERT INTO `expenses` (`datum`, `titel`, `betrag_red`) VALUES ('$datum', '$titel', '$betrag_red' ) ";
    $rs = mysqli_query($con, $sql);

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formular</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        #wrapper {
            max-width: 700px;
            margin: 30px auto;
        }

        .right {
            text-align: right;
        }

        .page-link {
            color: #212529;
        }

        .page-link:hover {
            color: #212529;
        }

        .page-item.active .page-link {
            border-color: #212529;
            background-color: #212529;
        }
    </style>
</head>

<body>
    <div id="wrapper" class="container-fluid">
        <h1>Einnahmen / Ausgaben</h1>
        <form action="form.php" method="post">
            <div class="row g-3 mt-3">
                <div class="col-sm mt-1">
                    <input type="date" name="datum" class="form-control" value="" required aria-label="Datum" require>
                </div>
                <div class="col-sm-5  mt-1">
                    <input type="text" name="titel" class="form-control" value="" required placeholder="Titel"
                        aria-label="Titel">
                </div>
                <div class="col-sm  mt-1">
                    <div class="input-group">
                        <input type="text" name="betrag" class="form-control" value="" required placeholder="Betrag"
                            aria-label="Betrag">
                        <div class="input-group-text">€</div>
                    </div>
                </div>
            </div>
            <div class="mt-3 right">
                <div class="col-12 pl-0 pr-0">
                    <button type="submit" name="einnahme" class="btn btn-success mr-3" formnovalidate="formnovalidate"
                        value="Einnahme">Einnahme</button>
                    <button type="submit" name="ausgabe" class="btn btn-danger" formnovalidate="formnovalidate"
                        name="ausgabe" value="ausgabe">Ausgabe</button>
                    <input type="hidden" name="_token" value="">
                </div>
            </div>
        </form>
        <hr class="mt-5">
        <?php
    $sql = "SELECT * FROM expenses";
    $result = mysqli_query($con, $sql);
    ?>
        <div>
            <div class="row pl-2">
                <div class="col-sm text-success">Einnahmen: 

                    <?php
                    $total = mysqli_query($con, 'SELECT SUM(betrag_green) AS value_sum FROM expenses'); 
                    $row = mysqli_fetch_assoc($total); 
                    $sum_green = $row['value_sum'];
                    echo ($sum_green . ',00 €');
                    ?>

                </div>
                <div class="col-sm text-danger">Ausgaben: 

                <?php
                    $total = mysqli_query($con, 'SELECT SUM(betrag_red) AS value_sum FROM expenses'); 
                    $row = mysqli_fetch_assoc($total); 
                    $sum_red = $row['value_sum'];
                    echo ($sum_red . ',00 €');
                    ?>
                </div>
                <div class="col-sm text-success">Stand: 
                    <?php
                    echo ($sum_green - $sum_red . ',00 €');
                    ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="mt-5">
        <p class="pl-2"><strong><?php 
        echo date('F Y'); 
        ?></strong></p>
            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                    <th>Datum</th>
                        <th>Titel</th>
                        <th class="right">Einnahme</th>
                        <th class="right">Ausgabe</th>
                    </tr>
                    </thead>
                    <tbody>
            <?php
        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
            
                        
              
                
                    <tr>
                        <td>
                            <?php
                echo $row["datum"];
                            ?>
                        </td>
                        <td>
                            <?php
                echo $row["titel"];
                        ?>
                        </td>
                        <td class="text-success right">
                            <?php

                echo $row["betrag_green"] . ',00';

                            ?>
                        </td>
                        <td class="text-danger right">
                            <?php

                echo $row["betrag_red"] . ',00';

                        ?>
                        </td>
                    </tr>
    
             
           
            <?php
            endwhile;
            ?>
            <?php
        endif;
            ?>
               </tbody>
             </table>
            <p class="pl-2 mt-5"><strong>Oktober 2021</strong></p>
            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Titel</th>
                        <th class="right">Einnahme</th>
                        <th class="right">Ausgabe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>05.10.2021</td>
                        <td>Lebensmittel</td>
                        <td class="text-success right"></td>
                        <td class="text-danger right">50,53</td>
                    </tr>
                    <tr>
                        <td>01.10.2021</td>
                        <td>Lohn</td>
                        <td class="text-success right">2000,00</td>
                        <td class="text-danger right"></td>
                    </tr>
                    <tr>
                        <td>01.10.2021</td>
                        <td>Lohn</td>
                        <td class="text-success right">2000,00</td>
                        <td class="text-danger right"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr class="mt-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="First">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&lsaquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>

                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&rsaquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Last">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Last</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>