<?php
// Initialize $id to 1
$id_uekf = 1;
$action = "update";
// Check if $append_id is not empty
if (!empty($append_id_uekf)) {
  // If $append_id is not empty, assign its value to $id
  $id_uekf = $append_id_uekf;
}
?>

<!-- Start of a new table row -->
<tr class="qe_sub_table_tr_uekf">
  <td class="qe_sub_table_count_uekf">1.</td>

  <td colspan="2">
    <select type="text" class="form-control form-control-sm custom-select document_name_uekf"
      name="document_name_uekf[]" id="document_name_uekf_<?= $id_uekf ?>">
      <option value="">Select Document</option>
      <?php foreach ($document_data as $item) {

        ?>
        <option value="<?php echo $item->document_name ?>">
          <?php echo $item->document_name ?>

        </option>
      <?php } ?>
    </select>
  </td>

  <td>
    <div class="custom-file" style="padding:0px">
      <input type="hidden" name="file_name[]" value="" />
      <input type="file" name="file_uekf[]" class="custom-file-input document_file_uekf"
        id="document_file_uekf_<?= $id_uekf ?>" style="margin:opx;">
      <label class="custom-file-label form-control-sm" for="files" style="margin:opx;">choose file</label>
    </div>
  </td>

  <!-- Table cell for the file input -->


  <!-- Table cell for the remove button (this will be updated dynamically) -->
  <td class="qe_sub_table_remove_td_uekf"></td>
</tr>

<script>
  $("#document_file_uekf_<?= $id_uekf ?>").on('change', function () {
    $("#document_name_uekf_<?= $id_uekf ?>").attr('required', 'required');
  });






</script>