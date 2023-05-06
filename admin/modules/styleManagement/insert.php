<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Thêm kiểu dáng sản phẩm</h4>
            <div class="table-responsive pt-3">
              <table class="table table-light">
                <form method="POST" action="modules/styleManagement/handle.php">
                  <tr>
                    <td>Tên kiểu dáng</td>
                    <td><input type="text" name="StyleName"></td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <button type="submit" name="themstyle" class="btn btn-outline-dark btn-icon-text">
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