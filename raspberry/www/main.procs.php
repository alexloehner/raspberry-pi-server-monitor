<?php
/**
 * Created by PhpStorm.
 * User: Alexander Löhner
 * Date: 18.10.2015
 * Time: 11:51
 */
?><div id="terminal2" class="terminal">Loading...</div>
<script type="text/javascript">
$( document ).ready(function() {
  $.ajaxSetup({
    cache: false,
    async: true
  });
  get_procs();
});
</script>

