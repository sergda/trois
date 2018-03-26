        <div class="catalog-feedback">
            <form name="sentMessage" class="form form-register1" id="fedbackForm"  novalidate>
                <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                <div class="modal-body form-group">


                    <div class="control-group">
                        <div class="controls">
                            <input type="text" name="name" class="form-control" onblur='if(this.value=="") this.placeholder="Your Name"' onfocus='if(this.value=="Your Name") this.value=""' placeholder="Your Name" id="name" required data-validation-required-message="Please, indicate Your Name" />
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <input type="email" name="email" class="form-control" onblur='if(this.value=="") this.placeholder="Your e-mail"' onfocus='if(this.value=="Your e-mail") this.value=""' placeholder="Your e-mail" id="email" required data-validation-required-message="Please, indicate Your e-mail" />
                        </div>
                    </div>
                    <div id="success"> </div>
                </div>
                <div class="modal-footer">
                    <!-- button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button -->
                    <input type="submit" class="btn btn-secondary form-button" value="Send">
                </div>
                <div id="success"> </div>
            </form>
        </div>