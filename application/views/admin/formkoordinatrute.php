<!--script google map-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script>
$(document).on('click','#clearmap',clearmap)
.on('click','#simpandaftarkoordinatrute',simpandaftarkoordinatrute)
.on('click','#hapuspolylinerute',hapuspolylinerute)
.on('click','#viewpolylinerute',viewpolylinerute);
    var poly;
    var map;
 
    function initialize() {
        var mapOptions = {
        zoom: 14,
        // Center di kantor kecamatan jekulo
        center: new google.maps.LatLng(-6.806428778495534, 110.84213197231293)
        };
 
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
 
        var polyOptions = {
        strokeColor: '#000000',
        strokeOpacity: 1.0,
        strokeWeight: 3
        };
        poly = new google.maps.Polyline(polyOptions);
        poly.setMap(map);
 
        // Add a listener for the click event
        google.maps.event.addListener(map, 'rightclick', addLatLng);
        google.maps.event.addListener(map, "rightclick", function(event) {
          var lat = event.latLng.lat();
          var lng = event.latLng.lng();
          var datakoordinat = {'latitude':lat, 'longitude':lng};
          $.ajax({
              url : '<?php echo site_url("admin/tambahkoordinatrute") ?>',
              data : datakoordinat,
              dataType : 'json',
              type : 'POST',
              success : function(data,status){
                  if (data.status!='error') {
                      $('#daftarkoordinat').load('<?php echo current_url()."/ #daftarkoordinat > *" ?>');
                  }else{
                      alert(data.msg);
                  }
              }
          })
          //$('#latitude').val(lat);
          //$('#longitude').val(lng);
          //alert(lat +" dan "+lng);
        });
    }
 
    /**
     * Handles click events on a map, and adds a new point to the Polyline.
     * @param {google.maps.MouseEvent} event
     */
    function addLatLng(event) {
 
        var path = poly.getPath();
 
        // Because path is an MVCArray, we can simply append a new coordinate
        // and it will automatically appear.
        path.push(event.latLng);
 
        // Add a new marker at the new plotted point on the polyline.
        var marker = new google.maps.Marker({
        position: event.latLng,
        title: '#' + path.getLength(),
        map: map
        });
    }
    function clearmap(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo site_url("admin/hapusdaftarkoordinatrute") ?>',
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                      $('#daftarkoordinat').load('<?php echo current_url()."/ #daftarkoordinat > *" ?>');
                  }else{
                      alert(data.msg);
                  }
            }
        })
            var mapOptions = {
            zoom: 14,
            // Center the map on Chicago, USA.
            center: new google.maps.LatLng(-6.805701340471898, 110.92556476593018)
          };
 
          map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
 
          var polyOptions = {
            strokeColor: '#000000',
            strokeOpacity: 1.0,
            strokeWeight: 3
          };
          poly = new google.maps.Polyline(polyOptions);
          poly.setMap(null);
          initialize();
    }
    function simpandaftarkoordinatrute(e){
        e.preventDefault();
        var datakoordinat = {'id_rute':$('#id_rute').val()};
        console.log(datakoordinat);
        $.ajax({
            url : '<?php echo site_url("admin/simpandaftarkoordinatrute") ?>',
            dataType : 'json',
            data : datakoordinat,
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    $('#daftarkoordinat').load('<?php echo current_url()."/ #daftarkoordinat > *" ?>');
                    $('#daftarkoordinatrute').load('<?php echo current_url()."/ #daftarkoordinatrute > *" ?>');
                    alert(data.msg);
                    clearmap(e);
                }else{
                    alert(data.msg);
                }
            }
        })
    }
    function hapuspolylinerute(e){
        e.preventDefault();
        var datakoordinat = {'id_rute':$(this).data('iddatarute')};
        console.log(datakoordinat);
        $.ajax({
            url : '<?php echo site_url("admin/hapuspolylinerute") ?>',
            data : datakoordinat,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    alert(data.msg);
                    $('#daftarkoordinatrute').load('<?php echo current_url()."/ #daftarkoordinatrute > *" ?>');
                    clearmap(e);
                }else{
                    alert(data.msg);
                }
            }
        })
    }
    function viewpolylinerute(e){
        e.preventDefault();
        var datakoordinat = {'id_rute':$(this).data('iddatarute')};
        console.log(datakoordinat);
        $.ajax({
            url : '<?php echo site_url("admin/viewpolylinerute") ?>',
            data : datakoordinat,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    clearmap(e);
                    //load polyline
                    $.each(data.msg,function(m,n){
                        var lat = n["latitude"];
                        var lng = n["longitude"];
                        console.log(m,n);
                        $.each(data.datarute,function(k,v){
                            createpolylinedatarute(data.msg,v['namarute'],lat,lng);
                        })
                        return false;
                    })
                    //end load polyline
                }else{
                    alert(data.msg);
                }
            }
        })
    }
    function createpolylinedatarute(datakoordinat,nama,lat,lon){
        var mapOptions = {
        zoom: 14,
        //get center latlong
        center: new google.maps.LatLng(lat, lon),
        //mapTypeId: google.maps.MapTypeId.TERRAIN
        //end get center latlong
        };
 
        var map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);
 
        var listkoordinat = [];
        $.each(datakoordinat,function(k,v){
          listkoordinat.push(new google.maps.LatLng(parseFloat(v['latitude']), parseFloat(v['longitude'])));
        })
        var pathKoordinat = new google.maps.Polyline({
        path: listkoordinat,
        geodesic: true,
        strokeOpacity: 1.0,
        });
 
        pathKoordinat.setMap(map);
 
    }
 
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<!--end script google map-->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-globe"></span> Peta</div>
                <div class="panel-body" style="height:300px;" id="map-canvas">
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> Daftar Koordinat</div>
                <div class="panel-body" style="min-height:300px;">
                    <table class="table">
                        <th>No</th>
                        <th>Lat</th>
                        <th>Long</th>
                        <th></th>
                        <tbody id="daftarkoordinat">
                            <?php if($this->cart->contents()!=null){
                                foreach ($this->cart->contents() as $koordinat) {
                                    if($koordinat['jenis']=='rute'){
                                        echo '<tr><td>'.$koordinat["id"].'</td><td>'.$koordinat["latitude"].'</td><td>'.$koordinat["longitude"].'</td></tr>';
                                    }
                                }
                            } ?>
                        </tbody>
                    </table>
                    <form action="#">
                        <div class="form-group">
                            <label for="datarute">Data Rute</label>
                            <?php if ($itemdatarute->num_rows()!=null) {
                                echo '<select name="id_rute" id="id_rute" class="form-control">';
                                foreach ($itemdatarute->result() as $datarute) {
                                    echo "<option value='".$datarute->id_rute."'>".$datarute->namarute."</option>";
                                }
                                echo '</select>';
                            }else{
                                echo anchor('admin/rute', '<span class="glyphicon glyphicon-plus"></span> Tambah Data rute', 'class="btn btn-info form-control"');
                            } ?>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-sm" id="simpandaftarkoordinatrute"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                            <button class="btn btn-info btn-sm" id="clearmap"><span class="glyphicon glyphicon-globe"></span> ClearMap</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-th-list"></span> Daftar Koordinat Polyline Data rute</div>
                <div class="panel-body" style="min-height:400px">
                    <table class="table">
                        <th>No</th>
                        <th>Data Rute</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th></th>
                        <tbody id="daftarkoordinatrute">
                            <?php
                            if ($itemkoordinatrute->num_rows()!=null) {
                                $no = 1;
                                foreach ($itemdatarute->result() as $rute) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $no++;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $rute->namarute;
                                    echo "</td>";
                                    echo "<td>";
                                    foreach ($itemkoordinatrute->result() as $koordinat) {
                                        if ($koordinat->id_rute==$rute->id_rute) {
                                            echo $koordinat->latitude."</br>";
                                        }
                                    }
                                    echo "</td>";
                                    echo "<td>";
                                    foreach ($itemkoordinatrute->result() as $koordinat) {
                                        if ($koordinat->id_rute==$rute->id_rute) {
                                            echo $koordinat->longitude."</br>";
                                        }
                                    }
                                    echo "</td>";
                                    echo "<td>";
                                    echo '<button class="btn-info btn btn-sm" id="viewpolylinerute" data-iddatarute="'.$rute->id_rute.'"><span class="glyphicon-globe glyphicon"></span> View Polyline</button> ';
                                    echo '<button class="btn-danger btn btn-sm" id="hapuspolylinerute" data-iddatarute="'.$rute->id_rute.'"><span class="glyphicon-remove glyphicon"></span></button>';
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                             ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>