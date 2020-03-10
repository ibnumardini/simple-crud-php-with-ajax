<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crud Ajax</title>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <h1 class="text-center" style="margin:50px 0;">Simple Crud PHP Ajax</h1>
    <div class="container">
      <div class="card mt-5">
        <div class="card-body">
          <h5 class="card-title">Data Buku</h5>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Tahun Terbit</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody id="barisData"></tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card my-5">
            <div class="card-body">
              <h5 class="card-title">Tambah Buku</h5>
              <table class="table">
                  <input class="form-control" type="hidden" name="id" />
                <tr>
                  <td>Judul Buku</td>
                  <td><input class="form-control" type="text" name="judulBuku" /></td>
                </tr>
                <tr>
                  <td>Pengarang</td>
                  <td><input class="form-control" type="text" name="pengarang" /></td>
                </tr>
                <tr>
                  <td>Tahun Terbit</td>
                  <td><input class="form-control" type="text" name="tahunTerbit" /></td>
                </tr>
                <tr>
                <td></td>
                  <td><button id="btnAdd" onclick="tambahData()" class="btn btn-primary">Save</button>
                  <button id="btnUpdate" onclick="updateData()" class="btn btn-primary">Update</button></td>
                </tr>
              </table>
              <p id="pesan"></p>
            </div>
          </div>
        </div>
        <div class="col-md-6"></div>
      </div>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>

    <script>
      onload();

      function updateData(){
        let id = $("[name='id']").val();
        let judulBuku = $("[name='judulBuku']").val();
        let pengarang = $("[name='pengarang']").val();
        let tahunTerbit = $("[name='tahunTerbit']").val();

        $.ajax({
          type: "POST",
          data: "id=" + id + "&judulBuku=" + judulBuku + "&pengarang=" + pengarang + "&tahunTerbit=" + tahunTerbit,
          url: "updateData.php",
          success: function(result) {
            let objResult = JSON.parse(result);
            $("#pesan").html(objResult.pesan);
            onload();
          }
        });
      }

      function tambahData() {
        let judulBuku = $("[name='judulBuku']").val();
        let pengarang = $("[name='pengarang']").val();
        let tahunTerbit = $("[name='tahunTerbit']").val();

        $.ajax({
          type: "POST",
          data: "judulBuku=" + judulBuku + "&pengarang=" + pengarang + "&tahunTerbit=" + tahunTerbit,
          url: "add.php",
          success: function(result) {
            let objResult = JSON.parse(result);
            $("#pesan").html(objResult.pesan);
            onload();
          }
        });
      }

      function pilihData(id_buku){
        let id = id_buku;
        $.ajax({
          type : "POST",
          data : "id="+id,
          url : "ambilData.php",
          success : function(result){
            let objResult = JSON.parse(result);
            $("[name='id']").val(objResult.id);
            $("[name='judulBuku']").val(objResult.judul_buku);
            $("[name='pengarang']").val(objResult.pengarang);
            $("[name='tahunTerbit']").val(objResult.tahun_terbit);
            $("#btnAdd").hide();
            $("#btnUpdate").show();
          }
        })
        
      }

      function onload(){
        let dataHandler = $("#barisData");
        dataHandler.html("");
          $.ajax({
          type: "GET",
          data: "",
          url: "http://crud-ajax.test/read.php",
          success: function(result) {
            let obj = JSON.parse(result);
            $.each(obj, function(key, val) {
              let newRow = $("<tr>");
              newRow.html( "<td>" + val.id + "<td>" + val.judul_buku + "<td>" + val.pengarang + "<td>" + val.tahun_terbit + "<td><button onclick='pilihData("+ val.id +")' class='btn btn-primary'>Select</button>" );
              dataHandler.append(newRow);
            $("#btnUpdate").hide();
            });
          }
        });
      }
    </script>
  </body>
</html>
