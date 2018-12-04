<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> Form Kapal</h3>
              </div>
              <div class="panel-body">
                  <form action="#">
                      <div class="form-group">
                        <label for="namakapal">Nama Kapal</label>
                        <input type="text" class="form-control" id="namakapal" placeholder="">
                        <input type="hidden" name="id_kapal" id="id_kapal" value="">
                      </div>
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
                      </div>
                      <div class="form-group">
                        <button type="button" name="simpankapal" id="simpankapal" class="btn btn-primary">Simpan</button>
                        <button type="button" name="resetkapal"  id="resetkapal" class="btn btn-warning">Reset</button>
                        <button type="button" name="updatekapal" id="updatekapal" class="btn btn-info" disabled="true">Update</button>
                      </div>
                  </form>
              </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Daftar Kapal</h3>
              </div>
              <div class="panel-body">
                  <table class="table table-bordered">
                      <th>No</th>
                      <th>Nama Kapal</th>
                      <th>Keterangan</th>
                      <th></th>
                      <tbody id="daftarkapal">
                          <?php
                          $no = 1;
                          foreach ($itemkapal->result() as $kapal) {
                              ?>
                              <tr>
                                  <td><?php echo $no;?></td>
                                  <td><?php echo $kapal->namakapal;?></td>
                                  <td><?php echo $kapal->keterangan;?></td>
                                  <td>
                                      <button type="button" class="btn btn-sm btn-info" data-idkapal="<?php echo $kapal->id_kapal;?>" name="editkapal<?php echo $kapal->id_kapal;?>" id="editkapal"><span class="glyphicon glyphicon-edit"></span></button>
                                      <button type="button" class="btn btn-sm btn-danger" data-idkapal="<?php echo $kapal->id_kapal;?>" name="deletekapal<?php echo $kapal->id_kapal;?>" id="deletekapal"><span class="glyphicon glyphicon-trash"></span></button>
                                  </td>
                              </tr>
                              <?php
                              $no++;
                          }
                           ?>
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click','#simpankapal',simpankapal)
    .on('click','#resetkapal',resetkapal)
    .on('click','#updatekapal',updatekapal)
    .on('click','#editkapal',editkapal)
    .on('click','#deletekapal',deletekapal);
    function simpankapal() {//simpan kapal
        var datakapal = {'namakapal':$('#namakapal').val(),
        'keterangan':$('#keterangan').val()};console.log(datakapal);
        $.ajax({
            url : '<?php echo site_url("admin/kapal/create");?>',
            data : datakapal,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    $('#daftarkapal').load('<?php echo current_url()." #daftarkapal > *";?>');
                    resetkapal();//form langsung dikosongkan pas selesai input data
                }else{
                    alert(data.msg);
                }
            },
            error : function(x,t,m){
                alert(x.responseText);
            }
        })
    }
    function resetkapal() {//reset form kapal
        $('#namakapal').val('');
        $('#keterangan').val('');
        $('#id_kapal').val('');
        $('#simpankapal').attr('disabled',false);
        $('#updatekapal').attr('disabled',true);
    }

    function editkapal() {//edit kapal
        var id = $(this).data('idkapal');
        var datakapal = {'id_kapal':id};console.log(datakapal);
        $('input[name=editkapal'+id+']').attr('disabled',true);//biar ga di klik dua kali, maka di disabled
        $.ajax({
            url : '<?php echo site_url("admin/kapal/edit");?>',
            data : datakapal,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    $('input[name=editkapal'+id+']').attr('disabled',false);//disabled di set false, karena transaksi berhasil
                    $('#simpankapal').attr('disabled',true);
                    $('#updatekapal').attr('disabled',false);
                    $.each(data.msg,function(k,v){
                        $('#id_kapal').val(v['id_kapal']);
                        $('#namakapal').val(v['namakapal']);
                        $('#keterangan').val(v['keterangan']);
                    })
                }else{
                    alert(data.msg);
                    $('input[name=editkapal'+id+']').attr('disabled',false);//disabled di set false, karena transaksi berhasil
                }
            },
            error : function(x,t,m){
                alert(x.responseText);
                $('input[name=editkapal'+id+']').attr('disabled',false);//disabled di set false, karena transaksi berhasil
            }
        })
    }

    function updatekapal() {//update kapal
        var datakapal = {'namakapal':$('#namakapal').val(),
        'keterangan':$('#keterangan').val(),
        'id_kapal':$('#id_kapal').val()};console.log(datakapal);
        $.ajax({
            url : '<?php echo site_url("admin/kapal/update");?>',
            data : datakapal,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    $('#daftarkapal').load('<?php echo current_url()." #daftarkapal > *";?>');
                    resetkapal();//form langsung dikosongkan pas selesai input data
                }else{
                    alert(data.msg);
                }
            },
            error : function(x,t,m){
                alert(x.responseText);
            }
        })
    }

    function deletekapal() {//delete kapal
        if (confirm("Anda yakin akan menghapus data kapal ini?")) {
            var id = $(this).data('idkapal');
            var datakapal = {'id_kapal':id};console.log(datakapal);
            $.ajax({
                url : '<?php echo site_url("admin/kapal/delete");?>',
                data : datakapal,
                dataType : 'json',
                type : 'POST',
                success : function(data,status){
                    if (data.status!='error') {
                        $('#daftarkapal').load('<?php echo current_url()." #daftarkapal > *";?>');
                        resetkapal();//form langsung dikosongkan pas selesai input data
                    }else{
                        alert(data.msg);
                    }
                },
                error : function(x,t,m){
                    alert(x.responseText);
                }
            })
        }
    }
</script>