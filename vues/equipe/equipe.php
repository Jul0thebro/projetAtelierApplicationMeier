<div class="table-responsive">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <tbody>
                                    <?php
                                     $idEquipe = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                                     $idPlayer = recupIdPlayer($_SESSION["pseudo"]["pseudo"]);
                                     $i = recupIdTeamCaptain($idPlayer["idPlayer"]);
                                     // si l'utilisateur est le captinaine de cette équipe 
                                     if ($i["idDroit"] == 2 && $idEquipe == $i["idEquipe"]){
                                        echo arrayToHtmlTablePlayersCaptain(affichageJoueurs($idEquipe)); 
                                     }
                                     else {
                                        echo arrayToHtmlTablePlayers(affichageJoueurs($idEquipe)); 
                                     }
                                    
                   
                                   

                                     ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
</div>
</main>
</div>
</div>