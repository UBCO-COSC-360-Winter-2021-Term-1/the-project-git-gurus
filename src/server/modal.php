<!-- Modal -->
<div class="modal fade" id="LogButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="LogButtonLabel">User Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php 
                if(!isset($_SESSION["user"])) {
                    include 'loginform.php';
                    echo('<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="http://cosc360.ok.ubc.ca/avivarma/newuser.php"><button type="button" class="btn btn-primary">New Account</button><a>
                    </div>');
                } else {
                    echo('<p>User signed in is ' . $_SESSION["user"] .' </p>');
                    include 'changepassword.php';
                    echo('<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="http://cosc360.ok.ubc.ca/avivarma/logout.php"><button type="button" class="btn btn-primary">Log Out</button><a>
                    </div>');
                }
                ?>
            </div>
            
        </div>
    </div>
</div>