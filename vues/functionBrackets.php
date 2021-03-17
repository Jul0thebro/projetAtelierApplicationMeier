<?php
session_start();
$tbPlayers = $_SESSION["players"];
$idTournoi = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$huitieme = "";
$quart = "";
$demi = "";
$final = "";

for ($i = 0; $i < 16; $i += 4) {
    $huitieme .= "
            <div class=\"winners\">
                <div class=\"matchups\">
                    <div class=\"matchup\">
                        <div class=\"participants\">
                            <div class=\"participant winner\">
                            <span>" . $tbPlayers[$i] . "</span></div>
                            <div class=\"participant\">
                            <span>" . $tbPlayers[$i + 1] . "</span></div>
                        </div>
                    </div>
                    <br/>
                    <div class=\"matchup\">
                        <div class=\"participants\">
                            <div class=\"participant winner\">
                            <span>" . $tbPlayers[$i + 2] . "</span></div>
                            <div class=\"participant\">
                            <span>" . $tbPlayers[$i + 3] . "</span></div>
                        </div>
                    </div>
                </div>
                <div class=\"connector\">
                    <div class=\"merger\"></div>
                    <div class=\"line\"></div>
                </div>
            </div>";
}
for ($j = 0; $j < 2; $j++) {
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
}

$demi .= "  <div class=\"winners\">
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
                </div>";

$final .= "<div class=\"winners\">
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
                </div>";

$_SESSION["huitieme"] = $huitieme;
$_SESSION["quart"] = $quart;
$_SESSION["demi"] = $demi;
$_SESSION["final"] = $final;

header("Location: ?uc=tournoi&&id=$idTournoi");
exit();
