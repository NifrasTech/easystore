<div class="modal image-modal fade" id="modal-image">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content pt-0" id="image-form" method="POST" enctype="multipart/form-data">
      <div class="modal-header mb-1"> 
        <h5 class="modal-title">Product Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
      </div>
      <div class="modal-body flex-grow-1">
        @CSRF
        <input type="hidden" name="id" id="txtID">

        <div class="form-group" id="image-container">
        <input type="file" id="input-file-now" name="image" class="dropify p-2"/>
        </div>        

        <button type="submit" class="btn btn-primary mt-1 me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal">Cancel</button>

      </div>
    </form>
  </div>
</div>