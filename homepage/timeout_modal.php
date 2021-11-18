<div class="modal fade" id="logout_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div style="width:100%;height:100%;margin: 0px; padding:0px">
                    <div style="margin: 0px; padding:0px;float:">
                        <h4>Your session is about to expire!</h4>
                        <p style="font-size: 15px;">You will be logged out in <span id="timer" style="display: inline;font-size: 30px;font-style: bold">10</span> seconds.</p>              
                        <p style="font-size: 15px;">Do you want to stay signed in?</p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div style="margin-left: 30%;margin-bottom: 20px;margin-top: 20px;">
                <a href="javascript:;" onclick="resetTimer()" class="btn btn-success" aria-hidden="true">Yes, Keep me signed in</a>
                <a href='logout.php' class="btn btn-danger" aria-hidden="true">No, Sign me out</a>
            </div>
        </div>
    </div>
</div>