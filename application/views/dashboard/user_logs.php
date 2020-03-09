<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">User Activity</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Logger</th>
                                        <th scope="col">Logger Message</th>
                                        <th scope="col">Logger IP</th>
                                        <th scope="col">Logger Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $n = 1;
                                    foreach ($logs as $log): 
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$n?></th>
                                        <td><?=$log->type?></td>
                                        <td><?=$log->message?></td>
                                        <td><?=$log->ip_address?></td>
                                        <td><?=$log->date_logged?></td>
                                    </tr>
                                    <?php 
                                    $n++;
                                    endforeach; 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>