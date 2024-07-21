<?php

while ($Result = mysqli_fetch_array($ExecQuery)) {
  ?>
  <div class="card">
    <div class="card-content">
      <h2><?php echo $Result['Name']; ?></h2>
      <!-- Add more details here, such as description, image, etc. -->
      <p><?php echo $Result['Description']; ?></p>
    </div>
  </div>
  <?php
}
?>