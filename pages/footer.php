<!-- Footer -->
<footer class="footer">
  <div class="row align-items-center justify-content-xl-between">
    <div class="col-xl-4">
      <div class="copyright text-center text-xl-left text-muted">
        &copy; 2019 <a class="font-weight-bold ml-1" target="_blank" href="../about_us/stock-path.html">Stock Path</a>
      </div>
    </div>
    <div class="col-xl-8">
      <ul class="nav nav-footer justify-content-center justify-content-xl-end">
        <li class="nav-item">
          <a href="#" class="nav-link" data-toggle="modal" data-target="#generate">Video</a>
        </li>
        <li class="nav-item">
          <a href='<?php echo($help); ?>' target="_blank" class="nav-link" ><i class="fa fa-question-circle mr-1"></i>Help</a>
        </li>
        <li class="nav-item">
          <a href="../about_us/aboout-us.html" class="nav-link" target="_blank">About Us</a>

        </li>
      </ul>
    </div>

      <div class="modal fade" id="generate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> How to use the form</h5>
            </div>
            <div class="modal-body">
              <video width="450" controls>
                  <source src="../vid.mp4" type="video/mp4">
             
                  Your browser does not support HTML5 video.
                </video>

            </div>
            <div class="modal-footer">  
            
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>






  </div>
</footer>