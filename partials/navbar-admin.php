<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<link rel="stylesheet" href="../../css/Admin/home-admin.css">
<header>
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>BBBOOTSTRAP</h3>
            <hr>
        </div>
        <ul class="list-unstyled components">
            <p>MENUS</p>
            <li> <a href="../../pages/Admin/home-admin.php">Home</a> </li>
            <li> <a href="../../pages/Admin/users.php">Users</a> </li>
            <li> <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Subscribers</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li> <a href="#">Active</a> </li>
                    <li> <a href="#">Idle</a> </li>
                    <li> <a href="#">Non Active</a> </li>
                </ul>
            </li>
            <li> <a href="#">Timeline</a> </li>
            <li> <a href="#">Live Chat</a> </li>
            <li> <a href="#">Likes</a> </li>
            <li> <a href="#">Comments</a> </li>
        </ul>
        <ul class="list-unstyled CTAs">
            <li> <a href="../../logout.php" class="download">Subscribe</a> </li>
        </ul>
    </nav>
 
                                <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'></script>
                                <script type='text/javascript' src=''></script>
                                <script type='text/javascript' src=''></script>
                                <script type='text/Javascript'>$(document).ready(function(){
$("#sidebarCollapse").on('click', function(){
$("#sidebar").toggleClass('active');
});
});</script>
</header>