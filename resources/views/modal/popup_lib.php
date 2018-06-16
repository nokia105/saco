       
       @section('js')

                      
    
      <!-- Select2 -->

 
    <script type="text/javascript">
    
    function showAjaxModal(url)
    {
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"></div>');
        
        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'false'});
    
        
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
            
                jQuery('#modal_ajax .modal-body').html(response);
                closeOnEscape: false;
            
            dialogClass: "noclose";
            }
        });
    }
</script>

    
    <!-- (Ajax Modal)-->
          
     
          
    
    <script type="text/javascript">
    function confirm_modal(delete_url)
    {
        jQuery('#modal-4').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
    </script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog" >
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link"><?php echo 'delete';?></a>
                    <!--<button type="button" class="btn btn-info" data-dismiss="modal"><?php echo 'cancel';?></button>-->
                </div>
            </div>
        </div>
    </div>



       @endsection