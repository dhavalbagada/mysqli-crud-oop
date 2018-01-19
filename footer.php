  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-notify.js"></script>
  <script type="text/javascript" src="assets/js/signup-login.js"></script>
  <!--<script type="text/javascript" src="assets/js/jquery.tabledit.js"></script>
  <script type="text/javascript" src="assets/js/jquery.tabledit.min.js"></script>-->
  <script type="text/javascript" src="assets/js/jquery-confirm.min.js"></script>   
  <script type="text/javascript" src="assets/js/notify/pnotify.core.js"></script>
 <script type="text/javascript" src="assets/js/notify/pnotify.buttons.js"></script>
 <script type="text/javascript" src="assets/js/notify/pnotify.nonblock.js"></script>
 
 

	<script type="text/javascript">

	 $(function(){
		 var message = '<?php echo (isset($msg)) ? $msg : ""; ?>';
		 var type2 = '<?php echo (isset($type)) ? $type : ""; ?>';
	  if(message !=''){
		 
		 new PNotify({
		  title: type2,
		  text: message,
		  type: type2,
		  delay: 2000,
		   top:"500px"
		 });
	  }// if(message !=''){
		
	 });//$(function(){

	 </script>
</body>
</html>