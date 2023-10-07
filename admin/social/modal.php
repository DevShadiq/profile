<!-- delete city modal -->
<div class="modal fade" id="socail<?php echo $iconlist_row['social_slug'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header delete">
        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete User
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>Are you sure ? You want to delete this User data ?</h3>
      </div>
      <div class="modal-footer delete-modal">
        <a href="delete.php?deleteid=<?php echo $iconlist_row['social_slug']; ?>" class="btn btn-danger">Yes</a>
      </div>
    </div>
  </div>
</div>