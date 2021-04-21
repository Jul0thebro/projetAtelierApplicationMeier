<?php
//Variables
$tbPlayers = $_SESSION["players"]; // Sert à récupérer les équipes inscrites
$tableauAffichage = array(); //Tableau où l'on va stocker les paires aléatoire
// le for suivant permet de créer des paires d'équipes aléatoire avec celles qui sont inscrites au tournoi
for ($i = count($tbPlayers) / 2; $i > 0; $i--) {
    $random = array_rand($tbPlayers, 2);
    array_push($tableauAffichage, $tbPlayers[$random[0]]["nomEquipe"], $tbPlayers[$random[1]]["nomEquipe"]);
    unset($tbPlayers[$random[0]]);
    unset($tbPlayers[$random[1]]);
}

$idTournoi = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$tableauFinal = array();
$huitieme = "";
$quart = "";
$demi = "";
$final = "";
if ($tableauVerif = verifSiBracketGenerer($idTournoi)) {
    for ($i = 0; $i < 8; $i += 2) {
        $huitieme .= "
        <div class=\"winners\">
            <div class=\"matchups\">    
                <div class=\"matchup\">
                    <div class=\"participants\">
                        <div class=\"participant winner\">
                        <span>" . $tableauVerif[$i]["equipe1"] . "</span></div>
                        <div class=\"participant\">
                        <span>" . $tableauVerif[$i]["equipe2"] . "</span></div>
                    </div>
                </div>
                <br/>
                <div class=\"matchup\">
                    <div class=\"participants\">
                        <div class=\"participant winner\">
                        <span>" . $tableauVerif[$i + 1]["equipe1"] . "</span></div>
                        <div class=\"participant\">
                        <span>" . $tableauVerif[$i + 1]["equipe2"] . "</span></div>
                    </div>
                </div>
            </div>
            <div class=\"connector\">
                <div class=\"merger\"></div>
                <div class=\"line\"></div>
            </div>
        </div>";
    }
} else {
    for ($i = 0; $i < 16; $i += 4) {
        $huitieme .= "
                <div class=\"winners\">
                    <div class=\"matchups\">
                        <div class=\"matchup\">
                            <div class=\"participants\">
                                <div class=\"participant winner\">
                                <span>" . $tableauAffichage[$i] . "</span></div>
                                <div class=\"participant\">
                                <span>" . $tableauAffichage[$i + 1] . "</span></div>
                            </div>
                        </div>
                        <br/>
                        <div class=\"matchup\">
                            <div class=\"participants\">
                                <div class=\"participant winner\">
                                <span>" . $tableauAffichage[$i + 2] . "</span></div>
                                <div class=\"participant\">
                                <span>" . $tableauAffichage[$i + 3] . "</span></div>
                            </div>
                        </div>
                    </div>
                    <div class=\"connector\">
                        <div class=\"merger\"></div>
                        <div class=\"line\"></div>
                    </div>
                </div>";
        array_push($tableauFinal, $tableauAffichage[$i], $tableauAffichage[$i + 1], $tableauAffichage[$i + 2], $tableauAffichage[$i + 3]);
    }
}



/*for ($j = 0; $j < 2; $j++) {
    $quart .= "<div class=\"winners\">
                        <div class=\"matchups\">    
                            <div class=\"matchup\">
                                <div class=\"participants\">
                                    <div class=\"participant winner\">
                                        <span> </span>
                                    </div>
                                    <div class=\"participant\">
                                        <span> </span>
                                    </div>
                                </div>
                            </div>
                            <div class=\"matchup\">
                                <div class=\"participants\">
                                    <div class=\"participant winner\">
                                        <span> </span>
                                    </div>
                                    <div class=\"participant\">
                                        <span> </span>
                                    </div>
                                </div>
                            </div>
                            <div class=\"connector\">
                                <div class=\"merger\"></div>
                                <div class=\"line\"></div>
                            </div>
                        </div>
                    </div>";
}*/
/*$demi .= "  <div class=\"winners\">
                    <div class=\"matchups\">    
                        <div class=\"matchup\">
                            <div class=\"participants\">
                                <div class=\"participant winner\">
                                    <span> </span></div>
                                <div class=\"participant\">
                                    <span> </span></div>
                            </div>
                        </div>
                        <div class=\"matchup\">
                            <div class=\"participants\">
                                <div class=\"participant winner\">
                                    <span> </span>
                                </div>
                                <div class=\"participant\">
                                    <span> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"connector\">
                        <div class=\"merger\"></div>
                        <div class=\"line\"></div>
                    </div>
                </div>";*/

/*$final .= "<div class=\"winners\">
                    <div class=\"matchups\">    
                        <div class=\"matchup\">
                            <div class=\"participants\">
                                <div class=\"participant winner\">
                                     <span> </span>
                                </div>
                                <div class=\"participant\">
                                     <span> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";*/
SupprPaireEquipesTournoi($idTournoi);
for ($i = 0; $i < count($tableauFinal); $i = $i + 2) {
    saveBracket($tableauFinal[$i], $tableauFinal[$i + 1], $idTournoi);
}
?>
<!-- Va nous permettre de changer l'affichage de la page tournoi  -->
<br><br><br><br><br><br><br><br><br><br>
<div class="bracket" id="bracketPrincipale">

    <!-- matchups -> matchup -> participants -> participant ou participant winner -->
    <section class="round eighthfinals">
        <?php


        if ($huitieme != null)
            echo $huitieme;;
        ?>
    </section>

    <!-- Quarts de final -->
    <section class="round quarterfinals">
        <!-- Premier bracket quarter -->
        <div class="winners">
            <div class="matchups">
                <div class="matchup">
                    <div class="participants">
                        <div class="participant winner">
                            <span> </span>
                        </div>
                        <div class="participant">
                            <span> </span>
                        </div>
                    </div>
                </div>
                <div class="matchup">
                    <div class="participants">
                        <div class="participant winner">
                            <span> </span>
                        </div>
                        <div class="participant">
                            <span> </span>
                        </div>
                    </div>
                </div>
                <div class="connector">
                    <div class="merger"></div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <!-- Deuxieme bracket quarter -->
        <div class="winners">
            <div class="matchups">
                <div class="matchup">
                    <div class="participants">
                        <div class="participant winner">
                            <span> </span>
                        </div>
                        <div class="participant">
                            <span> </span>
                        </div>
                    </div>
                </div>
                <div class="matchup">
                    <div class="participants">
                        <div class="participant winner">
                            <span> </span>
                        </div>
                        <div class="participant">
                            <span> </span>
                        </div>
                    </div>
                </div>
                <div class="connector">
                    <div class="merger"></div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demis de final -->
    <section class="round semifinals">
        <div class="winners">
            <div class="matchups">
                <div class="matchup">
                    <div class="participants">
                        <div class="participant winner">
                            <span> </span>
                        </div>
                        <div class="participant">
                            <span> </span>
                        </div>
                    </div>
                </div>
                <div class="matchup">
                    <div class="participants">
                        <div class="participant winner">
                            <span> </span>
                        </div>
                        <div class="participant">
                            <span> </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="connector">
                <div class="merger"></div>
                <div class="line"></div>
            </div>
        </div>
    </section>

    <!-- final -->
    <section class="round finals">
        <div class="winners">
            <div class="matchups">
                <div class="matchup">
                    <div class="participants">
                        <div class="participant winne">
                            <span> </span>
                        </div>
                        <div class="participant">
                            <span> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>