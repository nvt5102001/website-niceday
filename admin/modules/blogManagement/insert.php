<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thêm bài viết</h4>
                        <div class="table-responsive pt-3">
                            <table class="table table-light">
                                <form method="POST" action="modules/blogManagement/handle.php" enctype="multipart/form-data">
                                    <tr>
                                        <td>Tên bài viết</td>
                                        <td><textarea  name="BlogTitle" style="resize: none;width:500px;height:100px;"></textarea></td>
                                    </tr>

                                    <tr>
                                        <td>Hình ảnh</td>
                                        <td><input type="file" name="Image"></td>
                                    </tr>
                                    <tr>
                                        <td>Tóm tắt</td>
                                        <td><textarea  name="SummaryContent" style="resize: none;width:500px;height:100px;"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Nội dung</td>
                                        <td><textarea rows="5" cols="30" name="Content" style="resize: none;width:500px;height:300px;"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Người viết</td>
                                        <td>
                                            <select name="employee">
                                                <?php
                                                $sql_employee = "SELECT * FROM tblaccount WHERE AccessPermissions = '2'";
                                                $query_employee = mysqli_query($mysqli, $sql_employee);
                                                while ($row_employee = mysqli_fetch_array($query_employee)) {
                                                ?>
                                                    <option value="<?php echo $row_employee['AccountID'] ?>"><?php echo $row_employee['AccountName'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button type="submit" name="thembaiviet" class="btn btn-outline-dark btn-icon-text">
                                                Thêm
                                                <i class="ti-file btn-icon-append"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>