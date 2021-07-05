<script>
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".add").click(function(){
            var id_perawat = $("[name='id_perawat']").val();
            var url = "<?php echo site_url('perawat/formjabatan');?>/"+id_perawat;
            window.location = url;
            // alert(url);
            return false; 
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            var id_perawat = $("[name='id_perawat']").val();
            var url = "<?php echo site_url('perawat/formjabatan');?>/"+id_perawat + "/" + id;
            window.location = url;
            // alert(url);
            return false; 
        });
        $(".hapus").click(function(){
           $(".modal").show();
       });
       $(".tidak").click(function(){
           $(".modal").hide();
       });
       $(".ya").click(function(){
            var id= $(".bg-gray").attr("href");
            var id_perawat = $("[name='id_perawat']").val();
            window.location="<?php echo site_url('perawat/hapusjabatan');?>/"+id + "/" + id_perawat;
           return false;
       });
    });
</script>

    <div class="col-xs-12">
        <?php
            if($this->session->flashdata('message')){

               $pesan=explode('-', $this->session->flashdata('message'));
                echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <b>".$pesan[1]."</b>
                </div>";
            }

        ?>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="form-horizontal">
            <div class="box-body">
               <div class="form-group">
                <label class="col-md-2 control-label">Nama Perawat</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name='nama_perawat' readonly value="<?php echo $p->nama_perawat;?>"/>
                </div>
                <label class="col-md-2 control-label">NIP</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name='id_perawat' readonly value="<?php echo $id_perawat;?>"/>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover " id="myTable" >
                    <thead>
                        <tr class="bg-navy">
                            <th width="10" class='text-center'>No</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">TMT</th>
                            <th class="text-center">No KEP/SKEP </th>
                            <th class="text-center">TGL SKEP </th>
                            <th class="text-center">Jenis </th>
                            <th class="text-center">Dokumen </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=0;
                        foreach ($q->result() as $data) {
                            $i++;
                            echo "<tr id=data href='".$data->id."'>
                            <td>".$i."</td>                                      
                            <td>".$data->jabatan."</td>
                            <td>".($data->tmt == "" || $data->tmt == "0000-00-00"  ? "" : date("d-m-Y", strtotime($data->tmt)))."</td>
                            <td>".$data->no_kep."</td>
                            <td>".($data->tgl_skep == "" || $data->tgl_skep == "0000-00-00"  ? "" : date("d-m-Y", strtotime($data->tgl_skep)))."</td>
                            <td>".$data->jenis."</td>
                            <td><a href='".base_url()."file_pdf/suket/".$data->filepdf."' target='blank'>".$data->filepdf."</a></td>
                            </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
          <div class="box-footer with-border">
                <div class="pull-right">
                    <div class="btn-group">   
                        <button class="add btn btn-primary  dim" type="button"><i class="fa fa-plus"></i></button>
                        <button class="edit btn btn-warning  dim" type="button"><i class="fa fa-edit"></i></button>
                        <button class="hapus btn btn-danger  dim" type="button"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <div class='modal'>
   <div class='modal-dialog'>
       <div class='modal-content'>
           <div class="modal-header bg-orange"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;NOTIFICATION</h4></div>
           <div class='modal-body'>Yakin akan menghapus data ?</div>
           <div class='modal-footer'>
               <button class="ya btn btn-sm btn-danger">Ya</button>
                <button class="tidak btn btn-sm btn-success">Tidak</button>
           </div>
       </div>
   </div>
</div>