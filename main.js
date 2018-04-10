// list fieldset id
var fieldsetId = ['trang-chu','qly-nhan-vien','qly-don-vi','qly-chuc-vu','them-nvien','them-hinhanh-nvien','chinh-sua-nvien','chinh-sua-hinhanh-nvien'];

// Hàm hiển thị vùng nội dung
function showPage(id, prop, value) {
  for (i=0; i<fieldsetId.length; i++) {
    document.getElementById(fieldsetId[i]).style.display = 'none';
  }
  // show the table by id
  document.getElementById(id).style.display = 'block';
  // storage session page
  sessionStorage.setItem('page', id);
  // parameter transmission for property
  for (i=0; i<prop.length; i++) {
    if (value[i] === 'Nam') {
      document.getElementById('nam').checked = true;
      document.getElementById('nu').checked = false;
    } else if (value[i] === 'Nu') {
      document.getElementById('nam').checked = false;
      document.getElementById('nu').checked = true;
    } else document.getElementById(prop[i]).value = value[i];
  }
}

// Hàm hiển thị vùng nội dung được ghi nhớ trước đó trong phiên làm việc
function showFieldsetSessions() {
  // hide the table
  for (i=0; i<fieldsetId.length; i++) {
    document.getElementById(fieldsetId[i]).style.display = 'none';
  }
  // show the table by id
  if (sessionStorage.getItem('page') === null) {
    document.getElementById('trang-chu').style.display = 'block';
  } else document.getElementById(sessionStorage.getItem('page')).style.display = 'block';
}

// Hàm checkall cho checkbox
function toggle(source,name) {
  checkboxes = document.getElementsByName(name);
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}

// Hàm truyền giá trị vào các text field
function showHideElement(primary, second, value) {
    var x = document.getElementById(primary);
    if (x.style.display === "none") {
        x.style.display = "block";
        for (i=0; i<second.length; i++) {
          document.getElementById(second[i]).value = value[i];
        }
    } else {
        x.style.display = "none";
    }
}

// Hàm gọi menu-bar ở các thiết bị có kích thước khung hình nhỏ hơn mặc đinh - tính năng responsive
function callMenuBar() {
    var x = document.getElementById("menu-bar");
    if (x.className === "menu-bar") {
        x.className += " responsive";
    } else {
        x.className = "menu-bar";
    }
}

// Hàm đóng menu-bar khi ấn vào bất kỳ vị trí nào trong page
function closeMenuBar() {
    document.getElementById("menu-bar").className = "menu-bar";
}
