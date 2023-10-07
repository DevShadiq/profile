<div class="sidenav-backdrop backdrop"></div>

<footer class="page-footer">
    <div class="font-13">2023 © <b>Sadiq</b> - All rights reserved.</div>
    <a class="px-4" href="https://www.facebook.com/saeemjp/" target="_blank">Sadiq Rahman</a>
    <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
</footer>
</div>
<!-- END PAGA BACKDROPS-->
<!-- CORE PLUGINS-->
<script src="<?php echo $path; ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo $path; ?>/assets/js/popper.min.js"></script>
<script src="<?php echo $path; ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo $path; ?>/assets/js/parslay.min.js"></script>
<script src="<?php echo $path; ?>/assets/js/metisMenu.min.js"></script>
<script src="<?php echo $path; ?>/assets/js/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="https://cdn.tiny.cloud/1/tbq4e7zldy536qurlx4ribcgljkfd9k1bd4gw1gxcfzfpnes/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="<?php echo $path; ?>/assets/js/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo $path; ?>/assets/js/select2.min.js" type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src="<?php echo $path; ?>/assets/js/app.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#example-table').DataTable({
            pageLength: 10,
            //"ajax": './assets/demo/data/table_data.json',
            /*"columns": [
                { "data": "name" },
                { "data": "office" },
                { "data": "extn" },
                { "data": "start_date" },
                { "data": "salary" }
            ]*/
        });
    })
</script>
<script type="text/javascript">
    $(function() {
        $('.example-table2').DataTable({
            pageLength: 10,
        });
    })
</script>

<script>
    tinymce.init({
        forced_root_block: "",
        selector: '#mytextarea'
    });
</script>



<script type="text/javascript">
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>

<script type="text/javascript">
    function printContent2(el) {
        var restorepage = document.body.innerHTML;
        var printcontent2 = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent2;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<script type="text/javascript">
    function printContent3(el) {
        var restorepage = document.body.innerHTML;
        var printcontent3 = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent3;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<script>
    function getcustomer(val) {
        $.ajax({
            type: "POST",
            url: "customer.php",
            data: 'cusid=' + val,
            success: function(data) {
                $(".customerdata").html(data);

            }
        });

    }
</script>

<script type="text/javascript">
    $(function() {
        $(".showdiv").change(function() {
            if ($(this).val() == "5") {
                $("#coursediv").show();
            } else {
                $("#coursediv").hide();
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

    });
</script>
<script type="text/javascript">
    $('.select2').select2();
    // add row
    $("#addRow").click(function() {
        var html = '';
        html += '<div class="form-row" id="inputFormRow">';
        html += '<div class="form-group stock-input">';
        html += '<select class="form-control select2" name="pro_name[]"><option value="">Product</option><?php $pro = "select * from product order by pro_id asc";
                                                                                                            $pro_result = $conn->query($pro);
                                                                                                            while ($pro_row = $pro_result->fetch_assoc()) {
                                                                                                                $p_id = $pro_row['pro_id'];
                                                                                                                $p_sql = "SELECT SUM(stc_pro_quantity) as p_qnt FROM stockin where stc_pro_name = '$p_id'";
                                                                                                                $p_result = $conn->query($p_sql);
                                                                                                                $p_row = $p_result->fetch_assoc();
                                                                                                                $p_count = $p_row['p_qnt'];
                                                                                                                $p_sql2 = "SELECT SUM(sto_pro_qnt) as p_qnt2 FROM stockout where sto_pro_id = '$p_id'";
                                                                                                                $p_result2 = $conn->query($p_sql2);
                                                                                                                $p_row2 = $p_result2->fetch_assoc();
                                                                                                                $p_count2 = $p_row2['p_qnt2'];
                                                                                                                $count = $p_count - $p_count2; ?><option value="<?php echo $pro_row['pro_id']; ?>"><?php echo $pro_row['pro_name']; ?><?php echo '&nbsp;(' . $count . ')'; ?></option><?php } ?> </select>';
        html += '</div>';
        html += '<div class="form-group stock-input">';
        html += '<select class="form-control select2" name="sup_name[]"><option value="">Supplier</option><?php $sup = "select * from supplier where sup_status = 'active' order by sup_id asc";
                                                                                                            $sup_result = $conn->query($sup);
                                                                                                            while ($sup_row = $sup_result->fetch_assoc()) { ?><option value="<?php echo $sup_row['sup_id']; ?>"><?php echo $sup_row['sup_name']; ?></option><?php } ?></select>';
        html += '</div>';
        html += '<div class="form-group stock-input">';
        html += '<select class="form-control select2" name="bra_name[]"><option value="">Brand</option><?php $bra = "select * from brand where bra_status = 'active' order by bra_id asc";
                                                                                                        $bra_result = $conn->query($bra);
                                                                                                        while ($bra_row = $bra_result->fetch_assoc()) { ?><option value="<?php echo $bra_row['bra_name']; ?>"><?php echo $bra_row['bra_name']; ?></option><?php } ?></select>';
        html += '</div>';
        html += '<div class="form-group stock-input">';
        html += '<input type="text" class="form-control" placeholder="Model" name="pro_model[]" autocomplete>';
        html += '</div>';
        html += '<div class="form-group stock-input">';
        html += '<input type="number" class="form-control" name="pro_quantity[]" placeholder="Qnt" autocomplete>';
        html += '</div>';
        html += '<div class="form-group stock-input2">';
        html += '<input type="date" class="form-control" placeholder="Date" name="pro_date[]" style="padding: .4rem .5rem;" autocomplete>';
        html += '</div>';
        html += '<div class="form-group stock-input">';
        html += '<select class="form-control" name="course_name[]"><option value="">Course</option><?php $cou = "select * from course order by cou_id asc";
                                                                                                    $cou_result = $conn->query($cou);
                                                                                                    while ($cou_row = $cou_result->fetch_assoc()) { ?><option value="<?php echo $cou_row['cou_name']; ?>"><?php echo $cou_row['cou_name']; ?></option><?php } ?></select>';
        html += '</div>';
        html += '<div class="form-group stock-input">';
        html += '<input type="text" class="form-control" id="course_batch" placeholder="Batch" name="course_batch[]" autocomplete>';
        html += '</div>';
        html += '<div style="padding-top:5px;width:3%;">';
        html += '<button class="removeRow" type="button" id="removeRow" style="color:#ffffff;font-weight:bold;background: linear-gradient(to right, #ff416c, #ff4b2b);padding:1px 5px;border-radius:4px;border:none;"><i class="fa fa-trash" aria-hidden="true"></i></button>';
        html += '</div>';

        $('#newRow').append(html);
        $('.select2').select2();
    });

    // remove row
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
    });
</script>



</body>

</html>