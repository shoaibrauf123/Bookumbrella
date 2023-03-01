<div class="col-xs-12">
    <div class="container page-cont">
        <div class="row no-padding col-sm-offset-2">
            <h2>추천된친구</h2>

            <div class="clear30"></div>
            <div class="col-md-9 col-xs-12">
                <?php if ($result) { ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Email</th>
                            <th>회원가입날짜</th>
                            <th>회원상태</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total = count($result);
                        for ($i = 0; $i < $total; $i++) { ?>
                            <tr>
                                <td><?php echo $result[$i]['email']; ?></td>
                                <td><?php echo $result[$i]['date_created']; ?></td>
                                <td>
                                    <?php if ($result[$i]['status'] == 0) {
                                        echo 'Inactive';
                                    } else if ($result[$i]['status'] == 1) {
                                        echo 'Active';
                                    } ?>
                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <br><br>
                <?php } else { ?>
                    <div class="alert alert-danger">
                        No Referred Friends
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
</div>
 