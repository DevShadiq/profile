        // add row
        $("#addRow").click(function () {
            var html = '';
            html += '<div class="form-row" id="inputFormRow">';
            html += '<div class="form-group col-md-2">';
            html += '<select class="form-control" name="pro_name[]" id="pro-box2"><option value="">Select Product</option><?php $pro = "select * from product order by pro_id asc";$pro_result = $conn->query($pro);while($pro_row = $pro_result->fetch_assoc()){ ?><option value="<?php echo $pro_row['pro_id'];?>"><?php echo $pro_row['pro_name'];?></option><?php } ?>  </select>';
            html += '</div>';
			html += '<div class="form-group col-md-2">';
            html += '<select class="form-control sup-box" name="sup_name[]" id="sup_name"><option value="">Select Supplier</option><?php $sup = "select * from supplier where sup_status = 'active' order by sup_id asc";$sup_result = $conn->query($sup);while($sup_row = $sup_result->fetch_assoc()){ ?><option value="<?php echo $sup_row['sup_id'];?>"><?php echo $sup_row['sup_name'];?></option><?php } ?></select>';
            html += '</div>';
			
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });