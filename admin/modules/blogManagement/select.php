<?php
$sql_lietke_bv = "SELECT * FROM tblblog";
$query_lietke_bv = mysqli_query($mysqli, $sql_lietke_bv);
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body-header">
                            <h4 class="card-title">Danh sách bài viết</h4>
                            <button class="btn btn-outline-dark btn-icon-text">
                                <i class="mdi mdi-plus"></i>
                                <a href="index.php?action=blogManagement&query=insert">Thêm bài viết</a>
                            </button>
                        </div>
                        <div class="table-responsive pt-3">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên bài viết</th>
                                        <th>Tóm tắt</th>
                                        <th>Thời gian đăng bài</th>
                                        <th>Quản lý</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($row = mysqli_fetch_array($query_lietke_bv)) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td style="white-space: nowrap;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            max-width: 200px;">
                                                <?php echo $row['BlogTitle'] ?></td>
                                            <td style="white-space: nowrap;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            max-width: 200px;">
                                                <?php echo $row['SummaryContent'] ?></td>
                                            <td><?php echo $row['PostDate'] ?></td>
                                            </td>
                                            <td>
                                                <a href="modules/blogManagement/handle.php?BlogID=<?php echo $row['BlogID'] ?>" onClick="return confirm('Bạn có muốn xoá bài viết này không?');">Xoá</a> | <a href="?action=blogManagement&query=update&BlogID=<?php echo $row['BlogID'] ?>">Sửa</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
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