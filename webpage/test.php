<?php
$q = $_REQUEST["q"];
$t = $_REQUEST["t"];
?>
<div id="M<?php echo $q; ?>"class="w3-row" style="margin-left: 15%; margin-top: 30px">
     <div class="w3-panel w3-grey w3-display-container w3-dropdown-click w3-animate-opacity" style="height: 100px; width: 70%">
            <div onclick="expandQuestion('Q<?php echo $q; ?>')" class="w3-display-left w3-dark-grey w3-center" style="width: 50%; height: 100px">
                <p>Test Station <?php echo $q; ?></p>
            </div>
            <div class="w3-display-right w3-grey w3-center" style="width: 50%">
                <p>Test Tag</p>
                <p>Timestamp</p>
            </div>
            <span onclick="closeQuestion('Q<?php echo $q; ?>'), this.parentElement.style.display = 'none', this.parentElement.parentElement.style.display = 'none'"
                  class="w3-button w3-border w3-dark-grey w3-large w3-display-topright" style="height: 51px">&times;</span>
        </div>
        <textarea id="Q<?php echo $q; ?>" class="w3-border w3-hide w3-container w3-animate-opacity" rows="4" readonly="" style="height: 100px; width: 59.5%; margin-bottom: 20px"><?php echo $t; ?>
        </textarea>
</div>