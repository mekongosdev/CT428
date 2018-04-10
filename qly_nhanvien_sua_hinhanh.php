<fieldset id="chinh-sua-hinhanh-nvien">
  <legend><h2>CHỈNH SỬA HÌNH ẢNH NHÂN VIÊN</h2></legend>
  <button class="btn" onclick="showPage('qly-nhan-vien',[],[]); return false;">Quay lại</button>
  <hr>
  <form method="post" enctype="multipart/form-data">
    <p>Thay đổi hình ảnh cho nhân viên:
      <input type="hidden" name="manv" id="manv_ha" value="" />
      <input type="text" id="hoten_ha" value="" disabled />
    </p>
    <input type="file" name="img_nv" style="margin-bottom: 10px;" /><br>
    <button type="submit" class="btn-primary" name="upload_img_nv">Cập nhật</button>
  </form>
</fieldset>
