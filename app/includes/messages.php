<!-- Checking the message 1st if it exit or not before displaying it -->
<?php if(isset($_SESSION['message'])): ?>
    <div class="msg <?php echo $_SESSION['type']; ?>">
        <li><?php echo $_SESSION['message']; ?></li>

        <!-- Removing the message e.g. When you refresh -->
        <?php
        unset($_SESSION['message']);
        unset($_SESSION['type']);
        ?>
    </div>
<?php endif; ?>