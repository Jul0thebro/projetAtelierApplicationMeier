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
                                <thead>
                                    <tr>
                                        <th>Pseudo</th>
                                        <th>Age</th>
                                        <th>Rôle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $idEquipe = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                                     echo arrayToHtmlTablePlayers(affichageJoueurs($idEquipe)); 
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