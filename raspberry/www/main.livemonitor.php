<div id="terminal1" class="terminal">
<ul class="list-group">
            	<li class="list-group-item twoliner">
			<div class="col-xs-2">
				Info:
			</div>
			<div class="col-xs-6">
				<span id="distribution"></span>
			</div>
			<div class="col-xs-4">
				<span id="kernel"></span>
			</div>
			<div class="col-xs-2">
				&nbsp;
			</div>
			<div class="col-xs-6">
				<span id="uptime"></span>
			</div>
			<div class="col-xs-4">
				Apt Updates: <span id="updates"></span>
			</div>
		</li>
            	<li class="list-group-item oneliner">
			<div class="col-xs-2">
				Performance:
			</div>
			<div class="col-xs-6">
				Load: <span id="load1"></span>, <span id="load5"></span>, <span id="load15"></span>
			</div>
			<div class="col-xs-4">
				Procs: <span id="procs"></span> (<span id="procsrunning"></span>/<span id="procssleeping"></span>/<span id="procszombies"></span>)
			</div>
		</li>
            	<li class="list-group-item twoliner">
			<div class="col-xs-2">
				Memory:
			</div>
			<div class="col-xs-6">
				Total RAM: <span id="totalram"></span> Mb
			</div>
			<div class="col-xs-4">
				Used RAM: <span id="usedram"></span> Mb
			</div>
			<div class="col-xs-2">
				&nbsp;
			</div>
			<div class="col-xs-6">
				Total Swap: <span id="totalswap"></span> Mb
			</div>
			<div class="col-xs-4">
				Used Swap: <span id="usedswap"></span> Mb
			</div>
		</li>
            	<li class="list-group-item oneliner">
			<div class="col-xs-2">
				Disk:
			</div>
			<div class="col-xs-6">
				Read: <span id="diskread"></span>
			</div>
			<div class="col-xs-4">
				Write: <span id="diskwrite"></span>
			</div>
		</li>
            	<li class="list-group-item oneliner">
			<div class="col-xs-2">
				Network:
			</div>
			<div class="col-xs-6">
				Incoming: <span id="netin"></span>
			</div>
			<div class="col-xs-4">
				Outgoing: <span id="netout"></span>
			</div>
		</li>
            	<li class="list-group-item oneliner">
			<div class="col-xs-2">
				MySQL:
			</div>
			<div class="col-xs-2">
				Sleeps: <span id="sleeps"></span>
			</div>
			<div class="col-xs-3">
				Queries: <span id="queries"></span>
			</div>
			<div class="col-xs-2">
				qps: <span id="qps"></span>
			</div>
			<div class="col-xs-3">
				Slow Queries: <span id="slowqueries"></span>
			</div>
		</li>
            	<li class="list-group-item oneliner">
			<div class="col-xs-2">
				CPU:
			</div>
			<div class="col-xs-10">
				<span id="usage"></span>
			</div>
		</li>
            	<li class="list-group-item oneliner">
			<div class="col-xs-2">
				Sensors:
			</div>
			<div class="col-xs-3">
				SYSTIN: <span id="systin"></span>
			</div>
			<div class="col-xs-3">
				CPUTIN: <span id="cputin"></span>
			</div>
			<div class="col-xs-4">
				AUXTIN: <span id="auxtin"></span>
			</div>
		</li>
            	<li class="list-group-item twoliner">
			<div class="col-xs-2">
				Status:
			</div>
			<div class="col-xs-10">
				<span id="apps1"></span>
			</div>
			<div class="col-xs-2">
				&nbsp;
			</div>
			<div class="col-xs-10">
				<span id="apps2"></span>
			</div>
		</li>
          </ul>
</div>
<script type="text/javascript">
$( document ).ready(function() {
  $.ajaxSetup({
    cache: false,
    async: true
  });
  get_livemon();
});
</script>

