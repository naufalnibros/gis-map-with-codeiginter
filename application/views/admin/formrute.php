<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> Form Rute</h3>
              </div>
              <div class="panel-body">
                  <form action="#">
                      <div class="form-group">
                        <label for="namarute">Nama Rute</label>
                        <input type="text" class="form-control" id="namarute" placeholder="">
                        <input type="hidden" name="id_rute" id="id_rute" value="">
                      </div>
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
                      </div>
                      <div class="form-group">
                        <button type="button" name="simpanrute" id="simpanrute" class="btn btn-primary">Simpan</button>
                        <button type="button" name="resetrute"  id="resetrute" class="btn btn-warning">Reset</button>
                        <button type="button" name="updaterute" id="updaterute" class="btn btn-info" disabled="true">Update</button>
                      </div>
                  </form>
              </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Daftar Rute</h3>
              </div>
              <div class="panel-body">
                  <table class="table table-bordered">
                      <th>No</th>
                      <th>Nama Rute</th>
                      <th>Keterangan</th>
                      <th></th>
                      <tbody id="daftarrute">
                          <?php
                          $no = 1;
                          foreach ($itemrute->result() as $rute) {
                              ?>
                              <tr>
                                  <td><?php echo $no;?></td>
                                  <td><?php echo $rute->namarute;?></td>
                                  <td><?php echo $rute>keterangan;?></td>
                                  <td>
                                      <button type="button" class="btn btn-sm btn-info" data-idrute="<?php echo $rute->id_rute;?>" name="editrute<?php echo $rute->id_rute;?>" id="editrute"><span class="glyphicon glyphicon-edit"></span></button>
                                      <button type="button" class="btn btn-sm btn-danger" data-idrute="<?php echo $rute->id_rute;?>" name="deleterute<?php echo $rute->id_rute;?>" id="deleterute"><span class="glyphicon glyphicon-trash"></span></button>
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
    $(document).on('click','#simpanrute',simpanrute)
    .on('click','#resetrute',resetrute)
    .on('click','#updaterute',updaterute)
    .on('click','#editrute',editrute)
    .on('click','#deleterute',deleterute);
    function simpanrute() {//simpan rute
        var datarute = {'namarute':$('#namarute').val(),
        'keterangan':$('#keterangan').val()};console.log(datarute);
        $.ajax({
            url : '<?php echo site_url("admin/rute/create");?>',
            data : datarute,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    $('#daftarrute').load('<?php echo current_url()." #daftarrute > *";?>');
                    resetrute();//form langsung dikosongkan pas selesai input data
                }else{
                    alert(data.msg);
                }
            },
            error : function(x,t,m){
                alert(x.responseText);
            }
        })
    }
    function resetrute() {//reset form rute
        $('#namarute').val('');
        $('#rute').val('');
        $('#id_rute').val('');
        $('#simpanrute').attr('disabled',false);
        $('#updaterute').attr('disabled',true);
    }
</script>