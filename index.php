<?php

if(isset($_SESSION['admin_id'])) {
  echo "<script>window.location='admin/dashboard'</script>"; 
} else {
  echo "<script>window.location='admin/login'</script>"; 
}


?>