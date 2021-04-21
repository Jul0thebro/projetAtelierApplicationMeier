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
                                        <th>Regarder l'équipe</th>
                                        <th>Nom de l'équipe</th>
                                        <th>Date de création</th>
                                        <th>nombre de joueurs</th>
                                        <th hidden>id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo arrayToHtmlTableTeams(affichageEquipes()); ?>
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