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
                                    <tr class="table-secondary">
                                        <th>Regarder les tournois</th>
                                        <th>Nombre de places restantes</th>
                                        <th>Nom du tournoi</th>
                                        <th>Jeux</th>
                                        <th>Tailles des équipes</th>
                                        <th>Date</th>
                                        <th>Etat</th>
                                        <th>ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo arrayToHtmlTable(readTournament()); ?>
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