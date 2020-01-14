<?php

use wishlist\Chemins;

$JS   = Chemins::$JS;
$NODE = Chemins::$NODEJS;

echo <<< footer
        </div>
        <footer class="page-bottom">
            <hr>
            <div>Copyright &copy; My Wishlist 2019-2020 <br>
                 BERGERON Ghilain, GREGOIRE Dylan, GACHENOT Antoine</div>
        </footer>
    </body>

    <script async src="$NODE/argon2-browser/lib/argon2.js"></script>
    <script async src="$JS/ajax.js"></script>
    <script async src="$JS/utils.js"></script>
</html>
footer;

?>